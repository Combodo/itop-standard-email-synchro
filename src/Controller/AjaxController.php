<?php
/**
 * @copyright   Copyright (C) 2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */
namespace Combodo\iTop\Extension\StandardEmailSynchro\Controller;


use CMDBSource;
use Combodo\iTop\Application\TwigBase\Controller\Controller;
use DBObjectSearch;
use DBObjectSet;
use HTMLSanitizer;
use IssueLog;
use MetaModel;
use RawEmailMessage;
use utils;
use Dict;

class AjaxController extends Controller
{
	public function OperationPreviewEML()
	{
		$iTicketId = (int)utils::ReadParam('ticket_id', 0);
		$sUIDL = utils::ReadParam('uidl', '', false, 'raw_data');
		
		$aMessage = $this->DecodeEML($iTicketId, $sUIDL);
		$this->DisplayAjaxPage(['message' => $aMessage], 'eml_preview');
	}
	
	public function OperationDownloadEML()
	{
		$iTicketId = (int)utils::ReadParam('ticket_id', 0);
		$sUIDL = utils::ReadParam('uidl', '', false, 'raw_data');
		
		$oBlob = $this->GetEML($iTicketId, $sUIDL);
		if ($oBlob !== null)
		{
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="message.eml"');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Expires: 0');			
			header('Content-Length: '.strlen($oBlob->GetData()));
			echo $oBlob->GetData();
		}
	}

	public function OperationCheckUIDLs()
	{
		$iTicketId = (int)utils::ReadParam('ticket_id', 0);
		$aUIDLs = utils::ReadParam('uidls', array(), false, 'raw_data');
		$aReplicas = $this->CheckUIDLs($iTicketId, $aUIDLs);
		$this->DisplayJSONPage($aReplicas);
	}
	
	public function OperationDebugTrace()
	{
		$iMailInboxId = utils::ReadParam('id', 0, false, 'raw_data');
		$oInbox = MetaModel::GetObject('MailInboxBase', $iMailInboxId, false);
		$sMessage = '';
		$sTrace = '';

		if(is_object($oInbox))
		{
			if ($oInbox->Get('trace') == 'yes')
			{
				$sTrace = $oInbox->Get('debug_trace');
			}
			else
			{
				$sMessage = 'MailInboxStandard:DebugTraceNotActive';
			}
		}
		else
		{
			$sMessage = 'UI:ObjectDoesNotExist';
		}

		$this->DisplayAjaxPage(['message' => $sMessage, 'trace' => $sTrace], 'debug_trace');
	}
	
	private function GetEML(int $iTicketId, string $sUIDL)
	{
		$oTicket = MetaModel::GetObject('Ticket', $iTicketId, false);
		if (is_object($oTicket))
		{
			// Ok, we can read the ticket, so we are allowed to read all emails related to the ticket
			$sOQL = "SELECT EmailReplica WHERE ticket_id=$iTicketId AND uidl = ".CMDBSource::Quote($sUIDL);
			$oSearch = DBObjectSearch::FromOQL($sOQL);
			$oSearch->AllowAllData();
			$oReplicaSet = new DBObjectSet($oSearch);
			$oReplica = $oReplicaSet->Fetch();
			if ($oReplica !== null)
			{
				$oBlob = $oReplica->Get('contents');
				return $oBlob;
			}
		}
		return null;
	}
	
	private function DecodeEML(int $iTicketId, string $sUIDL)
	{
		$oBlob = $this->GetEML($iTicketId, $sUIDL);
		if ($oBlob !== null)
		{
			$oMessage = new RawEmailMessage($oBlob->GetData());
			return [
				'subject' => $oMessage->GetSubject(),
				'date' => $oMessage->GetHeader('Date', $oMessage->GetHeaders()),
				'body' => HTMLSanitizer::Sanitize($oMessage->GetHTMLBody()),
				'download_url' => utils::GetAbsoluteUrlModulePage('itop-standard-email-synchro', 'ajax2.php', ['operation' => 'DownloadEML', 'ticket_id' => $iTicketId, 'uidl' => $sUIDL]),
			];
		}
		return [];
	}

	private function CheckUIDLs(int $iTicketId, $aUIDLs)
	{
		$aReplicas = [];
		if (count($aUIDLs) > 0)
		{
			$oTicket = MetaModel::GetObject('Ticket', $iTicketId, false);
			if (is_object($oTicket))
			{
				// Ok, we can read the ticket, so we are allowed to read all emails related to the ticket
				$sOQL = "SELECT EmailReplica WHERE ticket_id=$iTicketId AND uidl IN (".implode(',', CMDBSource::Quote($aUIDLs)).')';
				$oSearch = DBObjectSearch::FromOQL($sOQL);
				$oSearch->AllowAllData();
				$oReplicaSet = new DBObjectSet($oSearch);
				$oReplicaSet->OptimizeColumnLoad(array('EmailReplica' => array('uidl')));
				
				while($oReplica = $oReplicaSet->Fetch())
				{
					$aReplicas[$oReplica->Get('uidl')] = true;
				}
			}
		}
		return $aReplicas;
	}
}