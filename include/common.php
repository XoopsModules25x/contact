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
 * contact module for xoops
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GPL 2.0 or later
 * @package         contact
 * @since           1.0
 * @min_xoops       2.5.7
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<http://xoops.wedega.com>
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');
if (!defined('CONTACT_MODULE_PATH')) {
    define('CONTACT_DIRNAME', basename(dirname(__DIR__)));
    define('CONTACT_PATH', XOOPS_ROOT_PATH.'/modules/'.CONTACT_DIRNAME);
    define('CONTACT_URL', XOOPS_URL.'/modules/'.CONTACT_DIRNAME);
    define('CONTACT_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.CONTACT_DIRNAME);
    define('CONTACT_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.CONTACT_DIRNAME);
    define('CONTACT_IMAGE_PATH', CONTACT_PATH.'/assets/images');
    define('CONTACT_IMAGE_URL', CONTACT_URL.'/assets/images/');
    define('CONTACT_ADMIN', CONTACT_URL . '/admin/index.php');
}
// module information
$copyright = "<a href='http://xoops.wedega.com' title='WEDEGA Webdesign Gabor' target='_blank'>
                     <img src='". $local_logo."' alt='WEDEGA Webdesign Gabor' /></a>";
                     
require_once XOOPS_ROOT_PATH.'/class/xoopsrequest.php';
require_once CONTACT_PATH.'/class/helper.php';
require_once CONTACT_PATH.'/include/functions.php';
