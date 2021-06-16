<?php
// Copyright (C) 2010-2021 Combodo SARL, 2016-18 ITOMIG GmbH
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU Lesser General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
Dict::Add('DE DE', 'German', 'Deutsch', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Standard-Maileingangspostfach',
	'Class:MailInboxStandard+' => 'Quelle eingehender Mails',
	'Class:MailInboxStandard/Attribute:behavior' => 'Verhalten',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Neue Tickets anlegen',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Vorhandene Tickets aktualisieren',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Tickets anlegen oder aktualisieren',

	'Class:MailInboxStandard/Attribute:email_storage' => 'Nach der Verarbeitung einer Mail',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Auf dem Server belassen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Sofort löschen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Verschieben',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Zielordner',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Ordner in den die Mail verschoben werden soll, wenn \'verschieben\' als Option gewählt wurde (IMAP-Protokoll wird genutzt).',

	'Class:MailInboxStandard/Attribute:target_class' => 'Ticket-Klasse',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Benutzeranfrage',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Ticket-Defaultwerte',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Default-Titel (falls der Betreff leer ist)',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Muster, das im Betreff gematched werden muss',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Titel-Muster',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Nutzen Sie PCRE-Sysmtax, inklusive Anfangs- und Ende-Limitatoren (delimiters)',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Anzuwendende Stimuli',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Einen Stimulus anwenden, wenn das Ticket in dem angegebenen Status ist',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Verwenden Sie das Format <state_code>:<stimulus_code>',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Verhalten bei unbekanntem Melder',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Neue Person anlegen',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Mail ablehnen',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Ablehnungsnachricht bei unbekanntem Melder',

	'Class:MailInboxStandard/Attribute:trace' => 'Debug-Trace',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Ja',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Nein',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Weitere Kontakte hinzufügen (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Nie',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Beim Anlegen eines Tickets',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Beim Aktualisieren eines Tickets',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Immer',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Default-Werte für neue Person',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Debug-Log',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Verhalten im Fehlerfall',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Nachricht aus der Mailbox löschen',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Nachricht in der Mailbox behalten',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Mails weiterleiten an..',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(Von)',
	'MailInbox:Server' => 'Mailbox-Konfiguration',
	'MailInbox:Behavior' => 'Verhalten bei eingehenden Mails',
	'MailInbox:Caller' => 'Unbekannte Melder',
	'MailInbox:Errors' => 'Mails mit Fehlern',
	'MailInbox:OtherContacts' => 'Verhalten bzgl. zusätzlicher Kontakte',
	'Menu:MailInboxes' => 'Mail-Inboxen',
	'Menu:MailInboxes+' => 'Konfiguration von Mail-Inboxen, die nach eingehenden Mails abzuscannen sind',
	'MailInboxStandard:DebugTrace' => 'Debug-Trace',
	'MailInboxStandard:DebugTraceNotActive' => 'Aktivieren Sie Debugging für diese Inbox um den Debug-Trace hier zu sehen.',
	'MailInbox:NoSubject' => 'Kein Betreff',
));

//
// Class: MailInboxStandard
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Routine Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Normaler Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Emergency Change',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug Trace',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '',
));
