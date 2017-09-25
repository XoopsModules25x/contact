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
 * @author      Mirza (AKA Bleekk)
 */

use Xmf\Request;

include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'contact_index.tpl';
//unset($_SESSION);
include XOOPS_ROOT_PATH . '/header.php';

/** reCaptcha by google **/
global $xoopsConfig, $xoopsModuleConfig;
$captcha = '';

$saveinfo = $xoopsModuleConfig['saveinfo'];
$sendmail = $xoopsModuleConfig['sendmail'];

if ('' !== Request::getString('g-recaptcha-response', '', 'POST')) {
    $captcha = Request::getString('g-recaptcha-response', '', 'POST');
}

if (!$captcha && $xoopsModuleConfig['recaptchause']) {
    redirect_header('index.php', 2, _MD_CONTACT_MES_NOCAPTCHA);
} else {
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $xoopsModuleConfig['recaptchakey'] . '&response=' . $captcha . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
    if (false === $response['success'] && $xoopsModuleConfig['recaptchause']) {
        redirect_header('index.php', 2, _MD_CONTACT_MES_CAPTCHAINCORRECT);
    } else {
        global $xoopsConfig, $xoopsOption, $xoopsTpl, $xoopsUser, $xoopsUserIsAdmin, $xoopsLogger;
        $op         = Request::getString('op', 'form', 'POST');
        $department = Request::getString('department', '', 'GET');
        if ('save' === $op) {
            if ('' === Request::getString('submit', '', 'POST')) {
                redirect_header(XOOPS_URL, 3, _MD_CONTACT_MES_ERROR);
            } else {
                // check email
                if ('' === Request::getString('contact_mail', '', 'POST')) {
                    redirect_header('index.php', 1, _MD_CONTACT_MES_NOVALIDEMAIL);
                }

                // Info Processing
                $contact = $contactHandler->contactInfoProcessing();

                // insert in DB
                if (1 === $saveinfo) {
                    $obj = $contactHandler->create();
                    $obj->setVars($contact);
                    if (!$contactHandler->insert($obj)) {
                        redirect_header('index.php', 3, _MD_CONTACT_MES_NOTSAVE);
                    }
                }

                // send mail can send message
                if (1 === $sendmail) {
                    $message = $contactHandler->contactSendMail($contact);
                    if ($xoopsModuleConfig['mailconfirm']) {
                        $res_mailconfirm = $contactHandler->contactSendMailConfirm($contact);
                    }
                } elseif (1 === $saveinfo) {
                    $message = _MD_CONTACT_MES_SAVEINDB;
                } else {
                    $message = _MD_CONTACT_MES_SENDERROR;
                }

                redirect_header(XOOPS_URL, 3, $message);
            }
        }
    }
}

include XOOPS_ROOT_PATH . '/footer.php';
