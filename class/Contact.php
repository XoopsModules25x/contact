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
 * Class contact
 */
class Contact extends \XoopsObject
{
    private $db;
    private $table;

    /**
     * contact constructor.
     */
    public function __construct()
    {
        // parent::__construct();
        $this->initVar('contact_id', \XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_uid', \XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_cid', \XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('contact_name', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_subject', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_mail', \XOBJ_DTYPE_EMAIL, null, false);
        $this->initVar('contact_url', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_create', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('contact_icq', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_skype', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_company', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_location', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_phone', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_department', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_ip', \XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('contact_message', \XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('contact_address', \XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('contact_reply', \XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar('contact_platform', \XOBJ_DTYPE_ENUM, null, false, '', '', ['Android', 'Ios', 'Web']);
        $this->initVar('contact_type', \XOBJ_DTYPE_ENUM, null, false, '', '', ['Contact', 'Phone', 'Mail']);

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
        $form->addElement(new \XoopsFormText(_AM_CONTACT_NAMEFROM, 'contact_name', 50, 255, \XoopsUser::getUnameFromId($GLOBALS['xoopsUser']->uid())), true);
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
        $vars = &$this->getVars();
        foreach (\array_keys($vars) as $i) {
            $ret [$i] = $this->getVar($i);
        }

        return $ret;
    }
}
