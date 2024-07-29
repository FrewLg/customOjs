<?php

/**
 * @file plugins/generic/reviewerCredits/ReviewerCreditsReportDAO.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewerCreditsReportDAO
 * @ingroup plugins_reports_review
 * @see ReviewReportPlugin
 *
 * @brief Review report DAO
 */

 namespace APP\plugins\generic\reviewerCredits;

 use PKP\db\DAO;
 use PKP\db\DAORegistry;
 use APP\core\Application;
 use PKP\submission\SubmissionComment;

class ReviewerCreditsReportDAO extends DAO {
	/**
	 * Get the review report data.
	 *
	 * @param $contextId int Context ID
	 *
	 * @return array
	 */
	function getReviewReport( $contextId ) {

		$comments = $this->getComments( $contextId );

		$reviews = $this->getReviews( $contextId );

		$responses = $this->getResponses();

		return [ $comments, $reviews, $responses ];
	}

	/**
	 * @param int $contextId
	 *
	 * @return array
	 */
	private function getComments( int $contextId ): array {

		$comments         = array();

		$queryTemplate = 'SELECT DISTINCT sc.submission_id,
						sc.comments,
						sc.author_id,
						r.review_id
					FROM submission_comments sc
					JOIN submissions s ON (s.submission_id = sc.submission_id)
					JOIN review_assignments r ON (sc.assoc_id = r.review_id)
					WHERE comment_type = ? AND s.context_id = ? AND sc.viewable = 1';

		if (class_exists('\PKP\submission\SubmissionComment')) {
			$commentType = \PKP\submission\SubmissionComment::COMMENT_TYPE_PEER_REVIEW;
		}
		// Prepare and execute the query using the determined comment type
		$commentsReturner = $this->retrieve(
			$queryTemplate,
			[$commentType, (int) $contextId]
		);

		$comments = iterator_to_array( $commentsReturner );

		return $comments;
	}

/**
 * @param int $contextId
 * @return array
 */
private function getReviews( int $contextId ): array {
    $application = new Application();
    $site = $application->getRequest()->getSite();
    $sitePrimaryLocale = $site->getPrimaryLocale();

    $query = "SELECT DISTINCT 
                r.review_id as review_id,
                a.submission_id AS submission_id,
                u.user_id AS reviewer_id,
                u.username,
                us1.setting_value as user_given,
                us2.setting_value as user_family,
                u.email,
                us3.setting_value as affiliation,
                r.date_due AS date_due,
                r.date_response_due AS date_response_due,
                r.date_completed AS date_completed,
                r.recommendation AS recommendation
              FROM review_assignments r
              LEFT JOIN submissions a ON r.submission_id = a.submission_id
              LEFT JOIN users u ON u.user_id = r.reviewer_id
			  LEFT JOIN user_settings us1 ON (u.user_id = us1.user_id AND us1.setting_name = 'givenName' AND us1.locale = ?)
			  LEFT JOIN user_settings us2 ON (u.user_id = us2.user_id AND us2.setting_name = 'familyName' AND us2.locale = ?)
              LEFT JOIN user_settings us3 ON (u.user_id = us3.user_id AND us3.setting_name = 'affiliation' AND us3.locale = ?)
              LEFT JOIN user_settings us4 ON (u.user_id = us4.user_id AND us4.setting_name = 'orcid')
              WHERE a.context_id = ?
              ORDER BY r.review_id DESC";

    $params = [
        $sitePrimaryLocale,  // firstName locale
        $sitePrimaryLocale,  // lastName locale
        $sitePrimaryLocale,  // affiliation locale
        (int) $contextId     // context ID
    ];

    $reviewsReturner = $this->retrieve($query, $params);

    $reviews = [];
	foreach ($reviewsReturner as $result) {
		$row = new \stdClass(); 
		$row->review_id = $result->review_id;
		$row->submission_id = $result->submission_id;
		$row->reviewer_id = $result->reviewer_id;
		$row->date_due = $result->date_due;
		$row->date_response_due = $result->date_response_due;
		$row->date_completed = $result->date_completed;
		$row->recommendation = $result->recommendation;
		$row->user_family = $result->user_family;       // Access as object properties, not array
		$row->user_given = $result->user_given;
		$reviews[] = $row;
	}
	

    return $reviews;
}





	private function getResponses() {

		$responses         = array();
		$responsesReturner = $this->retrieve(
			"SELECT r.review_id, r.response_value FROM review_form_responses r
 					JOIN review_form_elements e ON e.review_form_element_id = r.review_form_element_id AND e.included != 0
 					WHERE r.response_type = 'string' "
		);

		$responses     = iterator_to_array( $responsesReturner );
		$tempResponses = array();
		foreach ( $responses as $result ) {
			$tempResponses[ $result->review_id ][] = $result;
		}
		$responses = $tempResponses;

		return $responses;

	}
}
