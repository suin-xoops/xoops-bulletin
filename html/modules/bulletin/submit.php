<?php

require 'header.php';

//権限クラス
$gperm = new BulletinGP;

//投稿権限が無い場合
if(!$gperm->group_perm(1)){
	redirect_header($myurl.'/index.php', 0, _NOPERM);
	exit();
}

// オペレーション
$op = isset($_POST['op']) ? trim($_POST['op']) : 'form';

// チケットのチェック
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

// トピックがない場合
if( $op == 'form' ) {
	$BTopic = new BulletinTopic();
	if( !$BTopic->topicExists() ){
		redirect_header($myurl.'/index.php', 3, _MD_NO_TOPICS);
		exit;
	}
}

// $_POSTの値を取得
$topic_id  = isset($_POST['topic_id'])  ? intval($_POST['topic_id'])  : 0 ;
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
	
	// 権限がない場合HTMLをOFF
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
	
	// 権限がない場合HTMLをOFF
	if( !$gperm->group_perm(4) ){
		$html = 0;
		$br   = 1;
	}
	
	// uid の確定
	$uid  = 0;
	if ( $xoopsUser ) {
		$uid = $xoopsUser->getVar('uid');
	}
	
	// 値をセット
	$story = new Bulletin();
	$story->setVar('title', $title);
	$story->setVar('hometext', $hometext);
	$story->setVar('uid', $uid);
	$story->setVar('topicid', $topic_id);
	$story->setVar('hostname', xoops_getenv('REMOTE_ADDR'));
	$story->setVar('html', $html);
	$story->setVar('br', $br);
	$story->setVar('smiley', $smiley);
	$story->setVar('xcode', $xcode);
	$story->setVar('notifypub', $notifypub);
	$story->setVar('type', 1);
	$story->setVar('topicimg', 1);
	
	//自動承認の権限が与えられているか
	if($gperm->group_perm(2)){
		$approve = 1;
		$story->setVar('published', time());
		$story->setVar('expired', 0);
		// 投稿数加算
		if (is_object($xoopsUser) && $bulletin_plus_posts == 1) {
			$xoopsUser->incrementPost();
		}
	}
	
	//DB挿入時にエラーが発生したら
	if(!$story->store()) {
		redirect_header($myurl.'/index.php',120,_MD_THANKS_BUT_ERROR);
		exit();
	}
	
	// イベント実行
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
	
	// メールで承認を通知する場合
	if ($notifypub) {
		require_once XOOPS_ROOT_PATH.'/include/notification_constants.php';
		$notification_handler->subscribe('story', $story->getVar('storyid'), 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
	}
	
	// 自動承認のときはメッセージを変える
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