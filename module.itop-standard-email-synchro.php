<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'itop-standard-email-synchro/2.6.0',
	array(
		// Identification
		//
		'label' => 'Ticket Creation from Emails (Standard)',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'combodo-email-synchro/1.0.0',
			// no other dependency is listed, for backward 1.x compatibility... though this module uses implicitely the Ticket's derived classes...
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'mailinboxstandard.class.inc.php',
			'model.itop-standard-email-synchro.php'
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
			'ticket_log' => array('UserRequest' => 'public_log', 'Incident' => 'public_log'),
		),
	)
);

