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
 * @author      Mirza (AKA Bleekk)
 * @version     $Id: index.php 12285 2014-01-30 11:31:16Z beckmi $
 */
include 'header.php';
$xoopsOption['template_main'] = 'contact_index.html';
//unset($_SESSION);
include XOOPS_ROOT_PATH . "/header.php";

global $xoopsConfig, $xoopsOption, $xoopsTpl, $xoopsUser, $xoopsUserIsAdmin, $xoopsLogger;

	$department = $contact_handler->Contact_CleanVars($_GET, 'department', '', 'string');
	$obj  = $contact_handler->create();
	
    /*Modules Options*/
    if ($xoopsModuleConfig['form_dept'] == 1) {
        if (xoops_getModuleOption('form_dept', 'contact')) {
            // show a drop down with the correct departments listed
            $departmentlist = array();
            $departments    = xoops_getModuleOption('contact_dept', 'contact');
            foreach ($departments as $val) {
                list($name, $email) = explode(',', $val, 2); //split the name and email
                array_push($departmentlist, $name);
            }
        }
        $xoopsTpl->assign('depart', $xoopsModuleConfig['form_dept']);
        $xoopsTpl->assign('departments', $departmentlist);
    }
	$xoopsTpl->assign('captcha', $xoopsModuleConfig['useCaptcha']);
	$xoopsTpl->assign('captchakey', $xoopsModuleConfig['captchaKey']);
	$xoopsTpl->assign('url', $xoopsModuleConfig['form_url']);
    $xoopsTpl->assign('icq', $xoopsModuleConfig['form_icq']);
	$xoopsTpl->assign('skype', $xoopsModuleConfig['form_skype']);
	$xoopsTpl->assign('company', $xoopsModuleConfig['form_company']);
	$xoopsTpl->assign('location', $xoopsModuleConfig['form_location']);
	$xoopsTpl->assign('phone', $xoopsModuleConfig['form_phone']);
	$xoopsTpl->assign('address', $xoopsModuleConfig['form_address']);
	
	$xoopsTpl->assign('map', $xoopsModuleConfig['embed_maps']);
	/*end Modules options*/
    $xoopsTpl->assign('breadcrumb', '<li><a href="' . XOOPS_URL . '">' . _YOURHOME . '</a></li> <li class="active">' . $xoopsModule->name().'</li>');
    $xoopsTpl->assign('info', xoops_getModuleOption('contact_info', 'contact'));
    
    /* added by goffy */
    $xoopsTpl->assign('lng_username', _MD_CONTACT_NAME);
    $xoopsTpl->assign('lng_email', _MD_CONTACT_MAIL);
    $xoopsTpl->assign('lng_url', _MD_CONTACT_URL);
    $xoopsTpl->assign('lng_company', _MD_CONTACT_COMPANY);
    $xoopsTpl->assign('lng_icq', _MD_CONTACT_ICQ_NAME);
    $xoopsTpl->assign('lng_address', _MD_CONTACT_ADDRESS);
    $xoopsTpl->assign('lng_location', _MD_CONTACT_LOCATION);
    $xoopsTpl->assign('lng_phone', _MD_CONTACT_PHONE);
    $xoopsTpl->assign('lng_skypename', _MD_CONTACT_SKYPE_NAME);
    $xoopsTpl->assign('lng_department', _MD_CONTACT_DEPARTMENT);
    $xoopsTpl->assign('lng_subject', _MD_CONTACT_SUBJECT);
    $xoopsTpl->assign('lng_message', _MD_CONTACT_MESSAGE);
    $xoopsTpl->assign('lng_submit', _MD_CONTACT_SUBMIT);
    
    $xoopsTpl->assign('lng_username_info', _MD_CONTACT_NAME_INFO);
    $xoopsTpl->assign('lng_email_info', _MD_CONTACT_MAIL_INFO);
    $xoopsTpl->assign('lng_url_info', _MD_CONTACT_URL_INFO);
    $xoopsTpl->assign('lng_company_info', _MD_CONTACT_COMPANY_INFO);
    $xoopsTpl->assign('lng_address_info', _MD_CONTACT_ADDRESS_INFO);
    $xoopsTpl->assign('lng_location_info', _MD_CONTACT_LOCATION_INFO);
    $xoopsTpl->assign('lng_phone_info', _MD_CONTACT_PHONE_INFO);
	$xoopsTpl->assign('lng_icq_info', _MD_CONTACT_ICQ_INFO);
    $xoopsTpl->assign('lng_skypename_info', _MD_CONTACT_SKYPE_NAME_INFO);
    $xoopsTpl->assign('lng_subject_info', _MD_CONTACT_SUBJECT_INFO);
    $xoopsTpl->assign('lng_message_info', _MD_CONTACT_MESSAGE_INFO);
		       
include XOOPS_ROOT_PATH . "/footer.php";
