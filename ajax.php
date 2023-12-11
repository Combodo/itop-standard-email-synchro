<?php
// Copyright (C) 2013-2023 Combodo SARL
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
/**
 * Processing of AJAX calls for the MailInboxes
 *
 * @copyright   Copyright (C) 2013-2023 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

use Combodo\iTop\Extension\StandardEmailSynchro\Controller\AjaxController;

require_once(APPROOT.'application/startup.inc.php');

require_once(APPROOT.'/application/loginwebpage.class.inc.php');
LoginWebPage::DoLoginEx(null, false, LoginWebPage::EXIT_HTTP_401); // Check user rights and exits with "401 Not authorized" if not already logged in
session_write_close();

$oController = new AjaxController(__DIR__.'/views', 'itop-standard-email-synchro');
$oController->SetDefaultOperation('DebugTrace');

$oController->HandleOperation();
