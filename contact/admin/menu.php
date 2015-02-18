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

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$module_handler  = xoops_gethandler('module');
$module          = $module_handler->getByDirname(basename(dirname(dirname(__FILE__))));
$pathIcon32 = '../../' . $module->getInfo('icons32');
xoops_loadLanguage('modinfo', $module->dirname());

$adminmenu = array();

$i                      = 1;
$adminmenu[$i]["title"] = _MI_CONTACT_MENU_HOME;
$adminmenu[$i]["link"]  = "admin/index.php";
$adminmenu[$i]["desc"]  = _MI_CONTACT_MENU_HOME_DESC;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/home.png';
$i++;
$adminmenu[$i]["title"] = _MI_CONTACT_MENU_CONTACT;
$adminmenu[$i]["link"]  = "admin/contact.php";
$adminmenu[$i]["desc"]  = _MI_CONTACT_MENU_CONTACT_DESC;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/content.png';
$i++;
$adminmenu[$i]["title"] = _MI_CONTACT_MENU_LOGS;
$adminmenu[$i]["link"]  = "admin/log.php";
$adminmenu[$i]["desc"]  = _MI_CONTACT_MENU_LOGS_DESC;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/identity.png';
$i++;
$adminmenu[$i]["title"] = _MI_CONTACT_MENU_TOOLS;
$adminmenu[$i]["link"]  = "admin/tools.php";
$adminmenu[$i]["desc"]  = _MI_CONTACT_MENU_TOOLS_DESC;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/delete.png';
$i++;
$adminmenu[$i]["title"] = _MI_CONTACT_MENU_ABOUT;
$adminmenu[$i]["link"]  = "admin/about.php";
$adminmenu[$i]["desc"]  = _MI_CONTACT_MENU_ABOUT_DESC;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/about.png';
