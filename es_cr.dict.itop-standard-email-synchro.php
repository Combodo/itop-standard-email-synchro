<?php
// Copyright (C) 2010-2021 Combodo SARL
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
Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Buzón Estandard de Correo',
	'Class:MailInboxStandard+' => 'Fuente de correo entrante',
	'Class:MailInboxStandard/Attribute:behavior' => 'Comportamiento',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Crear nuevos Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Actualizar Tickets existentes',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Crear or Actualizar Tickets',

	'Class:MailInboxStandard/Attribute:email_storage' => 'Despues de procesar el correo',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Mantenerlo en el servidor de correo',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Borrarlo inmediatamente',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move to another folder~~',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder~~',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol~~',

	'Class:MailInboxStandard/Attribute:target_class' => 'Clase Ticket',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incidente',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Requerimiento',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Valores por Omisión para Ticket',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Título por Omisión (si el Asunto está vacío)',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Patrón de coincidencia en el Asunto',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Título de Patrón',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Usar sintaxis PCRE, incluyendo deliminatores de inicio y fin',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli para aplicar',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Stimulus a aplicar cuando el tickes esté en un estado determinado',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Usar el formato <state_code>:<stimulus_code>',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Comporamiento en caso de requiriente desconocido',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Crear una nueva Persona',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Rechazar el correo',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown Caller rejection reply~~',

	'Class:MailInboxStandard/Attribute:trace' => 'Traza de Depuración',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Si',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'No',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Agregar más contactos (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Nunca',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Cuando se cree un nuevo Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Cuando se actualice un Ticket existenge',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Siempre',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Valores por Omisión para Nueva Persona',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Log de Depuración',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Comportamiento',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Borrar el mensaje del buzón',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Mantener el mensaje en el buzón',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Reenviar correos A',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(De/From)',
	'MailInbox:Server' => 'Configuración de Buzón',
	'MailInbox:Behavior' => 'Comportamiento de correos Entrantes',
	'MailInbox:Caller' => 'Requiriente Desconocido',
	'MailInbox:Errors' => 'Correos con Error',
	'MailInbox:OtherContacts' => 'Comportamiento para Contactos Adicionales',
	'Menu:MailInboxes' => 'Buzones de correos Entrantes',
	'Menu:MailInboxes+' => 'Configuración de buzones para búsqueda de correos Entrantes',
	'MailInboxStandard:DebugTrace' => 'Traza de Depuración',
	'MailInboxStandard:DebugTraceNotActive' => 'Activar la depuración en este buzón para ver traza de depuración aquí.',
	'MailInbox:NoSubject' => 'Sin Asunto',
));

//
// Class: MailInboxStandard
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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
