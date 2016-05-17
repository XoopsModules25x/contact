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
 * Contact us module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 3.0 or later
 * @package        contacts
 * @since          2.22
 * @min_xoops      2.5.7
 * @author         Txmod Xoops - Email:<info@txmodxoops.org> - Website:<http://txmodxoops.org>
 * @version        $Id: 2.3 common.php 14020 Tue 2016-05-17 18:46:52Z Kazumi Ono (Onokazu), modified by Trabis, rewritten by Voltan, modified by Bleekk, Goffy, New GUI & version by Timgno $
 */
if (!defined('XOOPS_ICONS32_PATH')) define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
if (!defined('XOOPS_ICONS32_URL')) define('XOOPS_ICONS32_URL', XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
define('CONTACTS_DIRNAME', 'contact');
define('CONTACTS_PATH', XOOPS_ROOT_PATH.'/modules/'.CONTACTS_DIRNAME);
define('CONTACTS_URL', XOOPS_URL.'/modules/'.CONTACTS_DIRNAME);
define('CONTACTS_ICONS_PATH', CONTACTS_PATH.'/assets/icons');
define('CONTACTS_ICONS_URL', CONTACTS_URL.'/assets/icons');
define('CONTACTS_IMAGE_PATH', CONTACTS_PATH.'/assets/images');
define('CONTACTS_IMAGE_URL', CONTACTS_URL.'/assets/images');
define('CONTACTS_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.CONTACTS_DIRNAME);
define('CONTACTS_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.CONTACTS_DIRNAME);
define('CONTACTS_UPLOAD_FILES_PATH', CONTACTS_UPLOAD_PATH.'/files');
define('CONTACTS_UPLOAD_FILES_URL', CONTACTS_UPLOAD_URL.'/files');
define('CONTACTS_UPLOAD_IMAGE_PATH', CONTACTS_UPLOAD_PATH.'/images');
define('CONTACTS_UPLOAD_IMAGE_URL', CONTACTS_UPLOAD_URL.'/images');
define('CONTACTS_UPLOAD_SHOTS_PATH', CONTACTS_UPLOAD_PATH.'/images/shots');
define('CONTACTS_UPLOAD_SHOTS_URL', CONTACTS_UPLOAD_URL.'/images/shots');
define('CONTACTS_ADMIN', CONTACTS_URL . '/admin/index.php');
$localLogo = CONTACTS_IMAGE_URL . '/txmodxoops_logo.png';
// Module Information
$copyright = "<a href='http://txmodxoops.org' title='Txmod Xoops' target='_blank'><img src='".$localLogo."' alt='Txmod Xoops' /></a>";
include_once XOOPS_ROOT_PATH .'/class/xoopsrequest.php';
include_once CONTACTS_PATH .'/class/helper.php';
include_once CONTACTS_PATH .'/include/functions.php';
