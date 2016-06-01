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

$xoopsTpl->assign('navigation', $admin_class->addNavigation('about.php'));
$xoopsTpl->assign('renderabout', $admin_class->renderabout('6KJ7RW5DR3VTJ', false));

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_about.html');
// Call footer
require dirname(__FILE__) . '/admin_footer.php';
