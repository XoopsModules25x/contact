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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class contact extends XoopsObject
{

    public function __construct()
    {
        $this->XoopsObject();
        $this->initVar("contact_id", XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar("contact_uid", XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar("contact_cid", XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar("contact_name", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_subject", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_mail", XOBJ_DTYPE_EMAIL, null, false);
        $this->initVar("contact_url", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_create", XOBJ_DTYPE_INT, null, false);
        $this->initVar("contact_icq", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_company", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_location", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_phone", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_department", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_ip", XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar("contact_message", XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar("contact_address", XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar("contact_reply", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("contact_platform", XOBJ_DTYPE_ENUM, null, false, '', '', array('Android', 'Ios', 'Web'));
        $this->initVar("contact_type", XOBJ_DTYPE_ENUM, null, false, '', '', array('Contact', 'Phone', 'Mail'));

        $this->db    = $GLOBALS ['xoopsDB'];
        $this->table = $this->db->prefix('contact');
    }

    public function Contact_ContactForm($department)
    {
        global $xoopsConfig, $xoopsOption, $xoopsUser, $xoopsUserIsAdmin, $xoopsModuleConfig;
        if ($this->isNew()) {
            if (!empty($xoopsUser)) {
                $contact_uid      = $xoopsUser->getVar('uid');
                $contact_name     = $xoopsUser->getVar('uname');
                $contact_mail     = $xoopsUser->getVar('email');
                $contact_url      = $xoopsUser->getVar('url');
                $contact_icq      = $xoopsUser->getVar('user_icq');
                $contact_location = $xoopsUser->getVar('user_from');

            } else {
                $contact_uid      = 0;
                $contact_name     = '';
                $contact_mail     = '';
                $contact_url      = '';
                $contact_icq      = '';
                $contact_location = '';
            }
        } else {
            $contact_uid      = $this->getVar('contact_uid');
            $contact_name     = $this->getVar('contact_name');
            $contact_mail     = $this->getVar('contact_mail');
            $contact_url      = $this->getVar('contact_url');
            $contact_icq      = $this->getVar('contact_icq');
            $contact_location = $this->getVar('contact_location');
        }

        $form = new XoopsThemeForm(_MD_CONTACT_FORM, 'save', 'index.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormHidden ('op', 'save'));
        $form->addElement(new XoopsFormHidden ('contact_id', $this->getVar('contact_id', 'e')));
        $form->addElement(new XoopsFormHidden ('contact_uid', $contact_uid));
        $form->addElement(new XoopsFormText (_MD_CONTACT_NAME, 'contact_name', 50, 255, $contact_name), true);
        $form->addElement(new XoopsFormText (_MD_CONTACT_MAIL, 'contact_mail', 50, 255, $contact_mail), true);

        if (xoops_getModuleOption('form_url', 'contact')) {
            $form->addElement(new XoopsFormText (_MD_CONTACT_URL, 'contact_url', 50, 255, $contact_url), false);
        }
        if (xoops_getModuleOption('form_icq', 'contact')) {
            $form->addElement(new XoopsFormText (_MD_CONTACT_ICQ, 'contact_icq', 50, 255, $contact_icq), false);
        }
        if (xoops_getModuleOption('form_company', 'contact')) {
            $form->addElement(new XoopsFormText (_MD_CONTACT_COMPANY, 'contact_company', 50, 255, $this->getVar('contact_company')), false);
        }
        if (xoops_getModuleOption('form_location', 'contact')) {
            $form->addElement(new XoopsFormText (_MD_CONTACT_LOCATION, 'contact_location', 50, 255, $contact_location), false);
        }
        if (xoops_getModuleOption('form_phone', 'contact')) {
            $form->addElement(new XoopsFormText (_MD_CONTACT_PHONE, 'contact_phone', 50, 255, $this->getVar('contact_phone')), false);
        }
        if (xoops_getModuleOption('form_address', 'contact')) {
            $form->addElement(new XoopsFormTextArea (_MD_CONTACT_ADDRESS, 'contact_address', $this->getVar('contact_address', 'e'), 3, 60), false);
        }
        if (xoops_getModuleOption('form_dept', 'contact')) {
            // show a drop down with the correct departments listed
            $departmentlist = new XoopsFormSelect(_MD_CONTACT_DEPARTMENT, 'contact_department');
            $departments    = xoops_getModuleOption('contact_dept', 'contact');
            foreach ($departments as $val) {
                $valexplode = explode(',', $val);
                $departmentlist->addOption($valexplode[0]);
            }
            $form->addElement($departmentlist);
        }

        $form->addElement(new XoopsFormText (_MD_CONTACT_SUBJECT, 'contact_subject', 50, 255, $this->getVar('contact_subject')), true);
        $form->addElement(new XoopsFormTextArea (_MD_CONTACT_MESSAGE, 'contact_message', $this->getVar('contact_message', 'e'), 5, 60), true);


            // check captcha
            if ((!$xoopsUser && $xoopsModuleConfig['captchaAnonymous'])
                || ($xoopsUser && !$xoopsUserIsAdmin && $xoopsModuleConfig['captchaRegistered'])
            ) {
                xoops_load('XoopsFormCaptcha');
                $form->addElement(new XoopsFormCaptcha('','',false), true);
            }

        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    public function Contact_ReplyForm()
    {
        global $xoopsConfig;
        $form = new XoopsThemeForm(_AM_CONTACT_REPLY, 'doreply', 'contact.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormHidden ('op', 'doreply'));
        $form->addElement(new XoopsFormHidden ('contact_id', $this->getVar('contact_id', 'e')));
        $form->addElement(new XoopsFormHidden ('contact_uid', $this->getVar('contact_uid', 'e')));
        $form->addElement(new XoopsFormLabel(_AM_CONTACT_FROM, '', ''));
        $form->addElement(
            new XoopsFormText (_AM_CONTACT_NAMEFROM, 'contact_name', 50, 255, XoopsUser::getUnameFromId($this->getVar('contact_uid'))),
            true
        );
        $form->addElement(new XoopsFormText (_AM_CONTACT_MAILFROM, 'contact_mail', 50, 255, $xoopsConfig['adminmail']), true);
        $form->addElement(new XoopsFormLabel(_AM_CONTACT_TO, '', ''));
        $form->addElement(new XoopsFormText (_AM_CONTACT_NAMETO, 'contact_nameto', 50, 255, $this->getVar('contact_name')), true);
        $form->addElement(new XoopsFormText (_AM_CONTACT_MAILTO, 'contact_mailto', 50, 255, $this->getVar('contact_mail')), true);
        $form->addElement(new XoopsFormText (_AM_CONTACT_SUBJECT, 'contact_subject', 50, 255, _RE . $this->getVar('contact_subject')), true);
        $form->addElement(new XoopsFormTextArea (_AM_CONTACT_MESSAGE, 'contact_message', '', 5, 60), true);
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     **/
    public function toArray()
    {
        $ret  = array();
        $vars = $this->getVars();
        foreach (array_keys($vars) as $i) {
            $ret [$i] = $this->getVar($i);
        }

        return $ret;
    }
}

class ContactContactHandler extends XoopsPersistableObjectHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, "contact", 'contact', 'contact_id', 'contact_mail');
    }

    /**
     * Get variables passed by GET or POST method
     *
     */
    public function Contact_CleanVars(&$global, $key, $default = '', $type = 'int')
    {

        switch ($type) {
            case 'array':
                $ret = (isset($global[$key]) && is_array($global[$key])) ? $global[$key] : $default;
                break;
            case 'date':
                $ret = (isset($global[$key])) ? strtotime($global[$key]) : $default;
                break;
            case 'string':
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
                break;
            case 'mail':
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_EMAIL) : $default;
                break;
            case 'url':
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED) : $default;
                break;
            case 'ip':
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_IP) : $default;
                break;
            case 'amp':
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_FLAG_ENCODE_AMP) : $default;
                break;
            case 'text':
                $ret = (isset($global[$key])) ? htmlentities($global[$key], ENT_QUOTES, 'UTF-8') : $default;
                break;
            case 'platform':
                $ret = (isset($global[$key])) ? $this->Contact_Platform($global[$key]) : $this->Contact_Platform($default);
                break;
            case 'type':
                $ret = (isset($global[$key])) ? $this->Contact_Type($global[$key]) : $this->Contact_Type($default);
                break;
            case 'int':
            default:
                $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
                break;

        }
        if ($ret === false) {
            return $default;
        }

        return $ret;
    }

    public function Contact_InfoProcessing($global)
    {
        $contact                       = array();
        $contact['contact_cid']        = $this->Contact_CleanVars($_POST, 'contact_id', '', 'int');
        $contact['contact_uid']        = $this->Contact_CleanVars($_POST, 'contact_uid', '', 'int');
        $contact['contact_name']       = $this->Contact_CleanVars($_POST, 'contact_name', '', 'string');
        $contact['contact_nameto']     = $this->Contact_CleanVars($_POST, 'contact_nameto', '', 'string');
        $contact['contact_subject']    = $this->Contact_CleanVars($_POST, 'contact_subject', '', 'string');
        $contact['contact_mail']       = $this->Contact_CleanVars($_POST, 'contact_mail', '', 'mail');
        $contact['contact_mailto']     = $this->Contact_CleanVars($_POST, 'contact_mailto', '', 'mail');
        $contact['contact_url']        = $this->Contact_CleanVars($_POST, 'contact_url', '', 'url');
        $contact['contact_create']     = time();
        $contact['contact_icq']        = $this->Contact_CleanVars($_POST, 'contact_icq', '', 'string');
        $contact['contact_company']    = $this->Contact_CleanVars($_POST, 'contact_company', '', 'string');
        $contact['contact_location']   = $this->Contact_CleanVars($_POST, 'contact_location', '', 'text');
        $contact['contact_phone']      = $this->Contact_CleanVars($_POST, 'contact_phone', '', 'int');
        $contact['contact_department'] = $this->Contact_CleanVars($_POST, 'contact_department', _MD_CONTACT_DEFULTDEP, 'string');
        $contact['contact_ip']         = getenv("REMOTE_ADDR");
        $contact['contact_message']    = $this->Contact_CleanVars($_POST, 'contact_message', '', 'text');
        $contact['contact_address']    = $this->Contact_CleanVars($_POST, 'contact_address', '', 'text');
        $contact['contact_platform']   = $this->Contact_CleanVars($_POST, 'contact_platform', 'Web', 'platform');
        $contact['contact_type']       = $this->Contact_CleanVars($_POST, 'contact_type', 'Contact', 'type');

        return $contact;
    }

    public function Contact_SendMail($contact)
    {
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($this->Contact_ToEmails($contact['contact_department']));
        $xoopsMailer->setFromEmail($contact['contact_mail']);
        $xoopsMailer->setFromName($contact['contact_name']);
        $xoopsMailer->setSubject($contact['contact_subject']);
        $xoopsMailer->setBody(html_entity_decode($contact['contact_message'], ENT_QUOTES, 'UTF-8'));
        if ($xoopsMailer->send()) {
            $message = _MD_CONTACT_MES_SEND;
        } else {
            $message = $xoopsMailer->getErrors();
        }

        return $message;
    }

    public function Contact_ReplyMail($contact)
    {
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($contact['contact_mailto']);
        $xoopsMailer->setFromEmail($contact['contact_mail']);
        $xoopsMailer->setFromName($contact['contact_name']);
        $xoopsMailer->setSubject($contact['contact_subject']);
        $xoopsMailer->setBody($contact['contact_message']);
        if ($xoopsMailer->send()) {
            $message = _MD_CONTACT_MES_SEND;
        } else {
            $message = $xoopsMailer->getErrors();
        }

        return $message;
    }

    public function Contact_ToEmails($department = null)
    {
        global $xoopsConfig;
        $department_mail[] = $xoopsConfig['adminmail'];
        if (!empty($department)) {
            $departments = xoops_getModuleOption('contact_dept', 'contact');
            foreach ($departments as $vals) {
                $vale = explode(',', $vals);
                if ($department == $vale[0]) {
                    $department_mail[] = $vale[1];
                }
            }
        }

        return $department_mail;
    }

    public function Contact_AddReply($contact_id)
    {
        $obj = $this->get($contact_id);
        $obj->setVar('contact_reply', 1);
        if (!$this->insert($obj)) {
            return false;
        }

        return true;
    }

    public function Contact_GetReply($contact_id)
    {

        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ('contact_cid', $contact_id));
        $criteria->add(new Criteria ('contact_type', 'Contact'));
        $contacts = $this->getObjects($criteria, false);
        if ($contacts) {
            $ret = array();
            foreach ($contacts as $root) {
                $tab                   = array();
                $tab                   = $root->toArray();
                $tab['contact_owner']  = XoopsUser::getUnameFromId($root->getVar('contact_uid'));
                $tab['contact_create'] = formatTimestamp($root->getVar('contact_create'), _MEDIUMDATESTRING);
                $ret []                = $tab;
            }

            return $ret;
        } else {
            return false;
        }
    }

    public function Contact_GetAdminList($contact, $id)
    {
        $ret      = array();
        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ($id, '0'));
        $criteria->add(new Criteria ('contact_type', 'Contact'));
        $criteria->setSort($contact['sort']);
        $criteria->setOrder($contact['order']);
        $criteria->setStart($contact['start']);
        $criteria->setLimit($contact['limit']);
        $contacts = $this->getObjects($criteria, false);
        if ($contacts) {
            foreach ($contacts as $root) {
                $tab                   = array();
                $tab                   = $root->toArray();
                $tab['contact_owner']  = XoopsUser::getUnameFromId($root->getVar('contact_uid'));
                $tab['contact_create'] = formatTimestamp($root->getVar('contact_create'), _MEDIUMDATESTRING);
                $ret []                = $tab;
            }
        }

        return $ret;
    }

    /**
     * Get file Count
     */
    public function Contact_GetCount($id)
    {
        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ($id, '0'));
        $criteria->add(new Criteria ('contact_type', 'Contact'));

        return $this->getCount($criteria);
    }

    /**
     * Get Insert ID
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Contact Prune Count
     */
    public function Contact_PruneCount($timestamp, $onlyreply)
    {
        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ('contact_create', $timestamp, '<='));
        if ($onlyreply) {
            $criteria->add(new Criteria ('contact_reply', 1));
        }

        return $this->getCount($criteria);
    }

    /**
     * Contact Delete Before Date
     */
    public function Contact_DeleteBeforeDate($timestamp, $onlyreply)
    {
        $criteria = new CriteriaCompo ();
        $criteria->add(new Criteria ('contact_create', $timestamp, '<='));
        if ($onlyreply) {
            $criteria->add(new Criteria ('contact_reply', 1));
        }
        $this->deleteAll($criteria);
    }

    /**
     * Contact Platform
     */
    public function Contact_Platform($platform)
    {
        $platform = strtolower($platform);
        switch ($platform) {
            case 'Android':
                $ret = 'Android';
                break;

            case 'Ios':
                $ret = 'Ios';
                break;

            case 'Web':
            default:
                $ret = 'Web';
                break;
        }

        return $ret;
    }

    /**
     * Contact type
     */
    public function Contact_Type($type)
    {
        $type = strtolower($type);
        switch ($type) {
            case 'Mail':
                $ret = 'Mail';
                break;

            case 'Phone':
                $ret = 'Phone';
                break;

            case 'Contact':
            default:
                $ret = 'Contact';
                break;
        }

        return $ret;
    }

    /**
     * Contact logs
     */
    public function Contact_Logs($column, $timestamp = null)
    {
        $ret = array();
        if (!in_array($column, array('contact_mail', 'contact_url', 'contact_phone'))) {
            return $ret;
        }
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('contact_cid', '0'));
        if (!empty($timestamp)) {
            $criteria->add(new Criteria('contact_create', $timestamp, '<='));
        }
        $criteria->setSort('contact_create');
        $criteria->setOrder('DESC');
        $contacts = $this->getObjects($criteria, false);
        if ($contacts) {
            foreach ($contacts as $root) {
                $rootColumn = $root->getVar($column);
                if (!empty($rootColumn)) {
                    $ret[] = $root->getVar($column);
                    unset($root);
                }
            }
        }

        return array_unique($ret);
    }
}
