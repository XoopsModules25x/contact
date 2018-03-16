<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xmf\Request;

/**
 * Contact module
 *
 * @copyright     XOOPS Project (https://xoops.org)
 * @license       http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author        Kazumi Ono (aka Onokazu)
 * @author        Trabis <lusopoemas@gmail.com>
 * @author        Hossein Azizabadi (AKA Voltan)
 * @author        Mirza (AKA Bleekk)
 */

defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class contact
 */
class Contact extends XoopsObject
{
    private $db;
    private $table;

    /**
     * contact constructor.
     */
    public function __construct()
    {
        // parent::__construct();
        $this->initVar('contact_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_uid', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_cid', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_name', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_subject', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_mail', XOBJ_DTYPE_EMAIL, null, false);
        $this->initVar('contact_url', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_create', XOBJ_DTYPE_INT, null, false);
        $this->initVar('contact_icq', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_company', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_location', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_phone', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_department', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_ip', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_message', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('contact_address', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('contact_reply', XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar('contact_platform', XOBJ_DTYPE_ENUM, null, false, '', '', ['Android', 'Ios', 'Web']);
        $this->initVar('contact_type', XOBJ_DTYPE_ENUM, null, false, '', '', ['Contact', 'Phone', 'Mail']);

        $this->db    = $GLOBALS ['xoopsDB'];
        $this->table = $this->db->prefix('contact');
    }

    /**
     * @return XoopsThemeForm
     */
    public function contactReplyForm()
    {
        //        global $xoopsConfig;
        $form = new \XoopsThemeForm(_AM_CONTACT_REPLY, 'doreply', 'main.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new \XoopsFormHidden('op', 'doreply'));
        $form->addElement(new \XoopsFormHidden('contact_id', $this->getVar('contact_id', 'e')));
        $form->addElement(new \XoopsFormHidden('contact_uid', $this->getVar('contact_uid', 'e')));
        $form->addElement(new \XoopsFormLabel(_AM_CONTACT_FROM, '', ''));
        $form->addElement(new \XoopsFormText(_AM_CONTACT_NAMEFROM, 'contact_name', 50, 255, XoopsUser::getUnameFromId($GLOBALS['xoopsUser']->uid())), true);
        $form->addElement(new \XoopsFormText(_AM_CONTACT_MAILFROM, 'contact_mail', 50, 255, $GLOBALS['xoopsUser']->getVar('email')), true);
        $form->addElement(new \XoopsFormLabel(_AM_CONTACT_TO, '', ''));
        $form->addElement(new \XoopsFormText(_AM_CONTACT_NAMETO, 'contact_nameto', 50, 255, $this->getVar('contact_name')), true);
        $form->addElement(new \XoopsFormText(_AM_CONTACT_MAILTO, 'contact_mailto', 50, 255, $this->getVar('contact_mail')), true);
        $form->addElement(new \XoopsFormText(_AM_CONTACT_SUBJECT, 'contact_subject', 50, 255, _RE . $this->getVar('contact_subject')), true);
        $form->addElement(new \XoopsFormTextArea(_AM_CONTACT_MESSAGE, 'contact_message', '', 5, 60), true);
        $form->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     **/
    public function toArray()
    {
        $ret  = [];
        $vars =& $this->getVars();
        foreach (array_keys($vars) as $i) {
            $ret [$i] = $this->getVar($i);
        }

        return $ret;
    }
}

/**
 * Class ContactContactHandler
 */
class ContactContactHandler extends XoopsPersistableObjectHandler
{
    /**
     * ContactContactHandler constructor.
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'contact', 'Contact', 'contact_id', 'contact_mail');
    }

    /**
     * Get variables passed by GET or POST method
     * @param        $global
     * @param        $key
     * @param string $default
     * @param string $type
     * @return false|int|mixed|string
     */
    /*
    public function contactCleanVars(&$global, $key, $default = '', $type = 'int')
    {
        switch ($type) {
            case 'array':
                $ret = (isset($global[$key]) && is_array($global[$key])) ? $global[$key] : $default;
                break;
            case 'date':
                $ret = isset($global[$key]) ? strtotime($global[$key]) : $default;
                break;
            case 'string':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
                break;
            case 'mail':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_VALIDATE_EMAIL) : $default;
                break;
            case 'url':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED) : $default;
                break;
            case 'ip':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_VALIDATE_IP) : $default;
                break;
            case 'amp':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_FLAG_ENCODE_AMP) : $default;
                break;
            case 'text':
                $ret = isset($global[$key]) ? htmlentities($global[$key], ENT_QUOTES, 'UTF-8') : $default;
                break;
            case 'platform':
                $ret = isset($global[$key]) ? $this->contactPlatform($global[$key]) : $this->contactPlatform($default);
                break;
            case 'type':
                $ret = isset($global[$key]) ? $this->contactType($global[$key]) : $this->contactType($default);
                break;
            case 'int':
            default:
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
                break;
        }
        if ($ret === false) {
            return $default;
        }

        return $ret;
    }
*/

    /**
     * @return array
     */
    public function contactInfoProcessing()
    {
        $contact                       = [];
        $contact['contact_cid']        = Request::getInt('contact_id', 0, 'POST');
        $contact['contact_uid']        = Request::getInt('contact_uid', 0, 'POST');
        $contact['contact_name']       = Request::getString('contact_name', '', 'POST');
        $contact['contact_nameto']     = Request::getString('contact_nameto', '', 'POST');
        $contact['contact_subject']    = Request::getString('contact_subject', '', 'POST');
        $contact['contact_mail']       = Request::getString('contact_mail', '', 'POST');
        $contact['contact_mailto']     = Request::getEmail('contact_mailto', '', 'POST');
        $contact['contact_url']        = Request::getUrl('contact_url', '', 'POST');
        $contact['contact_create']     = time();
        $contact['contact_icq']        = Request::getString('contact_icq', '', 'POST');
        $contact['contact_company']    = Request::getString('contact_company', '', 'POST');
        $contact['contact_location']   = Request::getString('contact_location', '', 'POST');
        $contact['contact_phone']      = Request::getString('contact_phone', '', 'int');
        $contact['contact_department'] = Request::getString('contact_department', _MD_CONTACT_DEFULTDEP, 'POST');
        $contact['contact_ip']         = getenv('REMOTE_ADDR');
        $contact['contact_message']    = Request::getText('contact_message', '', 'POST');
        $contact['contact_address']    = Request::getString('contact_address', '', 'POST');
        $contact['contact_platform']   = Request::getString('contact_platform', 'Web', 'POST');
        $contact['contact_type']       = Request::getString('contact_type', 'Contact', 'POST');
        $contact['contact_reply']      = Request::getInt('contact_reply', 0, 'POST');

        return $contact;
    }

    /**
     * @param $contact
     * @return string
     */
    public function contactSendMail($contact)
    {
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($this->contactToEmails($contact['contact_department']));
        $xoopsMailer->setFromEmail($contact['contact_mail']);
        $xoopsMailer->setFromName(html_entity_decode($contact['contact_name'], ENT_QUOTES, 'UTF-8'));

        $subjectPrefix = '';
        if ($GLOBALS['xoopsModuleConfig']['form_dept'] && $GLOBALS['xoopsModuleConfig']['subject_prefix'] && $GLOBALS['xoopsModuleConfig']['contact_dept']) {
            $subjectPrefix = '[' . $GLOBALS['xoopsModuleConfig']['prefix_text'] . ' ' . $contact['contact_department'] . ']: ';
        }
        $xoopsMailer->setSubject($subjectPrefix . html_entity_decode($contact['contact_subject'], ENT_QUOTES, 'UTF-8'));
        $xoopsMailer->setBody(html_entity_decode($contact['contact_message'], ENT_QUOTES, 'UTF-8'));
        if ($xoopsMailer->send()) {
            $message = _MD_CONTACT_MES_SEND;
        } else {
            $message = $xoopsMailer->getErrors();
        }

        return $message;
    }

    /**
     * @param $contact
     * @return string
     */
    public function contactSendMailConfirm($contact)
    {
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($contact['contact_mail']);
        $xoopsMailer->setFromEmail($this->contactToEmails($contact['contact_department']));
        $xoopsMailer->setFromName(html_entity_decode($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES, 'UTF-8'));

        $xoopsMailer->setSubject(_MD_CONTACT_MAILCONFIRM_SUBJECT);
        $body = str_replace('{NAME}', html_entity_decode($contact['contact_name'], ENT_QUOTES, 'UTF-8'), _MD_CONTACT_MAILCONFIRM_BODY);
        $body = str_replace('{SUBJECT}', html_entity_decode($contact['contact_subject'], ENT_QUOTES, 'UTF-8'), $body);
        $body = str_replace('{BODY}', html_entity_decode($contact['contact_message'], ENT_QUOTES, 'UTF-8'), $body);
        $xoopsMailer->setBody($body);
        if ($xoopsMailer->send()) {
            $message = _MD_CONTACT_MES_SEND;
        } else {
            $message = $xoopsMailer->getErrors();
        }

        return $message;
    }

    /**
     * @param $contact
     * @return string
     */
    public function contactReplyMail($contact)
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

    /**
     * @param null $department
     * @return array
     */
    public function contactToEmails($department = null)
    {
        //        global $xoopsConfig;
        $department_mail[] = xoops_getModuleOption('contact_recipient_std', 'contact');
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

    /**
     * @param $contact_id
     * @return bool
     */
    public function contactAddReply($contact_id)
    {
        $obj = $this->get($contact_id);
        $obj->setVar('contact_reply', 1);
        if (!$this->insert($obj)) {
            return false;
        }

        return true;
    }

    /**
     * @param $contact_id
     * @return array|bool
     */
    public function contactGetReply($contact_id)
    {
        $ret      = false;

        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_cid', $contact_id));
        $criteria->add(new \Criteria('contact_type', 'Contact'));
        $contacts =& $this->getObjects($criteria, false);
        if ($contacts) {
            $ret = [];
            /** @var Contact $root */
            foreach ($contacts as $root) {
                $tab                   = [];
                $tab                   = $root->toArray();
                $tab['contact_owner']  = XoopsUser::getUnameFromId($root->getVar('contact_uid'));
                $tab['contact_create'] = formatTimestamp($root->getVar('contact_create'), _MEDIUMDATESTRING);
                $ret []                = $tab;
            }
        }

        return $ret;
    }

    /**
     * @param $contact
     * @param $id
     * @return array
     */
    public function contactGetAdminList($contact, $id)
    {
        $ret      = [];
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria($id, '0'));
        $criteria->add(new \Criteria('contact_type', 'Contact'));
        $criteria->setSort($contact['sort']);
        $criteria->setOrder($contact['order']);
        $criteria->setStart($contact['start']);
        $criteria->setLimit($contact['limit']);
        $contacts =& $this->getObjects($criteria, false);
        if ($contacts) {
            /** @var Contact $root */
            foreach ($contacts as $root) {
                $tab                   = [];
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
     * @param $id
     * @return int
     */
    public function contactGetCount($id)
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria($id, '0'));
        $criteria->add(new \Criteria('contact_type', 'Contact'));

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
     * @param $timestamp
     * @param $onlyreply
     * @return int
     */
    public function contactPruneCount($timestamp, $onlyreply)
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_create', $timestamp, '<='));
        if ($onlyreply) {
            $criteria->add(new \Criteria('contact_reply', 1));
        }

        return $this->getCount($criteria);
    }

    /**
     * Contact Delete Before Date
     * @param $timestamp
     * @param $onlyreply
     */
    public function contactDeleteBeforeDate($timestamp, $onlyreply)
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_create', $timestamp, '<='));
        if ($onlyreply) {
            $criteria->add(new \Criteria('contact_reply', 1));
        }
        $this->deleteAll($criteria);
    }

    /**
     * Contact Platform
     * @param $platform
     * @return string
     */
    public function contactPlatform($platform)
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
     * @param $type
     * @return string
     */
    public function contactType($type)
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
     * @param      $column
     * @param null $timestamp
     * @return array
     */
    public function contactLogs($column, $timestamp = null)
    {
        $ret = [];
        if (!in_array($column, ['contact_mail', 'contact_url', 'contact_phone'])) {
            return $ret;
        }
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_cid', '0'));
        if (!empty($timestamp)) {
            $criteria->add(new \Criteria('contact_create', $timestamp, '<='));
        }
        $criteria->setSort('contact_create');
        $criteria->setOrder('DESC');
        $contacts =& $this->getObjects($criteria, false);
        if ($contacts) {
            /** @var Contact $root */
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
