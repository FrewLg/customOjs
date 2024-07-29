<?php

/**
 * @file plugins/generic/reviewerCredits/ReviewerCreditsSettingsForm.php
 *
 * Copyright (c) 2015-2018 University of Pittsburgh
 * Copyright (c) 2014-2018 Simon Fraser University
 * Copyright (c) 2003-2018 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ReviewerCreditsSettingsForm
 * @ingroup plugins_generic_reviewerCredits
 *
 * @brief Form for site admins to modify ReviewerCredits plugin settings
 */


 namespace APP\plugins\generic\reviewerCredits;

 use PKP\form\Form;
 use PKP\form\validation\FormValidator;
 use PKP\form\validation\FormValidatorCustom;
 use PKP\form\validation\FormValidatorPost;
 use PKP\form\validation\FormValidatorCSRF;
 use APP\template\TemplateManager;
 use PKP\notification\PKPNotification;
 use APP\notification\NotificationManager;

class ReviewerCreditsSettingsForm extends Form {

	/** @var $contextId int */
	var $contextId;

	/** @var $plugin object */
	var $plugin;

	/** @var $passwdPlaceholder string */
	var $passwdPlaceholder = '****************';

	/**
	 * Constructor
	 *
	 * @param $plugin object
	 * @param $contextId int
	 */
	public function __construct( $plugin, $contextId ) {
		$this->contextId = $contextId;
		$this->plugin    = $plugin;

		if ( method_exists( $this->plugin, 'getTemplateResource' ) ) {
			$constructArgument = $this->plugin->getTemplateResource( 'settingsForm.tpl' );
		} else {
			$constructArgument = $this->plugin->getTemplateResourceName() . ':templates/settingsForm.tpl';
		}
		parent::__construct( $constructArgument );

		$this->addCheck( new FormValidator( $this, 'reviewerCreditsJournalLogin', 'required', 'plugins.generic.reviewerCredits.manager.settings.rcLoginRequired' ) );
		$this->addCheck( new FormValidator( $this, 'reviewerCreditsJournalPassword', 'required', 'plugins.generic.reviewerCredits.manager.settings.rcPasswordRequired' ) );

		$this->addCheck( new FormValidatorCustom(
			$this, 'reviewerCreditsJournalLogin',
			'required',
			'plugins.generic.reviewerCredits.manager.settings.invalid',
			array( $this, 'customValidator' )
		) );

		$this->addCheck( new FormValidatorPost( $this ) );
		$this->addCheck( new FormValidatorCSRF( $this ) );
	}

	/**
	 * Initialize form data.
	 */
	public function initData() {
		$contextId = $this->contextId;
		$plugin    =& $this->plugin;
		$oldPasswd = $plugin->getSetting( $contextId, 'reviewerCreditsJournalPassword' );
		$f3        = $plugin->getSetting( $contextId, 'reviewerCreditsJournalF3' );
		if ( empty( $oldPasswd ) ) {
			$password = '';
		} else {
			$password = $this->passwdPlaceholder;
		}

		$editorDataCheckbox = $plugin->getSetting( $contextId, 'reviewerCreditsEditorData' );

		$this->_data = array(
			'reviewerCreditsJournalLogin'    => $plugin->getSetting( $contextId, 'reviewerCreditsJournalLogin' ),
			'reviewerCreditsJournalPassword' => $password,
			'reviewerCreditsJournalF3'       => $f3,
			'reviewerCreditsEditorData'      => $editorDataCheckbox
		);
	}

	/**
	 * Assign form data to user-submitted data.
	 */
	public function readInputData() {
		$this->readUserVars( array( 'reviewerCreditsJournalLogin' ) );
		$this->readUserVars( array( 'reviewerCreditsJournalPassword' ) );
		$this->readUserVars( array( 'reviewerCreditsJournalF3' ) );
		$this->readUserVars( array( 'reviewerCreditsEditorData' ) );
	}

	/**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	public function fetch( $request, $template = null, $display = false ) {
		$templateMgr = TemplateManager::getManager( $request );
		$templateMgr->assign( 'pluginName', $this->plugin->getName() );

		return parent::fetch( $request );
	}

	/**
	 * Save settings.
	 */
	public function execute( ...$functionArgs ) {
		$plugin    =& $this->plugin;
		$contextId = $this->contextId;
		$oldPasswd = $plugin->getSetting( $contextId, 'reviewerCreditsJournalPassword' );
		$newPasswd = $this->getData( 'reviewerCreditsJournalPassword' );

		$plugin->updateSetting( $contextId, 'reviewerCreditsJournalLogin', $this->getData( 'reviewerCreditsJournalLogin' ), 'string' );
		$plugin->updateSetting( $contextId, 'reviewerCreditsJournalF3', $this->getData( 'reviewerCreditsJournalF3' ), 'bool' );
		$plugin->updateSetting( $contextId, 'reviewerCreditsEditorData', $this->getData( 'reviewerCreditsEditorData' ), 'bool' );

		if ( $newPasswd != $this->passwdPlaceholder && $newPasswd != $oldPasswd ) {
			$plugin->updateSetting( $contextId, 'reviewerCreditsJournalPassword', $this->getData( 'reviewerCreditsJournalPassword' ), 'string' );
		}
	}

	/**
	 * Check credentials.
	 */
	public function customValidator( $args ) {
		$username            = trim( $args );
		$plugin              =& $this->plugin;
		$contextId           = $this->contextId;
		$oldPasswd           = $plugin->getSetting( $contextId, 'reviewerCreditsJournalPassword' );
		$newPasswd           = $this->getData( 'reviewerCreditsJournalPassword' );
		$notificationManager = new NotificationManager();
		if ( empty( $username ) || empty( $newPasswd ) ) {
			$isValid = false;
		} else {
			if ( $newPasswd != $this->passwdPlaceholder ) {
				$password = $newPasswd;
			} else {
				$password = $oldPasswd;
			}
			$apiAuthToken = $plugin->verifyCredentials( $username, $password );

			if ( $apiAuthToken->error ) {
				//Showing the error received from the ReviewerCredits server.
				$notificationManager->createTrivialNotification( $contextId, PKPNotification::NOTIFICATION_TYPE_ERROR, array( 'contents' => $apiAuthToken->data ) );
			}

			$isValid = ! $apiAuthToken->error;
		}
		if ( ! $isValid ) {
			if ( empty( $oldPasswd ) ) {
				$this->_data['reviewerCreditsJournalPassword'] = '';
			} else {
				$this->_data['reviewerCreditsJournalPassword'] = $this->passwdPlaceholder;
			}
		}

		return $isValid;
	}
}