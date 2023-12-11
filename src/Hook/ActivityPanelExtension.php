<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */
namespace Combodo\iTop\Extension\StandardEmailSynchro\Hook;

use AbstractApplicationUIExtension;
use Dict;
use utils;
use WebPage;


class ActivityPanelExtension extends AbstractApplicationUIExtension
{
	/**
	 * @inheritDoc
	 */
	public function OnDisplayProperties($oObject, WebPage $oPage, $bEditMode = false)
	{
		if ($oObject instanceof \Ticket) // TODO: check the mailinbox objects to check what are the target classes
		{
			$iTicketId = $oObject->GetKey();
			$sJSUrl = json_encode(utils::GetAbsoluteUrlModulePage('itop-standard-email-synchro', 'ajax.php'));
			$sJSMsgClickToView = json_encode(Dict::S('MailInboxStandard:ClickToViewSourceEmail'));
			$sJSMsgViewSourceEmail = json_encode(Dict::S('MailInboxStandard:ViewSourceEmail'));
			$sJSMsgEmailNotAvailable = json_encode(Dict::S('MailInboxStandard:EmailNotAvailable'));
			$sJSMsgDlgTitle = json_encode(Dict::S('MailInboxStandard:PreviewDlgTitle'));
			$oPage->add_ready_script(
<<<JAVASCRIPT
let aUIDLs = [];
const sUrl = $sJSUrl;
$('a[data-role=\"email-uidl\"]').each(function() {
	aUIDLs.push($(this).attr('data-object-id'));
});
$.post(sUrl, {operation: 'CheckUIDLs', ticket_id: $iTicketId, uidls: aUIDLs}, function(data) {
	$('a[data-role=\"email-uidl\"]').each(function() {
		const uidl = $(this).attr('data-object-id');
		if (data[uidl]) {
			$(this)
			.attr('title', $sJSMsgClickToView)
			.attr('onclick', 'DoDisplayEML($iTicketId, "'+uidl+'")')
			.attr('style', 'display: block; margin-top: -1.5rem; font-size: 1.0rem; color: var(--ibo-hyperlink-color);')
			.html('<span class="fas fa-envelope"></span> <span style="font-size: 1rem;">'+$sJSMsgViewSourceEmail+'</span>');
		} else {
			$(this).attr('title', $sJSMsgEmailNotAvailable)
			.attr('style', 'display: block; margin-top: -1.5em; opacity: 0.5; cursor: not-allowed;')
			.html('<span class="fas fa-envelope"></span> <span style="font-size: 1rem;">'+$sJSMsgEmailNotAvailable+'</span>');
		}
	});
}, 'json');
JAVASCRIPT
				);
			$oPage->add_script(
<<<JAVASCRIPT
function DoDisplayEML(ticket_id, uidl)
{
	const sUrl = $sJSUrl;
	$.post(sUrl, {operation: 'PreviewEml', ticket_id: ticket_id, uidl: uidl}, function(data) {
		$('body').append('<div style="display:none" id="DoDisplayEMLSourceDlg">'+data+'</div>');
		$('#DoDisplayEMLSourceDlg').dialog({
			title: $sJSMsgDlgTitle,
			autoOpen: true,
			modal: true,
			width: 800,
			close: function() { $(this).remove(); },
		});
	}, 'html');
}
JAVASCRIPT
				);
		}
	}
}
