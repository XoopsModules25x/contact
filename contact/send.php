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
 * @author      Mirza (AKA Bleekk)
 * @version     $Id: index.php 12285 2014-01-30 11:31:16Z beckmi $
 */
include __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'contact_index.tpl';
//unset($_SESSION);
include XOOPS_ROOT_PATH . "/header.php";

/** reCaptcha by google **/
global $xoopsConfig;

if(isset($_POST['g-recaptcha-response'])){
    $captcha = $_POST['g-recaptcha-response'];
}

if(!$captcha && $contacts->getConfig('recaptchause'){
    redirect_header("index.php", 2, _MD_CONTACT_MES_NOCAPTCHA);
} else {
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$contacts->getConfig('recaptchakey')."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    if($response.success == false && $contacts->getConfig('recaptchause')
    {
        redirect_header("index.php", 2, _MD_CONTACT_MES_CAPTCHAINCORRECT);
    } else {
        global $xoopsConfig, $xoopsOption, $xoopsTpl, $xoopsUser, $xoopsUserIsAdmin, $xoopsLogger;
        $op         = $contactsHandler->Contact_CleanVars($_POST, 'op', 'form', 'string');
        $department = $contactsHandler->Contact_CleanVars($_GET, 'department', '', 'string');
        if($op == "save") {
            if (empty($_POST['submit']) ) {
                redirect_header(XOOPS_URL, 3, _MD_CONTACT_MES_ERROR);
                exit();
            } else {           
                // check email
                if (!$contactsHandler->Contact_CleanVars($_POST, 'contact_mail', '', 'mail')) {
                    redirect_header("index.php", 1, _MD_CONTACT_MES_NOVALIDEMAIL);
                    exit();
                }
            
                // Info Processing
                $contact = $contactsHandler->Contact_InfoProcessing($_POST);
              
                // insert in DB
                if ($saveinfo = true) {
                    $obj = $contactsHandler->create();
                    $obj->setVars($contact);
                    if (!$contactsHandler->insert($obj)) {
                        redirect_header("index.php", 3, _MD_CONTACT_MES_NOTSAVE);
                        exit();
                    }
                }
            
                // send mail can send message
                if ($sendmail = true) {
                    $message = $contactsHandler->Contact_SendMail($contact);
                    if ($contacts->getConfig('mailconfirm') {
                        $res_mailconfirm = $contactsHandler->Contact_SendMailConfirm($contact);
                    }
                } elseif ($saveinfo = true) {
                    $message = _MD_CONTACT_MES_SAVEINDB;
                } else {
                    $message = _MD_CONTACT_MES_SENDERROR;
                }
                
                redirect_header(XOOPS_URL, 3, $message);
                exit();
            }
        }
    }
}
include __DIR__ . '/footer.php';