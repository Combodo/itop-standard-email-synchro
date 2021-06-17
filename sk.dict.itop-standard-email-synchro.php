<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2021 Combodo SARL
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
Dict::Add('SK SK', 'Slovak', 'Slovenčina', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Standard Mail Inbox~~',
	'Class:MailInboxStandard+' => 'Source of incoming eMails~~',
	'Class:MailInboxStandard/Attribute:behavior' => 'Behavior~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Create new Tickets~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Update existing Tickets~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Create or Update Tickets~~',

	'Class:MailInboxStandard/Attribute:email_storage' => 'After processing the eMail~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Keep it on the mail server~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Delete it immediately~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move to another folder~~',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder~~',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol~~',

	'Class:MailInboxStandard/Attribute:target_class' => 'Ticket Class~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'User Request~~',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Ticket Default Values~~',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Default Title (if subject is empty)~~',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Pattern to match in the subject~~',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Title Pattern~~',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Use PCRE syntax, including starting and ending delimiters~~',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli to apply~~',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Apply a stimulus when the ticket is in a given state~~',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Use the format <state_code>:<stimulus_code>~~',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Behavior in case of Unknown Caller~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Create a new Person~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Reject the eMail~~',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown Caller rejection reply~~',

	'Class:MailInboxStandard/Attribute:trace' => 'Debug trace~~',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Yes~~',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'No~~',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Add more contacts (To, CC)~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Never~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'When creating a new Ticket~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'When updating an existing Ticket~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Always~~',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'New Person\'s Default Values~~',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Debug Log~~',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Behavior in case of error~~',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Delete the message from the mailbox~~',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Keep the message in the mailbox~~',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Forward eMails To~~',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(From)~~',
	'MailInbox:Server' => 'Mailbox Configuration~~',
	'MailInbox:Behavior' => 'Behavior on Incoming eMails~~',
	'MailInbox:Caller' => 'Unknown Callers~~',
	'MailInbox:Errors' => 'Emails in Error~~',
	'MailInbox:OtherContacts' => 'Behavior for Additional Contacts~~',
	'Menu:MailInboxes' => 'Incoming eMail Inboxes~~',
	'Menu:MailInboxes+' => 'Configuration of Inboxes to scan for Incoming eMails~~',
	'MailInboxStandard:DebugTrace' => 'Debug Trace~~',
	'MailInboxStandard:DebugTraceNotActive' => 'Activate the debug on this Inbox to see the debug trace here.~~',
	'MailInbox:NoSubject' => 'No subject~~',
));

//
// Class: MailInboxStandard
//

Dict::Add('SK SK', 'Slovak', 'Slovenčina', array(
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'RoutineChange~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'NormalChange~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'EmergencyChange~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '~~',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug trace~~',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '~~',
));
