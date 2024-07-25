<?php

/**
 * @file ReviewCreditsReportPlugin.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewReportPlugin
 * @ingroup plugins_reports_review
 * @see ReviewReportDAO
 *
 * @brief Review report plugin
 */

 namespace APP\plugins\generic\reviewerCredits;

 use PKP\db\DAORegistry;
 use PKP\facades\Locale;
 use PKP\plugins\ReportPlugin;
 use PKP\config\Config;
 use PKP\submission\reviewAssignment\ReviewAssignment;
 use APP\core\Request;
 use DateTime;

class ReviewerCreditsReportPlugin extends ReportPlugin {
	/**
	 * ReviewerCreditsReportPlugin constructor.
	 */
	public function __construct() {

		if ( Config::getVar( 'general', 'installed' ) ) {
			$reviewReportDAO = new ReviewerCreditsReportDAO();
			DAORegistry::registerDAO( 'ReviewerCreditsReportDAO', $reviewReportDAO );
		}
		$this->addLocaleData();

		return true;
	}

	/**
	 * @copydoc Plugin::getName()
	 */
	function getName() {
		return 'ReviewerCreditsReportPlugin';
	}

	/**
	 * @copydoc Plugin::getDisplayName()
	 */
	function getDisplayName() {
		return __( 'plugins.generic.reviewerCredits.report.displayName' );
	}

	/**
	 * @copydoc Plugin::getDescription()
	 */
	function getDescription() {
		return __( 'plugins.generic.reviewerCredits.report.description' );
	}

	/**
	 * @copydoc ReportPlugin::display()
	 * @param Request $request
	 */
	function display( $args, $request ) {
		$context = $request->getContext();

		header( 'content-type: text/comma-separated-values' );
		header( 'content-disposition: attachment; filename=ReviewerCredits-reviews-' . date( 'Ymd' ) . '.csv' );

		$reviewReportDao = DAORegistry::getDAO( 'ReviewerCreditsReportDAO' );
		list( $commentsIterator, $reviewsIterator, $responses ) = $reviewReportDao->getReviewReport( $context->getId() );
//		error_log( "responses: " . print_r( $responses, true ) );
		$comments = [];
		foreach ( $commentsIterator as $row ) {
			$cleanComment = strip_tags( $row->comments );

			$comments[ $row->submission_id ][ $row->author_id ][ $row->review_id ] = $cleanComment;
		}
//		error_log( "comments: " . print_r( $comments, true ) );

		//TODO: Change to fixed values in English.
		$recommendations = [
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_ACCEPT             => 'Accept Submission',
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_PENDING_REVISIONS  => 'Revisions Required',
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_RESUBMIT_HERE      => 'Resubmit for Review',
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_RESUBMIT_ELSEWHERE => 'Resubmit Elsewhere',
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_DECLINE            => 'Decline Submission',
			ReviewAssignment::SUBMISSION_REVIEWER_RECOMMENDATION_SEE_COMMENTS       => 'See Comments'
		];

		$columns = [
			'journal_title'  => "Journal Title",
			'journal_pissn'  => "Journal p-ISSN",
			'journal_eissn'  => "Journal e-ISSN",
			'user_given'     => "Reviewer First Name",
			'user_family'    => "Reviewer Last Name",
			'reviewer_email' => "E-mail Address",
			'orcid'          => "ORCID iD or ORCID URL",
			'manuscript'     => "Manuscript ID",
			'revision'       => "Revision Number",
			'date_due'       => "Date Review Due",
			'date_completed' => "Date Review Complete",
			'open_pr'        => "The peer reviewer identity is disclosed (OPEN PEER REVIEW)",
			'doi'            => "Publication DOI or DOI URL"
		];


		$f3 = ( new ReviewerCreditsPlugin() )->getSetting( $context->getId(), 'reviewerCreditsJournalF3' );
		if ( ! empty( $f3 ) && $f3 ) {
			$columns = array_merge( $columns,
				[
					'date_accepted'  => "Acceptance Date",
					'recommendation' => "Recommendation",
					'word_count' => "Word Count"
				] );
		}

		$fp = fopen( 'php://output', 'wt' );
		//Add BOM (byte order mark) to fix UTF-8 in Excel
		fprintf( $fp, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
		fputcsv( $fp, array_values( $columns ) );

		$reviewAssignmentDao = DAORegistry::getDAO( 'ReviewAssignmentDAO' );
		
		if (class_exists(\APP\facades\Repo::class)) {
			$userDao = \APP\facades\Repo::user()->dao;
		} else {
			error_log("Repo class not found. Using older methods.");
		}

		$journal      = $request->getJournal();
		$journalTitle = $journal->getLocalizedPageHeaderTitle();
		$journalPIssn = $journal->getData( 'printIssn' );
		$journalEIssn = $journal->getData( 'onlineIssn' );

		foreach ( $reviewsIterator as $row ) {
			if ( substr( $row->date_response_due, 11 ) === '00:00:00' ) {
				$row->date_response_due = substr( $row->date_response_due, 0, 11 ) . '23:59:59';
			}
			if ( substr( $row->date_due, 11 ) === '00:00:00' ) {
				$row->date_due = substr( $row->date_due, 0, 11 ) . '23:59:59';
			}
			$reviewId = $row->review_id;

			/** @var ReviewAssignment $reviewAssignmentDao */
			$reviewAssignment = $reviewAssignmentDao->getById( $reviewId );

			$reviewer = $userDao->get( $reviewAssignment->getReviewerId() );

			$manuscriptId = 'S' . $reviewAssignment->getSubmissionId() . '-R' . $reviewAssignment->getRound();

			$aggrResponse = "";
			if ( array_key_exists( $reviewId, $responses ) ) {
				foreach ( $responses[ $reviewId ] as $response ) {
//					error_log( "review id: " . $row->review_id . " response_value: " . $response->response_value );
					$aggrResponse .= " "  . strip_tags( $response->response_value );
				}
			}
			foreach ( $columns as $index => $junk )
				switch ( $index ) {
					case 'journal_title':
						$columns[ $index ] = $journalTitle;
						break;
					case 'journal_pissn':
						$columns[ $index ] = $journalPIssn;
						break;
					case 'journal_eissn':
						$columns[ $index ] = $journalEIssn;
						break;
					case 'reviewer_email':
						$columns[ $index ] = $reviewer->getEmail();
						break;
					case 'orcid':
						$columns[ $index ] = $reviewer->getOrcid();
						break;
					case 'manuscript':
						$columns[ $index ] = $manuscriptId;
						break;
					case 'revision':
						$columns[ $index ] = $reviewAssignment->getRound();
						break;
					case 'open_pr':
					case 'doi':
					case 'empty':
					case 'instructions':
						$columns[ $index ] = null;
						break;
					case 'recommendation':
						if ( isset( $recommendations[ $row->$index ] ) ) {
							$columns[ $index ] = isset( $row->$index ) ? $recommendations[ $row->$index ] : $row->$index ;
						} else {
							$columns[ $index ] = '';
						}
						break;

					case 'date_accepted':
						if ( empty( $reviewAssignment->getDateConfirmed() ) ) {
							$columns[ $index ] = "";
						} else {
							$columns[ $index ] = DateTime::createFromFormat( 'Y-m-d H:i:s', $reviewAssignment->getDateConfirmed() )->format( 'Y-m-d H:i:s' );
						}
						break;

					case 'word_count':
						if ( isset( $comments[ $row->submission_id ][ $row->reviewer_id ][ $reviewId ] ) ) {
							$columns[ $index ] = str_word_count( $aggrResponse . " " . $comments[ $row->submission_id ][ $row->reviewer_id ][ $reviewId ] ); //comment is already cleaned of <p></p> tags.
						} else {
							$columns[ $index ] = str_word_count( $aggrResponse );
						}
						break;
					default:
						$columns[ $index ] = $row->$index;
				}
			fputcsv( $fp, $columns );
		}
		fclose( $fp );
	}

}
