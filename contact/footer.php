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
 * Contact module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        events
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Txmod Xoops - Email:<support@txmodxoops.org> - Website:<http://www.txmodxoops.org>
 * @version        $Id: 1.0 footer.php 14010 Thu 2016-04-21 21:20:45Z Timgno $
 */
if(count($xoBreadcrumbs) > 1) {
	$GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
}
// 
$GLOBALS['xoopsTpl']->assign('admin', XOOPS_URL . '/modules/contact/admin/index.php');
// 
include_once XOOPS_ROOT_PATH .'/footer.php';
