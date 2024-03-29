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
 * Contact module for xoops
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GPL 2.0 or later
 * @package         wgsitenotice
 * @since           1.0
 * @min_xoops       2.5.7
 * @author          Goffy (wedega.com) - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @param $options
 * @return array
 */

use XoopsModules\Contact;

// Function show block form only
/**
 * @param $options
 * @return array
 */
function block_contact_form_show($options)
{
    $block = [];
    contactGetElements($block);

    return $block;
}

// Function show block map
/**
 * @param $options
 * @return array
 */
function block_contact_map_show($options)
{
    $block = [];
    contactGetElements($block);

    return $block;
}

// Function show block form and map
/**
 * @param $options
 * @return array
 */
function block_contact_form_map_show($options)
{
    $block = [];
    contactGetElements($block);

    return $block;
}

/**
 * @param $block
 */
function contactGetElements(&$block)
{
    $helper = Contact\Helper::getInstance();

    xoops_loadLanguage('main', 'contact');

    require_once XOOPS_ROOT_PATH . '/modules/contact/class/contact.php';

    $block['lng_username'] = 'name';

    /*Modules Options*/
    if (1 == $helper->getConfig('form_dept')) {
        // show a drop down with the correct departments listed
        $departmentlist = [];
        $departments    = xoops_getModuleOption('contact_dept', 'contact');
        foreach ($departments as $val) {
            [$name, $email] = explode(',', $val, 2); //split the name and email
            $departmentlist[] = $name;
        }
        $block['depart']      = $helper->getConfig('form_dept');
        $block['departments'] = $departmentlist;
    }
    $block['recaptcha']       = $helper->getConfig('recaptchause');
    $block['recaptchakey']    = $helper->getConfig('recaptchakey');
    $block['url']             = $helper->getConfig('form_url');
    $block['icq']             = $helper->getConfig('form_icq');
    $block['skype']           = $helper->getConfig('form_skype');
    $block['company']         = $helper->getConfig('form_company');
    $block['location']        = $helper->getConfig('form_location');
    $block['phone']           = $helper->getConfig('form_phone');
    $block['address']         = $helper->getConfig('form_address');
    $block['info']            = $helper->getConfig('contact_info');
    $block['contact_default'] = $helper->getConfig('contact_default');
    $block['map']             = $helper->getConfig('embed_maps');
    /*end Modules options*/

    /* get language vars*/
    $block['lng_username']   = _MD_CONTACT_NAME;
    $block['lng_email']      = _MD_CONTACT_MAIL;
    $block['lng_url']        = _MD_CONTACT_URL;
    $block['lng_company']    = _MD_CONTACT_COMPANY;
    $block['lng_icq']        = _MD_CONTACT_ICQ_NAME;
    $block['lng_address']    = _MD_CONTACT_ADDRESS;
    $block['lng_location']   = _MD_CONTACT_LOCATION;
    $block['lng_phone']      = _MD_CONTACT_PHONE;
    $block['lng_skypename']  = _MD_CONTACT_SKYPE_NAME;
    $block['lng_department'] = _MD_CONTACT_DEPARTMENT;
    $block['lng_subject']    = _MD_CONTACT_SUBJECT;
    $block['lng_message']    = _MD_CONTACT_MESSAGE;
    $block['lng_submit']     = _MD_CONTACT_SUBMIT;

    $block['lng_username_info']  = _MD_CONTACT_NAME_INFO;
    $block['lng_email_info']     = _MD_CONTACT_MAIL_INFO;
    $block['lng_url_info']       = _MD_CONTACT_URL_INFO;
    $block['lng_company_info']   = _MD_CONTACT_COMPANY_INFO;
    $block['lng_address_info']   = _MD_CONTACT_ADDRESS_INFO;
    $block['lng_location_info']  = _MD_CONTACT_LOCATION_INFO;
    $block['lng_phone_info']     = _MD_CONTACT_PHONE_INFO;
    $block['lng_icq_info']       = _MD_CONTACT_ICQ_INFO;
    $block['lng_skypename_info'] = _MD_CONTACT_SKYPE_NAME_INFO;
    $block['lng_subject_info']   = _MD_CONTACT_SUBJECT_INFO;
    $block['lng_message_info']   = _MD_CONTACT_MESSAGE_INFO;
}
