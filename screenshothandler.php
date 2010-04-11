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
 * @package    Server
 */
function generateFilename()
{
    return substr(md5(time()),0,6);
}
do {
    $filename = 'caps/'.generateFilename().'.png';
} while(file_exists($filename));

file_put_contents($filename, base64_decode(file_get_contents("php://input")));

echo 'http://host.tld/caps/'.$filename;
