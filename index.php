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
 * @author      Mirza (AKA Bleekk)
 */

use XoopsModules\Contact;

require_once \dirname(__DIR__, 2) . '/mainfile.php';
require_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'contact_index.tpl';
//unset($_SESSION);
require XOOPS_ROOT_PATH . '/header.php';
$helper = Contact\Helper::getInstance();
global $xoopsModuleConfig, $xoopsModule, $xoopsUser;

/*Modules Options*/
if (1 == $helper->getConfig('form_dept')) {
    // show a drop down with the correct departments listed
    $departmentlist = [];
    $departments    = xoops_getModuleOption('contact_dept', 'contact');
    foreach ($departments as $val) {
        [$name, $email] = explode(',', $val, 2); //split the name and email
        $departmentlist[] = $name;
    }
    $GLOBALS['xoopsTpl']->assign('depart', $helper->getConfig('form_dept'));
    $GLOBALS['xoopsTpl']->assign('departments', $departmentlist);
}
$GLOBALS['xoopsTpl']->assign('recaptcha', $helper->getConfig('recaptchause'));
$GLOBALS['xoopsTpl']->assign('recaptchakey', $helper->getConfig('recaptchakey'));
$GLOBALS['xoopsTpl']->assign('url', $helper->getConfig('form_url'));
$GLOBALS['xoopsTpl']->assign('icq', $helper->getConfig('form_icq'));
$GLOBALS['xoopsTpl']->assign('skype', $helper->getConfig('form_skype'));
$GLOBALS['xoopsTpl']->assign('company', $helper->getConfig('form_company'));
$GLOBALS['xoopsTpl']->assign('location', $helper->getConfig('form_location'));
$GLOBALS['xoopsTpl']->assign('phone', $helper->getConfig('form_phone'));
$GLOBALS['xoopsTpl']->assign('address', $helper->getConfig('form_address'));
$GLOBALS['xoopsTpl']->assign('map', $helper->getConfig('embed_maps'));
$GLOBALS['xoopsTpl']->assign('info', xoops_getModuleOption('contact_info', 'contact'));
$GLOBALS['xoopsTpl']->assign('contact_default', xoops_getModuleOption('contact_default', 'contact'));

if ($helper->getConfig('show_breadcrumbs')) {
    $GLOBALS['xoopsTpl']->assign('show_breadcrumbs', true);
    $GLOBALS['xoopsTpl']->assign('breadcrumb', '<li><a href="' . XOOPS_URL . '">' . _YOURHOME . '</a></li> <li class="active">' . $xoopsModule->name() . '</li>');
}
/*end Modules options*/

$uid = is_object($xoopsUser) ? $xoopsUser->getVar('uid') : 0;
$GLOBALS['xoopsTpl']->assign('contact_uid', $uid);

/* lang vars, added by goffy */
$GLOBALS['xoopsTpl']->assign('lng_username', _MD_CONTACT_NAME);
$GLOBALS['xoopsTpl']->assign('lng_email', _MD_CONTACT_MAIL);
$GLOBALS['xoopsTpl']->assign('lng_url', _MD_CONTACT_URL);
$GLOBALS['xoopsTpl']->assign('lng_company', _MD_CONTACT_COMPANY);
$GLOBALS['xoopsTpl']->assign('lng_icq', _MD_CONTACT_ICQ_NAME);
$GLOBALS['xoopsTpl']->assign('lng_address', _MD_CONTACT_ADDRESS);
$GLOBALS['xoopsTpl']->assign('lng_location', _MD_CONTACT_LOCATION);
$GLOBALS['xoopsTpl']->assign('lng_phone', _MD_CONTACT_PHONE);
$GLOBALS['xoopsTpl']->assign('lng_skypename', _MD_CONTACT_SKYPE_NAME);
$GLOBALS['xoopsTpl']->assign('lng_department', _MD_CONTACT_DEPARTMENT);
$GLOBALS['xoopsTpl']->assign('lng_subject', _MD_CONTACT_SUBJECT);
$GLOBALS['xoopsTpl']->assign('lng_message', _MD_CONTACT_MESSAGE);
$GLOBALS['xoopsTpl']->assign('lng_submit', _MD_CONTACT_SUBMIT);

$GLOBALS['xoopsTpl']->assign('lng_username_info', _MD_CONTACT_NAME_INFO);
$GLOBALS['xoopsTpl']->assign('lng_email_info', _MD_CONTACT_MAIL_INFO);
$GLOBALS['xoopsTpl']->assign('lng_url_info', _MD_CONTACT_URL_INFO);
$GLOBALS['xoopsTpl']->assign('lng_company_info', _MD_CONTACT_COMPANY_INFO);
$GLOBALS['xoopsTpl']->assign('lng_address_info', _MD_CONTACT_ADDRESS_INFO);
$GLOBALS['xoopsTpl']->assign('lng_location_info', _MD_CONTACT_LOCATION_INFO);
$GLOBALS['xoopsTpl']->assign('lng_phone_info', _MD_CONTACT_PHONE_INFO);
$GLOBALS['xoopsTpl']->assign('lng_icq_info', _MD_CONTACT_ICQ_INFO);
$GLOBALS['xoopsTpl']->assign('lng_skypename_info', _MD_CONTACT_SKYPE_NAME_INFO);
$GLOBALS['xoopsTpl']->assign('lng_subject_info', _MD_CONTACT_SUBJECT_INFO);
$GLOBALS['xoopsTpl']->assign('lng_message_info', _MD_CONTACT_MESSAGE_INFO);

require XOOPS_ROOT_PATH . '/footer.php';
