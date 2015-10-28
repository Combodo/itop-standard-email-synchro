<?php
class MailInboxStandard extends MailInboxBase
{
	protected static $aUndesiredSubjectPatterns = null;
	
	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,view_in_gui,bizmodel",
			"key_type" => "autoincrement",
			"name_attcode" => array("login"),
			"state_attcode" => "",
			"reconc_keys" => array('server', 'login', 'protocol', 'mailbox', 'port'),
			"db_table" => "mailinbox_standard",
			"db_key_field" => "id",
			"db_finalclass_field" => "realclass",
			"display_template" => "",
			'icon' => utils::GetAbsoluteUrlModulesRoot().basename(dirname(__FILE__)).'/images/mailbox.png',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeEnum("behavior", array("allowed_values"=>new ValueSetEnum('create_only,update_only,both'), "sql"=>"behavior", "default_value"=>'both', "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("target_class", array("allowed_values"=> new ValueSetEnum('Incident,UserRequest,Change,RoutineChange,NormalChange,EmergencyChange,Problem'), "sql"=>"target_class", "default_value"=>'UserRequest', "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("ticket_default_values", array("allowed_values"=>null, "sql"=>"ticket_default_values", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ticket_default_title", array("allowed_values"=>null, "sql"=>"ticket_default_title", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("title_pattern", array("allowed_values"=>null, "sql"=>"title_pattern", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("unknown_caller_behavior", array("allowed_values"=>new ValueSetEnum('create_contact,reject_email'), "sql"=>"unknown_caller_behavior", "default_value"=>'reject_email', "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("caller_default_values", array("allowed_values"=>null, "sql"=>"caller_default_values", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("error_behavior", array("allowed_values"=>new ValueSetEnum('delete,mark_as_error'), "sql"=>"error_behavior", "default_value"=>'mark_as_error', "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEmailAddress("notify_errors_to", array("allowed_values"=>null, "sql"=>"notify_errors_to", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEmailAddress("notify_errors_from", array("allowed_values"=>null, "sql"=>"notify_errors_from", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("trace", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"trace", "default_value"=>'no', "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLongText("debug_trace", array("allowed_values"=>null, "sql"=>"debug_trace", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("email_storage", array("allowed_values"=>new ValueSetEnum('keep,delete'), "sql"=>"email_storage", "default_value"=>'keep', "is_null_allowed"=>false, "depends_on"=>array())));
		
		// Display lists
		// Display lists
		MetaModel::Init_SetZListItems('details', array(
											'col:col0' => array(
													'fieldset:MailInbox:Server' => array('server', 'login', 'password', 'protocol', 'port', 'mailbox', 'active', 'trace'),
													'fieldset:MailInbox:Errors' => array('error_behavior', 'notify_errors_to', 'notify_errors_from'),
											),
											'col:col1' => array(
													'fieldset:MailInbox:Behavior' => array( 'behavior', 'email_storage', 'target_class', 'ticket_default_values', 'ticket_default_title', 'title_pattern'),
													'fieldset:MailInbox:Caller' => array('unknown_caller_behavior', 'caller_default_values'),
											),
										)); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('server', 'mailbox','protocol', 'active')); // Attributes to be displayed for a list
		MetaModel::Init_SetZListItems('standard_search', array('server', 'login', 'mailbox','protocol', 'active')); // Attributes to be displayed in the search form
	}

	/**
	 * Add an extra tab showing the debug trace
	 * @see cmdbAbstractObject::DisplayBareRelations()
	 */
	function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		parent::DisplayBareRelations($oPage, $bEditMode);
		if (!$bEditMode)
		{
			$oPage->SetCurrentTab(Dict::S('MailInboxStandard:DebugTrace'));
			$sAjaxUrl = addslashes(utils::GetAbsoluteUrlModulesRoot().basename(dirname(__FILE__)).'/ajax.php');
			$iId = $this->GetKey();
			if ($this->Get('trace') == 'yes')
			{
				$oPage->add('<p><button type="button" id="debug_trace_refresh">'.Dict::S(Dict::S('UI:Button:Refresh')).'</button></p>');
				$oPage->add('<div id="debug_trace_output"></div>');
				$oPage->add_ready_script(
<<<EOF
$('#debug_trace_refresh').click(function() {
	$('#debug_trace_output').html('<img src="../images/indicator.gif"/>');
	$.post('$sAjaxUrl', {operation: 'debug_trace', id: $iId }, function(data) {
		$('#debug_trace_output').html(data);
	});
});
$('#debug_trace_refresh').trigger('click');
EOF
				);
			}
			else
			{
				$oPage->add('<div id="debug_trace_output"><p>'.Dict::S('MailInboxStandard:DebugTraceNotActive').'</p></div>');
			}
		}
	}
		
	/**
	 * Debug trace: activated/disabled by the configuration flag set for the base module...
	 * @param string $sText
	 */
	protected function Trace($sText)
	{
		parent::Trace($sText);
		$iMaxTraceLength = 500*1024; // Maximum size of the Trace to keep in the database...
		
		if ($this->Get('trace') == 'yes')
		{
			$sStampedText = date('Y-m-d H:i:s').' - '.$sText."\n";
			$this->Set('debug_trace', substr($this->Get('debug_trace').$sStampedText, -$iMaxTraceLength));

			// TODO: store the Trace in a way that does not keep track of history !!!
			// Creating a CMDBChange is no longer needed in 2.0, but let's keep doing it for compatibility with 1.x
			$oMyChange = MetaModel::NewObject("CMDBChange");
			$oMyChange->Set("date", time());
			$sUserString = CMDBChange::GetCurrentUserName();
			$oMyChange->Set("userinfo", $sUserString);
			$iChangeId = $oMyChange->DBInsert();
			$this->DBUpdateTracked($oMyChange);
		}
	}
	
	protected function RecordAttChanges(array $aValues, array $aOrigValues)
	{
		// Do NOT record the changes on the 'debug trace' attribute
		unset($aValues['debug_trace']);
		parent::RecordAttChanges($aValues, $aOrigValues);
	}
	
	/**
	 * Initial dispatching of an incoming email: determines what to do with the email
	 * @param EmailReplica $oEmailReplica The EmailReplica associated with the email. A new replica (i.e. not yet in DB) one for new emails
	 * @return int An action code from EmailProcessor
	 */
	public function DispatchEmail(EmailReplica $oEmailReplica)
	{
		return parent::DispatchEmail($oEmailReplica);
	}
	
	/**
	 * Process an new (unread) incoming email
	 * @param EmailSource $oSource The source from which this email was read
	 * @param int $index The index of the message in the source
	 * @param EmailMessage $oEmail The decoded email
	 * @return Ticket The ticket created or updated in response to the email
	 */
	public function ProcessNewEmail(EmailSource $oSource, $index, EmailMessage $oEmail)
	{		
		$this->Trace("Processing new eMail (index = $index)");
		$oTicket = null;
		if ($this->IsUndesired($oEmail))
		{
			$oRawEmail = $oSource->GetMessage($index);
			$this->HandleError($oEmail, 'undesired_message', $oRawEmail);
			return null;
		}
		$sContactQuery = 'SELECT Contact WHERE email = :email';
		$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sContactQuery), array(), array('email' => $oEmail->sCallerEmail));
		$sAdditionalDescription = '';
		switch($oSet->Count())
		{
			case 1:
			// Ok, the caller was found in iTop
			$oCaller = $oSet->Fetch();
			break;
			
			case 0:
			switch($this->Get('unknown_caller_behavior'))
			{
				case 'reject_email':
				$this->Trace('No contact found for the email address "'.$oEmail->sCallerEmail.'", the ticket will NOT be created');
				$oRawEmail = $oSource->GetMessage($index);
				$this->HandleError($oEmail, 'unknown_contact', $oRawEmail);
				return null;
				break;
				
				case 'create_contact':
				default:
				$this->Trace("Creating a new Person for the email: {$oEmail->sCallerEmail}");
				$oCaller = new Person();
				$oCaller->Set('email', $oEmail->sCallerEmail);
				$sDefaultValues = $this->Get('caller_default_values');
				$aDefaults = explode("\n", $sDefaultValues);
				$aDefaultValues = array();
				foreach($aDefaults as $sLine)
				{
					if (preg_match('/^([^:]+):(.*)$/', $sLine, $aMatches))
					{
						$sAttCode = trim($aMatches[1]);
						$sValue = trim($aMatches[2]);
						$aDefaultValues[$sAttCode] = $sValue;
					}
				}
				$this->InitObjectFromDefaultValues($oCaller, $aDefaultValues);
				try
				{
					// Creating a CMDBChange is no longer needed in 2.0, but let's keep doing it for compatibility with 1.x
					$oMyChange = MetaModel::NewObject("CMDBChange");
					$oMyChange->Set("date", time());
					$sUserString = CMDBChange::GetCurrentUserName();
					$oMyChange->Set("userinfo", $sUserString);
					$iChangeId = $oMyChange->DBInsert();
					$oCaller->DBInsertTracked($oMyChange);					
				}
				catch(Exception $e)
				{
					$this->Trace('Failed to create a Person for the email address "'.$oEmail->sCallerEmail.'".');
					$this->Trace($e->getMessage());
					$oRawEmail = $oSource->GetMessage($index);
					$this->HandleError($oEmail, 'failed_to_create_contact', $oRawEmail);
					return null;
				}
				
			}			
			break;
			
			default:
			$this->Trace('Found '.$oSet->Count().' callers with the same email address "'.$oEmail->sCallerEmail.'", the first one will be used...');
			// Multiple callers with the same email address !!!
			$oCaller = $oSet->Fetch();
		}
		
		// Check whether we need to create a new ticket or to update an existing one
		// First check if there are any iTop object mentioned in the headers of the eMail
		$oTicket = $oEmail->oRelatedObject;
		
		if (($oTicket != null) && !($oTicket instanceof Ticket))
		{
			// The object referenced by the email is not a ticket !!
			// => Forward the message and delete the ticket ??
			$this->Trace("iTop Standard Email Synchro: WARNING the message $index ({$oEmail->sUIDL}) contains a reference to a valid iTop object that is NOT a ticket !");
			$oTicket = null;
		}
		
		if ($oTicket == null)
		{
			// No associated ticket found by parsing the headers, check
			// if the subject does not match a specific pattern
			$sPattern = $this->FixPattern($this->Get('title_pattern'));
			if(($sPattern != '') && (preg_match($sPattern, $oEmail->sSubject, $aMatches)))
			{
				$iTicketId = 0;
				sscanf($aMatches[1], '%d', $iTicketId);
				$this->Trace("iTop Simple Email Synchro: Retrieving ticket ".$iTicketId." (match by subject pattern)...");
				$oTicket = MetaModel::GetObject('Ticket', $iTicketId, false);
			}
		}
		
		switch($this->Get('behavior'))
		{
			case 'create_only':
			$oTicket = $this->CreateTicketFromEmail($oEmail, $oCaller);
			break;
			
			case 'update_only':
			if (!is_object($oTicket))
			{
				// No ticket associated with the incoming email, nothing to update, reject the email
				$oRawEmail = $oSource->GetMessage($index);
				$this->HandleError($oEmail, 'nothing_to_update', $oRawEmail);
			}
			else
			{
				// Update the ticket with the incoming eMail
				$this->UpdateTicketFromEmail($oTicket, $oEmail, $oCaller);
			}
			break;
			
			default: // both: update or create as needed
			if (!is_object($oTicket))
			{
				// Let's create a new ticket
				$oTicket = $this->CreateTicketFromEmail($oEmail, $oCaller);
			}
			else
			{
				// Update the ticket with the incoming eMail
				$this->UpdateTicketFromEmail($oTicket, $oEmail, $oCaller);
			}
			break;			
		}
		
		return $oTicket;
	}
	
	/**
	 * Actual creation of the ticket from the incoming email. Overload this method
	 * to implement your own behavior, if needed
	 * @param EmailMessage $oEmail The decoded incoming email
	 * @param Contact $oCaller The contact corresponding to the "From" email address
	 * @return Ticket the created ticket or null in case of failure
	 */
	public function CreateTicketFromEmail(EmailMessage $oEmail, Contact $oCaller)
	{
			// In case of error (exception...) set the behavior
		if ($this->Get('error_behavior') == 'delete')
		{
			$this->SetNextAction(EmailProcessor::DELETE_MESSAGE); // Remove the message from the mailbox
		}
		else
		{
			$this->SetNextAction(EmailProcessor::MARK_MESSAGE_AS_ERROR); // Keep the message in the mailbox, but marked as error
		}
		$this->Trace("Creating a new Ticket from eMail '".$oEmail->sSubject."'");
		if (!MetaModel::IsValidClass($this->Get('target_class')))
		{
			throw new Exception('Invalid "ticket_class" configured: "'.$this->Get('target_class').'" is not a valid class. Cannot create such an object.');
		}
		$oTicket = MetaModel::NewObject($this->Get('target_class'));
		$oTicket->Set('org_id', $oCaller->Get('org_id'));
		if (MetaModel::IsValidAttCode(get_class($oTicket), 'caller_id'))
		{
			$oTicket->Set('caller_id', $oCaller->GetKey());
		}
		if (MetaModel::IsValidAttCode(get_class($oTicket), 'origin'))
		{
			$oTicket->Set('origin', 'mail');
		}
		if ($oEmail->sSubject == '')
		{
			$sDefaultSubject = ($this->Get('ticket_default_title') == '') ? Dict::S('MailInbox:NoSubject') : $this->Get('ticket_default_title');
			$this->Trace("The incoming email has no subject, the ticket's title will be set to: '$sDefaultSubject'");
			$oTicket->Set('title', $sDefaultSubject);
		}
		else
		{
			$oAttDef = MetaModel::GetAttributeDef(get_class($oTicket), 'title');
			$iMaxSize = $oAttDef->GetMaxSize();
			$oTicket->Set('title', substr($oEmail->sSubject, 0, $iMaxSize));
		}
		
		$aIgnoredAttachments = array();
		
		// Insert the remaining attachments so that we know their ID and can reference them in the message's body
		
		// Creating a CMDBChange is no longer needed in 2.0, but let's keep doing it for compatibility with 1.x
		$oMyChange = MetaModel::NewObject("CMDBChange");
		$oMyChange->Set("date", time());
		$sUserString = CMDBChange::GetCurrentUserName();
		$oMyChange->Set("userinfo", $sUserString);
		$iChangeId = $oMyChange->DBInsert();
		
		$aAddedAttachments = $this->AddAttachments($oTicket, $oEmail, $oMyChange, true, $aIgnoredAttachments);  // Cannot insert them for real since the Ticket is not saved yet (we don't know its ID)
																												// we'll have to call UpdateAttachments once the ticket is properly saved
		
		$this->Trace("Email body format: ".$oEmail->sBodyFormat);
		if ($oEmail->sBodyFormat == 'text/html')
		{
			$this->Trace("Managing inline images...");
			$sBodyText = $this->ManageInlineImages($oEmail->sBodyText, $aAddedAttachments, $aIgnoredAttachments);
			$this->Trace("Removing HTML tags...");
			$sBodyText = $oEmail->StripTags($sBodyText);
		}
		else
		{
			$sBodyText = $oEmail->sBodyText;
		}
		$sTicketDescription = $sBodyText;
		if (empty($sTicketDescription))
		{
			$sTicketDescription = 'No description provided.';
		}
		$oAttDef = MetaModel::GetAttributeDef(get_class($oTicket), 'description');
		$iMaxSize = $oAttDef->GetMaxSize();
		$bTextTruncated = false;
		if (strlen($sTicketDescription) > $iMaxSize)
		{
			$oEmail->aAttachments[] = array('content' => $sTicketDescription, 'filename' => 'original message.txt', 'mimeType' => 'text/plain');
		}
		$oTicket->Set('description', $this->FitTextIn($sTicketDescription, $iMaxSize - 1000)); // Keep some room just in case...
		
		// Default values
		$sDefaultValues = $this->Get('ticket_default_values');
		$aDefaults = explode("\n", $sDefaultValues);
		$aDefaultValues = array();
		foreach($aDefaults as $sLine)
		{
			if (preg_match('/^([^:]+):(.*)$/', $sLine, $aMatches))
			{
				$sAttCode = trim($aMatches[1]);
				$sValue = trim($aMatches[2]);
				$aDefaultValues[$sAttCode] = $sValue;
			}
		}
		$this->InitObjectFromDefaultValues($oTicket, $aDefaultValues);
		
		$oTicket->DBInsertTracked($oMyChange);
		$this->Trace("Ticket ".$oTicket->GetName()." created.");
		
		// Process attachments
		$this->UpdateAttachments($aAddedAttachments, $oTicket); // Now update the attachment since we know the ID of the ticket
		
		if ($this->Get('email_storage') == 'delete')
		{
			// Remove the processed message from the mailbox
			$this->Trace("Ticket created, deleting the source eMail '".$oEmail->sSubject."'");
			$this->SetNextAction(EmailProcessor::DELETE_MESSAGE);		
		}
		else
		{
			// Keep the message in the mailbox
			$this->SetNextAction(EmailProcessor::NO_ACTION);		
		}
		return $oTicket;
	}
	
	
	/**
	 * Actual update of a ticket from the incoming email. Overload this method
	 * to implement your own behavior, if needed
	 * @param Ticket $oTicket The ticket to update
	 * @param EmailMessage $oEmail The decoded incoming email
	 * @param Contact $oCaller The contact corresponding to the "From" email address
	 * @return void
	 */
	public function UpdateTicketFromEmail(Ticket $oTicket, EmailMessage $oEmail, Contact $oCaller)
	{
		// In case of error (exception...) set the behavior
		if ($this->Get('error_behavior') == 'delete')
		{
			$this->SetNextAction(EmailProcessor::DELETE_MESSAGE); // Remove the message from the mailbox
		}
		else
		{
			$this->SetNextAction(EmailProcessor::MARK_MESSAGE_AS_ERROR); // Keep the message in the mailbox, but marked as error
		}		
		
		// Check that the ticket is of the expected class
		if (!is_a($oTicket, $this->Get('target_class')))
		{
			$this->Trace("iTop Simple Email Synchro: Error: the incoming email refers to the ticket ".$oTicket->GetName()." of class ".get_class($oTicket).", but this mailbox is configured to process only tickets of class ".$this->Get('target_class'));
			$this->SetNextAction(EmailProcessor::MARK_MESSAGE_AS_ERROR); // Keep the message in the mailbox, but marked as error
			return;
		}
		
		// Try to extract what's new from the message's body
		$this->Trace("iTop Simple Email Synchro: Updating the iTop ticket ".$oTicket->GetName()." from eMail '".$oEmail->sSubject."'");

		// Creating a CMDBChange is no longer needed in iTop 2.0, but let's keep doing it for compatibility with 1.x
		$oMyChange = MetaModel::NewObject("CMDBChange");
		$oMyChange->Set("date", time());
		$sUserString = CMDBChange::GetCurrentUserName();
		$oMyChange->Set("userinfo", $sUserString);
		$oMyChange->DBInsert();
		
		// Process attachments
		$aIgnoredAttachments = array();
		$aAddedAttachments = $this->AddAttachments($oTicket, $oEmail, $oMyChange, true, $aIgnoredAttachments);
		
		$this->Trace("Email body format: ".$oEmail->sBodyFormat);
		$this->Trace("Extracting the new part...");
		if ($oEmail->sBodyFormat == 'text/html')
		{
			$this->Trace("Managing inline images...");
			$sBodyText = $this->ManageInlineImages($oEmail->sBodyText, $aAddedAttachments, $aIgnoredAttachments);
		}
		else
		{
			$sBodyText = $oEmail->sBodyText;
		}
		$sBodyText = $oEmail->GetNewPart($sBodyText, $oEmail->sBodyFormat); // GetNewPart always returns a plain text version of the message
		
		$this->Trace($oEmail->sTrace);
		// Write the log on behalf of the caller
		$sCallerName = $oEmail->sCallerName;
		if (empty($sCallerName))
		{
			$sCallerName = $oEmail->sCallerEmail;
		}
					
		// Determine which field to update
		$sAttCode = 'public_log';
		$aAttCodes = MetaModel::GetModuleSetting('itop-standard-email-synchro', 'ticket_log', array('UserRequest' => 'public_log', 'Incident' => 'public_log'));
		if (array_key_exists(get_class($oTicket), $aAttCodes))
		{
			$sAttCode = $aAttCodes[get_class($oTicket)];
		}
		
		$oLog = $oTicket->Get($sAttCode);
		$oLog->AddLogEntry($sBodyText, $sCallerName);
		$oTicket->Set($sAttCode, $oLog);

		$oTicket->DBUpdateTracked($oMyChange);			
		$this->Trace("Ticket ".$oTicket->GetName()." updated.");
		
		// If there are any TriggerOnMailUpdate defined, let's activate them
		//
		$aClasses = MetaModel::EnumParentClasses(get_class($oTicket), ENUM_PARENT_CLASSES_ALL);
		$sClassList = implode(", ", CMDBSource::Quote($aClasses));
		$oSet = new DBObjectSet(DBObjectSearch::FromOQL("SELECT TriggerOnMailUpdate AS t WHERE t.target_class IN ($sClassList)"));
		while ($oTrigger = $oSet->Fetch())
		{
			$oTrigger->DoActivate($oTicket->ToArgs('this'));
		}

		if ($this->Get('email_storage') == 'delete')
		{
			// Remove the processed message from the mailbox
			$this->Trace("Ticket updated, deleting the source eMail '".$oEmail->sSubject."'");
			$this->SetNextAction(EmailProcessor::DELETE_MESSAGE);		
		}
		else
		{
			// Keep the message in the mailbox
			$this->SetNextAction(EmailProcessor::NO_ACTION);		
		}		
		return $oTicket;		
	}

	protected function ManageInlineImages($sBodyText, $aAddedAttachments, $aIgnoredAttachments)
	{
		// Search for inline images: i.e. <img tags containing an src="cid:...."
		if (preg_match_all('/<img[^>]+src="cid:([^"]+)"/i', $sBodyText, $aMatches, PREG_OFFSET_CAPTURE))
		{
			$aInlineImages = array();
			foreach ($aMatches[0] as $idx => $aInfo)
			{
				$aInlineImages[$idx] = array(
					'position' => $aInfo[1]
				);
			}
			foreach ($aMatches[1] as $idx => $aInfo)
			{
				$sCID = $aInfo[0];
				if (!array_key_exists($sCID, $aAddedAttachments) && !array_key_exists($sCID, $aIgnoredAttachments))
				{
					$this->Trace("Info: inline image: $sCID not found as an attachment. Ignored.");
				}
				else if (array_key_exists($sCID, $aAddedAttachments))
				{
					$aInlineImages[$idx]['cid'] = $sCID;
					$this->Trace("Inline image cid:$sCID stored as Attachment::".$aAddedAttachments[$sCID]->GetKey());
				}
			}
			$sWholeText = $sBodyText;
			$idx = count($aInlineImages);
			// Insert the URLs to the attachments, just before the <img tag so that the hyperlink remains (as plain text) at the right position
			// when the HTML tags will be stripped
			// Start from the end of the text to preserve the positions of the <img tags AFTER the insertion
			while ($idx > 0)
			{
				$idx --;
				if (array_key_exists('cid', $aInlineImages[$idx]))
				{
					$sBefore = substr($sWholeText, 0, $aInlineImages[$idx]['position']);
					$sAfter = substr($sWholeText, $aInlineImages[$idx]['position']);
					$oAttachment = $aAddedAttachments[$aInlineImages[$idx]['cid']];
					$sUrl = utils::GetAbsoluteUrlAppRoot().'pages/ajax.render.php?operation=download_document&class=Attachment&id='.$oAttachment->GetKey().'&field=contents';
					$sWholeText = $sBefore.' '.$sUrl.' '. $sAfter;
				}
			}
			$sBodyText = $sWholeText;
		}
		else
		{
			$this->Trace("Inline Images: no inline-image found in the message");
		}
		return $sBodyText;
	}
	
	/**
	 * Check (based on a set of patterns tested against the subject of the email) if the email is considered as "undesired"
	 * @param EmailMessage $oEmail The message to check
	 * @return boolean
	 */
	protected function IsUndesired(EmailMessage $oEmail)
	{
		$bRet = false; 
		if (self::$aUndesiredSubjectPatterns == null)
		{
			self::$aUndesiredSubjectPatterns = MetaModel::GetModuleSetting('combodo-email-synchro', 'undesired-subject-patterns', array());
		}
		foreach(self::$aUndesiredSubjectPatterns as $sPattern)
		{
			if (preg_match($sPattern, $oEmail->sSubject))
			{
				$this->Trace("The message '{$oEmail->sSubject}' is considered as undesired, since it matches '$sPattern'.");
				return true;
			}
		}
		$this->Trace("The message '{$oEmail->sSubject}' is NOT considered as undesired.");
		return false; // No match, the message is NOT undesired
	}
	
	/**
	 * Error handler... what to do in case of error ??
	 * @param EmailMessage $oEmail can be null in case of decoding error (like message too big)
	 * @param string $sErrorCode
	 * @return void
	 */
	public function HandleError($oEmail, $sErrorCode, $oRawEmail = null, $sAdditionalErrorMessage = '')
	{
		$sTo = $this->Get('notify_errors_to');
		$sFrom = $this->Get('notify_errors_from');
		if ($this->Get('error_behavior') == 'delete')
		{
			$this->SetNextAction(EmailProcessor::DELETE_MESSAGE); // Remove the message from the mailbox
			$sLastAction = "<p>The eMail was deleted from the mailbox.</p>\n";
		}
		else
		{
			$this->SetNextAction(EmailProcessor::MARK_MESSAGE_AS_ERROR); // Keep the message in the mailbox, but marked as error
			$sLastAction = "<p>The eMail is marked as error and will be ignored in further processing of the mailbox.</p>\n";
		}
		
		switch($sErrorCode)
		{
			case 'unknown_contact':
			// Reject the message because of an unknown caller
			$sSubject = '[iTop] Unknown contact in incoming eMail - '.$oEmail->sSubject;
			$sBody = "<p>The following email (see attachment) comes from an unknown caller (".$oEmail->sCallerEmail.").<br/>\n";
			$sBody .= "<p>Check the configuration of the Mail Inbox '".$this->GetName()."', since the current configuration does not allow to create new contacts for unknown callers.</p>\n";
			$sBody .= $sLastAction;
			$this->sLastError = "Unknown caller (".$oEmail->sCallerEmail.")";
			break;
			
			case 'decode_failed':
			$sSubject = '[iTop] Failed to decode an incoming eMail';
			if ($oRawEmail && ($oRawEmail->GetSize() > EmailBackgroundProcess::$iMaxEmailSize))
			{
				$sBody = "<p>The incoming eMail is bigger (".$oRawEmail->GetSize()." bytes) than the maximum configured size (maximum_email_size = ".EmailBackgroundProcess::$iMaxEmailSize.").</p>\n";
				$this->sLastError = "eMail is bigger (".$oRawEmail->GetSize()." bytes) than the maximum configured size (maximum_email_size = ".EmailBackgroundProcess::$iMaxEmailSize.")";
				
				if ($this->Get('error_behavior') == 'delete')
				{
					if ($this->sBigFilesDir == '')
					{
						$sBody .= "<p>The email was deleted. In the future you can:\n<ul>\n";
						$sBody .= "<li>either increase the 'maximum_email_size' parameter in the iTop configuration file, so that the message gets processed</li>\n";
						$sBody .= "<li>or configure the parameter 'big_files_dir' in the iTop configuration file, so that such emails are kept on the web server for further inspection.</li>\n</ul>";
					}
					else if (!is_writable($this->sBigFilesDir))
					{
						$sBody .= "<p>The email was deleted, since the directory where to save such files on the web server ($this->sBigFilesDir) is NOT writable to iTop.</p>\n";
					}
					else
					{
						$idx = 1;
						$sFileName = 'email_'.(date('Y-m-d')).'_';
						$sExtension = '.eml';
						$hFile = false;
						while(($hFile = fopen($this->sBigFilesDir.'/'.$sFileName.$idx.$sExtension, 'x')) === false)
						{
							$idx++;
						}
						fwrite($hFile, $oRawEmail->GetRawContent());
						fclose($hFile);
						$sBody .= "<p>The message was saved as '{$sFileName}{$idx}{$sExtension}' on the web server, in the directory '{$this->sBigFilesDir}'.</p>\n";
						$sBody .= "<p>In order process such messages, increase the value of the 'maximum_email_size' parameter in the iTop configuration file.</p>\n";
					}
				}
				else
				{
					$sBody .= $sLastAction;
				}
								
				$oRawEmail = null; // Do not attach the original message to the mail sent to the admin since it's already big, send the message now
				$this->Trace($sSubject."\n\n".$sBody);
				// Send the email now...
				if(($sTo != '') && ($sFrom != ''))
				{
					$oEmailToSend = new Email();
			  		$oEmailToSend->SetRecipientTO($sTo);
			  		$oEmailToSend->SetSubject($sSubject);
			  		$oEmailToSend->SetBody($sBody, 'text/html');	
			  		$oEmailToSend->SetRecipientFrom($sFrom);
			  		$oEmailToSend->Send($aIssues, true /* bForceSynchronous */, null /* $oLog */);
				}
			}
			else
			{
				$sBody = "<p>The following eMail (see attachment) was not decoded properly and therefore was not processed at all.</p>\n";
				$sBody .= $sLastAction;
			}
			break;
			
			case 'nothing_to_update':
			$sSubject = '[iTop] Unable to update a ticket from the eMail - '.$oEmail->sSubject;
			$sBody = "<p>The following email (see attachment) does not seem to correspond to a ticket in iTop.<br/>\n";
			$sBody .= "The Mail Inbox ".$this->GetName()." is configured to only update existing tickets, therefore the eMail has been rejected.</p>\n";
			$sBody .= $sLastAction;
			$this->sLastError = "No corresponding iTop ticket to update (mode=update only)";
			break;
			
			case 'failed_to_create_contact':
			$sSubject = '[iTop] Failed to create a contact for the incoming eMail - '.$oEmail->sSubject;
			$sBody = "<p>The following email (see attachment) comes from an unknown caller (".$oEmail->sCallerEmail.").<br/>\n";
			$sBody .= "The configuration of the Mail Inbox ".$this->GetName()." instructs to create a new contact based on some default values, but this creation was not successful.<br/>\n";
			$sBody .= "Check the contact's default values configured in the Mail Inbox.</p>\n";
			$sBody .= $sLastAction;
			$this->sLastError = "Failed to create a contact from the incoming eMail. Caller = ".$oEmail->sCallerEmail;
			break;
			
			case 'rejected_attachments':
			$sSubject = '[iTop] Failed to process attachment(s) for the incoming eMail - '.$oEmail->sSubject;
			$sBody = "<p>Some attachments to the eMail were not processed because they are too big:</p>\n";
			$sBody .= "<pre>".$sAdditionalErrorMessage."</pre>\n";
			$sBody .= $sLastAction;
			
			$oRawEmail = null; // No original message in attachment
			$this->Trace($sSubject."\n\n".$sBody);
			// Send the email now...
			if(($sTo != '') && ($sFrom != ''))
			{
				$oEmailToSend = new Email();
		  		$oEmailToSend->SetRecipientTO($sTo);
		  		$oEmailToSend->SetSubject($sSubject);
		  		$oEmailToSend->SetBody($sBody, 'text/html');	
		  		$oEmailToSend->SetRecipientFrom($sFrom);
		  		$oEmailToSend->Send($aIssues, true /* bForceSynchronous */, null /* $oLog */);
			}
			break;
				
			case 'undesired_message':
			$sSubject = '[iTop] Undesired message - '.$oEmail->sSubject;
			$sBody = "<p>The attached message was rejected because it is considered as undesired, based on the 'undesired_subject_patterns' specified in the iTop configuration file.</p>\n";
			$sBody .= $sLastAction;
			
			// Send the email now...
			if(($sTo != '') && ($sFrom != ''))
			{
				$oEmailToSend = new Email();
		  		$oEmailToSend->SetRecipientTO($sTo);
		  		$oEmailToSend->SetSubject($sSubject);
		  		$oEmailToSend->SetBody($sBody, 'text/html');	
		  		$oEmailToSend->SetRecipientFrom($sFrom);
		  		$oEmailToSend->Send($aIssues, true /* bForceSynchronous */, null /* $oLog */);
			}
			break;
			
			default:
			$sSubject = '[iTop] handle error';
			$sBody = '<p>Unexpected error: '.$sErrorCode."</p>\n";
			$sBody .= $sLastAction;
			$this->sLastError = 'Unexpected error: '.$sErrorCode;
		}
		$sBody .= "<p>&nbsp;</p><p>Mail Inbox Configuration: ".$this->GetHyperlink()."</p>\n";
		
		if(($sTo == '') || ($sFrom == ''))
		{
			$this->Trace("HandleError($sErrorCode): No forward configured for forwarding the email...(To: '$sTo', From: '$sFrom'), skipping.");
		}
		else if($oRawEmail)
		{
			$this->Trace($sSubject."\n\n".$sBody);
			$oRawEmail->SendAsAttachment($sTo, $sFrom, $sSubject, $sBody);
		}
	}
	
	/**
	 * Make sure that the given string is a proper PCRE pattern by surrounding
	 * it with slashes, if needed
	 * @param string $sPattern The pattern to check (can be an empty string)
	 * @return string The valid pattern (or an empty string)
	 */
	protected function FixPattern($sPattern)
	{
		$sReturn = $sPattern;
		if ($sPattern != '')
		{
			$sFirstChar = substr($sPattern, 0, 1);
			$sLastChar = substr($sPattern, -1, 1);
			if (($sFirstChar != $sLastChar) || preg_match('/[0-9A-Z-a-z]/', $sFirstChar) || preg_match('/[0-9A-Z-a-z]/', $sLastChar))
			{
				// Missing delimiter patterns
				$sReturn = '/'.$sPattern.'/';
			}
		}
		return $sReturn;
	}
}

// Adding an entry in the admin menu

class StdEmailSynchro extends ModuleHandlerAPI
{
	public static function OnMenuCreation()
	{
		// Add an item in the admin menus
		if (UserRights::IsAdministrator())
		{
			$oAdminMenu = new MenuGroup('AdminTools', 80 /* fRank */);
			new OQLMenuNode('MailInboxes', 'SELECT MailInboxStandard', $oAdminMenu->GetIndex(), 20 /* fRank */, true);
		}
	}
}

/**
 * Simple extension to turn the displayed URLs pointing to an attachment into an inline image
 *
 */
class StdMailInboxPlugIn implements iApplicationUIExtension
{
	public function OnDisplayProperties($oObject, WebPage $oPage, $bEditMode = false)
	{
		if ($oObject instanceof Ticket)
		{
			$oPage->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'itop-standard-email-synchro/magnific-popup.css');
			$oPage->add_linked_script(utils::GetAbsoluteUrlModulesRoot().'itop-standard-email-synchro/jquery.magnific-popup.min.js');
			$maxWidth = MetaModel::GetModuleSetting('itop-standard-email-synchro', 'inline_image_max_width', '');
			if ($maxWidth !== '')
			{
				$sStyle = "style=\"max-width:{$maxWidth}px;cursor:zoom-in;\"";
			}
			else
			{
				$sStyle = "style=\"cursor:zoom-in;\"";
			}
			// replace all hyperlink with the appropriate format by an inline image
			$oPage->add_ready_script(
<<<EOF
	$('#tab_00 a').each(function() {
		var sUrl = this.href;
		var sLabel = new String($(this).html());
		sLabel = sLabel.replace(/&amp;/g, '&');
		var regExpr = /pages\/ajax.render.php\?operation=download_document&class=Attachment/;
	
		if ((sUrl == sLabel) && (regExpr.exec(sUrl)))
		{
			$(this).replaceWith('<img class="inline-image" src="'+sUrl+'" href="'+sUrl+'" $sStyle></img>');
		}
			
	});
	$('.inline-image').magnificPopup({ 
  		type: 'image'
		
	});
EOF
			);
		}
	}

	public function OnDisplayRelations($oObject, WebPage $oPage, $bEditMode = false)
	{
	}

	public function OnFormSubmit($oObject, $sFormPrefix = '')
	{
	}

	public function OnFormCancel($sTempId)
	{
	}

	public function EnumUsedAttributes($oObject)
	{
		return array();
	}

	public function GetIcon($oObject)
	{
		return '';
	}

	public function GetHilightClass($oObject)
	{
		// Possible return values are:
		// HILIGHT_CLASS_CRITICAL, HILIGHT_CLASS_WARNING, HILIGHT_CLASS_OK, HILIGHT_CLASS_NONE
		return HILIGHT_CLASS_NONE;
	}

	public function EnumAllowedActions(DBObjectSet $oSet)
	{
		// No action
		return array();
	}
}

// Register the background action for asynchronous execution in cron.php
EmailBackgroundProcess::RegisterEmailProcessor('MailInboxesEmailProcessor');
