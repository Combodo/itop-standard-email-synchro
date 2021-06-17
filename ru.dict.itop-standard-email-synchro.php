<?php
/**
 * Localized data
 *
 * @author      Vladimir Kunin <v.b.kunin@gmail.com>
 * @link        http://community.itop-itsm.ru  iTop Russian Community
 * @link        https://github.com/itop-itsm-ru/itop-rus
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
Dict::Add('RU RU', 'Russian', 'Русский', array(
	// Dictionary entries go here
	'Class:MailInboxStandard' => 'Стандартный почтовый ящик',
	'Class:MailInboxStandard+' => 'Источник входящих сообщений электронной почты',
	'Class:MailInboxStandard/Attribute:behavior' => 'Поведение',
	'Class:MailInboxStandard/Attribute:behavior/Value:create_only' => 'Создать новый тикет',
	'Class:MailInboxStandard/Attribute:behavior/Value:update_only' => 'Обновить существующий тикета',
	'Class:MailInboxStandard/Attribute:behavior/Value:both' => 'Создать или обновить тикет',

	'Class:MailInboxStandard/Attribute:email_storage' => 'После обработки сообщения',
	'Class:MailInboxStandard/Attribute:email_storage/Value:keep' => 'Оставить сообщение в п/я',
	'Class:MailInboxStandard/Attribute:email_storage/Value:delete' => 'Удалить сообщение из п/я',
	'Class:MailInboxStandard/Attribute:email_storage/Value:move' => 'Move to another folder~~',

	'Class:MailInboxStandard/Attribute:target_folder' => 'Target folder~~',
	'Class:MailInboxStandard/Attribute:target_folder+' => 'Only used to move an email with the IMAP protocol~~',

	'Class:MailInboxStandard/Attribute:target_class' => 'Класс тикета',
	'Class:MailInboxStandard/Attribute:target_class/Value:Incident' => 'Инцидент',
	'Class:MailInboxStandard/Attribute:target_class/Value:UserRequest' => 'Запрос',

	'Class:MailInboxStandard/Attribute:ticket_default_values' => 'Значения по умолчанию',
	'Class:MailInboxStandard/Attribute:ticket_default_title' => 'Название тикета (если Тема пустая)',
	'Class:MailInboxStandard/Attribute:title_pattern+' => 'Шаблон для поиска в теме сообщения',
	'Class:MailInboxStandard/Attribute:title_pattern' => 'Шаблон темы сообщения (RegExp)',
	'Class:MailInboxStandard/Attribute:title_pattern?' => 'Используйте синтаксис PCRE, в том числе начальный и конечный разделители',

	'Class:MailInboxStandard/Attribute:stimuli' => 'Действия для выполнения',
	'Class:MailInboxStandard/Attribute:stimuli+' => 'Выполнять указанные действия, если тикет находится в соответствующем статусе',
	'Class:MailInboxStandard/Attribute:stimuli?' => 'Используйте формат: <код_статуса>:<код_действия>, пример: pending:ev_assign',

	'Class:MailInboxStandard/Attribute:unknown_caller_behavior' => 'Поведение при неизвестном отправителе',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:create_contact' => 'Создать новую Персону',
	'Class:MailInboxStandard/Attribute:unknown_caller_behavior/Value:reject_email' => 'Отклонить сообщение',

    'Class:MailInboxStandard/Attribute:unknown_caller_rejection_reply' => 'Unknown Caller rejection reply~~',

	'Class:MailInboxStandard/Attribute:trace' => 'Отладка',
	'Class:MailInboxStandard/Attribute:trace/Value:yes' => 'Да',
	'Class:MailInboxStandard/Attribute:trace/Value:no' => 'Нет',
	
	'Class:MailInboxStandard/Attribute:import_additional_contacts' => 'Добавлять контакты (Кому, Копия)',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:never' => 'Никогда',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_creation' => 'При создании нового тикета',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:only_on_update' => 'При обновлении существующего тикета',
	'Class:MailInboxStandard/Attribute:import_additional_contacts/Value:always' => 'Всегда',
		
	'Class:MailInboxStandard/Attribute:caller_default_values' => 'Значения по умолчанию для новой Персоны',
	'Class:MailInboxStandard/Attribute:debug_log' => 'Журная отладки',
	'Class:MailInboxStandard/Attribute:error_behavior' => 'Поведение',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:delete' => 'Удалить сообщение из п/я',
	'Class:MailInboxStandard/Attribute:error_behavior/Value:mark_as_error' => 'Оставить сообщение в п/я',
	'Class:MailInboxStandard/Attribute:notify_errors_to' => 'Переслать сообщение (Кому)',
	'Class:MailInboxStandard/Attribute:notify_errors_from' => 'Переслать сообщение (От)',
	'MailInbox:Server' => 'Настройки почтового ящика',
	'MailInbox:Behavior' => 'При входящем сообщении',
	'MailInbox:Caller' => 'Неизвестный отправитель',
	'MailInbox:Errors' => 'Сообщение с ошибкой',
	'MailInbox:OtherContacts' => 'Дополнительные Контакты',
	'Menu:MailInboxes' => 'Входящая почта',
	'Menu:MailInboxes+' => 'Настройка почтовых ящиков для входящих сообщений электронной почты',
	'MailInboxStandard:DebugTrace' => 'Отладка',
	'MailInboxStandard:DebugTraceNotActive' => 'Включите отладку в настройках почтового ящика, чтобы увидеть трассировки.',
	'MailInbox:NoSubject' => 'Нет темы',
));

//
// Class: MailInboxStandard
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
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
