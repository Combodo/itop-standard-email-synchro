<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2024 Combodo SAS
 * @license	http://opensource.org/licenses/AGPL-3.0
 *
 * This file is part of iTop.
 *
 * iTop is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iTop is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with iTop. If not, see <http://www.gnu.org/licenses/>
 */

//
// Class: MailInboxStandard
//

Dict::Add('EN GB', 'British English', 'British English', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Standard Mail Inbox',
	'Class:MailInboxStandard+' => 'Source of incoming eMails',

	'Class:MailInboxStandard/Attribute:behavior' => 'Behavior',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Create new Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Update existing Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Create or Update Tickets',
    'Class:MailInboxStandard/Attribute:behavior+' => 'Behavior when a new message arrives in the inbox:
- Create or Update: Update a matching Ticket found, otherwise create. 
- Create new ticket: Every new message creates a new Ticket.
- Update existing ticket: Update a matching Ticket found, otherwise flag in error.',

	'Class:MailInboxStandard/Attribute:email_storage' => 'After processing the eMail',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Keep it on the mail server',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Delete it immediately',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move it to another folder',
    'Class:MailInboxStandard/Attribute:email_storage+' => 'Select the action to be taken after successfully processing an incoming eMail.
eMails in error are not in the scope of this setting, they are handled using the field \'Behavior in case of error\'.',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol',

	'Class:MailInboxStandard/Attribute:target_class' => 'Ticket Class',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'User Request',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Routine Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Normal Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Emergency Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '',
	'Class:MailInboxStandard/Attribute:target_class+' => 'Which class of Ticket to create or update when a new eMail arrives in this inbox. Only one class is possible.',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Ticket Default Values',
    'Class:MailInboxStandard/Attribute:ticket_default_values+' => "Provide a value for all the mandatory fields at ticket creation.
Fields title, caller_id, org_id, origin and description are already managed.
One field per line using the format: <field_code>:<value>
When setting external keys such as 'org_id', use the id (or the friendly name which is less robust).",
	'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'One initialization per line, in format <field_code>:<value>',


	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Default Title (if subject is empty)',
    'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'The subject of the incoming eMail is used to feed the title on ticket creation. 
This one is a fallback, used only if the eMail subject is empty',

	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Pattern to match in the subject',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Title Pattern',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Use PCRE syntax, including starting and ending delimiters',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli to apply',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Define the stimulus to apply for each ticket state.
One state/stimulus per line, using format <state_code>:<stimulus_code>',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'One state/stimulus per line, using format <state_code>:<stimulus_code>',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'In case of unknown sender',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Create a new Person',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Reject the eMail',
    'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Behavior when the sender email is not found in the '.ITOP_APPLICATION_SHORT.' Persons:
 - Create a new Person: with the sender email and the "New Person\'s Default Values"
 - Reject the eMail: flag the eMail in error and reply to the sender with the content of "Unknown senders rejection reply"',

	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown senders rejection reply',
    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Optional reply to sender used with option “Reject the eMail”.
Unknown senders are email addresses which do not correspond to any Person in '.ITOP_APPLICATION_SHORT.'.
If this field is left empty, then no message is sent to unknown senders',

	'Class:MailInboxStandard/Attribute:trace' => 'Debug trace',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Yes',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'No',
    'Class:MailInboxStandard/Attribute:trace+' => '	Use this to track the various operations performed while processing eMails from this Inbox.
Do not activate this option for long periods on production since it tends to generate a lot of output which slows down the server',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Add more contacts (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Never',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'When creating a new Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'When updating an existing Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Always',
    'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Search for '.ITOP_APPLICATION_SHORT.' contacts having the email address present in To and CC of the received eMail message, and link them to the Ticket.
Already linked contacts are ignored. Unknown email addresses are ignored.',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => "New Person's Default Values",
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Provide a value for all mandatory fields of a Person, except email.
Use one field initialization per line, in the format: <field_code>:<value>',
	'Class:MailInboxStandard/Attribute:caller_default_values?' => 'One setting per line, in format <field_code>:<value>',

	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug trace',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '',

	'Class:MailInboxStandard/Attribute:error_behavior' => 'Behavior in case of error',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Delete the message from the mailbox',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Keep the message in the mailbox',
	'Class:MailInboxStandard/Attribute:error_behavior+' => 'Root causes of eMails in error: 
- Messages too big (size > \'maximum_email_size\'),
- Unknown sender (email address not found in '.ITOP_APPLICATION_SHORT.' Persons),
- eMail format not supported (e.g. encrypted, unknown, etc.),',

	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Forward eMails To',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'The email address to which to forward emails in error. 
eMails in error are forwarded as an attachment, unless they are too big, in which case they are moved to a directory specified in the \'big_files_dir\' configuration.
If this address is left empty and if the emails in error are deleted, then nobody will notice the issue and be able to troubleshoot.',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(From)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'The email address to be used as the “sender” of error notifications. 
Required when forwarding the eMails in error, as most mail servers only relay messages with a defined sender address.',

// Fieldsets and Tabs

	'MailInbox:Server' => 'Mailbox Configuration',
	'MailInbox:Behavior' => 'Behavior on Incoming eMails',
	'MailInbox:Caller' => 'Unknown Senders',
	'MailInbox:Errors' => 'Emails in Error',
	'MailInbox:OtherContacts' => 'Behavior for Additional Contacts',
	'Menu:MailInboxes' => 'Incoming eMail Inboxes',
	'Menu:MailInboxes+' => 'Configuration of Inboxes to scan for Incoming eMails',
	'MailInboxStandard:DebugTrace' => 'Debug Trace',
	'MailInboxStandard:DebugTraceNotActive' => 'Activate the debug on this Inbox to see the debug trace here.',
	'MailInbox:NoSubject' => 'No subject',
));
