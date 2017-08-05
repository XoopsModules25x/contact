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
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Kazumi Ono (aka Onokazu)
 * @author      Trabis <lusopoemas@gmail.com>
 * @author      Hossein Azizabadi (AKA Voltan)
 */

include __DIR__ . '/header.php';

if (!empty($_POST)) {
    // Info Processing
    $contact = $contactHandler->contactInfoProcessing();
    // Save info
    $obj = $contactHandler->create();
    $obj->setVars($contact);
    $contactHandler->insert($obj);
    // send mail can seet message
    $message = $contactHandler->contactSendMail($contact);
}
