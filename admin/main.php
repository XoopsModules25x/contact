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
global $xoopsModuleConfig;
// Define default value
$level      = '';

$saveinfo = $xoopsModuleConfig['saveinfo'];
$sendmail = $xoopsModuleConfig['sendmail'];

$op         = Request::getString('op', 'list');
$contact_id = Request::getInt('id', 0);

// Define scripts
$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/contact/assets/js/admin.js');
// Add module stylesheet
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/contact/assets/css/admin.css');
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');

switch ($op) {
    case 'list':
        $contact            = [];
        $contact['perpage'] = xoops_getModuleOption('admin_perpage', 'contact');
        $contact['order']   = 'DESC';
        $contact['sort']    = 'contact_id';

        // get limited information
        $contact['limit'] = Request::getInt('limit', 0);

        // get start information
        $contact['start'] = Request::getInt('start', 0);

        $contact_numrows = $contactHandler->contactGetCount('contact_cid');
        $contacts        = $contactHandler->contactGetAdminList($contact, 'contact_cid');

        if ($contact_numrows > $contact['limit']) {
            $contact_pagenav = new \XoopsPageNav($contact_numrows, $contact['limit'], $contact['start'], 'start', 'limit=' . $contact['limit']);
            $contact_pagenav = $contact_pagenav->renderNav(4);
        } else {
            $contact_pagenav = '';
        }

        $GLOBALS['xoopsTpl']->assign('contacts', $contacts);
        $GLOBALS['xoopsTpl']->assign('contact_pagenav', $contact_pagenav);
        $level = 'list';
        break;

    case 'reply':
        if ($contact_id > 0) {
            /** @var Contact $obj */
            $obj = $contactHandler->get($contact_id);
            if (0 != $obj->getVar('contact_cid')) {
                redirect_header('main.php', 3, _AM_CONTACT_CANTREPLY);
            }
            /** @var XoopsThemeForm $form */
            $form = $obj->contactReplyForm();
            $GLOBALS['xoopsTpl']->assign('replyform', $form->render());
            $GLOBALS['xoopsTpl']->assign('replylist', $contactHandler->contactGetReply($contact_id));
        } else {
            redirect_header('main.php', 3, _AM_CONTACT_MSG_EXIST);
        }
        $level = 'reply';
        break;

    case 'doreply':
        // check email
        if ('' === Request::getString('contact_mailto', '', 'POST')) {
            redirect_header('main.php', 3, _MD_CONTACT_MES_NOVALIDEMAIL);
        }

        // Info Processing
        $contact = $contactHandler->contactInfoProcessing();

        // insert in DB
        if (1 === $saveinfo) {
            $obj = $contactHandler->create();
            $obj->setVars($contact);

            if (!$contactHandler->insert($obj)) {
                redirect_header('main.php', 3, '4');
            }

            $contactHandler->contactAddReply($contact['contact_cid']);
        }

        // send mail can seet message
        $message = _MD_CONTACT_MES_SENDERROR;
        if (1 === $sendmail) {
            $message = $contactHandler->contactReplyMail($contact);
        } elseif (1 === $saveinfo) {
            $message = _MD_CONTACT_MES_SAVEINDB;
        }

        redirect_header('main.php', 3, $message);

        $level = 'doreply';
        break;

    case 'view':
        $obj = $contactHandler->get($contact_id);

        if (!$obj) {
            redirect_header('main.php', 3, _AM_CONTACT_MSG_EXIST);
        }

        $contact                       = [];
        $contact                       = $obj->toArray();
        $contact['contact_id']         = $obj->getVar('contact_id');
        $contact['contact_uid']        = $obj->getVar('contact_uid');
        $contact['contact_name']       = $obj->getVar('contact_name');
        $contact['contact_owner']      = XoopsUser::getUnameFromId($obj->getVar('contact_uid'));
        $contact['contact_subject']    = $obj->getVar('contact_subject');
        $contact['contact_mail']       = $obj->getVar('contact_mail');
        $contact['contact_url']        = $obj->getVar('contact_url');
        $contact['contact_create']     = formatTimestamp($obj->getVar('contact_create'), _MEDIUMDATESTRING);
        $contact['contact_icq']        = $obj->getVar('contact_icq');
        $contact['contact_company']    = $obj->getVar('contact_company');
        $contact['contact_location']   = $obj->getVar('contact_location');
        $contact['contact_phone']      = $obj->getVar('contact_phone');
        $contact['contact_department'] = $obj->getVar('contact_department');
        $contact['contact_ip']         = $obj->getVar('contact_ip');
        $contact['contact_message']    = $obj->getVar('contact_message');
        $contact['contact_address']    = $obj->getVar('contact_address');

        $GLOBALS['xoopsTpl']->assign('contact', $contact);
        $GLOBALS['xoopsTpl']->assign('replylist', $contactHandler->contactGetReply($contact_id));

        $level = 'view';
        break;

    case 'delete':
        if ($contact_id > 0) {
            // Prompt message
            xoops_confirm(['id' => $contact_id], 'main.php?op=dodelete', _AM_CONTACT_MSG_DELETE);
        } else {
            redirect_header('main.php', 3, _AM_CONTACT_MSG_EXIST);
        }

        $level = 'delete';
        break;

    case 'dodelete':
        if (!$contact_id > 0) {
            redirect_header('main.php', 3, _AM_CONTACT_MSG_EXIST);
            //            xoops_cp_footer();
            //            exit();
        }

        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_id', $contact_id));
        $criteria->add(new \Criteria('contact_cid', $contact_id), 'OR');

        if (!$contactHandler->deleteAll($criteria)) {
            redirect_header('main.php', 1, _AM_CONTACT_MSG_DELETEERROR);
            //            xoops_cp_footer();
            //            exit();
        }

        redirect_header('main.php', 1, _AM_CONTACT_MSG_DELETED);
    //        xoops_cp_footer();
    //        exit();
    //        break;
}

$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation(basename(__FILE__)));
$GLOBALS['xoopsTpl']->assign('level', $level);

// Call template file
$GLOBALS['xoopsTpl']->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_main.tpl');
// Call footer
require __DIR__ . '/admin_footer.php';
