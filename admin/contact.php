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
$op         = $contact_handler->Contact_CleanVars($_REQUEST, 'op', 'list', 'string');
$contact_id = $contact_handler->Contact_CleanVars($_REQUEST, 'id', '0', 'int');

// Define scripts
$xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
$xoTheme->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
$xoTheme->addScript(XOOPS_URL . '/modules/contact/js/admin.js');
// Add module stylesheet
$xoTheme->addStylesheet(XOOPS_URL . '/modules/contact/css/admin.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');

switch ($op) {
    case 'list':
        $contact            = array();
        $contact['perpage'] = xoops_getModuleOption('admin_perpage', 'contact');
        $contact['order']   = 'DESC';
        $contact['sort']    = 'contact_id';

        // get limited information
        if (isset($_REQUEST['limit'])) {
            $contact['limit'] = $contact_handler->Contact_CleanVars($_REQUEST, 'limit', 0, 'int');
        } else {
            $contact['limit'] = $contact['perpage'];
        }

        // get start information
        if (isset($_REQUEST['start'])) {
            $contact['start'] = $contact_handler->Contact_CleanVars($_REQUEST, 'start', 0, 'int');
        } else {
            $contact['start'] = 0;
        }

        $contact_numrows = $contact_handler->Contact_GetCount('contact_cid');
        $contacts        = $contact_handler->Contact_GetAdminList($contact, 'contact_cid');

        if ($contact_numrows > $contact['limit']) {
            $contact_pagenav = new XoopsPageNav($contact_numrows, $contact['limit'], $contact['start'], 'start', 'limit=' . $contact['limit']);
            $contact_pagenav = $contact_pagenav->renderNav(4);
        } else {
            $contact_pagenav = '';
        }

        $xoopsTpl->assign('contacts', $contacts);
        $xoopsTpl->assign('contact_pagenav', $contact_pagenav);
        $level = 'list';
        break;

    case 'reply':
        if ($contact_id > 0) {
            $obj = $contact_handler->get($contact_id);
            if ($obj->getVar('contact_cid') != 0) {
                redirect_header('contact.php', 3, _AM_CONTACT_CANTREPLY);
            }
            $form = $obj->Contact_ReplyForm();
            $xoopsTpl->assign('replyform', $form->render());
            $xoopsTpl->assign('replylist', $contact_handler->Contact_GetReply($contact_id));
        } else {
            redirect_header('contact.php', 3, _AM_CONTACT_MSG_EXIST);
        }
        $level = 'reply';
        break;

    case 'doreply':

        // check email
        if (!$contact_handler->Contact_CleanVars($_POST, 'contact_mailto', '', 'mail')) {
            redirect_header("contact.php", 3, _MD_CONTACT_MES_NOVALIDEMAIL);
            exit();
        }

        // Info Processing
        $contact = $contact_handler->Contact_InfoProcessing($_POST);

        // insert in DB
        if ($saveinfo = true) {
            $obj = $contact_handler->create();
            $obj->setVars($contact);

            if (!$contact_handler->insert($obj)) {
                redirect_header("contact.php", 3, '4');
                exit();
            }

            $contact_handler->Contact_AddReply($contact['contact_cid']);

        }

        // send mail can seet message
        if ($sendmail = true) {
            $message = $contact_handler->Contact_ReplyMail($contact);
        } elseif ($saveinfo = true) {
            $message = _MD_CONTACT_MES_SAVEINDB;
        } else {
            $message = _MD_CONTACT_MES_SENDERROR;
        }

        redirect_header("contact.php", 3, $message);

        $level = 'doreply';
        break;

    case 'view':

        $obj = $contact_handler->get($contact_id);

        if (!$obj) {
            redirect_header('contact.php', 3, _AM_CONTACT_MSG_EXIST);
            exit ();
        }

        $contact                       = array();
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

        $xoopsTpl->assign('contact', $contact);
        $xoopsTpl->assign('replylist', $contact_handler->Contact_GetReply($contact_id));

        $level = 'view';
        break;

    case 'delete':

        if ($contact_id > 0) {
            // Prompt message
            xoops_confirm(array("id" => $contact_id), 'contact.php?op=dodelete', _AM_CONTACT_MSG_DELETE);
        } else {
            redirect_header('contact.php', 3, _AM_CONTACT_MSG_EXIST);
        }

        $level = 'delete';
        break;

    case 'dodelete':

        if (!$contact_id > 0) {
            redirect_header('contact.php', 3, _AM_CONTACT_MSG_EXIST);
            xoops_cp_footer();
            exit ();
        }

        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ('contact_id', $contact_id));
        $criteria->add(new Criteria ('contact_cid', $contact_id), 'OR');

        if (!$contact_handler->deleteAll($criteria)) {
            redirect_header('contact.php', 1, _AM_CONTACT_MSG_DELETEERROR);
            xoops_cp_footer();
            exit ();
        }

        redirect_header('contact.php', 1, _AM_CONTACT_MSG_DELETED);
        xoops_cp_footer();
        exit ();
        break;
}

$xoopsTpl->assign('navigation', $admin_class->addNavigation('contact.php'));
$xoopsTpl->assign('level', $level);

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/contact/templates/admin/contact_contact.html');
// Call footer
require dirname(__FILE__) . '/admin_footer.php';
