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

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);

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
	    MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);

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

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);

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

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);

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

		MetaModel::GetConfig()->SetModuleSetting('itop-standard-email-synchro', 'aggregate_replies', true);


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

}
