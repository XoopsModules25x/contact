<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Contact module
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Kazumi Ono (aka Onokazu)
 * @author      Trabis <lusopoemas@gmail.com>
 * @author      Hossein Azizabadi (AKA Voltan)
 * @version     $Id$
 */

include 'header.php';

if (!empty($_POST)) {
    // Info Processing
    $contact = $contact_handler->Contact_InfoProcessing($_POST);
    // Save info
    $obj = $contact_handler->create();
    $obj->setVars($contact);
    $contact_handler->insert($obj);
    // send mail can seet message
    $message = $contact_handler->Contact_SendMail($contact);
}
