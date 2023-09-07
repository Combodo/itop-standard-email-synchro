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


namespace Combodo\iTop\Test\UnitTest\CombodoEmailSynchro;

use Combodo\iTop\Test\UnitTest\ItopDataTestCase;
use EmailMessage;
use EmailReplica;
use MailInboxStandard;
use MetaModel;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 */
class ITopStandardEmailSynchroTest extends ItopDataTestCase
{

	public function testGetRelatedTicket_related_object_in_construction(){
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', true);

		$oOrganization = MetaModel::NewObject("Organization");
		$oOrganization->Set('name', 'Org name');
		$organisationId = $oOrganization->DBInsert();

		$oTicketToInsert = MetaModel::NewObject("UserRequest");
		$oTicketToInsert->Set('title', 'Exemple de ticket');
		$oTicketToInsert->Set('description', 'Description de ticket');
		$oTicketToInsert->set('org_id', $organisationId);
		$ticketToInsertId = $oTicketToInsert->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', $ticketToInsertId);
		$oEmailReplica->DBInsert();

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
			$oTicketToInsert,
			[
				"in-reply-to" => "previous-message-id"
			],
			"decodeStatus"
		);

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);
		$relatedTicketClass = get_class($oTicket);

		$this->assertEquals('UserRequest', $relatedTicketClass);
		$this->assertEquals($ticketToInsertId, $oTicket->Get('id'));
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
	    $oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', true);

		$oOrganization = MetaModel::NewObject("Organization");
		$oOrganization->Set('name', 'Org name');
		$organisationId = $oOrganization->DBInsert();

		$oTicketToInsert = MetaModel::NewObject("UserRequest");
		$oTicketToInsert->Set('title', 'Exemple de ticket');
		$oTicketToInsert->Set('description', 'Description de ticket');
		$oTicketToInsert->set('org_id', $organisationId);
		$ticketToInsertId = $oTicketToInsert->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', $ticketToInsertId);
		$oEmailReplica->DBInsert();



		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);
		$relatedTicketClass = get_class($oTicket);

	    $this->assertEquals('UserRequest', $relatedTicketClass);
	    $this->assertEquals($ticketToInsertId, $oTicket->Get('id'));
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
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', true);

		$oOrganization = MetaModel::NewObject("Organization");
		$oOrganization->Set('name', 'Org name');
		$organisationId = $oOrganization->DBInsert();

		$oTicketToInsert = MetaModel::NewObject("UserRequest");
		$oTicketToInsert->Set('title', 'Exemple de ticket');
		$oTicketToInsert->Set('description', 'Description de ticket');
		$oTicketToInsert->set('org_id', $organisationId);
		$ticketToInsertId = $oTicketToInsert->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', $ticketToInsertId);
		$oEmailReplica->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', $ticketToInsertId);
		$oEmailReplica->DBInsert();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);
		$relatedTicketClass = get_class($oTicket);

		$this->assertEquals('UserRequest', $relatedTicketClass);
		$this->assertEquals($ticketToInsertId, $oTicket->Get('id'));
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
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', true);

		$oOrganization = MetaModel::NewObject("Organization");
		$oOrganization->Set('name', 'Org name');
		$organisationId = $oOrganization->DBInsert();

		$oTicketToInsert = MetaModel::NewObject("UserRequest");
		$oTicketToInsert->Set('status', 'closed');
		$oTicketToInsert->Set('title', 'Exemple de ticket');
		$oTicketToInsert->Set('description', 'Description de ticket');
		$oTicketToInsert->Set('org_id', $organisationId);
		$ticketToInsertId = $oTicketToInsert->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', $ticketToInsertId);
		$oEmailReplica->DBInsert();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


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
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', true);

		$oOrganization = MetaModel::NewObject("Organization");
		$oOrganization->Set('name', 'Org name');
		$organisationId = $oOrganization->DBInsert();

		$oTicketToInsert = MetaModel::NewObject("UserRequest");
		$oTicketToInsert->Set('status', 'closed');
		$oTicketToInsert->Set('title', 'Exemple de ticket');
		$oTicketToInsert->Set('description', 'Description de ticket');
		$oTicketToInsert->Set('org_id', $organisationId);
		$ticketToInsertId = $oTicketToInsert->DBInsert();

		$oEmailReplica = new EmailReplica();
		$oEmailReplica->Set('message_id', 'previous-message-id');
		$oEmailReplica->Set('ticket_id', -12);
		$oEmailReplica->DBInsert();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


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
				"in-reply-to" => "previous-message-id" 
			],
			"decodeStatus"
		);
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	public function testGetRelatedTicket_conf_aggregate_answers_false(){

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
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();
		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', false);


		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

}
