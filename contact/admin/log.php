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
// Define default value
$op = $contact_handler->Contact_CleanVars($_REQUEST, 'op', 'form', 'string');

switch ($op) {
    case 'form':
        // prune manager
        $form   = new XoopsThemeForm(_AM_CONTACT_LOGS_FORM, 'logs', 'log.php', 'post');
        $column = new XoopsFormSelect(_AM_CONTACT_LOGS_COLUMN, 'column', 'contact_phone');
        $column->addOption("contact_phone", _AM_CONTACT_LOGS_COLUMN_PHONE);
        $column->addOption("contact_url", _AM_CONTACT_LOGS_COLUMN_URL);
        $column->addOption("contact_mail", _AM_CONTACT_LOGS_COLUMN_MAIL);
        $form->addElement($column);
        $form->addElement(new XoopsFormHidden('op', 'getlog'));
        $form->addElement(new XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        $xoopsTpl->assign('form', $form->render());
        break;

    case 'getlog':
        $column = $contact_handler->Contact_CleanVars($_REQUEST, 'column', '', 'string');
        $log    = $contact_handler->Contact_Logs($column);
        $xoopsTpl->assign('logs', $log);
        break;
}

$xoopsTpl->assign('navigation', $admin_class->addNavigation('log.php'));
// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_logs.html');
// Call footer
require dirname(__FILE__) . '/admin_footer.php';
