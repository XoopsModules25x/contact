<?php

namespace XoopsModules\Contact;

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

/**
 * Class ContactHandler
 */
class ContactHandler extends \XoopsPersistableObjectHandler
{
    /**
     * ContactHandler constructor.
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db = null)
    {
        parent::__construct($db, 'contact', Contact::class, 'contact_id', 'contact_mail');
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
                            if(defined('FILTER_SANITIZE_ADD_SLASHES')){
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_ADD_SLASHES) : $default;
            } else {
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
            }
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
        $contact['contact_create']     = \time();
        $contact['contact_icq']        = Request::getString('contact_icq', '', 'POST');
        $contact['contact_skype']      = Request::getString('contact_skype', '', 'POST');
        $contact['contact_company']    = Request::getString('contact_company', '', 'POST');
        $contact['contact_location']   = Request::getString('contact_location', '', 'POST');
        $contact['contact_phone']      = Request::getString('contact_phone', '', 'int');
        $contact['contact_department'] = Request::getString('contact_department', \xoops_getModuleOption('contact_recipient_std', 'contact'), 'POST');
        $contact['contact_ip']         = \getenv('REMOTE_ADDR');
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
        $xoopsMailer = \xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($this->contactToEmails($contact['contact_department']));
        $xoopsMailer->setFromEmail($contact['contact_mail']);
        $xoopsMailer->setFromName(\html_entity_decode($contact['contact_name'], \ENT_QUOTES, 'UTF-8'));

        $info          = '';
        $subjectPrefix = '';
        if ($GLOBALS['xoopsModuleConfig']['form_dept'] && $GLOBALS['xoopsModuleConfig']['subject_prefix'] && $GLOBALS['xoopsModuleConfig']['contact_dept']) {
            $subjectPrefix = '[' . $GLOBALS['xoopsModuleConfig']['prefix_text'] . ' ' . $contact['contact_department'] . ']: ';
            $info          .= _MD_CONTACT_DEPARTMENT . ': ' . $contact['contact_department'] . "\n";
        }
        $xoopsMailer->setSubject($subjectPrefix . \html_entity_decode($contact['contact_subject'], \ENT_QUOTES, 'UTF-8'));

        if ($contact['contact_url']) {
            $info .= _MD_CONTACT_URL . ': ' . $contact['contact_url'] . "\n";
        }
        if ($contact['contact_icq']) {
            $info .= _MD_CONTACT_ICQ . ': ' . $contact['contact_icq'] . "\n";
        }
        if ($contact['contact_skype']) {
            $info .= _MD_CONTACT_SKYPE . ': ' . $contact['contact_skype'] . "\n";
        }
        if ($contact['contact_phone']) {
            $info .= _MD_CONTACT_PHONE . ': ' . $contact['contact_phone'] . "\n";
        }
        if ($contact['contact_company']) {
            $info .= _MD_CONTACT_COMPANY . ': ' . $contact['contact_company'] . "\n";
        }
        if ($contact['contact_location']) {
            $info .= _MD_CONTACT_LOCATION . ': ' . $contact['contact_location'] . "\n";
        }
        if ($contact['contact_address']) {
            $info .= _MD_CONTACT_ADDRESS . ': ' . $contact['contact_address'] . "\n";
        }
        if ('' !== $info) {
            $info = "\n" . $info . "\n";
        }

        $body = \str_replace('{BODY}', \html_entity_decode($contact['contact_message'], \ENT_QUOTES, 'UTF-8'), _MD_CONTACT_MAIL_BODY);
        $body = \str_replace('{INFO}', $info, $body);
        $body = \str_replace('{WEBSITE}', XOOPS_URL, $body);

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
    public function contactSendMailConfirm($contact)
    {
        $xoopsMailer = \xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($contact['contact_mail']);
        $xoopsMailer->setFromEmail(\xoops_getModuleOption('contact_recipient_std', 'contact'));
        $xoopsMailer->setFromName(\html_entity_decode($GLOBALS['xoopsConfig']['sitename'], \ENT_QUOTES, 'UTF-8'));

        $xoopsMailer->setSubject(_MD_CONTACT_MAILCONFIRM_SUBJECT);

        $info = '';
        if ($contact['contact_url']) {
            $info .= _MD_CONTACT_URL . ': ' . $contact['contact_url'] . "\n";
        }
        if ($contact['contact_icq']) {
            $info .= _MD_CONTACT_ICQ . ': ' . $contact['contact_icq'] . "\n";
        }
        if ($contact['contact_skype']) {
            $info .= _MD_CONTACT_SKYPE . ': ' . $contact['contact_skype'] . "\n";
        }
        if ($contact['contact_phone']) {
            $info .= _MD_CONTACT_PHONE . ': ' . $contact['contact_phone'] . "\n";
        }
        if ($contact['contact_company']) {
            $info .= _MD_CONTACT_COMPANY . ': ' . $contact['contact_company'] . "\n";
        }
        if ($contact['contact_location']) {
            $info .= _MD_CONTACT_LOCATION . ': ' . $contact['contact_location'] . "\n";
        }
        if ($contact['contact_address']) {
            $info .= _MD_CONTACT_ADDRESS . ': ' . $contact['contact_address'] . "\n";
        }
        if ('' !== $info) {
            $info = "\n" . $info . "\n";
        }

        $body = \str_replace('{NAME}', \html_entity_decode($contact['contact_name'], \ENT_QUOTES, 'UTF-8'), _MD_CONTACT_MAILCONFIRM_BODY);
        $body = \str_replace('{SUBJECT}', \html_entity_decode($contact['contact_subject'], \ENT_QUOTES, 'UTF-8'), $body);
        $body = \str_replace('{INFO}', $info, $body);
        $body = \str_replace('{BODY}', \html_entity_decode($contact['contact_message'], \ENT_QUOTES, 'UTF-8'), $body);
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
        $xoopsMailer = \xoops_getMailer();
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
        $department_mail[] = \xoops_getModuleOption('contact_recipient_std', 'contact');
        if (!empty($department)) {
            $departments = \xoops_getModuleOption('contact_dept', 'contact');
            foreach ($departments as $vals) {
                $vale = \explode(',', $vals);
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
        $ret = false;
        $tab = [];

        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('contact_cid', $contact_id));
        $criteria->add(new \Criteria('contact_type', 'Contact'));
        $contacts =& $this->getObjects($criteria, false);
        if ($contacts) {
            $ret = [];
            /** @var Contact $root */
            foreach ($contacts as $root) {
                $tab                   = $root->toArray();
                $tab['contact_owner']  = \XoopsUser::getUnameFromId($root->getVar('contact_uid'));
                $tab['contact_create'] = \formatTimestamp($root->getVar('contact_create'), _MEDIUMDATESTRING);
                $ret []                = $tab;
                unset($tab);
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
                $tab['contact_owner']  = \XoopsUser::getUnameFromId($root->getVar('contact_uid'));
                $tab['contact_create'] = \formatTimestamp($root->getVar('contact_create'), _MEDIUMDATESTRING);
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
        $platform = mb_strtolower($platform);
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
        $type = mb_strtolower($type);
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
        if (!\in_array($column, ['contact_mail', 'contact_url', 'contact_phone'])) {
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

        return \array_unique($ret);
    }
}
