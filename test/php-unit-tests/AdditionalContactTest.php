<?php
// Copyright (c) 2010-2024 Combodo SAS
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
use MetaModel;


class AdditionaContactTest extends ItopDataTestCase
{
    public const CREATE_TEST_ORG = true;

    public function testEmailAddedAsContact()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');

        $iCaller = $this->GivenPersonByEmailInDB('caller@combodo.com');
        $this->GivenPersonByEmailInDB('ContactInTo@combodo.com');
        $this->GivenPersonByEmailInDB('ContactInCc@combodo.com');
        $oTicket = $this->GivenTicket($iCaller, []);
        $oMessage = $this->GivenMessage(["CONTACTINTO@combodo.com"], ['contactincc@combodo.com']);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, ["ContactInTo@combodo.com", 'ContactInCc@combodo.com'], 'The contacts corresponding (case insensitive) to the email in TO or CC should be added to the ticket contacts');
    }

    // Unless the email correspond to the MailInbox email address (login), in which case it is ignored - "correspond" must be case in-sensitive
    public function testMailboxContactNotAdded()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');
        $this->GivenPersonByEmailInDB('inbox@combodo.com');

        $iCaller = $this->GivenPersonByEmailInDB('caller@combodo.com');
        $oTicket = $this->GivenTicket($iCaller, []);
        $oMessage = $this->GivenMessage(["inbox@combodo.com"], ["INBOX@combodo.com"]);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, [], 'No contact should be added when the email is the inbox email address');
    }

    // ensure that "email correspond to a contact" is case in-sensitive and support multiple emails on a contact
    public function testCallerNotAdded()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');
        $oTicket = $this->GivenTicket();
        $oMessage = $this->GivenMessage(["caller@combodo.com"], []);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, [], 'No contact should be added when the email is the caller email');
    }

    public function testDuplicateEmailsNotAdded()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');
        $this->GivenPersonByEmailInDB('contact@combodo.com');
        $oTicket = $this->GivenTicket();
        $oMessage = $this->GivenMessage(["contact@combodo.com", 'Contact@combodo.com'], ['CONTACT@combodo.com']);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, ["contact@combodo.com"], 'Duplicate emails should be ignored');
    }

    public function testAlreadyLinkedContactNotAdded()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');
        $iContact = $this->GivenPersonByEmailInDB('ExistingContact@combodo.com');
        $oTicket = $this->GivenTicket(0, [$iContact]);
        $oMessage = $this->GivenMessage(['ExistingContact@combodo.com'], []);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, ["ExistingContact@combodo.com"], 'An email corresponding to an already linked contact should not be be added in double');
    }

    public function testUnknownEmailIgnored()
    {
        // Given
        $oInbox = $this->GivenInbox('Inbox@combodo.com');
        $oTicket = $this->GivenTicket();
        $oMessage = $this->GivenMessage(['NonExistingContact@combodo.com'], ['SecondNonExistingContact@combodo.com']);

        // When
        $this->InvokeNonPublicMethod(\MailInboxStandard::class, 'AddAdditionalContacts', $oInbox, [$oTicket, $oMessage]);

        // Then
        $this->AssertContactsEmailsEquals($oTicket, [], 'Email in TO or CC that do not correspond to a contact are ignored silently');
    }



    ///////////////////////////////////
    //            HELPERS            //
    ///////////////////////////////////

    private function AssertContactsEmailsEquals(\cmdbAbstractObject $oTicket, array $aExpected, $sMessage = '')
    {

        $oLinkSet = $oTicket->Get('contacts_list');
        $aContactEmails = [];
        foreach ($oLinkSet as $oLnk) {
            $oContact = MetaModel::GetObject('Contact', $oLnk->Get('contact_id'));
            $aContactEmails[] = $oContact->Get('email');
        }
        $this->assertEqualsCanonicalizing($aExpected, $aContactEmails, $sMessage);
    }

    private function GivenInbox(string $sLogin)
    {
        $oInbox = MetaModel::NewObject(\MailInboxStandard::class, [
            'server' => 'server' . uniqid(),
            'login' => $sLogin,
        ]);
        return $oInbox;
    }

    private function GivenTicket(int $iCaller = 1, array $aContactIds = [])
    {
        $oTicket = MetaModel::NewObject(\UserRequest::class, [
            'title' => 'Exemple de ticket',
            'description' => 'Description de ticket',
            'caller_id' => $iCaller,
        ]);
        $oContacts = $oTicket->Get('contacts_list');
        foreach ($aContactIds as $iContactId) {
            $oLnk = MetaModel::NewObject(\lnkContactToTicket::class, [
                'contact_id' => $iContactId,
                // 'ticket_id' => $oTicket->GetKey(),
            ]);
            $oContacts->AddItem($oLnk);
        }
        $oTicket->Set('contacts_list', $oContacts);
        return $oTicket;
    }

    private function GivenMessage(array $aTo, array $aCC)
    {
        $aTo = array_map(function ($sEmail) {
            return ['email' => $sEmail];
        }, $aTo);
        $aCC = array_map(function ($sEmail) {
            return ['email' => $sEmail];
        }, $aCC);
        // Simulate an email message with a recipient that is not the inbox email address
        // and not already a contact of the ticket
        return new \EmailMessage(
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
            null, //$oTicket,
            [
                "in-reply-to" => "previous-message-id"
            ],
            "decodeStatus",
            '',
            $aTo,
            $aCC
        );
    }

    private function GivenPersonByEmailInDB(string $sEmail): int
    {
        return $this->GivenObjectInDB(\Person::class, [
            'name' => 'Totor',
            'first_name' => 'Toto',
            'email' => $sEmail,
        ]);
    }
}