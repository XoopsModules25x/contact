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
 */

$moduleDirName = basename(__DIR__);
require_once __DIR__ . '/../../include/cp_header.php';
include __DIR__ . '/class/contact.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

/** @var ContactContactHandler $contactHandler*/
$contactHandler = xoops_getModuleHandler('contact', $moduleDirName);
