<?php
/**
 * This file is part of GtkGrab.
 *
 * GtkGrab is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License.
 *
 * GtkGrab is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GtkGrab.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   GtkGrab
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt GPL
 * @copyright  Copyright 2010 Evan Coury (http://www.Evan.pro/)
 * @copyright  Copyright 2010 Pieter Kokx (http://blog.kokx.nl/)
 * @package    Server
 */

// must be in the format 'user' => 'token'
$users = array();

// read the input
$input = file_get_contents("php://input");

// verify the user
if (!isset($_SERVER['HTTP_X_USERNAME']) || !isset($users[$_SERVER['HTTP_X_USERNAME']])) {
    exit('Error: No authorization');
}
$token = $users[$_SERVER['HTTP_X_USERNAME']];
if (!isset($_SERVER['HTTP_X_SIGNATURE']) || ($_SERVER['HTTP_X_SIGNATURE'] != sha1($input . $token))) {
    exit('Error: No authorization');
}

// write the file
function generateFilename()
{
    return substr(md5(microtime()),0,6);
}
do {
    $filename = 'caps/'.generateFilename().'.png';
} while(file_exists($filename));

file_put_contents($filename, base64_decode($input));

echo 'http://' . $_SERVER['HTTP_HOST'] . trim(dirname($_SERVER['PHP_SELF']), '/') . '/'.$filename;
