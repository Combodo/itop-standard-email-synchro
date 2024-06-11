<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2024 Combodo SAS
 * @license    https://opensource.org/licenses/AGPL-3.0
 * 
 */
/**
 *
 */
Dict::Add('DE DE', 'German', 'Deutsch', [
	'Class:MailInboxStandard' => 'Standard-Maileingangspostfach',
	'Class:MailInboxStandard+' => 'Quelle eingehender Mails',
	'Class:MailInboxStandard/Attribute:behavior' => 'Verhalten',
	'Class:MailInboxStandard/Attribute:behavior+' => 'Behavior when a new message arrives in the inbox:
- Create or Update: Update a matching Ticket found, otherwise create. 
- Create new ticket: Every new message creates a new Ticket.
- Update existing ticket: Update a matching Ticket found, otherwise flag in error.~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Tickets anlegen oder aktualisieren',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Neue Tickets anlegen',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Vorhandene Tickets aktualisieren',
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Default-Werte für neue Person',
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Provide a value for all mandatory fields of a Person, except email.
Use one field initialization per line, in the format: <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:caller_default_values?' => 'One setting per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Debug-Log',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug Trace',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '',
	'Class:MailInboxStandard/Attribute:email_storage' => 'Nach der Verarbeitung einer Mail',
	'Class:MailInboxStandard/Attribute:email_storage+' => 'Select the action to be taken after successfully processing an incoming eMail.
eMails in error are not in the scope of this setting, they are handled using the field \'Behavior in case of error\'.~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Sofort löschen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Auf dem Server belassen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Verschieben',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Verhalten im Fehlerfall',
	'Class:MailInboxStandard/Attribute:error_behavior+' => 'Root causes of eMails in error: 
- Messages too big (size > \'maximum_email_size\'),
- Unknown sender (email address not found in '.ITOP_APPLICATION_SHORT.' Persons),
- eMail format not supported (e.g. encrypted, unknown, etc.),~~',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Nachricht aus der Mailbox löschen',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Nachricht in der Mailbox behalten',
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Weitere Kontakte hinzufügen (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Search for '.ITOP_APPLICATION_SHORT.' contacts having the email address present in To and CC of the received eMail message, and link them to the Ticket.
Already linked contacts are ignored. Unknown email addresses are ignored.~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Immer',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Nie',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Beim Anlegen eines Tickets',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Beim Aktualisieren eines Tickets',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(Von)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'The email address to be used as the “sender” of error notifications. 
Required when forwarding the eMails in error, as most mail servers only relay messages with a defined sender address.~~',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Mails weiterleiten an..',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'The email address to which to forward emails in error. 
eMails in error are forwarded as an attachment, unless they are too big, in which case they are moved to a directory specified in the \'big_files_dir\' configuration.
If this address is left empty and if the emails in error are deleted, then nobody will notice the issue and be able to troubleshoot.~~',
	'Class:MailInboxStandard/Attribute:stimuli' => 'Anzuwendende Stimuli',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Einen Stimulus anwenden, wenn das Ticket in dem angegebenen Status ist',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Verwenden Sie das Format <state_code>:<stimulus_code>',
	'Class:MailInboxStandard/Attribute:target_class' => 'Ticket-Klasse',
	'Class:MailInboxStandard/Attribute:target_class+' => 'Which class of Ticket to create or update when a new eMail arrives in this inbox. Only one class is possible.~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Emergency Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Normaler Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Routine Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Benutzeranfrage',
	'Class:MailInboxStandard/Attribute:target_folder' => 'Zielordner',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Ordner in den die Mail verschoben werden soll, wenn \'verschieben\' als Option gewählt wurde (IMAP-Protokoll wird genutzt).',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Default-Titel (falls der Betreff leer ist)',
	'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'The subject of the incoming eMail is used to feed the title on ticket creation. 
This one is a fallback, used only if the eMail subject is empty~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Ticket-Defaultwerte',
	'Class:MailInboxStandard/Attribute:ticket_default_values+' => 'Provide a value for all the mandatory fields at ticket creation.
Fields title, caller_id, org_id, origin and description are already managed.
One field per line using the format: <field_code>:<value>
When setting external keys such as \'org_id\', use the id (or the friendly name which is less robust).~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'One initialization per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Titel-Muster',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Muster, das im Betreff gematched werden muss',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Nutzen Sie PCRE-Sysmtax, inklusive Anfangs- und Ende-Limitatoren (delimiters)',
	'Class:MailInboxStandard/Attribute:trace' => 'Debug-Trace',
	'Class:MailInboxStandard/Attribute:trace+' => '	Use this to track the various operations performed while processing eMails from this Inbox.
Do not activate this option for long periods on production since it tends to generate a lot of output which slows down the server~~',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Nein',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Ja',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Verhalten bei unbekanntem Melder',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Behavior when the sender email is not found in the '.ITOP_APPLICATION_SHORT.' Persons:
 - Create a new Person: with the sender email and the "New Person\'s Default Values"
 - Reject the eMail: flag the eMail in error and reply to the sender with the content of "Unknown senders rejection reply"~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Neue Person anlegen',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Mail ablehnen',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Ablehnungsnachricht bei unbekanntem Melder',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Optional reply to sender used with option “Reject the eMail”.
Unknown senders are email addresses which do not correspond to any Person in '.ITOP_APPLICATION_SHORT.'.
If this field is left empty, then no message is sent to unknown senders~~',
	'MailInbox:Behavior' => 'Verhalten bei eingehenden Mails',
	'MailInbox:Caller' => 'Unbekannte Melder',
	'MailInbox:Errors' => 'Mails mit Fehlern',
	'MailInbox:NoSubject' => 'Kein Betreff',
	'MailInbox:OtherContacts' => 'Verhalten bzgl. zusätzlicher Kontakte',
	'MailInbox:Server' => 'Mailbox-Konfiguration',
	'MailInboxStandard:DebugTrace' => 'Debug-Trace',
	'MailInboxStandard:DebugTraceNotActive' => 'Aktivieren Sie Debugging für diese Inbox um den Debug-Trace hier zu sehen.',
	'Menu:MailInboxes' => 'Mail-Inboxen',
	'Menu:MailInboxes+' => 'Konfiguration von Mail-Inboxen, die nach eingehenden Mails abzuscannen sind',
]);
