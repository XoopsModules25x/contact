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

// Call header
require __DIR__ . '/admin_header.php';
// Display Admin header
xoops_cp_header();

// Display Admin menu class
$adminObject->addInfoBox(_AM_CONTACT_INDEX_ADMENU1);
$adminObject->addInfoBoxLine(_AM_CONTACT_INDEX_ADMENU1, _AM_CONTACT_INDEX_TOTAL, $contactHandler->contactGetCount('contact_cid'));
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->addNavigation(basename(__FILE__)));
$GLOBALS['xoopsTpl']->assign('renderindex', $adminObject->renderIndex());

// Call template file
$GLOBALS['xoopsTpl']->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_index.tpl');
// Call footer
require __DIR__ . '/admin_footer.php';
