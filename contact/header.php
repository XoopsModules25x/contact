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
 * @author      Txmod Xoops (AKA Timgno)
 * @version     $Id: header.php 14064 2016-05-08 15:15:15Z timgno $
 */
include dirname(dirname(__DIR__)) .'/mainfile.php';
include __DIR__ .'/include/common.php';
//$hotel = ContactHelper::getInstance();
$xoBreadcrumbs = array();
$xoBreadcrumbs[] = array('title' => _MD_CONTACT_FORM, 'link' => CONTACTS_URL . '/');
// Get instance of module
$contacts = ContactHelper::getInstance();
$contactsHandler = $contacts->getHandler('contact');