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

use Xmf\Request;

// Call header
require __DIR__ . '/admin_header.php';
// Display Admin header
xoops_cp_header();
// Define default value
$op = Request::getString('op', 'form');

switch ($op) {
    case 'form':
        // prune manager
        $form   = new \XoopsThemeForm(_AM_CONTACT_LOGS_FORM, 'logs', 'log.php', 'post', true);
        $column = new \XoopsFormSelect(_AM_CONTACT_LOGS_COLUMN, 'column', 'contact_phone');
        $column->addOption('contact_phone', _AM_CONTACT_LOGS_COLUMN_PHONE);
        $column->addOption('contact_url', _AM_CONTACT_LOGS_COLUMN_URL);
        $column->addOption('contact_mail', _AM_CONTACT_LOGS_COLUMN_MAIL);
        $form->addElement($column);
        $form->addElement(new \XoopsFormHidden('op', 'getlog'));
        $form->addElement(new \XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;

    case 'getlog':
        $column = Request::getString('column', '');
        $log    = $contactHandler->contactLogs($column);
        $GLOBALS['xoopsTpl']->assign('logs', $log);
        break;
}

$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation(basename(__FILE__)));
// Call template file
$GLOBALS['xoopsTpl']->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_logs.tpl');
// Call footer
require __DIR__ . '/admin_footer.php';
