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
Dict::Add('ES CR', 'Spanish', 'Español, Castellano', [
	'Class:MailInboxStandard' => 'Buzón Estandard de Correo',
	'Class:MailInboxStandard+' => 'Fuente de correo entrante',
	'Class:MailInboxStandard/Attribute:behavior' => 'Comportamiento',
	'Class:MailInboxStandard/Attribute:behavior+' => 'Behavior when a new message arrives in the inbox:
- Create or Update: Update a matching Ticket found, otherwise create. 
- Create new ticket: Every new message creates a new Ticket.
- Update existing ticket: Update a matching Ticket found, otherwise flag in error.~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Crear or Actualizar Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Crear nuevos Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Actualizar Tickets existentes',
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Valores por Omisión para Nueva Persona',
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Provide a value for all mandatory fields of a Person, except email.
Use one field initialization per line, in the format: <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:caller_default_values?' => 'One setting per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Log de Depuración',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug trace~~',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '~~',
	'Class:MailInboxStandard/Attribute:email_storage' => 'Despues de procesar el correo',
	'Class:MailInboxStandard/Attribute:email_storage+' => 'Select the action to be taken after successfully processing an incoming eMail.
eMails in error are not in the scope of this setting, they are handled using the field \'Behavior in case of error\'.~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Borrarlo inmediatamente',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Mantenerlo en el servidor de correo',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move it to another folder~~',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Comportamiento',
	'Class:MailInboxStandard/Attribute:error_behavior+' => 'Root causes of eMails in error: 
- Messages too big (size > \'maximum_email_size\'),
- Unknown sender (email address not found in '.ITOP_APPLICATION_SHORT.' Persons),
- eMail format not supported (e.g. encrypted, unknown, etc.),~~',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Borrar el mensaje del buzón',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Mantener el mensaje en el buzón',
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Agregar más contactos (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Search for '.ITOP_APPLICATION_SHORT.' contacts having the email address present in To and CC of the received eMail message, and link them to the Ticket.
Already linked contacts are ignored. Unknown email addresses are ignored.~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Siempre',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Nunca',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Cuando se cree un nuevo Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Cuando se actualice un Ticket existenge',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(De/From)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'The email address to be used as the “sender” of error notifications. 
Required when forwarding the eMails in error, as most mail servers only relay messages with a defined sender address.~~',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Reenviar correos A',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'The email address to which to forward emails in error. 
eMails in error are forwarded as an attachment, unless they are too big, in which case they are moved to a directory specified in the \'big_files_dir\' configuration.
If this address is left empty and if the emails in error are deleted, then nobody will notice the issue and be able to troubleshoot.~~',
	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli para aplicar',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Stimulus a aplicar cuando el tickes esté en un estado determinado',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Usar el formato <state_code>:<stimulus_code>',
	'Class:MailInboxStandard/Attribute:target_class' => 'Clase Ticket',
	'Class:MailInboxStandard/Attribute:target_class+' => 'Which class of Ticket to create or update when a new eMail arrives in this inbox. Only one class is possible.~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Emergency Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incidente',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Normal Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Routine Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Requerimiento',
	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder~~',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol~~',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Título por Omisión (si el Asunto está vacío)',
	'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'The subject of the incoming eMail is used to feed the title on ticket creation. 
This one is a fallback, used only if the eMail subject is empty~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Valores por Omisión para Ticket',
	'Class:MailInboxStandard/Attribute:ticket_default_values+' => 'Provide a value for all the mandatory fields at ticket creation.
Fields title, caller_id, org_id, origin and description are already managed.
One field per line using the format: <field_code>:<value>
When setting external keys such as \'org_id\', use the id (or the friendly name which is less robust).~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'One initialization per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Título de Patrón',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Patrón de coincidencia en el Asunto',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Usar sintaxis PCRE, incluyendo deliminatores de inicio y fin',
	'Class:MailInboxStandard/Attribute:trace' => 'Traza de Depuración',
	'Class:MailInboxStandard/Attribute:trace+' => '	Use this to track the various operations performed while processing eMails from this Inbox.
Do not activate this option for long periods on production since it tends to generate a lot of output which slows down the server~~',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'No',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Si',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Comporamiento en caso de requiriente desconocido',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Behavior when the sender email is not found in the '.ITOP_APPLICATION_SHORT.' Persons:
 - Create a new Person: with the sender email and the "New Person\'s Default Values"
 - Reject the eMail: flag the eMail in error and reply to the sender with the content of "Unknown senders rejection reply"~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Crear una nueva Persona',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Rechazar el correo',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown senders rejection reply~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Optional reply to sender used with option “Reject the eMail”.
Unknown senders are email addresses which do not correspond to any Person in '.ITOP_APPLICATION_SHORT.'.
If this field is left empty, then no message is sent to unknown senders~~',
	'MailInbox:Behavior' => 'Comportamiento de correos Entrantes',
	'MailInbox:Caller' => 'Requiriente Desconocido',
	'MailInbox:Errors' => 'Correos con Error',
	'MailInbox:NoSubject' => 'Sin Asunto',
	'MailInbox:OtherContacts' => 'Comportamiento para Contactos Adicionales',
	'MailInbox:Server' => 'Configuración de Buzón',
	'MailInboxStandard:DebugTrace' => 'Traza de Depuración',
	'MailInboxStandard:DebugTraceNotActive' => 'Activar la depuración en este buzón para ver traza de depuración aquí.',
	'Menu:MailInboxes' => 'Buzones de correos Entrantes',
	'Menu:MailInboxes+' => 'Configuración de buzones para búsqueda de correos Entrantes',
]);
