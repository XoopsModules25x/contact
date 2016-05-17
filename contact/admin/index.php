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
 * Contact us module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 3.0 or later
 * @package        contacts
 * @since          2.22
 * @min_xoops      2.5.7
 * @author         Txmod Xoops - Email:<info@txmodxoops.org> - Website:<http://txmodxoops.org>
 * @version        $Id: 2.3 index.php 14020 Tue 2016-05-17 18:46:48Z Kazumi Ono (Onokazu), modified by Trabis, rewritten by Voltan, modified by Bleekk, Goffy, New GUI & version by Timgno $
 */
include __DIR__ . '/header.php';
// Count elements
$countMessages = $contactsHandler->getCount();
// Template Index
$templateMain = 'contact_admin_index.tpl';
// InfoBox Statistics
$adminMenu->addInfoBox(_AM_CONTACT_INDEX_ADMENU1);
// Info elements
$adminMenu->addInfoBoxLine(_AM_CONTACT_INDEX_ADMENU1, '<label>'._AM_CONTACT_INDEX_TOTAL.'</label>', $countMessages);
// Render Index
$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('index.php'));
$GLOBALS['xoopsTpl']->assign('index', $adminMenu->renderIndex());
include __DIR__ . '/footer.php';
