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


class ReviewerCreditsEditorialDecisionReportDAO extends DAO {
	/**
	 * Get the review report data.
	 *
	 * @param $contextId int Context ID
	 *
	 * @return array
	 */
	function getEditorialDecisionReport( $contextId ) {
		$results = $this->retrieve(
			'SELECT	submission_id, editor_id, decision, stage_id, round, 
				date_decided
			FROM	edit_decisions
			WHERE	submission_id in (select submission_id from submissions where context_id = ?)
				ORDER BY date_decided DESC', [ $contextId ]
		);
		$rows    = array();
		$rows = iterator_to_array( $results );

		return $rows;
	}
}
