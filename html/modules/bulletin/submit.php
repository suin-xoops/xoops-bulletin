<?php

require 'header.php';

//���¥��饹
$gperm = new BulletinGP;

//��Ƹ��¤�̵�����
if(!$gperm->group_perm(1)){
	redirect_header($myurl.'/index.php', 0, _NOPERM);
	exit();
}

// ���ڥ졼�����
$op = isset($_POST['op']) ? trim($_POST['op']) : 'form';

// �����åȤΥ����å�
if ( !empty($_POST['preview']) ) {
	if (XoopsMultiTokenHandler::quickValidate('bulletin_submit')) {
		$op = 'preview';
	}else{
		$op = 'form';
	}
}elseif( !empty($_POST['post']) ) {
	if (XoopsMultiTokenHandler::quickValidate('bulletin_submit')) {
		$op = 'post';
	}else {
		$op = 'form';
	}
}

// �ȥԥå����ʤ����
if( $op == 'form' ) {
	$BTopic = new BulletinTopic();
	if( !$BTopic->topicExists() ){
		redirect_header($myurl.'/index.php', 3, _MD_NO_TOPICS);
		exit;
	}
}

// $_POST���ͤ����
$topicid   = isset($_POST['topicid'])   ? intval($_POST['topicid'])   : 0 ;
$title     = isset($_POST['title'])     ?       ($_POST['title'])     : '';
$hometext  = isset($_POST['hometext'])  ?       ($_POST['hometext'])  : '';
$notifypub = isset($_POST['notifypub']) ? 1 : 0 ;
$smiley    = isset($_POST['smiley'])    ? 1 : 0 ;
$xcode     = isset($_POST['xcode'])     ? 1 : 0 ;
$html      = isset($_POST['html'])      ? 1 : 0 ;
$br        = isset($_POST['br'])        ? 1 : 0 ;
switch ($op) {
case "preview":
	require_once XOOPS_ROOT_PATH.'/header.php';
	
	// ���¤��ʤ����HTML��OFF
	if( !$gperm->group_perm(4) ){
		$html = 0;
		$br   = 1;
	}
	
	$p_title    = $myts->makeTboxData4Preview($title, 0, 0);
	$p_hometext = $myts->previewTarea($hometext, $html, $smiley, $xcode, 1, $br);
	$title      = $myts->makeTboxData4PreviewInForm($title);
	$hometext   = $myts->makeTareaData4PreviewInForm($hometext);
	themecenterposts($p_title, $p_hometext);
	echo '<br />';
	require $myroot.'/include/storyform.inc.php';
	require_once XOOPS_ROOT_PATH.'/footer.php';
	break;

case "post":
	
	// ���¤��ʤ����HTML��OFF
	if( !$gperm->group_perm(4) ){
		$html = 0;
		$br   = 1;
	}
	
	// uid �γ���
	$uid  = 0;
	if ( $xoopsUser ) {
		$uid = $xoopsUser->getVar('uid');
	}
	
	// �ͤ򥻥å�
	$story = new Bulletin();
	$story->setVar('title', $title);
	$story->setVar('hometext', $hometext);
	$story->setVar('uid', $uid);
	$story->setVar('topicid', $topicid);
	$story->setVar('hostname', xoops_getenv('REMOTE_ADDR'));
	$story->setVar('html', $html);
	$story->setVar('br', $br);
	$story->setVar('smiley', $smiley);
	$story->setVar('xcode', $xcode);
	$story->setVar('notifypub', $notifypub);
	$story->setVar('type', 1);
	$story->setVar('topicimg', 1);
	
	//��ư��ǧ�θ��¤�Ϳ�����Ƥ��뤫
	if($gperm->group_perm(2)){
		$approve = 1;
		$story->setVar('published', time());
		$story->setVar('expired', 0);
		// ��ƿ��û�
		if (is_object($xoopsUser) && $bulletin_plus_posts == 1) {
			$xoopsUser->incrementPost();
		}
	}
	
	//DB�������˥��顼��ȯ��������
	if(!$story->store()) {
		redirect_header($myurl.'/index.php',120,_MD_THANKS_BUT_ERROR);
		exit();
	}
	
	// ���٥�ȼ¹�
	$notification_handler =& xoops_gethandler('notification');
	$tags = array();
	$tags['STORY_NAME'] = $myts->stripSlashesGPC($title);
	$tags['STORY_URL']  = $myurl.'/article.php?storyid=' . $story->getVar('storyid');
	
	if($gperm->group_perm(2)){
		$notification_handler->triggerEvent('global', 0, 'new_story', $tags);
	} else {
		$tags['WAITINGSTORIES_URL'] = $myurl.'/admin/index.php?op=newarticle';
		$notification_handler->triggerEvent('global', 0, 'story_submit', $tags);
	}
	
	// �᡼��Ǿ�ǧ�����Τ�����
	if ($notifypub) {
		require_once XOOPS_ROOT_PATH.'/include/notification_constants.php';
		$notification_handler->subscribe('story', $story->getVar('storyid'), 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
	}
	
	// ��ư��ǧ�ΤȤ��ϥ�å��������Ѥ���
	if($gperm->group_perm(2)){
		redirect_header($myurl.'/index.php',2,_MD_THANKS_AUTOAPPROVE);
		exit();
	}
	
	redirect_header($myurl.'/index.php',3,_MD_THANKS);
	break;
	
	
case 'form':
default:
	$smiley    = 1;
	$br        = 1;
	$xcode     = 1;
	$notifypub = 1;
	require_once XOOPS_ROOT_PATH.'/header.php';
	require $myroot.'/include/storyform.inc.php';
	require_once XOOPS_ROOT_PATH.'/footer.php';
	break;
}
?>