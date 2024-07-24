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
	'Class:MailInboxStandard/Attribute:behavior+' => 'Verhalten beim Eintreffen einer neuen Nachricht im Posteingang:
- Erstellen oder Aktualisieren: Aktualisiere ein passendes Ticket, oder erstelle ein neues, falls keins vorhanden ist. 
- Neues Ticket erstellen: Jede neue Nachricht erstellt ein neues Ticket.
- Vorhandenes Ticket aktualisieren: Aktualisiere ein passendes Ticket, wenn gefunden, andernfalls als Fehler kennzeichnen',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Tickets anlegen oder aktualisieren',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Neue Tickets anlegen',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Vorhandene Tickets aktualisieren',
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Default-Werte für neue Person',
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Geben Sie einen Wert für alle Pflichtfelder einer Person an, mit Ausnahme der E-Mail.
Verwenden Sie eine Feldinitialisierung pro Zeile im folgenden Format: <field_code>:<value>',
	'Class:MailInboxStandard/Attribute:caller_default_values?' => 'Eine Einstellung pro Zeile im Format <field_code>:<value>',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Debug-Log',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug Trace',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '',
	'Class:MailInboxStandard/Attribute:email_storage' => 'Nach der Verarbeitung einer Mail',
	'Class:MailInboxStandard/Attribute:email_storage+' => 'Wählen Sie die Aktion aus, die nach der erfolgreichen Verarbeitung einer eingehenden E-Mail durchgeführt werden soll. E-Mails mit Fehlern fallen nicht in den Geltungsbereich dieser Einstellung; sie werden über das Feld behandelt \'Behavior in case of error\'.',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Sofort löschen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Auf dem Server belassen',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Verschieben',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Verhalten im Fehlerfall',
	'Class:MailInboxStandard/Attribute:error_behavior+' => 'Ursachen für E-Mails mit Fehlern: 
- Nachrichten zu groß (größe > \'maximum_email_size\'),
- Unbekannter Absender (E-Mail-Adresse nicht gefunden in '.ITOP_APPLICATION_SHORT.' Personen),
- E-Mail-Format wird nicht unterstützt (z. B. verschlüsselt, unbekannt usw.),',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Nachricht aus der Mailbox löschen',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Nachricht in der Mailbox behalten',
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Weitere Kontakte hinzufügen (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Suche nach '.ITOP_APPLICATION_SHORT.' Kontakte mit der E-Mail-Adresse, die im An- und CC-Feld der empfangenen E-Mail-Nachricht vorhanden sind, und verknüpfe mit dem Ticket.
Bereits verknüpfte Kontakte werden ignoriert. Unbekannte E-Mail-Adressen werden ebenfalls ignoriert.',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Immer',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Nie',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Beim Anlegen eines Tickets',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Beim Aktualisieren eines Tickets',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(Von)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'Die E-Mail-Adresse, die als "Absender" von Fehlermeldungen verwendet werden soll. Erforderlich beim Weiterleiten der E-Mails mit Fehlern, da die meisten Mailserver nur Nachrichten mit einer definierten Absenderadresse weiterleiten.',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Mails weiterleiten an..',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'Die E-Mail-Adresse, an die E-Mails mit Fehlern weitergeleitet werden sollen. 
E-Mails mit Fehlern werden als Anhang weitergeleitet, es sei denn, sie sind zu groß. In diesem Fall werden sie in ein im Konfigurationsparameter \'big_files_dir\' angegebenes Verzeichnis verschoben..
Wenn diese Adresse leer gelassen wird und die E-Mails mit Fehlern gelöscht werden, wird niemand das Problem bemerken und in der Lage sein, es zu beheben.',
	'Class:MailInboxStandard/Attribute:stimuli' => 'Anzuwendende Stimuli',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Einen Stimulus anwenden, wenn das Ticket in dem angegebenen Status ist',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Verwenden Sie das Format <state_code>:<stimulus_code>',
	'Class:MailInboxStandard/Attribute:target_class' => 'Ticket-Klasse',
	'Class:MailInboxStandard/Attribute:target_class+' => '
Welche Ticketklasse erstellt oder aktualisiert werden soll, wenn eine neue E-Mail in diesem Posteingang eintrifft. Es ist nur eine Klasse möglich.',
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
	'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'Der Betreff der eingehenden E-Mail wird verwendet, um den Titel bei der Ticketerstellung festzulegen. Dies ist ein Fallback, der nur verwendet wird, wenn der E-Mail-Betreff leer ist',
	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Ticket-Defaultwerte',
	'Class:MailInboxStandard/Attribute:ticket_default_values+' => 'Geben Sie Werte für alle Pflichtfelder bei der Ticketerstellung an.
Die Felder Titel, caller_id, org_id, origin und Beschreibung werden bereits verwaltet.
Ein Feld pro Zeile im folgenden Format: <field_code>:<value>
Beim Festlegen externer Schlüssel wie \'org_id\', verwenden Sie die ID (oder den freundlichen Namen, der weniger robust ist).',
	'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'Eine Initialisierung pro Zeile im Format <field_code>:<value>',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Titel-Muster',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Muster, das im Betreff gematched werden muss',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Nutzen Sie PCRE-Sysmtax, inklusive Anfangs- und Ende-Limitatoren (delimiters)',
	'Class:MailInboxStandard/Attribute:trace' => 'Debug-Trace',
	'Class:MailInboxStandard/Attribute:trace+' => '	Verwenden Sie dies, um die verschiedenen Operationen zu verfolgen, die beim Verarbeiten von E-Mails aus diesem Posteingang durchgeführt werden. Aktivieren Sie diese Option nicht über längere Zeiträume in der Produktion, da sie dazu neigt, viel Ausgabe zu erzeugen, was den Server verlangsamt.',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Nein',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Ja',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Verhalten bei unbekanntem Melder',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Verhalten, wenn die Absender-E-Mail-Adresse nicht gefunden wird'.ITOP_APPLICATION_SHORT.' Personen:
 - Erstelle eine neue Person: mit der Absenderemail und den \'New Person\'s Default-Werten"
 - E-Mail ablehnen: Die E-Mail als Fehler kennzeichnen und dem Absender mit dem Inhalt von „Ablehnung unbekannter Absender“ antworten',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Neue Person anlegen',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Mail ablehnen',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Ablehnungsnachricht bei unbekanntem Melder',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Optionale Antwort an den Absender, die mit der Option „E-Mail ablehnen“ verwendet wird.
Unbekannte Absender sind E-Mail-Adressen, die mit keiner Person in '.ITOP_APPLICATION_SHORT.' übereinstimmen.
Wenn dieses Feld leer gelassen wird, wird keine Nachricht an unbekannte Absender gesendet.',
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
