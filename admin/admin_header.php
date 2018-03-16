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

require_once __DIR__ . '/../../../include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
global $xoopsModule;

$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');
$helper = Contact\Helper::getInstance();
/** @var Xmf\Module\Admin $adminObject */
$adminObject = Xmf\Module\Admin::getInstance();

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new \XoopsTpl();
}

$pathIcon16      = Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32      = Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getConfig('modicons32');

// Local icons path
$xoopsTpl->assign('pathModIcon16', $pathIcon16);
$xoopsTpl->assign('pathModIcon32', $pathIcon32);

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('main');


// Contact Handler
/** @var ContactContactHandler $contactHandler*/
$contactHandler = Contact\Helper::getInstance()->getHandler('Contact');
