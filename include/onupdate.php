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
 * @param \XoopsModule $module
 * @param              $version
 */

use XoopsModules\Contact\{
    Common\Configurator,
    Helper,
    Utility
};
/** @var Helper $helper */
/** @var Utility $utility */
/** @var Configurator $configurator */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof \XoopsUser)
    || !$GLOBALS['xoopsUser']->isAdmin()) {
    exit('Restricted access' . PHP_EOL);
}



/**
 * Prepares system prior to attempting to install module
 * @param \XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_update_contact(\XoopsModule $module)
{
    /** @var Helper $helper */
    /** @var Utility $utility */
    $moduleDirName = \basename(\dirname(__DIR__));
    $helper        = Helper::getInstance();
    $utility       = new Utility();

    $xoopsSuccess = $utility::checkVerXoops($module);
    $phpSuccess   = $utility::checkVerPhp($module);

    return $xoopsSuccess && $phpSuccess;
}

/**
 * Performs tasks required during update of the module
 * @param \XoopsModule $module {@link XoopsModule}
 * @param null         $previousVersion
 *
 * @return bool true if update successful, false if not
 */
function xoops_module_update_contact(\XoopsModule $module, $previousVersion = null)
{
    $moduleDirName      = \basename(\dirname(__DIR__));
    $moduleDirNameUpper = mb_strtoupper($moduleDirName);

    /** @var Helper $helper */
    /** @var Utility $utility */
    /** @var Configurator $configurator */
    $helper       = Helper::getInstance();
    $utility      = new Utility();
    $configurator = new Configurator();

    $xoopsDB = \XoopsDatabaseFactory::getDatabaseConnection();

    if ($previousVersion < 180) {
        $sql = 'CREATE TABLE ' . $xoopsDB->prefix('contact') . ' (
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
        ) ENGINE=MyISAM;';
        $xoopsDB->query($sql);
    }

    if ($previousVersion < 181) {
        // Add contact_platform
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . "` ADD `contact_platform` ENUM('Android','Ios','Web') NOT NULL DEFAULT 'Web'";
        $xoopsDB->query($sql);
        // Add contact_type
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . "` ADD `contact_type` ENUM('Contact','Phone','Mail') NOT NULL DEFAULT 'Contact'";
        $xoopsDB->query($sql);
        // Add index contact_uid
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_uid` ( `contact_uid` )';
        $xoopsDB->query($sql);
        // Add index contact_cid
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_cid` ( `contact_cid` )';
        $xoopsDB->query($sql);
        // Add index contact_create
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_create` ( `contact_create` )';
        $xoopsDB->query($sql);
        // Add index contact_mail
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_mail` ( `contact_mail` )';
        $xoopsDB->query($sql);
        // Add index contact_phone
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_phone` ( `contact_phone` )';
        $xoopsDB->query($sql);
        // Add index contact_platform
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_platform` ( `contact_platform` )';
        $xoopsDB->query($sql);
        // Add index contact_type
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD INDEX `contact_type` ( `contact_type` )';
        $xoopsDB->query($sql);
    }

    if ($previousVersion < 227) {
        $configurator = new Configurator();
        $utility = new Utility();

        //delete old HTML templates
        if (count($configurator->templateFolders) > 0) {
            foreach ($configurator->templateFolders as $folder) {
                $templateFolder = $GLOBALS['xoops']->path('modules/' . $moduleDirName . $folder);
                if (is_dir($templateFolder)) {
                    $templateList = array_diff(scandir($templateFolder, SCANDIR_SORT_NONE), ['..', '.']);
                    foreach ($templateList as $k => $v) {
                        $fileInfo = new \SplFileInfo($templateFolder . $v);
                        if ('html' === $fileInfo->getExtension() && 'index.html' !== $fileInfo->getFilename()) {
                            if (is_file($templateFolder . $v)) {
                                unlink($templateFolder . $v);
                            }
                        }
                    }
                }
            }
        }

        //  ---  DELETE OLD FILES ---------------
        if (count($configurator->oldFiles) > 0) {
            //    foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
            foreach (array_keys($configurator->oldFiles) as $i) {
                $tempFile = $GLOBALS['xoops']->path('modules/' . $moduleDirName . $configurator->oldFiles[$i]);
                if (is_file($tempFile)) {
                    unlink($tempFile);
                }
            }
        }

        //  ---  DELETE OLD FOLDERS ---------------
        xoops_load('XoopsFile');
        if (count($configurator->oldFolders) > 0) {
            //    foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
            foreach (array_keys($configurator->oldFolders) as $i) {
                $tempFolder = $GLOBALS['xoops']->path('modules/' . $moduleDirName . $configurator->oldFolders[$i]);
                /* @var XoopsObjectHandler $folderHandler */
                $folderHandler = XoopsFile::getHandler('folder', $tempFolder);
                $folderHandler->delete($tempFolder);
            }
        }

        //  ---  CREATE FOLDERS ---------------
        if (count($configurator->uploadFolders) > 0) {
            //    foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
            foreach (array_keys($configurator->uploadFolders) as $i) {
                $utility::createFolder($configurator->uploadFolders[$i]);
            }
        }

        //  ---  COPY blank.png FILES ---------------
        if (count($configurator->copyBlankFiles) > 0) {
            $file = dirname(__DIR__) . '/assets/images/blank.png';
            foreach (array_keys($configurator->copyBlankFiles) as $i) {
                $dest = $configurator->copyBlankFiles[$i] . '/blank.png';
                $utility::copyFile($file, $dest);
            }
        }

        //delete .html entries from the tpl table
        $sql = 'DELETE FROM ' . $GLOBALS['xoopsDB']->prefix('tplfile') . " WHERE `tpl_module` = '" . $module->getVar('dirname', 'n') . '\' AND `tpl_file` LIKE \'%.html%\'';
        $GLOBALS['xoopsDB']->queryF($sql);

        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = xoops_getHandler('groupperm');

        return $grouppermHandler->deleteByModule($module->getVar('mid'), 'item_read');
    }

    if ($previousVersion < 227) {
        // Add contact_skype
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('contact') . '` ADD `contact_skype` VARCHAR(255) NULL AFTER `contact_icq`';
        $xoopsDB->query($sql);
    }
}
