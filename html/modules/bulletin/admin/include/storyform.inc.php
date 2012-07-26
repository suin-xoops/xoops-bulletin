<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

require_once XOOPS_ROOT_PATH. "/include/xoopscodes.php";
require_once XOOPS_ROOT_PATH. "/class/xoopsformloader.php";
require_once MODULE_ROOT_PATH."/class/formselecttime.php";



// �ȥԥå��Υ��쥯�ȥܥå�������

if(isset($topicid)){
	$topicselbox = Bulletin::makeTopicSelBox(0, $topicid, "topicid");
}else{
	$topicselbox = Bulletin::makeTopicSelBox(0, 0, "topicid");
}

$form = new XoopsThemeForm(($isedit) ? _AM_EDIT_ARTICLE : _MI_BULLETIN_ADMENU3, "coolsus", xoops_getenv('PHP_SELF'));

// �����å�ȯ��
$xoops_token       = new XoopsFormToken(XoopsMultiTokenHandler::quickCreate('news_admin_submit'));

$title_text        = new XoopsFormText(_AM_TITLE, 'title', 70, 80, $title);
$topic_select      = new XoopsFormLabel(_AM_TOPIC, $topicselbox);
$topicalign_select = new XoopsFormSelect(_AM_TOPIC_IMAGE, 'topicimg', $topicimg);
$topicalign_select->addOptionArray(array('1' => _AM_TOPIC_RIGHT, '2' => _AM_TOPIC_LEFT, '0' => _AM_TOPIC_DISABLE));
$ihome_yesno       = new XoopsFormRadioYN(_AM_PUBINHOME, 'ihome', $ihome);
$hometext_area     = new XoopsFormDhtmlTextArea(_AM_INTROTEXT, 'hometext', $hometext, 20, 15);

$bodytext_tray     = new XoopsFormElementTray(_AM_EXTEXT, '<br />');
	$bodytext_tray->addElement(new XoopsFormDhtmlTextArea('', 'bodytext', $bodytext, 20, 15));
	$bodytext_tray->addElement(new XoopsFormLabel('', '<p>'._MULTIPAGE.'</p>'));
	
$option_tray       = new XoopsFormElementTray(_AM_OPTIONSETTINGS, '<br />');
	$smiley_checkbox = new XoopsFormCheckBox('', 'smiley', $smiley);
	$smiley_checkbox->addOption(1, _AM_USE_SAMILEY);
	$html_checkbox = new XoopsFormCheckBox('', 'html', $html);
	$html_checkbox->addOption(1, _AM_USE_HTML);
	$br_checkbox = new XoopsFormCheckBox('', 'br', $br);
	$br_checkbox->addOption(1, _AM_USE_BR);
	$xcode_checkbox = new XoopsFormCheckBox('', 'xcode', $xcode);
	$xcode_checkbox->addOption(1, _AM_USE_XCODE);
	$autodate_checkbox = new XoopsFormCheckBox('', 'autodate', $autodate);
	
	// �Խ��⡼�� �� �Ǻ����� �� ���߻���
	if(!empty($isedit) && $published >$time){
	
		$desc  = '&nbsp;&nbsp;&nbsp;&nbsp;( '.formatTimestamp($published, _AM_NOWSETTIME).'&nbsp;/&nbsp;';
		$desc .= formatTimestamp($time, _AM_CURRENTTIME).' )';
		$autodate_checkbox->addOption(1, _AM_CHANGEDATETIME);
	
	}else{
	
		$desc  = '&nbsp;&nbsp;&nbsp;&nbsp;( '.formatTimestamp($time, _AM_CURRENTTIME).' )';
		$autodate_checkbox->addOption(1, _AM_SETDATETIME);
	
	}
	
	$autodate_select = new XoopsFormSelectTime('&nbsp;&nbsp;&nbsp;', 'auto', $auto, _AM_DATE_FORMAT);
	$autodate_label = new XoopsFormLabel('', $desc);
	$autoexpdate_checkbox = new XoopsFormCheckBox('', 'autoexpdate', $autoexpdate);
	
	// �Խ��⡼�� �� �Ǻܽ�λ��0
	if(!empty($isedit) && $expired > 0){
	
		$desc  = '&nbsp;&nbsp;&nbsp;&nbsp;( '.formatTimestamp($expired, _AM_NOWSETTIME).'&nbsp;/&nbsp;';
		$desc .= formatTimestamp($time, _AM_CURRENTTIME).' )';
		$autoexpdate_checkbox->addOption(1, _AM_CHANGEEXPDATETIME);
		
	}else{
	
		$desc = '&nbsp;&nbsp;&nbsp;( '.formatTimestamp($time, _AM_CURRENTTIME).' )';
		$autoexpdate_checkbox->addOption(1, _AM_SETEXPDATETIME);
	
	}
	
	$autoexpdate_select = new XoopsFormSelectTime('&nbsp;&nbsp;&nbsp;', 'autoexp', $autoexp, _AM_DATE_FORMAT);
	$autoexpdate_label = new XoopsFormLabel('', $desc);

	// �Խ��⡼�� �� �Ǻ����������ꤵ��Ƥ��� �� �桼����������
	if( !empty($isedit) && empty($published) && $type == 1 ){
	
		$approve_checkbox = new XoopsFormCheckBox('', 'approve', $approve);
		$approve_checkbox->addOption(1, '<strong>'._AM_APPROVE.'</strong>');
	
	} else {
	
		if( !empty($isedit) ){
		
			$approve_checkbox = new XoopsFormCheckBox('', 'movetotop', $movetotop);
			
			if($published >$time){
				$approve_checkbox->addOption(1, '<strong>'._AM_POST_NOW.'</strong>');
			}else{
				$approve_checkbox->addOption(1, '<strong>'._AM_MOVETOTOP.'</strong>');
			}
		}
		$form->addElement(new XoopsFormHidden('approve', 1));
	
	}

$option_tray->addElement($smiley_checkbox);
$option_tray->addElement($html_checkbox);
$option_tray->addElement($br_checkbox);
$option_tray->addElement($xcode_checkbox);
$option_tray->addElement($autodate_checkbox);
$option_tray->addElement($autodate_select);
$option_tray->addElement($autodate_label);
$option_tray->addElement($autoexpdate_checkbox);
$option_tray->addElement($autoexpdate_select);
$option_tray->addElement($autoexpdate_label);
if(isset($approve_checkbox) && is_object($approve_checkbox)){
	$option_tray->addElement($approve_checkbox);
}
$button_tray = new XoopsFormElementTray('', '');
$op_select   = new XoopsFormSelect('', 'op', $op);
$op_select->addOptionArray(array('form' => _AM_PREVIEW, 'save' => _AM_SAVE ));
$submit_button = new XoopsFormButton('', 'submit', _AM_GO, 'submit');
$button_tray->addElement($op_select);
$button_tray->addElement($submit_button);

$type_hidden = new XoopsFormHidden('type', $type);
$fct_hidden  = new XoopsFormHidden('fct', 'articles');
$storyid_hidden = new XoopsFormHidden('storyid', $storyid);
$preview_hidden = new XoopsFormHidden('preview', 1);

$form->addElement($xoops_token);
$form->addElement($title_text, true);
$form->addElement($topic_select);
$form->addElement($topicalign_select);
$form->addElement($ihome_yesno);
$form->addElement($hometext_area);
$form->addElement($bodytext_tray);
$form->addElement($option_tray);
$form->addElement($button_tray);
$form->addElement($type_hidden);
$form->addElement($fct_hidden);
$form->addElement($storyid_hidden);
$form->addElement($preview_hidden);
$form = $form->render();
?>