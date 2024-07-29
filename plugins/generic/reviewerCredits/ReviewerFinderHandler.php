<?php

 namespace APP\plugins\generic\reviewerCredits;

 use PKP\db\DAO;
 use PKP\security\Validation;
 use PKP\core\Core;
 use PKP\security\Role;
 use APP\facades\Repo;
 use APP\notification\NotificationManager;
 use PKP\notification\PKPNotification;


class ReviewerFinderHandler extends DAO
{

    /** @var int */
    var $contextId;

    /** @var object */
    var $plugin;

    /**
     * Constructor
     *
     * @param object $plugin
     * @param int $contextId
     */
    public function __construct($plugin, $contextId)
    {
        $this->contextId = $contextId;
        $this->plugin = $plugin;
    }

    /**
     * Fetch the data.
     */
    public function fetch($request, $template = null, $display = false)
    {
        $submissionId = $request->getUserVar('submissionId');

        if (!$submissionId) {
            return json_encode(['error' => 'No submission ID provided']);
        }

        $submission = Repo::submission()->get($submissionId);
        if (!$submission) {
            return json_encode(['error' => 'Submission not found']);
        }

        $submissionIDFromReviewerCredits = $this->getReviewerCreditsSubmissionId($submissionId);

        if ($submissionIDFromReviewerCredits) {
            $reviewerCandidates = $this->getReviewerCandidates($submissionIDFromReviewerCredits);
            return $reviewerCandidates;
        }

        $journal = $request->getJournal();
        $journalTitle = $journal->getLocalizedPageHeaderTitle();
        $journalEISSN = $journal->getData('onlineIssn');
        $journalPISSN = $journal->getData('printIssn');
        $journalContactEmail = $journal->getData('contactEmail');
        $originManuscriptId = "S" . $submissionId;

        $publication = $submission->getCurrentPublication();

        $authorsData = [];
        foreach ($publication->getData('authors') as $author) {
            $orcidUrl = $author->getData('orcid');
            $orcidId = null;
            if ($orcidUrl) {
                $orcidId = preg_replace('/^https:\/\/orcid\.org\//', '', $orcidUrl);
            }

            $authorData = [
                'name' => $author->getData('givenName') . ' ' . $author->getData('familyName'),
                'ORCID' => $orcidId,
                'email' => $author->getData('email')
            ];

            $authorsData[] = $authorData;
        }

        // Encode authorsData as a JSON string
        $encodedAuthorsData = json_encode(['authorsData' => $authorsData]);

        $data = [
            'journalTitle' => $journalTitle,
            'journalContactEmail' => $journalContactEmail,
            'originManuscriptId' => $originManuscriptId,
            'manuscriptTitle' => $submission->getLocalizedTitle(),
            'abstract' => strip_tags($submission->getLocalizedAbstract()),
            'authorsData' => $encodedAuthorsData,
            'manuscriptSourceFile' => "",
            'reviewerRegisterLink' => ""
        ];

        $emptyFields = [];
        foreach ($data as $key => $value) {
            if (empty($value) && $key != 'manuscriptSourceFile' && $key != 'reviewerRegisterLink') {
                $emptyFields[] = $key;
            }
        }

        if (empty($journalEISSN) && empty($journalPISSN)) {
            $emptyFields[] = 'P-ISSN';
            $emptyFields[] = 'E-ISSN';
        }

        if (!empty($emptyFields)) {
            return json_encode(['emptyFields' => implode(', ', $emptyFields)]);
        }
        $data ['journalEIssn'] = $journalEISSN;
        $data ['journalPIssn'] = $journalPISSN;

        $apiAuthTokenResponse = $this->plugin->getApiAuthTokenResponse();

        if (empty($apiAuthTokenResponse)) {
            return null;
        }

        if ($apiAuthTokenResponse->error) {
            $notificationManager = new NotificationManager();
            $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, array('contents' => __('plugins.generic.reviewerCredits.notification.failedAuth')));
            return null;
        }

        $output = new \stdClass();
        $response = $this->plugin->_makeApiCall(REVIEWER_CREDITS_SAVE_SUBMISSION_ENDPOINT, $data, $apiAuthTokenResponse->data);
        $outputMessage = "";

        if ($response->status != 200) {  // Error
            $output->error = true;
            $outputMessage = $response->payload->message;

        } else {
            $submissionIdFromReviewerCredits = $response->payload->payload->submissionId;
            $this->setSubmissionIdFromReviewerCreditsToDB($submissionIdFromReviewerCredits, $submissionId);

            $submissionIDFromReviewerCredits = $this->getReviewerCreditsSubmissionId($submissionId);

            $reviewerCandidates = $this->getReviewerCandidates($submissionIdFromReviewerCredits);
            return $reviewerCandidates;
        }

        if (!empty($outputMessage)) {
            // There is an error
            $notificationManager = new NotificationManager();
            $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, $outputMessage);
        }

        return json_encode($response);
    }


    /**
     * Get reviewer candidates from ReviewerCredits by using a GET API call.
     */
    private function getReviewerCandidates($submissionIDFromReviewerCredits, $isSecondTime = false)
    {
        $apiAuthTokenResponse = $this->plugin->getApiAuthTokenResponse();
        $url = REVIEWER_CREDITS_URL . REVIEWER_CREDITS_GET_REVIEWER_CANDIDATES_ENDPOINT . '?submissionId=' . urlencode($submissionIDFromReviewerCredits);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiAuthTokenResponse->data,
        ]);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode != 200) {
            if ($httpcode == 403) {
                if (!$isSecondTime) {
                    $this->plugin->getNewApiTokenResponse();
                    return $this->getReviewerCandidates($submissionIDFromReviewerCredits, true);
                } else {
                    return json_encode(['tokenError' => 'There was an error with the token. Please try again.']);
                }
            }
            return $response;
        }

        $reviewers = json_decode($response, true);
        $filteredReviewers = [];

        foreach ($reviewers['payload'] as $key => $reviewer) {
            if (empty($reviewer['name']) || empty($reviewer['email']) || empty($reviewer['affiliation'])) {
                continue;
            }

            $username = $this->generateUsername($reviewer['email']);
            $existingUser = Repo::user()->getByUsername($username);
            $existingUserByEmail = Repo::user()->getByEmail($reviewer['email']);
            $reviewer['registered'] = $existingUser || $existingUserByEmail ? 1 : 0;

            // Add the valid reviewer to the filtered list
            $filteredReviewers[] = $reviewer;
        }

        return json_encode(['payload' => $filteredReviewers]);
    }

    /**
     * Add or update the submission ID from ReviewerCredits in the database.
     */
    private function setSubmissionIdFromReviewerCreditsToDB($reviewerCreditsSubmissionId, $submissionId)
    {
        // Get the submission object

        $submission = Repo::submission()->get($submissionId);
        if (!$submission) {
            error_log("Failed to retrieve submission with ID: " . $submissionId);
        }

        $sql = "INSERT INTO submission_settings (submission_id, setting_name, setting_value, locale)
                VALUES (?, 'reviewerCreditsSubmissionId', ?, '')
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
        $params = [$submissionId, $reviewerCreditsSubmissionId];
        $result = $this->update($sql, $params);

        if ($result) {
            return true;
        } else {
            error_log("Failed to add submission ID from ReviewerCredits to the database");
            return false;
        }
    }

    private function getReviewerCreditsSubmissionId($submissionId)
    {
        $submission = Repo::submission()->get($submissionId);

        if (!$submission) {
            return false;
        }

        $sql = "SELECT setting_value FROM submission_settings WHERE submission_id = ? AND setting_name = 'reviewerCreditsSubmissionId'";
        $params = [$submissionId];
        $result = $this->retrieve($sql, $params);

        $row = $result->current();
        if ($row) {
            $reviewerCreditsSubmissionId = $row->setting_value;
            return $reviewerCreditsSubmissionId;
        } else {
            return false;
        }
    }

    public function addReviewerFromReviewerCredits($request)
    {
        $context = $request->getContext();

        $sql = "SELECT user_group_id FROM user_groups WHERE context_id = ? AND role_id = ?";
        $params = [$context->getId(), Role::ROLE_ID_REVIEWER];
        $result = $this->retrieve($sql, $params);

        $row = $result->current();
        if ($row) {
            $userGroupId = $row->user_group_id;
        } else {
            return json_encode(['error' => 'Failed to retrieve user group ID for reviewer']);
        }

        $user = Repo::user()->newDataObject();
        $reviewerDataJson = $request->getUserVar('reviewerData');
        $reviewerData = json_decode($reviewerDataJson, true);
        $primaryLocale = $context->getPrimaryLocale();

        if (!$reviewerData) {
            error_log("Failed to decode reviewer data.");
            return json_encode(['error' => 'Invalid reviewer data provided']);
        }

        $email = $reviewerData['email'];
        $username = $this->generateUsername($email);


        $existingUser = Repo::user()->getByUsername($username);
        $existingUserByEmail = Repo::user()->getByEmail($email);
        if ($existingUser || $existingUserByEmail) {
            return json_encode(['userExists' => 'User is already exists in your system.']);
        }

        $name = $reviewerData['name'];
        $nameArray = explode(" ", $name);
        $familyName = array_pop($nameArray);
        $givenName = implode(" ", $nameArray);

        $affiliation = $reviewerData['affiliation'];

        // Set multilingual fields
        $user->setGivenName($givenName, $primaryLocale);
        $user->setFamilyName($familyName, $primaryLocale);
        $user->setAffiliation($affiliation, $primaryLocale);

        $user->setEmail($email);
        $user->setInlineHelp(1);


        $password = Validation::generatePassword();

        $user->setUsername($username);
        $user->setPassword(Validation::encryptCredentials($username, $password));
        $user->setMustChangePassword(true);
        $user->setDateRegistered(Core::getCurrentDate());


        $reviewerId = Repo::user()->add($user);

        // Insert the user interests
        if (!empty($args['interests'])) {
            $interestManager = new \PKP\user\InterestManager();
            $interestManager->setInterestsForUser($user, $args['interests']);
        }

        Repo::userGroup()->assignUserToGroup($reviewerId, $userGroupId);
    


        // Send welcome email to user, if applicable
        if (!$request->getUserVar('skipEmail')) {
            $this->sendWelcomeEmail($user, $password, $request, $context);
        }

        return json_encode(['success' => 'Reviewer added successfully']);
    }

    private function generateUsername($email)
    {
        $usernamePart = strstr($email, '@', true);
        return strtolower($usernamePart);
    }


    private function sendWelcomeEmail($user, $password, $request, $context)
    {
        // Code for OJS 3.4
        $mailable = new \PKP\mail\mailables\ReviewerRegister($context, $password);
        $mailable->recipients($user);
        $mailable->sender($request->getUser());
        $mailable->replyTo($context->getData('contactEmail'), $context->getData('contactName'));
        $template = Repo::emailTemplate()->getByKey($context->getId(), \PKP\mail\mailables\ReviewerRegister::getEmailTemplateKey());
        $mailable->subject($template->getLocalizedData('subject'));
        $mailable->body($template->getLocalizedData('body'));

        try {
            \Illuminate\Support\Facades\Mail::send($mailable);
        } catch (\Symfony\Component\Mailer\Exception\TransportException $e) {
            error_log($e->getMessage());
            $notificationMgr = new \APP\notification\NotificationManager();
            $notificationMgr->createTrivialNotification(
                $request->getUser()->getId(),
                \PKP\notification\PKPNotification::NOTIFICATION_TYPE_ERROR,
                ['contents' => __('email.compose.error')]
            );
        }
    }
}