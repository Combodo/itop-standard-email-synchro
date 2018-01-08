<?php
// Copyright (C) 2010-2013 Combodo SARL
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

Dict::Add('FR FR', 'French', 'Français', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Boîte Mail Standard',
	'Class:MailInboxStandard+' => 'Source d\'eMails',
	'Class:MailInboxStandard/Attribute:behavior' => 'Comportement',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Créer des Tickets',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Mettre à jour des Tickets existants',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Créer ou mettre à jour des Tickets',

	'Class:MailInboxStandard/Attribute:email_storage' => 'Après traitement de l\'eMail',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Conserver l\'eMail sur le serveur',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Effacer immédiatement l\'eMail',

	'Class:MailInboxStandard/Attribute:target_class' => 'Type de Ticket',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Demande utilisateur',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Valeurs par défaut du Ticket',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Titre par défaut (en cas de sujet vide)',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Expression régulière à rechercher dans l\'objet de l\'eMail',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Recherche dans l\'objet du mail (RegExp)',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Utilisez la syntaxe PCRE avec les délimiteurs de début et de fin',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli à appliquer',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Appliquer un stimulus quand le ticket est dans un état donné',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Utilisez le format <code_etat>:<code_stimulus>',
		
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Comportement pour les contacts inconnus',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Créer une nouvelle Personne',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Rejeter l\'eMail',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Réponse pour les contacts inconnus',

	'Class:MailInboxStandard/Attribute:trace' => 'Activer la trace',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Oui',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Non',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Ajouter des contacts (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Jamais',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Lors de la création d\'un nouveau Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Lors de la mise à jour d\'un Ticket existant',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Toujours',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => "Valeurs par défaut pour la nouvelle Personne",
	'Class:MailInboxStandard/Attribute:debug_log' => 'Traces de Debug',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Comportement en cas d\'erreur',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Supprimer l\'eMail de la boîte mail',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Garder l\'eMail dans la boîte mail',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Faire suivre l\'eMail à',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(De)',
	'MailInbox:Server' => 'Configuration de la boîte mail',
	'MailInbox:Behavior' => 'Comportement',
	'MailInbox:Caller' => 'Contacts inconnus',
	'MailInbox:Errors' => 'eMails en erreur',
	'MailInbox:OtherContacts' => 'Contacts Additionnels',
	'Menu:MailInboxes' => 'Gestion des Boîtes Mail',
	'Menu:MailInboxes+' => 'Configuration des Boîtes Mails à scanner',
	'MailInboxStandard:DebugTrace' => 'Trace de Debug',
	'MailInboxStandard:DebugTraceNotActive' => 'Activez la trace sur cette boîte mail pour voir le résultat ici.',
	'MailInbox:NoSubject' => 'Pas de sujet',
));