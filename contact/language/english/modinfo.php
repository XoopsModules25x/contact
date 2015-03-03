<?php
// Module Info
// The name of this module
define('_MI_CONTACT_NAME', "Contact us");
define('_MI_CONTACT_DESC', "Contact module with email and database storage");
// Admin menu
define('_MI_CONTACT_MENU_HOME', "Home");
define('_MI_CONTACT_MENU_HOME_DESC', "Go back to homepage");
define('_MI_CONTACT_MENU_CONTACT', "Messages");
define('_MI_CONTACT_MENU_CONTACT_DESC', "List of messages");
define('_MI_CONTACT_MENU_TOOLS', "Purge");
define('_MI_CONTACT_MENU_TOOLS_DESC', "Purge Tools");
define('_MI_CONTACT_MENU_LOGS', "Logs");
define('_MI_CONTACT_MENU_LOGS_DESC', "Get Logs");
define('_MI_CONTACT_MENU_ABOUT', "About");
define('_MI_CONTACT_MENU_ABOUT_DESC', "About this module");
define('_MI_CONTACT_MENU_HELP', "Help");
define('_MI_CONTACT_MENU_HELP_DESC', "Module help");
// Module Settings
define('_MI_CONTACT_FORM_URL', "Get URL");
define('_MI_CONTACT_FORM_URL_DESC', "");
define('_MI_CONTACT_FORM_ICQ', "Get ICQ");
define('_MI_CONTACT_FORM_ICQ_DESC', "");
define('_MI_CONTACT_FORM_COMPANY', "Get Company");
define('_MI_CONTACT_FORM_COMPANY_DESC', "");
define('_MI_CONTACT_FORM_LOCATION', "Get Location");
define('_MI_CONTACT_FORM_LOCATION_DESC', "");
define('_MI_CONTACT_FORM_PHONE', "Get Phone");
define('_MI_CONTACT_FORM_PHONE_DESC', "");
define('_MI_CONTACT_FORM_ADDRESS', "Get Address");
define('_MI_CONTACT_FORM_ADDRESS_DESC', "");
define('_MI_CONTACT_FORM_DEPT', "Select Departments");
define('_MI_CONTACT_FORM_DEPT_DESC', "");
define('_MI_CONTACT_FORM_CAPTCHA_REGISTERED', "Use Captcha?");
define('_MI_CONTACT_FORM_CAPTCHA_DESC', "Select <em>Yes</em> to use Captcha in the submit form.<br />Default: <em>No</em>");
define('_MI_CONTACT_DEPT', "Departments");
define('_MI_CONTACT_DEPT_DESC', "Departments allow you to define a department/email combination.  Users selecting<br />"
    . "from a defined department will have their contact information sent to the corresponding<br />"
    . "email address you define.<br /><br />"
    . "Define each department/email as follows:<br /><br />"
    . "dept1,email1|dept2,email2|dept3,email3 etc. - each department and email must be separated<br />"
    . "by a comma ',', and each department email combination must be separated by a pipe '|'");
define('_MI_CONTACT_PERPAGE', "Messages per page");
define('_MI_CONTACT_PERPAGE_DESC', "");
define('_MI_CONTACT_TOPINFO', "Header contact form");
define('_MI_CONTACT_TOPINFO_DESC', "Set HTML codes to show in contact page");
define('_MI_CONTACT_HEAD_OPTIONS', "Form Options");
define('_MI_CONTACT_HEAD_ADMIN', "Admin setting");
define('_MI_CONTACT_HEAD_INFO', "Information");
//1.81
define('_MI_CONTACT_FORM_CAPTCHA_ANONYMOUS', "Your reCaptcha website key");
define('_MI_CONTACT_FORM_CAPTCHAKEY_DESC', "More about Google reCaptcha <br> https://www.google.com/recaptcha");

define('_MI_CONTACT_FORM_CAPTCHA_SECRETKEY', "Your reCaptcha secret key");
define('_MI_CONTACT_FORM_CAPTCHAKEY2_DESC', "More about Google reCaptcha <br> https://www.google.com/recaptcha");
define('_MI_CONTACT_MAP', "Embed google maps");
define('_MI_CONTACT_MAP_DESC', "embed google maps iframe <br> change iframe width to '100%'");
//2.1
define('_MI_CONTACT_FORM_SKYPE', "Get Skype");
define('_MI_CONTACT_FORM_SKYPE_DESC', "");

define('_MI_CONTACT_SUBJECT_PREFIX', "Add Department as Prefix?");
define('_MI_CONTACT_SUBJECT_PREFIX_DESC', "If yes, the name of the Department will be used as Prefix for the email Subject");

define('_MI_CONTACT_PREFIX_TEXT', "Email's Subject Prefix");
define('_MI_CONTACT_PREFIX_TEXT_DESC', "This text will be included in the email's Subject Prefix");
define('_MI_CONTACT_PREFIX_TEXT_DEFAULT', "Contact&nbsp;");
