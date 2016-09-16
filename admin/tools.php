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
// Define default value
$op = XoopsRequest::getString('op', 'list');

switch ($op) {
    case 'list':
        // prune manager
        $form = new XoopsThemeForm(_AM_CONTACT_TOOLS_PRUNE, 'tools', 'tools.php', 'post');
        $form->addElement(new XoopsFormTextDateSelect(_AM_CONTACT_TOOLS_PRUNE_BEFORE, 'prune_date', 15, time()));
        $onlyreply = new xoopsFormCheckBox('', 'onlyreply');
        $onlyreply->addOption(1, _AM_CONTACT_TOOLS_PRUNE_REPLYONLY);
        $form->addElement($onlyreply, false);
        $form->addElement(new XoopsFormHidden('op', 'prune'));
        $form->addElement(new XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        $GLOBALS['xoopsTpl']->assign('prune', $form->render());
        break;

    case 'prune':
        $timestamp = XoopsRequest::getInt('prune_date', '');
        $onlyreply = XoopsRequest::getInt('onlyreply', 0);
        $timestamp = strtotime($timestamp);
        $count     = $contactHandler->contactPruneCount($timestamp, $onlyreply);
        $contactHandler->contactDeleteBeforeDate($timestamp, $onlyreply);
        redirect_header('tools.php', 1, sprintf(_AM_CONTACT_MSG_PRUNE_DELETED, $count));
//        xoops_cp_footer();
//        exit();
//        break;
}

$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->addNavigation(basename(__FILE__)));
// Call template file
$GLOBALS['xoopsTpl']->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_tools.tpl');
// Call footer
require __DIR__ . '/admin_footer.php';
