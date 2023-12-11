<?php
// Copyright (c) 2010-2020 Combodo SARL
//
//   This file is part of iTop.
//
//   iTop is free software; you can redistribute it and/or modify
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   iTop is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with iTop. If not, see <http://www.gnu.org/licenses/>
//


namespace Combodo\iTop\Extension\Test;

use Combodo\iTop\Test\UnitTest\ItopDataTestCase;
use EmailMessage;
use EmailReplica;
use MetaModel;
use MailInboxStandard;
use Organization;
use UserRequest;

class ITopStandardEmailSynchroTest extends ItopDataTestCase
{

	private MailInboxStandard $oMailInboxStandard;
	private UserRequest $oTicket;

	private EmailReplica $oEmailReplica;

	public function setUp(): void
	{
		parent::setUp();
		$this->oMailInboxStandard = $this->createObject(MailInboxStandard::class,
			[
				'server' => 'server' . uniqid(),
				'login' => 'login' . uniqid(),
			]);

		$oOrg = $this->createObject(Organization::class, ['name' => 'Org name']);

		$this->oTicket = $this->createObject(UserRequest::class,
			[
				'title' => 'Exemple de ticket',
				'description' => 'Description de ticket',
				'org_id' => $oOrg->GetKey(),
			]
		);

		$this->oEmailReplica = $this->createObject(EmailReplica::class,
			[
				'message_id' => 'previous-message-id',
				'ticket_id' => $this->oTicket->GetKey(),
			]
		);

	}

	public function testGetRelatedTicket_related_object_in_construction(){



		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"The ticket R-0000XX was created",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			$this->oTicket,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);
		$this->assertNotNull($oTicket);
		$this->assertEquals('UserRequest', get_class($oTicket));
		$this->assertEquals($this->oTicket->GetKey(), $oTicket->GetKey());
	}

    public function testGetRelatedTicket_related_title_correspondance(){
		$this->oMailInboxStandard->Set('title_pattern', '/R-([0-9]+)/');


	    $sRef = 'R-0000'.$this->oTicket->GetKey();
	    $this->updateObject(UserRequest::class, $this->oTicket->GetKey(), ['ref'=> $sRef]);

        $oEmailMessage = new EmailMessage(
            "UIDL",
            "messageId",
            "The ticket R-0000".$this->oTicket->GetKey()." was created",
            "xxx.xxx@combodo.com",
            "xxx",
            "recipient",
            [],
            "1",
            "myBodyText",
            "UTF-8",
            [],
            null,
            [
            ],
            "decodeStatus"
        );

        $oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);
        $this->assertNotNull($oTicket);
        $this->assertEquals('UserRequest', get_class($oTicket));
        $this->assertEquals($this->oTicket->GetKey(), $oTicket->Get('id'));
    }

    public function testGetRelatedTicket_in_reply_field_update_ticket(){
        $oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
	        "subject",
	        "xxx.xxx@combodo.com",
	        "xxx",
	        "recipient",
	        [],
	        "1",
	        "myBodyText",
	        "UTF-8",
	        [],
	        null,
	        [
				"in-reply-to" => "previous-message-id"
	        ],
	        "decodeStatus"
        );




		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);
		$this->assertNotNull($oTicket);
		$relatedTicketClass = get_class($oTicket);

	    $this->assertEquals('UserRequest', $relatedTicketClass);
	    $this->assertEquals($this->oTicket->GetKey(), $oTicket->Get('id'));
    }

	public function testGetRelatedTicket_conf_true(){
		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);


		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);
		$this->assertNotNull($oTicket);
		$relatedTicketClass = get_class($oTicket);

		$this->assertEquals('UserRequest', $relatedTicketClass);
		$this->assertEquals($this->oTicket->GetKey(), $oTicket->Get('id'));
	}



	public function testGetRelatedTicket_duplicate_email_replica(){
		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);



		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);
		$this->assertNotNull($oTicket);
		$relatedTicketClass = get_class($oTicket);

		$this->assertEquals('UserRequest', $relatedTicketClass);
		$this->assertEquals($this->oTicket->GetKey(), $oTicket->Get('id'));
	}


	public function testGetRelatedTicket_closed_related_ticket(){

		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);

		$this->oTicket->Set('status', 'closed');
		$this->oTicket->DBUpdate();



		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	public function testGetRelatedTicket_replica_not_linked_to_ticket(){

		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);




		$this->oEmailReplica->Set('ticket_id', -12);
		$this->oEmailReplica->DBUpdate();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}


	public function testGetRelatedTicket_no_in_reply_field(){

		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
			],
			"decodeStatus"
		);

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	public function testGetRelatedTicket_conf_aggregate_replies_false(){

		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			"myBodyText",
			"UTF-8",
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', false);


		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $this->oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	/**
	 * @dataProvider ReplyEmailsProvider
	 */
	public function testBuildCaseLogEntry($sEmailBody, $sEmailFormat, $sExpectedCaseLog)
	{
		$oEmailMessage = new EmailMessage(
			"UIDL",
			"messageId",
			"subject",
			"xxx.xxx@combodo.com",
			"xxx",
			"recipient",
			[],
			"1",
			$sEmailBody,
			$sEmailFormat,
			[],
			null,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);
		
		$sCaseLogEntry = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'BuildCaseLogEntry', $this->oMailInboxStandard, [$oEmailMessage, [], []]);
		
		$this->assertEquals($sExpectedCaseLog, $sCaseLogEntry);
	}
	
	public function ReplyEmailsProvider()
	{
		return [
			'plain_text' => ['Plain Text Message.', 'text/plain', 'Plain Text Message.<a data-role="email-uidl" data-object-id="login_UIDL"></a>'],
			'simple_html' => ['<p>Html Message.</p>', 'text/html', '<p>Html Message.</p><a data-role="email-uidl" data-object-id="login_UIDL"></a>'],
			'block_quote' => ['<p>New Message.</p><blockquote>Original Message</blockquote>', 'text/html', '<p>New Message.</p><a data-role="email-uidl" data-object-id="login_UIDL"></a>'],
			'outlook_message' => [
<<<HTML
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=Generator content="Microsoft Word 15 (filtered medium)"><!--[if !mso]><style>v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style><![endif]--><style><!--
/* Font Definitions */
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:"Montserrat Light";
	panose-1:0 0 4 0 0 0 0 0 0 0;}
/* Style Definitions */
p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ligatures:standardcontextual;
	mso-fareast-language:EN-US;}
span.EmailStyle19
	{mso-style-type:personal-reply;
	font-family:"Montserrat Light";
	color:windowtext;}
.MsoChpDefault
	{mso-style-type:export-only;
	font-size:10.0pt;
	mso-ligatures:none;}
@page WordSection1
	{size:612.0pt 792.0pt;
	margin:70.85pt 70.85pt 70.85pt 70.85pt;}
div.WordSection1
	{page:WordSection1;}
--></style><!--[if gte mso 9]><xml>
<o:shapedefaults v:ext="edit" spidmax="1026" />
</xml><![endif]--><!--[if gte mso 9]><xml>
<o:shapelayout v:ext="edit">
<o:idmap v:ext="edit" data="1" />
</o:shapelayout></xml><![endif]--></head><body><div class=WordSection1><p><span>Et là avec une réponse ça fait quoi ?</span></p><p><span>- Denis</span></p><div><div style='border:none;border-top:solid #E1E1E1 1.0pt;padding:3.0pt 0cm 0cm 0cm'><p class=MsoNormal><b><span style='mso-ligatures:none;mso-fareast-language:FR'>De&nbsp;:</span></b><span style='mso-ligatures:none;mso-fareast-language:FR'> Denis Flaven <br><b>Envoyé&nbsp;:</b> mercredi 6 décembre 2023 14:47<br><b>À&nbsp;:</b> 'test@combodo.com' &lt;test@combodo.com&gt;<br><b>Objet&nbsp;:</b> R-000012<o:p></o:p></span></p></div></div><p class=MsoNormal><o:p>&nbsp;</o:p></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'>Nouveau message, écrit en partant de rien pour mettre à jour le ticket R-000012.<o:p></o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'><o:p>&nbsp;</o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'>Et là je mets une petite image&nbsp;:<o:p></o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'><o:p>&nbsp;</o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light";mso-ligatures:none'><img width=144 height=179 style='width:1.5in;height:1.8666in' id="Image_x0020_1" src="cid:image001.jpg@01DA2853.A32B2000"></span><span style='font-size:10.0pt;font-family:"Montserrat Light"'><o:p></o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'><o:p>&nbsp;</o:p></span></p><p class=MsoNormal><span style='font-size:10.0pt;font-family:"Montserrat Light"'>- Denis<o:p></o:p></span></p></div></body></html>
HTML
		, 'text/html',
<<<HTML
<div class="WordSection1"><p><span>Et là avec une réponse ça fait quoi ?</span></p><p><span>- Denis</span></p></div><a data-role="email-uidl" data-object-id="login_UIDL"></a>
HTML
			],
		];
	}
}
