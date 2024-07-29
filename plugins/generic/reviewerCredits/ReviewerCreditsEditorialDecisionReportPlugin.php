<?php

/**
 * @file ReviewerCreditsEditorialDecisionReportPlugin.php
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
 use APP\decision\Decision;
 use PKP\config\Config;
 use DateTime;


class ReviewerCreditsEditorialDecisionReportPlugin extends ReportPlugin {
	/**
	 * ReviewerCreditsEditorialDecisionReportPlugin constructor.
	 */
	public function __construct() {

		if ( Config::getVar( 'general', 'installed' ) ) {
			$editorialDecisionReportDAO = new ReviewerCreditsEditorialDecisionReportDAO();
			DAORegistry::registerDAO( 'ReviewerCreditsEditorialDecisionReportDAO', $editorialDecisionReportDAO );
		}
		$this->addLocaleData();

		return true;
	}

	/**
	 * Returns a list of decisions with labels.
	 *
	 * @return array
	 */
	public static function getDecisions(): array {
		return [
			\PKP\decision\Decision::ACCEPT => "Accept Submission",
			\PKP\decision\Decision::PENDING_REVISIONS => "Request Revisions",
			\PKP\decision\Decision::RESUBMIT => "Resubmit for Review",
			\PKP\decision\Decision::DECLINE => "Decline Submission",
			\PKP\decision\Decision::SEND_TO_PRODUCTION => "Send To Production",
			\PKP\decision\Decision::RECOMMEND_ACCEPT => "Recommendation: Accept Submission",
			\PKP\decision\Decision::RECOMMEND_PENDING_REVISIONS => "Recommendation: Request Revisions",
			\PKP\decision\Decision::RECOMMEND_RESUBMIT => "Recommendation: Resubmit for Review",
			\PKP\decision\Decision::RECOMMEND_DECLINE => "Recommendation: Decline Submission",
			\PKP\decision\Decision::NEW_EXTERNAL_ROUND => "New review round",
			\PKP\decision\Decision::EXTERNAL_REVIEW => "New review round",
		];
	}

	/**
	 * @copydoc Plugin::getName()
	 */
	function getName() {
		return 'ReviewerCreditsEditorialDecisionReportPlugin';
	}

	/**
	 * @copydoc Plugin::getDisplayName()
	 */
	function getDisplayName() {
		return __( 'plugins.generic.reviewerCredits.editorialDecisionReport.displayName' );
	}

	/**
	 * @copydoc Plugin::getDescription()
	 */
	function getDescription() {
		return __( 'plugins.generic.reviewerCredits.editorialDecisionReport.description' );
	}

	/**
	 * @copydoc ReportPlugin::display()
	 */
	function display( $args, $request ) {
		$context = $request->getContext();

		header( 'content-type: text/comma-separated-values' );
		header( 'content-disposition: attachment; filename=ReviewerCredits-editorialDecisions-' . date( 'Ymd' ) . '.csv' );

		$editDecisionReportDao = DAORegistry::getDAO( 'ReviewerCreditsEditorialDecisionReportDAO' );
		$editorialDecisions    = $editDecisionReportDao->getEditorialDecisionReport( $context->getId() );

		$decisions = self::getDecisions();

		$columns = [
			'journal_title' => "Journal Title",
			'journal_pissn' => "Journal p-ISSN",
			'journal_eissn' => "Journal e-ISSN",
			'submission_id' => "Manuscript ID",
			'round'         => "Round",
			'stage_id'      => "Stage Id",
			'decision'      => "Editorial Decision",
			'decision_date' => "Editorial Decision Date"
		];

		$editorDataEnabled = ( new ReviewerCreditsPlugin() )->getSetting( $context->getId(), 'reviewerCreditsEditorData' );
		if ( ! empty( $editorDataEnabled ) && $editorDataEnabled ) {
			$columns = array_merge( $columns,
				[
					'editor_name'    => "Editor Full Name",
					'editor_email'   => "Editor Email",
					'editor_orcid'   => "Editor Orcid",
					'editor_country' => "Editor Country"
				] );
		}

		$fp = fopen( 'php://output', 'wt' );
		//Add BOM (byte order mark) to fix UTF-8 in Excel
		fprintf( $fp, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
		fputcsv( $fp, array_values( $columns ) );


		if (class_exists(\APP\facades\Repo::class)) {
			$userDao = \APP\facades\Repo::user()->dao;
		} else {
			error_log("Repo class not found. Using older methods.");
		}


		$journal      = $request->getJournal();
		$journalTitle = $journal->getLocalizedPageHeaderTitle();
		$journalPIssn = $journal->getData( 'printIssn' );
		$journalEIssn = $journal->getData( 'onlineIssn' );

		foreach ( $editorialDecisions as $row ) {
//			error_log( "row: " . print_r( $row, true ) );
			

			$editor = $userDao->get( $row->editor_id );

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
					case 'submission_id':
						$columns[ $index ] = 'S' . $row->submission_id . '-R' . $row->round;
						break;
					case 'round':
						$columns[ $index ] = $row->round;
						break;
					case 'stage_id':
						$columns[ $index ] = $row->stage_id;
						break;
					case 'decision_date':
						$columns[ $index ] = empty( $row->date_decided )
							? ""
							: DateTime::createFromFormat( 'Y-m-d H:i:s', $row->date_decided )
							          ->format( 'Y-m-d H:i:s' );
						break;
					case 'decision':
						$columns[ $index ] = isset( $decisions[ $row->$index ] ) ? $decisions[ $row->$index ] : $row->$index;
						break;

					//optional editor data
					case 'editor_name':
						$columns[ $index ] = $editor->getFullName();
						break;
					case 'editor_email':
						$columns[ $index ] = $editor->getEmail();
						break;
					case 'editor_orcid':
						$columns[ $index ] = $editor->getOrcid() ?? '';
						break;
					case 'editor_country':
						$columns[ $index ] = $editor->getCountryLocalized() ?? '';
						break;
					default:
						$columns[ $index ] = $row->$index;
				}
			fputcsv( $fp, $columns );
		}
		fclose( $fp );
	}

}
