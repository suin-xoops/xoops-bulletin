<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

require XOOPS_ROOT_PATH.'/class/xoopsformloader.php';

$form = new XoopsThemeForm(_MD_SUBMITNEWS, 'storyform', xoops_getenv('PHP_SELF'));
$form->addElement(new XoopsFormToken(XoopsMultiTokenHandler::quickCreate('bulletin_submit')));
$form->addElement(new XoopsFormText(_MD_TITLE, 'title', 50, 80, $title), true);
$form->addElement(new XoopsFormLabel(_MD_TOPIC, Bulletin::makeTopicSelBox(0)));
$form->addElement($topic_select);
$form->addElement(new XoopsFormDhtmlTextArea(_MD_THESCOOP, 'hometext', $hometext, $bulletin_post_tray_row, $bulletin_post_tray_col), true);
$option_tray = new XoopsFormElementTray(_OPTIONS,'<br />');

// 通知機能を使うかのチェックボタン
if ($xoopsUser) {
	$notify_checkbox = new XoopsFormCheckBox('', 'notifypub', $notifypub);
	$notify_checkbox->addOption(1, _MD_NOTIFYPUBLISH);
	$option_tray->addElement($notify_checkbox);
}

// HTMLの使用権があるか
if( $gperm->group_perm(4) ){
	$html_checkbox = new XoopsFormCheckBox('', 'html', $html);
	$html_checkbox->addOption(1, _MD_USE_HTML);
	$option_tray->addElement($html_checkbox);
	$br_checkbox = new XoopsFormCheckBox('', 'br', $br);
	$br_checkbox->addOption(1, _MD_USE_BR);
	$option_tray->addElement($br_checkbox);
}

$smiley_checkbox = new XoopsFormCheckBox('', 'smiley', $smiley);
$smiley_checkbox->addOption(1, _MD_USE_SMILEY);
$option_tray->addElement($smiley_checkbox);
$xcode_checkbox = new XoopsFormCheckBox('', 'xcode', $xcode);
$xcode_checkbox->addOption(1, _MD_USE_XCODE);
$option_tray->addElement($xcode_checkbox);
$form->addElement($option_tray);
$button_tray = new XoopsFormElementTray('' ,'');
$button_tray->addElement(new XoopsFormButton('', 'preview', _PREVIEW, 'submit'));
$button_tray->addElement(new XoopsFormButton('', 'post', _MD_POST, 'submit'));
$form->addElement($button_tray);
$form->display();
?>