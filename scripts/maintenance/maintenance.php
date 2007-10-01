#!/usr/bin/php -q
<?php

/*
+---------------------------------------------------------------------------+
| Openads v${RELEASE_MAJOR_MINOR}                                                              |
| ============                                                              |
|                                                                           |
| Copyright (c) 2003-2007 Openads Limited                                   |
| For contact details, see: http://www.openads.org/                         |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

/**
 * A script file to run the Maintenance Statistics Engine and the
 * Maintenance Priority Engine processes.
 *
 * @package    OpenadsMaintenance
 * @subpackage Tools
 * @author     Andrew Hill <andrew.hill@openads.org>
 */

// Require the initialisation file
// Done this way so that it works in CLI PHP
$path = dirname(__FILE__);
require_once $path . '/../../init.php';

// Set longer time out, and ignore user abort
if (!ini_get('safe_mode')) {
    @set_time_limit($conf['maintenance']['timeLimitScripts']);
    @ignore_user_abort(true);
}

// Required files
require_once MAX_PATH . '/lib/Max.php';
require_once MAX_PATH . '/lib/OA/Maintenance.php';

$oMaint = new OA_Maintenance();
$oMaint->run();

// Update scheduled maintenance last run record
$oMaint->updateLastRun(true);

?>
