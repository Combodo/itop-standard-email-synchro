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
use MailInboxStandard;
use MetaModel;
use ReflectionException;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 */
class ITopStandardEmailSynchroTest extends ItopDataTestCase
{
	/**
	 * @throws ReflectionException
	 */
	public function testGetRelatedTicket(){

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
				"in-reply-to" => "previous-message-id" // with provider later
	        ],
	        "decodeStatus"
        );
	    $oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', false);



		$this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


	    $this->assertTrue(true);
    }


	public function testClosedRelatedTicket(){

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
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();


		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	public function testNoInReplyField(){

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
				"in-reply-to" => "previous-message-id" // with provider later
			],
			"decodeStatus"
		);
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();

		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);
	}

	public function testConfModuleFalse(){

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
				"in-reply-to" => "previous-message-id" // with provider later
			],
			"decodeStatus"
		);
		$oMailInboxStandard = new MailInboxStandard();
		$oMailInboxStandard->init();
		$oConfig = MetaModel::GetConfig();
		$oConfig->SetModuleSetting('itop-standard-email-synchro', 'aggregate_answers', false);


		$oTicket = $this->InvokeNonPublicMethod(MailInboxStandard::class, 'GetRelatedTicket', $oMailInboxStandard, [$oEmailMessage]);


		$this->assertEquals(null, $oTicket);


		// scenarios :
		// parent::GetRelatedTicket($oEmail) => return null, sinon tout le reste => never call
		// message id du in-reply-to => mock DBObjectSet, retourne 1 objet => assert typeof sur le getobject
		// etat closed => return null
		//

		// si pethode protected (par ex) : $this->InvokeNonPublicStaticMethod
	}

}
