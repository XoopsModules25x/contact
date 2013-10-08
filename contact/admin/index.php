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

// Call header
require dirname(__FILE__) . '/admin_header.php';
// Display Admin header
xoops_cp_header();

// Display Admin menu class
$admin_class->addInfoBox(_AM_CONTACT_INDEX_ADMENU1);
$admin_class->addInfoBoxLine(_AM_CONTACT_INDEX_ADMENU1, _AM_CONTACT_INDEX_TOTAL, $contact_handler->Contact_GetCount('contact_cid'));
$xoopsTpl->assign('navigation', $admin_class->addNavigation('index.php'));
$xoopsTpl->assign('renderindex', $admin_class->renderIndex());

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_index.html');
// Call footer
require dirname(__FILE__) . '/admin_footer.php';
