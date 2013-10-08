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

function xoops_module_update_contact($module, $version)
{
    $xoopsDB = XoopsDatabaseFactory::getDatabaseConnection();

    if ($version < 180) {
        $sql = "CREATE TABLE " . $xoopsDB->prefix('contact') . " (
        contact_id int(10) unsigned NOT NULL auto_increment,
        contact_uid int(10) NOT NULL,
        contact_cid int(10) NOT NULL,
        contact_create int(10) NOT NULL,
        contact_subject varchar(255) NOT NULL,
        contact_name varchar(255) NOT NULL,
        contact_mail varchar(255) NOT NULL,
        contact_url varchar(255) NOT NULL,
        contact_icq varchar(255) NOT NULL,
        contact_company varchar(255) NOT NULL,
        contact_location varchar(255) NOT NULL,
        contact_department varchar(60) NOT NULL,
        contact_ip varchar(20) NOT NULL,
        contact_phone varchar(20) NOT NULL,
        contact_message text NOT NULL,
        contact_address text NOT NULL,
        contact_reply tinyint(1) NOT NULL,
        PRIMARY KEY  (contact_id)
        ) ENGINE=MyISAM;";
        $xoopsDB->query($sql);
    }

    if ($version < 181) {
        // Add contact_platform
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD `contact_platform` ENUM('Android','Ios','Web') NOT NULL DEFAULT 'Web'";
        $xoopsDB->query($sql);
        // Add contact_type
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD `contact_type` ENUM('Contact','Phone','Mail') NOT NULL DEFAULT 'Contact'";
        $xoopsDB->query($sql);
        // Add index contact_uid
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_uid` ( `contact_uid` )";
        $xoopsDB->query($sql);
        // Add index contact_cid
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_cid` ( `contact_cid` )";
        $xoopsDB->query($sql);
        // Add index contact_create
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_create` ( `contact_create` )";
        $xoopsDB->query($sql);
        // Add index contact_mail
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_mail` ( `contact_mail` )";
        $xoopsDB->query($sql);
        // Add index contact_phone
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_phone` ( `contact_phone` )";
        $xoopsDB->query($sql);
        // Add index contact_platform
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_platform` ( `contact_platform` )";
        $xoopsDB->query($sql);
        // Add index contact_type
        $sql = "ALTER TABLE `" . $xoopsDB->prefix('contact') . "` ADD INDEX `contact_type` ( `contact_type` )";
        $xoopsDB->query($sql);
    }
}
