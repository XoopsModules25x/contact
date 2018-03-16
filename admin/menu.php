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

use XoopsModules\Contact;

// require_once __DIR__ . '/../class/Helper.php';
//require_once __DIR__ . '/../include/common.php';
$helper = Contact\Helper::getInstance();

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

$adminmenu[] = [
    'title' => _MI_CONTACT_MENU_HOME,
    'desc'  => _MI_CONTACT_MENU_HOME_DESC,
    'icon'  => $pathIcon32 . '/home.png',
    'link'  => 'admin/index.php'
];

$adminmenu[] = [
    'title' => _MI_CONTACT_MENU_CONTACT,
    'desc'  => _MI_CONTACT_MENU_CONTACT_DESC,
    'icon'  => $pathIcon32 . '/content.png',
    'link'  => 'admin/main.php'
];

$adminmenu[] = [
    'title' => _MI_CONTACT_MENU_LOGS,
    'desc'  => _MI_CONTACT_MENU_LOGS_DESC,
    'icon'  => $pathIcon32 . '/identity.png',
    'link'  => 'admin/log.php'
];

$adminmenu[] = [
    'title' => _MI_CONTACT_MENU_TOOLS,
    'desc'  => _MI_CONTACT_MENU_TOOLS_DESC,
    'icon'  => $pathIcon32 . '/delete.png',
    'link'  => 'admin/tools.php'
];

$adminmenu[] = [
    'title' => _MI_CONTACT_MENU_ABOUT,
    'desc'  => _MI_CONTACT_MENU_ABOUT_DESC,
    'icon'  => $pathIcon32 . '/about.png',
    'link'  => 'admin/about.php'
];
