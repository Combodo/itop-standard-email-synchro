<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
    'itop-standard-email-synchro/3.4.5',
    array(
        // Identification
        //
        'label' => 'Ticket Creation from Emails (Standard)',
        'category' => 'business',

        // Setup
        //
        'dependencies' => array(
            'combodo-email-synchro/3.4.2',
            // no other dependency is listed, for backward 1.x compatibility... though this module uses implicitely the Ticket's derived classes...
        ),
        'mandatory' => false,
        'visible' => true,

        // Components
        //
        'datamodel' => array(
            'model.itop-standard-email-synchro.php',
        ),
        'webservice' => array(),
        'data.struct' => array(),
		'data.sample' => array(),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
			'inline_image_max_width' => '500', // Maximum width (in px) for displaying inline images
			'ticket_log' => array('UserRequest' => 'public_log', 'Incident' => 'public_log'),
		),
	)
);

