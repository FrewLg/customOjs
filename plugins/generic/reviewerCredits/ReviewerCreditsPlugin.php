<?php

/**
 * @file plugins/generic/reviewerCredits/ReviewerCreditsPlugin.php
 *
 * Copyright (c) 2015-2018 University of Pittsburgh
 * Copyright (c) 2014-2018 Simon Fraser University
 * Copyright (c) 2003-2018 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ReviewerCreditsPlugin
 * @ingroup plugins_generic_reviewerCredits
 *
 * @brief ReviewerCredits plugin class
 */

 namespace APP\plugins\generic\reviewerCredits;

 use PKP\plugins\GenericPlugin;
 use APP\notification\NotificationManager;
 use PKP\core\JSONMessage;
 use APP\template\TemplateManager;
 use PKP\notification\PKPNotification;
 use PKP\config\Config;
 use PKP\plugins\Hook;
 use PKP\plugins\PluginRegistry;
 use PKP\Submission;
 use PKP\ReviewRoundDAO;
 use PKP\reviewForm\ReviewFormResponseDAO;
 use  PKP\reviewForm\ReviewFormElementDAO;
 use PKP\UserDAO;
 use PKP\linkAction\LinkAction;
 use PKP\linkAction\request\AjaxModal;
 use APP\core\Application;
 use PKP\db\DAORegistry;
 use PKP\facades\Locale;
 use APP\facades\Repo;
 use Illuminate\Support\Facades\Event;
 use DateTime;
 

define('REVIEWER_CREDITS_URL', 'https://www.reviewercredits.com/wp-json');
define('REVIEWER_CREDITS_AUTH_ENDPOINT', '/jwt-auth/v1/token');
define('REVIEWER_CREDITS_CLAIM_ENDPOINT', '/reviewer-credits/v10/journal/claim');
define('REVIEWER_CREDITS_EDITOR_DECISION_ENDPOINT', '/reviewer-credits/v10/journal/editorDecision');
define('REVIEWER_CREDITS_SAVE_SUBMISSION_ENDPOINT', '/reviewer-credits/v10/submission/proposal');
define('REVIEWER_CREDITS_GET_REVIEWER_CANDIDATES_ENDPOINT', '/reviewer-credits/v10/submission/reviewerCandidates');

//define('REVIEWER_CREDITS_BASIC_AUTH_CRED', 'user:passwd');

class ReviewerCreditsPlugin extends GenericPlugin
{

    protected $_apiFlag = false;
    protected $_consentFlag = true;
    private $_rvFinderFlag = false;

    /**
     * @copydoc Plugin::register()
     */
    public function register($category, $path, $mainContextId = null)
    {

        $success = parent::register($category, $path, $mainContextId);
        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) {
            return true;
        }
        if ($success && $this->getEnabled($mainContextId)) {
            Hook::register('LoadHandler', array($this, 'callbackGetInfo'));
            Hook::register('TemplateManager::fetch', array($this, 'handleTemplateDisplay'));
            Hook::register('reviewerreviewstep3form::execute', array($this, 'callbackSendClaim'));


            $reportPlugin = new ReviewerCreditsReportPlugin();
            PluginRegistry::register('reports', $reportPlugin, $this->getPluginPath());

            $editorialDecisionReportPlugin = new ReviewerCreditsEditorialDecisionReportPlugin();
            PluginRegistry::register('reports', $editorialDecisionReportPlugin, $this->getPluginPath());

            $f3enabled = $this->getSetting($this->getCurrentContextId(), 'reviewerCreditsJournalF3');
            if (!empty($f3enabled) && $f3enabled) {
//				error_log("EditorialDecisionAPI registered");
                Event::subscribe(new EditorialDecisionListener());
            }
            $this->_registerTemplateResource();
        }

        return $success;
    }

    /**
     * @copydoc Plugin::getDisplayName()
     */
    public function getDisplayName()
    {
        return __('plugins.generic.reviewerCredits.displayName');
    }

    /**
     * @copydoc Plugin::getDescription()
     */
    public function getDescription()
    {
        return __('plugins.generic.reviewerCredits.description');
    }

    /**
     * @copydoc Plugin::getActions()
     */
    public function getActions($request, $verb)
    {
        $router = $request->getRouter();

        return array_merge(
            $this->getEnabled() ? array(
                new LinkAction(
                    'settings',
                    new AjaxModal(
                        $router->url($request, null, null, 'manage', null, array(
                            'verb' => 'settings',
                            'plugin' => $this->getName(),
                            'category' => 'generic'
                        )),
                        $this->getDisplayName()
                    ),
                    __('manager.plugins.settings'),
                    null
                ),
            ) : array(),
            parent::getActions($request, $verb)
        );
    }

    /**
     * @see Plugin::manage()
     */
    public function manage($args, $request)
    {
        $notificationManager = new NotificationManager();
        $context = $request->getContext();
        $contextId = ($context == null) ? 0 : $context->getId();

        //Checking if the plugin installed in correct directory.
        if ($this->pluginPath !== "plugins/generic/reviewerCredits") {
            $notificationManager->createTrivialNotification($contextId,  PKPNotification::NOTIFICATION_TYPE_ERROR, array('contents' => __('plugins.generic.reviewerCredits.manager.settings.invalidPath')));
        }
        switch ($request->getUserVar('verb')) {
            case 'settings':
                // SHOULD TRY FOR 3.4.0
                //$templateMgr = APP\template\TemplateManager::getManager();
                //$templateMgr->register_function( 'plugin_url', array( $this, 'smartyPluginUrl' ) );
                /* Future implementation
                $apiOptions = array(
                    RC_API_REV_ID_TYPE_EMAIL => 'plugins.generic.reviewerCredits.manager.settings.rcReviewerIdType.email',
                    RC_API_REV_ID_TYPE_ORCID => 'plugins.generic.reviewerCredits.manager.settings.rcReviewerIdType.orcid',
                );

                $templateMgr->assign('rcReviewerIdType', $apiOptions);*/

                $form = new ReviewerCreditsSettingsForm($this, $contextId);

                $notificationManager = new NotificationManager();
                if ($request->getUserVar('save')) {
                    $form->readInputData();
                    if ($form->validate()) {
                        $form->execute();
                        //Showing journal credentials successfully configured message.
                        $notificationManager->createTrivialNotification($contextId,  PKPNotification::NOTIFICATION_TYPE_SUCCESS, array('contents' => __('plugins.generic.reviewerCredits.manager.settings.success')));
                        return new JSONMessage(true);
                    }
                } else {
                    $form->initData();
                }
                return new JSONMessage(true, $form->fetch($request));
                break;
            case 'reviewerFinder':
                $reviewerFinder = new ReviewerFinderHandler($this, $contextId);
                $fetchResult = $reviewerFinder->fetch($request);

                // Assuming fetch now returns a JSON string that represents an array/object
                $resultData = json_decode($fetchResult, true);

                // Check if decoding was successful and data is valid
                if ($resultData) {
                    return new \PKP\core\JSONMessage(true, $resultData);
                } else {
                    return new \PKP\core\JSONMessage(false, "Failed to fetch data");
                }
                break;
            case 'addReviewerFromReviewerCredits':
                $reviewerFinder = new ReviewerFinderHandler($this, $contextId);
                $fetchResult = $reviewerFinder->addReviewerFromReviewerCredits($request);

                // Assuming fetch now returns a JSON string that represents an array/object
                $resultData = json_decode($fetchResult, true);

                // Check if decoding was successful and data is valid
                // Check if decoding was successful and data is valid
                if ($resultData) {
                    return new \PKP\core\JSONMessage(true, $resultData);
                } else {
                    return new \PKP\core\JSONMessage(false, "Failed to fetch data");
                }
                break;

        }

        return parent::manage($args, $request);
    }

    /**
     * Check the correct operation to trigger the API Call
     */
    public function callbackGetInfo($hookName, $op)
    {
        if ($op[0] == 'reviewer' && $op[1] == 'saveStep') {
            $request = (new Application)->getRequest();
            $args = $request->getUserVars();
            if ($args['step'] == 3) {
                $this->_apiFlag = true;
            }
        }
    }

    /**
     * This method manage and send the Peer Review Claim information to ReviewerCredits
     */
    public function callbackSendClaim($hookName, $args)
    {
        if (!$this->_apiFlag or empty($_POST['confirmSendRC']) or $_POST['confirmSendRC'] != 1) {
            return;
        }

        $reviewAssignment = $args[0]->getReviewAssignment();
        $context = (new Application)->getRequest()->getContext();
        if (class_exists(\APP\facades\Repo::class)) {
            $userDao = \APP\facades\Repo::user()->dao;
        } else {
            error_log("Repo class not found. Using older methods.");
        }
        //$reviewerSubmission      = $args[0]->getReviewerSubmission();
        $reviewer = $userDao->get($reviewAssignment->getReviewerId());
        $claimPayload = new \stdClass();
        $claimPayload->firstName = $reviewer->getGivenName(Locale::getLocale());
        $claimPayload->lastName = $reviewer->getFamilyName(Locale::getLocale());

        $apiAuthTokenResponse = $this->getApiAuthTokenResponse();
        if (empty($apiAuthTokenResponse)) {
            return null;
        }


        $notificationManager = new NotificationManager();

        if ($apiAuthTokenResponse->error) {
            $notificationManager->createTrivialNotification($reviewer->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, array('contents' => __('plugins.generic.reviewerCredits.notification.failedAuth')));

            return;
        }
        //		error_log( "apiAuthToken: " . print_r( $apiAuthToken, true ) );

        $f3 = $this->getSetting($context->getId(), 'reviewerCreditsJournalF3');
        if (!empty($f3) && $f3 && !empty($_POST['confirmF3']) and $_POST['confirmF3'] == 1) {
            $this->addF3Fields($claimPayload, $reviewAssignment, $reviewAssignment->getReviewFormId());
        }

        $claimPayload->reviewerIdentifier = $reviewer->getOrcid();
        if (empty($claimPayload->reviewerIdentifier)) {
            // email only
            //no orcid saved. Identify with email.
            $claimPayload->reviewerIdentifier = $reviewer->getEmail();
            $claimPayload->email = $reviewer->getEmail();
            $claimPayload->reviewerIdentifierType = 'email';
        } else {
            // orcid & email
            $claimPayload->reviewerIdentifierType = 'orcid';
            $rawOrcid = preg_replace('{[^0-9X]}', '', $claimPayload->reviewerIdentifier);
            $hrOrcid = chunk_split($rawOrcid, 4, '-');
            $hrOrcid = substr($hrOrcid, 0, -1);
            $claimPayload->reviewerIdentifier = $hrOrcid;
            $claimPayload->email = $reviewer->getEmail();
        }

        $claimPayload->dateCompleted = DateTime::createFromFormat('Y-m-d H:i:s', $reviewAssignment->getDateCompleted())->format('Y/m/d');;
        $claimPayload->manuscriptID = 'S' . $reviewAssignment->getSubmissionId() . '-R' . $reviewAssignment->getRound();
        $claimPayload->dateDue = DateTime::createFromFormat('Y-m-d H:i:s', $reviewAssignment->getDateDue())->format('Y/m/d');
        $claimPayload->round = $reviewAssignment->getRound();
        usleep(50000);
        //		error_log( "claimPayload: " . print_r( $claimPayload, true ) );
        $apiClaimResponse = $this->_insertClaim($claimPayload, $apiAuthTokenResponse->data);
        //		error_log( "apiClaimResponse: " . print_r( $apiClaimResponse, true ) );

        if (property_exists($apiClaimResponse, 'placeholder')) {
            $message = $apiClaimResponse->placeholder ? array('contents' => __('plugins.generic.reviewerCredits.notification.placeholder')) : array('contents' => __('plugins.generic.reviewerCredits.notification.success'));
            $notificationManager->createTrivialNotification($reviewer->getId(), PKPNotification::NOTIFICATION_TYPE_SUCCESS, $message);
        } else if ($apiClaimResponse->error) {

            $errorMessage = array('contents' => __('plugins.generic.reviewerCredits.notification.failed'));
            $errorMessage .= property_exists($apiClaimResponse, "message") ? " Error description: " . $apiClaimResponse->message : "";

            $notificationManager->createTrivialNotification($reviewer->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, $errorMessage);
        } else {
            $notificationManager->createTrivialNotification($reviewer->getId(), PKPNotification::NOTIFICATION_TYPE_SUCCESS, array('contents' => __('plugins.generic.reviewerCredits.notification.success')));
        }
    }

    /**
     * This method manage and send the Editor Decision information to ReviewerCredits
     */
    public function callbackSendEditorDecision($hookName, $args, $event = null)
    {

//        error_log("editorDecision callback event: " . print_r($event, true));

        $notificationManager = new NotificationManager();

        try {

            $request = (new Application)->getRequest();
            $context = $request->getContext();

            $f3enabled = (new ReviewerCreditsPlugin())->getSetting($context->getId(), 'reviewerCreditsJournalF3');
            if (empty($f3enabled)) {
                return;
            }

            //error_log("editorDecision callback args: " . print_r($args, true));

            $apiAuthTokenResponse = $this->getApiAuthTokenResponse();

            if (empty($apiAuthTokenResponse)) {
                $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, array('contents' => __('plugins.generic.reviewerCredits.notification.failedAuth')));
                return null;
            }

            if ($apiAuthTokenResponse->error) {
                $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, array('contents' => __('plugins.generic.reviewerCredits.notification.failedAuth')));
                return;
            }

            /** @var UserDAO $userDao */
            $userDao = \APP\facades\Repo::user()->dao;

            /** @var Submission $submission */
            /** @var PKP\observers\events\DecisionAdded $event */
            $submission = $event->submission;

            /** @var ReviewRoundDAO $reviewRoundDao */
            $reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO');

//			$args[1] => Array
//			(
//				[editDecisionId] =>
//					[editorId] => 1
//	            [decision] => 17
//	            [dateDecided] => 2021-09-09 14:13:16
//	        )
            /** @var PKP\observers\events\DecisionAdded $event */
            $decision = $event->decision;
            $editor = $userDao->get($decision->getData('editorId'));
            $context = (new Application())->getRequest()->getContext();

            $decisionTexts = ReviewerCreditsEditorialDecisionReportPlugin::getDecisions();
//			error_log( "Request uservars: " . print_r( $request->getUserVars(), true ) );
            $round = null;
            if (!empty($request->getUserVar("reviewRoundId"))) {
                $round = $reviewRoundDao->getById($request->getUserVar("reviewRoundId"))->getRound();
            }
            $roundText = $round ? ('-R' . $round) : '';
            $editorDecisionPayload = new \stdClass();
            $editorDecisionPayload->journalTitle = $context->getName();
            $editorDecisionPayload->journalSubmissionId = 'S' . $submission->getId() . $roundText;
            $editorDecisionPayload->editorialDecision = $decisionTexts[$decision->getData('decision')];
            $editorDecisionPayload->editorialDecisionDate = $decision->getData('dateDecided');
            $editorDecisionPayload->stage = $request->getUserVar("stageId");
            $editorDecisionPayload->round = $round;

            $editorDataEnabled = (new ReviewerCreditsPlugin())->getSetting($context->getId(), 'reviewerCreditsEditorData');
            if (!empty($editorDataEnabled) && $editorDataEnabled) {
                $editorDecisionPayload->editorFullName = $editor->getFullName();
                $editorDecisionPayload->editorEmail = $editor->getEmail();
                $editorDecisionPayload->editorOrcid = $editor->getOrcid() ?? '';
                $editorDecisionPayload->editorCountry = $editor->getCountryLocalized() ?? '';
            }

            $output = new \stdClass();
            $response = $this->_makeApiCall(REVIEWER_CREDITS_EDITOR_DECISION_ENDPOINT, $editorDecisionPayload, $apiAuthTokenResponse->data);
            $outputMessage = "";
//			error_log( "response:" . print_r( $response, true ) );
            if ($response->status != 200) {  //Error
                $output->error = true;
                $outputMessage = $response->message;

                if (property_exists($response, 'payload') && property_exists($response->payload, 'message')) {
                    $outputMessage = $response->payload->message;
                }
            }

            if (!empty($outputMessage)) {
                //There is an error
                $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR, $outputMessage);
            }

        } catch (\Exception $e) {
            $message = "An error occured during integration with ReviewerCredits. Details: ";
            $notificationManager->createTrivialNotification($request->getUser()->getId(), PKPNotification::NOTIFICATION_TYPE_ERROR,
                $message . $e->getMessage());
            error_log($message . print_r($e, true));
        }

    }

    /**
     * Hook callback: register output filter.
     * @see TemplateManager::display()
     */
    public function handleTemplateDisplay($hookName, $args)
    {
        $templateMgr = $args[0];
        $template = $args[1];

        if ($template == 'controllers/tab/workflow/submission.tpl' && !$this->_rvFinderFlag) {
            $templateMgr->registerFilter('output', array($this, 'reviewerFinderFilter'));
        } elseif ($template == 'reviewer/review/step3.tpl') {
            if (method_exists($templateMgr, 'register_outputfilter')) {
                $templateMgr->register_outputfilter(array($this, 'profileFilter'));
            } else {
                $templateMgr->registerFilter('output', array($this, 'profileFilter'));
            }
        }

        return false;
    }

    /**
     * This method adds reviewerFinder.tpl to the output.
     *
     * @param $output string
     * @param $templateMgr TemplateManager
     *
     * @return $string
     */
    public function reviewerFinderFilter($output, $templateMgr)
    {
        if (!$this->_rvFinderFlag) {
            $this->_rvFinderFlag = true;
            if (method_exists($this, 'getTemplateResource')) {
                $output = $templateMgr->fetch($this->getTemplateResource('reviewerFinder.tpl')) . $output;
            }
        }

        return $output;
    }

    /**
     * Output filter adds ReviewerCredits checkbox to reviewer submission form.
     *
     * @param $output string
     * @param $templateMgr TemplateManager
     *
     * @return $string
     */
    public function profileFilter($output, $templateMgr)
    {
        if (preg_match('|div.*formButtons|', $output) && $this->_consentFlag == true) {
            if (!preg_match('|disabled|', $output)) {
                $this->_consentFlag = false;

                $request = (new Application)->getRequest();
                $f3 = $this->getSetting($request->getContext()->getId(), 'reviewerCreditsJournalF3');
                if (!empty($f3) && $f3) {
                    //show consent template with f3.
                    if (method_exists($this, 'getTemplateResource')) {
                        $output = $templateMgr->fetch($this->getTemplateResource('confirmRCEditF3.tpl')) . $output;
                    }

                } else {
                    //show normal consent template
                    if (method_exists($this, 'getTemplateResource')) {
                        $output = $templateMgr->fetch($this->getTemplateResource('confirmRCEdit.tpl')) . $output;
                    }
                }
            }
        }

        return $output;
    }

    /**
     * Journal credentials check.
     *
     * @param $username string
     * @param $password string
     *
     */
    public function verifyCredentials($username, $password): \stdClass
    {
        $authPayload = new \stdClass();
        $authPayload->username = $username;
        $authPayload->password = $password;
        $apiAuthTokenResponse = $this->_getTokenResponse($authPayload);

        return $apiAuthTokenResponse;
    }

    /**
     * This method call the ReviewerCredits API to obtain an authorization token response
     */
    protected function _getTokenResponse($authPayload): \stdClass
    {
        $tokenResponse = new \stdClass();
        $response = $this->_makeApiCall(REVIEWER_CREDITS_AUTH_ENDPOINT, $authPayload);
        if ($response->status != 200) {
            $errorMessage = "";
            if (property_exists($response, 'payload')) {
                $errorMessage = $response->payload->message;
            }
            if (property_exists($response->payload->data, 'json_error_message')) {
                if (!empty($errorMessage)) {
                    $errorMessage .= ' - ';
                }
                $errorMessage .= strip_tags($response->payload->data->json_error_message);
            }

            if (property_exists($response, 'message')) {
                $errorMessage .= $response->message;
            }
            $tokenResponse->error = true;
            $tokenResponse->data = $errorMessage;
        } else {
            $token = $response->payload->token;
            $tokenResponse->error = false;
            $request = Application::get()->getRequest();
            $context = $request->getContext();
            $contextId = $context ? $context->getId() : 0;
            $this->updateSetting($contextId, 'reviewerCreditsApiToken', $token);
            $tokenResponse->data = $token;
        }

        return $tokenResponse;
    }

    /**
     * This method call the ReviewerCredits API to create a new Peer Review Claim
     */
    protected function _insertClaim($claimPayload, $token)
    {
        $output = new \stdClass();
        $response = $this->_makeApiCall(REVIEWER_CREDITS_CLAIM_ENDPOINT, $claimPayload, $token);

        if ($response->status != 200 && $response->status != 422) {
            if (property_exists($response, 'payload')) {
                $outputMessage = $response->payload->message;
            }
            if (property_exists($response->payload, 'payload')) {
                $arrayMessage = array();
                foreach ($response->payload->payload as $key => $element) {
                    $arrayMessage[] = $key . ': ' . $element;
                }
                if (count($arrayMessage) > 0) {
                    if (!empty($outputMessage)) {
                        $outputMessage .= ' - ';
                    }
                    if (count($arrayMessage) > 1) {
                        $outputMessage .= join('; ', $arrayMessage);
                    } else {
                        $outputMessage .= $arrayMessage[0];
                    }
                }
            }
            $output->noUser = false;
            $output->error = true;
        } else {
            if ($response->status != 200) {
                $outputMessage = 0;
                $output->noUser = true;
                $output->error = true;
            } else {

                if (property_exists($response->payload, 'claimId')) {
                    $outputMessage = $response->payload->claimId;
                } else {
                    $outputMessage = $response->message;
                }

                if ($response->message == "placeholder") {
                    $output->placeholder = true;
                }

                $output->noUser = false;
                $output->error = false;
            }
        }
        $output->data = $outputMessage;

        return $output;
    }

    /**
     * This method make the call to the ReviewerCredits API using cURL
     */
    public function _makeApiCall($endpoint, $rawPayload, $token = null, $isSecondTime = false)
    {
        $output = new \stdClass();
        $payload = json_encode($rawPayload);
        $headers = array(
            'Content-Type:application/json',
            'Content-Length: ' . strlen($payload)
        );
        if (defined('REVIEWER_CREDITS_BASIC_AUTH_CRED')) {
            $headerAuth = 'Authorization: Basic ' . base64_encode(REVIEWER_CREDITS_BASIC_AUTH_CRED);
            if (!is_null($token)) {
                $headerAuth .= ', Bearer ' . $token;
            }
            $headers[] = $headerAuth;
        } else {
            if (!is_null($token)) {
                $headers[] = 'Authorization: Bearer ' . $token;
            }
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, REVIEWER_CREDITS_URL . $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $rawOutput = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($rawOutput === false) {
            $output->status = 0;
            $output->message = curl_error($ch);
        } else if ($httpStatus == 403) {
            if (!$isSecondTime) {
                //Running the method for the first time.
                $newTokenResponse = $this->getNewApiTokenResponse();
                if ($newTokenResponse->error) {
                    $output->status = $httpStatus;
                    $output->message = 'HTTP Status ' . $httpStatus;
                    $output->payload = json_decode($rawOutput);
                } else {
                    $output = $this->_makeApiCall($endpoint, $rawPayload, $newTokenResponse->data, true);
                }
            } else {
                //Running the method second time and had an error.
                $output->status = $httpStatus;
                $output->message = 'HTTP Status ' . $httpStatus;
                $output->payload = json_decode($rawOutput);
            }
        } elseif ($httpStatus != 200) {
            $output->status = $httpStatus;
            $output->message = 'HTTP Status ' . $httpStatus;
            $output->payload = json_decode($rawOutput);
        } else {
            $output->status = 200;
            $output->message = 'OK';
            $output->payload = json_decode($rawOutput);
        }

        curl_close($ch);

        return $output;
    }


    public function getNewApiTokenResponse()
    {
        $request = (new Application)->getRequest();
        $context = $request->getContext();
        $authPayload = new \stdClass();
        $authPayload->username = $this->getSetting($context->getId(), 'reviewerCreditsJournalLogin');
        $authPayload->password = $this->getSetting($context->getId(), 'reviewerCreditsJournalPassword');

        if (empty($authPayload->username) or empty($authPayload->password)) {
            return null;
        }

        $apiAuthTokenResponse = $this->_getTokenResponse($authPayload);
        if ($apiAuthTokenResponse->error) {
            return $apiAuthTokenResponse;
        }
        $this->updateSetting($context->getId(), 'reviewerCreditsApiToken', $apiAuthTokenResponse->data);

        return $apiAuthTokenResponse;
    }

    /**
     * @param stdClass $claimPayload
     * @param $reviewAssignment
     * @param $reviewId
     */
    private function addF3Fields(\stdClass $claimPayload, $reviewAssignment, $reviewId): void
    {
        $userVars = (new Application)->getRequest()->getUserVars();
//		error_log( "userVars: " . print_r( $userVars, true ) );

        $cleanComment = "";
        if (!empty($userVars["comments"])) {
            $cleanComment = strip_tags($userVars["comments"]);  //because in ojs you can add tags to the comment.
        }

        if (!empty($userVars["reviewFormResponses"])) {
            $reviewResponseDao = new ReviewFormResponseDAO();
            $reviewFormElementDao = new ReviewFormElementDAO();

            foreach ($userVars["reviewFormResponses"] as $index => $value) {
//				error_log( "reviewId: " . $reviewId . "  index:" . $index . " value: " . $value );
                $reviewFormResponse = $reviewResponseDao->getReviewFormResponse($reviewId, $index);
                $reviewFormElement = $reviewFormElementDao->getById($reviewFormResponse->getReviewFormElementId());

                if ($reviewFormElement->getIncluded() && is_string($value)) {
                    $cleanComment .= " " . $value;
                }
            }
        }

        $claimPayload->wordCount = str_word_count($cleanComment);

        $claimPayload->recommendation = $reviewAssignment->getLocalizedRecommendation();
        $claimPayload->acceptance = DateTime::createFromFormat('Y-m-d H:i:s', $reviewAssignment->getDateConfirmed())->format('Y/m/d');
    }

    /**
     * @return stdClass|null
     */
    public function getApiAuthTokenResponse(): ?\stdClass
    {
        $request = (new Application)->getRequest();
        $context = $request->getContext();

        // check if there is already a token in database
        $apiAuthToken = $this->getSetting($context->getId(), 'reviewerCreditsApiToken');
        if (!empty($apiAuthToken)) {
            $apiAuthTokenResponse = new \stdClass();
            $apiAuthTokenResponse->data = $apiAuthToken;
            $apiAuthTokenResponse->error = false;

            return $apiAuthTokenResponse;
        }

        //Get a new token if there is no token in the DB.
        $authPayload = new \stdClass();
        $authPayload->username = $this->getSetting($context->getId(), 'reviewerCreditsJournalLogin');
        $authPayload->password = $this->getSetting($context->getId(), 'reviewerCreditsJournalPassword');

        if (empty($authPayload->username) or empty($authPayload->password)) {
            return null;
        }

        $apiAuthTokenResponse = $this->_getTokenResponse($authPayload);
        if ($apiAuthTokenResponse->error) {
            return $apiAuthTokenResponse;
        }

        $apiAuthToken = $apiAuthTokenResponse->data;
        $this->updateSetting($context->getId(), 'reviewerCreditsApiToken', $apiAuthToken);

        return $apiAuthTokenResponse;
    }

}