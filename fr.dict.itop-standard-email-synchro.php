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

Dict::Add('FR FR', 'French', 'Français', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Boîte Mail Standard',
	'Class:MailInboxStandard+' => 'Source d\'eMails',

	'Class:MailInboxStandard/Attribute:behavior' => 'A réception d\'un eMail',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Créer un Ticket',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Mettre à jour un Ticket existant',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Créer ou mettre à jour un Ticket',
    'Class:MailInboxStandard/Attribute:behavior+' => 'Comportement lorsqu\'un nouveau message arrives dans la boîte mail:
- Créer ou mettre à jour un Ticket : met à jour le Ticket correspondant, sinon en crée un nouveau.
- Créer un Ticket : Crée systèmatiquement un nouveau ticket pour chaque message reçu.
- Mettre à jour un Ticket existant : met à jour le Ticket correspondant, sinon marque le message en erreur.',

	'Class:MailInboxStandard/Attribute:email_storage' => 'Après traitement de l\'eMail',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Conserver l\'eMail sur le serveur',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Effacer immédiatement l\'eMail',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Déplacer vers un autre dossier',
    'Class:MailInboxStandard/Attribute:email_storage+' => 'Choisir l\'action à effectuer après le traitement réussi d\'un eMail entrant.
Les eMails en erreur ne sont pas concernés par ce choix. Leur traitement dépend du paramètre \'Comportement en cas d\'erreur\'.',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Dossier cible',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Utilisé uniquement pour déplacer un e-mail avec le protocole IMAP',

	'Class:MailInboxStandard/Attribute:target_class' => 'Type de Ticket',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Incident',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Demande utilisateur',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Ticket de Changement',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Changement de Routine',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Changement Normal',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Changement en urgence',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problème',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '',
    'Class:MailInboxStandard/Attribute:target_class+' => 'Quel type de Ticket sera créé ou mis à jour par les messages reçus sur cette boîte mail ? Un seul type possible.',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Valeurs par défaut du Ticket',
    'Class:MailInboxStandard/Attribute:ticket_default_values+' => 'Initialiser les champs obligatoires en création du ticket avec des valeurs par défaut.
Le titre, le demandeur, l\'organisation, la description et l\'origine sont déjà gérés.
Une ligne par champ, au format format: <code_attribut>:<valeur>
Pour initialiser des clés externes comme \'org_id\', mettre comme valeur l\'id (ou le nom complet - moins pérenne).
Limitation connue : service_id:Service Médical ⇒ n\'est pas reconnu à cause des accents.',
    'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'Un champ par ligne, au format <code_attribut>:<valeur>',

	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Titre par défaut (en cas de sujet vide)',
    'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'Le sujet de l\'eMail est copié dans le titre du ticket lors de la création. 
 Si le sujet de l\'eMail reçu est vide, alors ce titre par défaut sera utilisé pour créer le ticket',

	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Expression régulière à rechercher dans l\'objet de l\'eMail',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Recherche dans l\'objet du mail (RegExp)',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Utilisez la syntaxe PCRE avec les délimiteurs de début et de fin',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Stimuli à appliquer',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Définir pour chaque état du ticket le stimulus à appliquer à la réception d\'un message.
Un couple état/stimulus par ligne, au format <code_etat>:<code_stimulus>',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Un couple état/stimulus par ligne, au format <code_etat>:<code_stimulus>',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'En cas d\'expéditeur inconnu',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Créer une nouvelle Personne',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Rejeter l\'eMail',
    'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Si l\'expéditeur de l\'eMail n\'est pas reconnu, que faire :
 - Créer une nouvelle Personne : dans '.ITOP_APPLICATION_SHORT.' avec l\'eMail de l\'expéditeur et les \'Valeurs par défaut pour la nouvelle Personne\'
 - Rejeter l\'eMail : ce qui le marquera en erreur et répondra avec le contenu du champ \'Réponse aux expéditeurs inconnus\'.',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Réponse aux expéditeurs inconnus',
    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Ce champ optionnel spécifie le message à envoyer aux expéditeurs inconnus.
Un expéditeur inconnu est celui dont l\'adresse mail ne correspond à aucune Personne dans '.ITOP_APPLICATION_SHORT.'.
Si ce champ est laissé vide, alors aucune réponse ne leur est envoyée.',

	'Class:MailInboxStandard/Attribute:trace' => 'Activer la trace',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Oui',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Non',
    'Class:MailInboxStandard/Attribute:trace+' => '	Permet d\'enregistrer les diffèrentes opérations effectuées lors du traitement des eMails reçus par cette boîte mail.
Ne laissez pas cette option activée trop longtemps dans un environnement de production, car elle génére une grande quantité de données qui peut ralentir votre serveur',

	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Ajouter des contacts (To, CC)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Jamais',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'Lors de la création d\'un nouveau Ticket',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'Lors de la mise à jour d\'un Ticket existant',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Toujours',
    'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Rechercher les contacts ayant comme email, l\'adresse d\'un destinataire du message, et les lier au Ticket.
Les contacts déjà liés sont ignorés. Les adresses mail inconnues sont ignorées.',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Valeurs par défaut pour la nouvelle Personne',
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Fournir une valeur pour tous les champs obligatoires de la Personne, sauf l\'email.
Un champ par ligne, au format <code_attribut>:<valeur>',
    'Class:MailInboxStandard/Attribute:caller_default_values?' => 'Un champ par ligne, au format <code_attribut>:<valeur>',

    'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug trace',
    'Class:MailInboxStandard/Attribute:debug_trace+' => '',

	'Class:MailInboxStandard/Attribute:error_behavior' => 'Comportement en cas d\'erreur',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Supprimer l\'eMail de la boîte mail',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Garder l\'eMail dans la boîte mail',
    'Class:MailInboxStandard/Attribute:error_behavior+' => 'Causes les plus fréquentes de mail en erreur :
- Les messages dont la taille dépasse le paramètre \'maximum_email_size\'.
- Les messages dont l\'expéditeur ne correspond pas à une Personne dans '.ITOP_APPLICATION_SHORT.'
- Les messages dont le format n\'est pas supporté (chiffré, inconnu, etc.)',

	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Faire suivre l\'eMail à',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'L\'adresse mail à laquelle faire suivre les eMails en erreur. 
Si cette adresse est vide et que les eMails en erreur sont supprimés, alors personne ne sera informé et aucune investigation ne pourra être mené.',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => '(De)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'L\'adresse mail à utiliser comme expéditeur des messages faisant suivre les eMails en erreur. 
Si elle n\'est pas spécifiée, la plupart des serveurs mail détruiront ces messages pour des raisons de sécurité.',

// Fieldsets and Tabs

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

