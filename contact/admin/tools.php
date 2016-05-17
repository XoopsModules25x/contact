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
include __DIR__ . '/header.php';
// Define default value
$op = XoopsRequest::getString('op', 'list');
// Template Log
$templateMain = 'contact_admin_tools.tpl';
switch ($op) {
    case 'list':
        // prune manager
		xoops_load('XoopsFormLoader');
        $form = new XoopsThemeForm(_AM_CONTACT_TOOLS_PRUNE, 'tools', 'tools.php', 'post');
        $form->addElement(new XoopsFormTextDateSelect(_AM_CONTACT_TOOLS_PRUNE_BEFORE, 'prune_date', 15, time()));
        $onlyreply = new xoopsFormCheckBox('', 'onlyreply');
        $onlyreply->addOption(1, _AM_CONTACT_TOOLS_PRUNE_REPLYONLY);
        $form->addElement($onlyreply, false);
        $form->addElement(new XoopsFormHidden('op', 'prune'));
        $form->addElement(new XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        $xoopsTpl->assign('prune', $form->render());
        break;

    case 'prune':
        $timestamp = $contact_handler->Contact_CleanVars($_REQUEST, 'prune_date', '', 'int');
        $onlyreply = $contact_handler->Contact_CleanVars($_REQUEST, 'onlyreply', 0, 'int');
        $timestamp = strtotime($timestamp);
        $count     = $contact_handler->Contact_PruneCount($timestamp, $onlyreply);
        $contact_handler->Contact_DeleteBeforeDate($timestamp, $onlyreply);
        redirect_header('tools.php', 1, sprintf(_AM_CONTACT_MSG_PRUNE_DELETED, $count));
        xoops_cp_footer();
        exit ();
        break;
}

$xoopsTpl->assign('navigation', $adminMenu->addNavigation('tools.php'));
// Call footer
include __DIR__ . '/footer.php';
