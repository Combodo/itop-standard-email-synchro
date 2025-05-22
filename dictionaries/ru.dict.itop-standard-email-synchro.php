<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2024 Combodo SAS
 * @license    https://opensource.org/licenses/AGPL-3.0
 * 
 */
/**
 * @author Vladimir Kunin <v.b.kunin@gmail.com>
 *
 */
Dict::Add('RU RU', 'Russian', 'Русский', [
	'Class:MailInboxStandard' => 'Стандартный почтовый ящик',
	'Class:MailInboxStandard+' => 'Источник входящих сообщений электронной почты',
	'Class:MailInboxStandard/Attribute:behavior' => 'Поведение',
	'Class:MailInboxStandard/Attribute:behavior+' => 'Behavior when a new message arrives in the inbox:
- Create or Update: Update a matching Ticket found, otherwise create. 
- Create new ticket: Every new message creates a new Ticket.
- Update existing ticket: Update a matching Ticket found, otherwise flag in error.~~',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Создать или обновить тикет',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Создать новый тикет',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Обновить существующий тикета',
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Значения по умолчанию для новой Персоны',
	'Class:MailInboxStandard/Attribute:caller_default_values+' => 'Provide a value for all mandatory fields of a Person, except email.
Use one field initialization per line, in the format: <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:caller_default_values?' => 'One setting per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Журная отладки',
	'Class:MailInboxStandard/Attribute:debug_trace' => 'Debug trace~~',
	'Class:MailInboxStandard/Attribute:debug_trace+' => '~~',
	'Class:MailInboxStandard/Attribute:email_storage' => 'После обработки сообщения',
	'Class:MailInboxStandard/Attribute:email_storage+' => 'Select the action to be taken after successfully processing an incoming eMail.
eMails in error are not in the scope of this setting, they are handled using the field \'Behavior in case of error\'.~~',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Удалить сообщение из п/я',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Оставить сообщение в п/я',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move it to another folder~~',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Поведение',
	'Class:MailInboxStandard/Attribute:error_behavior+' => 'Root causes of eMails in error: 
- Messages too big (size > \'maximum_email_size\'),
- Unknown sender (email address not found in '.ITOP_APPLICATION_SHORT.' Persons),
- eMail format not supported (e.g. encrypted, unknown, etc.),~~',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Удалить сообщение из п/я',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Оставить сообщение в п/я',
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Добавлять контакты (Кому, Копия)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts+' => 'Search for '.ITOP_APPLICATION_SHORT.' contacts having the email address present in To and CC of the received eMail message, and link them to the Ticket.
Already linked contacts are ignored. Unknown email addresses are ignored.~~',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Всегда',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Никогда',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'При создании нового тикета',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'При обновлении существующего тикета',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => 'Переслать сообщение (От)',
	'Class:MailInboxStandard/Attribute:notify_errors_from+' => 'The email address to be used as the “sender” of error notifications. 
Required when forwarding the eMails in error, as most mail servers only relay messages with a defined sender address.~~',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Переслать сообщение (Кому)',
	'Class:MailInboxStandard/Attribute:notify_errors_to+' => 'The email address to which to forward emails in error. 
eMails in error are forwarded as an attachment, unless they are too big, in which case they are moved to a directory specified in the \'big_files_dir\' configuration.
If this address is left empty and if the emails in error are deleted, then nobody will notice the issue and be able to troubleshoot.~~',
	'Class:MailInboxStandard/Attribute:stimuli' => 'Действия для выполнения',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Выполнять указанные действия, если тикет находится в соответствующем статусе',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Используйте формат: <код_статуса>:<код_действия>, пример: pending:ev_assign',
	'Class:MailInboxStandard/Attribute:target_class' => 'Класс тикета',
	'Class:MailInboxStandard/Attribute:target_class+' => 'Which class of Ticket to create or update when a new eMail arrives in this inbox. Only one class is possible.~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change' => 'Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Change+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange' => 'Emergency Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:EmergencyChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Инцидент',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange' => 'Normal Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:NormalChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem' => 'Problem~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:Problem+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange' => 'Routine Change~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:RoutineChange+' => '~~',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Запрос',
	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder~~',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol~~',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Название тикета (если Тема пустая)',
	'Class:MailInboxStandard/Attribute:ticket_default_title+' => 'The subject of the incoming eMail is used to feed the title on ticket creation. 
This one is a fallback, used only if the eMail subject is empty~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Значения по умолчанию',
	'Class:MailInboxStandard/Attribute:ticket_default_values+' => 'Provide a value for all the mandatory fields at ticket creation.
Fields title, caller_id, org_id, origin and description are already managed.
One field per line using the format: <field_code>:<value>
When setting external keys such as \'org_id\', use the id (or the friendly name which is less robust).~~',
	'Class:MailInboxStandard/Attribute:ticket_default_values?' => 'One initialization per line, in format <field_code>:<value>~~',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Шаблон темы сообщения (RegExp)',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Шаблон для поиска в теме сообщения',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Используйте синтаксис PCRE, в том числе начальный и конечный разделители',
	'Class:MailInboxStandard/Attribute:trace' => 'Отладка',
	'Class:MailInboxStandard/Attribute:trace+' => '	Use this to track the various operations performed while processing eMails from this Inbox.
Do not activate this option for long periods on production since it tends to generate a lot of output which slows down the server~~',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Нет',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Да',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Поведение при неизвестном отправителе',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior+' => 'Behavior when the sender email is not found in the '.ITOP_APPLICATION_SHORT.' Persons:
 - Create a new Person: with the sender email and the "New Person\'s Default Values"
 - Reject the eMail: flag the eMail in error and reply to the sender with the content of "Unknown senders rejection reply"~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Создать новую Персону',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Отклонить сообщение',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown senders rejection reply~~',
	'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply+' => 'Optional reply to sender used with option “Reject the eMail”.
Unknown senders are email addresses which do not correspond to any Person in '.ITOP_APPLICATION_SHORT.'.
If this field is left empty, then no message is sent to unknown senders~~',
	'MailInbox:Behavior' => 'При входящем сообщении',
	'MailInbox:Caller' => 'Неизвестный отправитель',
	'MailInbox:Errors' => 'Сообщение с ошибкой',
	'MailInbox:NoSubject' => 'Нет темы',
	'MailInbox:OtherContacts' => 'Дополнительные Контакты',
	'MailInbox:Server' => 'Настройки почтового ящика',
	'MailInboxStandard:DebugTrace' => 'Отладка',
	'MailInboxStandard:DebugTraceNotActive' => 'Включите отладку в настройках почтового ящика, чтобы увидеть трассировки.',
	'Menu:MailInboxes' => 'Входящая почта',
	'Menu:MailInboxes+' => 'Настройка почтовых ящиков для входящих сообщений электронной почты',
]);
