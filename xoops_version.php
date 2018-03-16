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

defined('XOOPS_ROOT_PATH') || die('Restricted access');

include __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);

// ------------------- Informations ------------------- //
$modversion = [
    'version'             => 2.26,
    'module_status'       => 'RC-1',
    'release_date'        => '2017/08/09',
    'name'                => _MI_CONTACT_NAME,
    'description'         => _MI_CONTACT_DESC,
    'official'            => 0,
    //1 indicates official XOOPS module supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => 'Kazumi Ono (Onokazu), Trabis, Voltan, Bleekk, Goffy, Mamba',
    'credits'             => 'XOOPS Development Team, Mohtava Project',
    'author_mail'         => 'author-email',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'help'                => 'page=help',
    // ------------------- Folders & Files -------------------
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . "/modules/$moduleDirName/docs/changelog.txt",
    //
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/$moduleDirName/docs/install.txt",
    // images
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => $moduleDirName,
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb/viewforum.php?forum=28/',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // ------------------- Min Requirements -------------------
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.8',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.1'],
    // ------------------- Admin Menu -------------------
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // ------------------- Main Menu -------------------
    'hasMain'             => 1,
    // ------------------- Install/Update -------------------
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // -------------------  PayPal ---------------------------
    'paypal'              => [
        'business'      => 'foundation@xoops.org',
        'item_name'     => 'Donation : ' . _MI_CONTACT_NAME,
        'amount'        => 0,
        'currency_code' => 'USD'
    ],
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => ['contact'],
];

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_CONTACT_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_CONTACT_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_CONTACT_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_CONTACT_SUPPORT, 'link' => 'page=support'],
];

// Templates
$modversion['templates'] = [
    [
        'file'        => $moduleDirName . '_index.tpl',
        'description' => '_MI_CONTACT_TEMPLATES'
    ],
];

// Blocks
$modversion['blocks'][] = [
    'file'        => 'block_' . $moduleDirName . '_form_map.php',
    'name'        => _MI_B_CONTACT_FORM,
    'description' => _MI_B_CONTACT_FORM_DESC,
    'show_func'   => 'block_' . $moduleDirName . '_form_show',
    'options'     => '',
    'template'    => 'block_' . $moduleDirName . '_form.tpl'
];
$modversion['blocks'][] = [
    'file'        => 'block_' . $moduleDirName . '_form_map.php',
    'name'        => _MI_B_CONTACT_MAP,
    'description' => _MI_B_CONTACT_MAP_DESC,
    'show_func'   => 'block_' . $moduleDirName . '_map_show',
    'options'     => '',
    'template'    => 'block_' . $moduleDirName . '_map.tpl'
];
$modversion['blocks'][] = [
    'file'        => 'block_' . $moduleDirName . '_form_map.php',
    'name'        => _MI_B_CONTACT_FORM_MAP,
    'description' => _MI_B_CONTACT_FORM_MAP_DESC,
    'show_func'   => 'block_' . $moduleDirName . '_form_map_show',
    'options'     => '',
    'template'    => 'block_' . $moduleDirName . '_form_map.tpl'
];

// Settings

$modversion['config'][] = [
    'name'        => 'saveinfo',
    'title'       => '_MI_CONTACT_MAIL_SAVE_DB',
    'description' => '_MI_CONTACT_MAIL_SAVE_DB_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1
];

$modversion['config'][] = [
    'name'        => 'sendmail',
    'title'       => '_MI_CONTACT_MAIL_SEND',
    'description' => '_MI_CONTACT_MAIL_SEND_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_CAPTCHA',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'recaptchause',
    'title'       => '_MI_CONTACT_FORM_RECAPTCHA_USE',
    'description' => '_MI_CONTACT_FORM_RECAPTCHA_USE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'recaptchakey',
    'title'       => '_MI_CONTACT_FORM_RECAPTCHA_KEY',
    'description' => '_MI_CONTACT_FORM_RECAPTCHA_KEY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_OPTIONS',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'form_url',
    'title'       => '_MI_CONTACT_FORM_URL',
    'description' => '_MI_CONTACT_FORM_URL_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_icq',
    'title'       => '_MI_CONTACT_FORM_ICQ',
    'description' => '_MI_CONTACT_FORM_ICQ_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_skype',
    'title'       => '_MI_CONTACT_FORM_SKYPE',
    'description' => '_MI_CONTACT_FORM_SKYPE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_company',
    'title'       => '_MI_CONTACT_FORM_COMPANY',
    'description' => '_MI_CONTACT_FORM_COMPANY_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_location',
    'title'       => '_MI_CONTACT_FORM_LOCATION',
    'description' => '_MI_CONTACT_FORM_LOCATION_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_phone',
    'title'       => '_MI_CONTACT_FORM_PHONE',
    'description' => '_MI_CONTACT_FORM_PHONE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'form_address',
    'title'       => '_MI_CONTACT_FORM_ADDRESS',
    'description' => '_MI_CONTACT_FORM_ADDRESS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_DEPT',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'form_dept',
    'title'       => '_MI_CONTACT_FORM_DEPT',
    'description' => '_MI_CONTACT_FORM_DEPT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'contact_dept',
    'title'       => '_MI_CONTACT_DEPT',
    'description' => '_MI_CONTACT_DEPT_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'array',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'subject_prefix',
    'title'       => '_MI_CONTACT_SUBJECT_PREFIX',
    'description' => '_MI_CONTACT_SUBJECT_PREFIX_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'prefix_text',
    'title'       => '_MI_CONTACT_PREFIX_TEXT',
    'description' => '_MI_CONTACT_PREFIX_TEXT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => _MI_CONTACT_PREFIX_TEXT_DEFAULT
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_INFO',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'contact_info',
    'title'       => '_MI_CONTACT_TOPINFO',
    'description' => '_MI_CONTACT_TOPINFO_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'contact_default',
    'title'       => '_MI_CONTACT_DEFAULT',
    'description' => '_MI_CONTACT_DEFAULT_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'embed_maps',
    'title'       => '_MI_CONTACT_MAP',
    'description' => '_MI_CONTACT_MAP_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_MISC',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'contact_recipient_std',
    'title'       => '_MI_CONTACT_RECIPIENT_STD',
    'description' => '_MI_CONTACT_RECIPIENT_STD_DESC',
    'formtype'    => 'text',
    'valuetype'   => 'text',
    'default'     => $GLOBALS['xoopsConfig']['adminmail']
];

$modversion['config'][] = [
    'name'        => 'mailconfirm',
    'title'       => '_MI_CONTACT_MAIL_CONFIRM',
    'description' => '_MI_CONTACT_MAIL_CONFIRM_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_CONTACT_HEAD_ADMIN',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
];

$modversion['config'][] = [
    'name'        => 'admin_perpage',
    'title'       => '_MI_CONTACT_PERPAGE',
    'description' => '_MI_CONTACT_PERPAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];
