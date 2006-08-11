<?php

//投稿権限が無い場合
if(!$gperm->group_perm(1)){
	die(_NOPERM);
	exit();
}

// トピックがない場合
$BTopic = new BulletinTopic();
if( !$BTopic->topicExists() ){
	die(_MD_NO_TOPICS);
	exit;
}

// 
$op = isset($_POST['op']) ? trim($_POST['op']) : 'form';
$op = isset($_GET['op']) && $_GET['op'] == 'delete' ? 'delete' : $op;

// error log
$errors = array();

// チケットのチェック
require_once "$mytrustdirpath/include/gtickets.php";
if ( !empty($_POST['preview']) ) {
	if ( ! $xoopsGTicket->check() ) {
		$errors['ticket'] = 'Ticket Error';
		$op = 'form';
	} else {
		$op = 'preview';
	}
}elseif( !empty($_POST['post']) ) {
	if ( ! $xoopsGTicket->check() ) {
		$errors['ticket'] = 'Ticket Error';
		$op = 'form';
	} else {
		$op = 'post';
	}
}

$storyid = isset( $_GET['storyid'] ) ? intval($_GET['storyid']) : 0 ;
$storyid = isset( $_POST['storyid'] ) ? intval($_POST['storyid']) : $storyid ;
$return = isset( $_GET['return'] ) ? intval($_GET['return']) : 0 ;
$return = isset( $_POST['return'] ) ? intval($_POST['return']) : $return ;

$story = new Bulletin( $storyid );

// 編集権限が無い場合
if( $storyid > 0 && !$isadmin ){
	die(_NOPERM);
	exit();
}

// トピックIDが指定されている場合
if( isset( $_GET['topicid'] ) ) $story->setVar('topicid', $_GET['topicid']);

// ホワイトリストによるサニタイズ
$str_arr = array('title','text');
$int_arr = array('topicid','type','ihome','topicimg','published','expired','approve');
$bai_arr = array('html','smiley','br','xcode','autodate','autoexpdate','notifypub','block');
foreach( $str_arr as $k ){
	if( isset($_POST[$k]) ) $story->setVar($k, $_POST[$k]);
}
foreach( $int_arr as $k ){
	if( isset($_POST[$k]) ) $story->setVar($k, $_POST[$k]);
}
foreach( $bai_arr as $k ){
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$_POST[$k] = isset( $_POST[$k] ) ? 1 : 0 ;
		$story->setVar($k, $_POST[$k]);
	}
}

// relation
if( $gperm->group_perm(7) && $bulletin_use_relations ){
	if( isset($_POST['storyidRH']) && isset($_POST['dirnameR']) && is_array($_POST['storyidRH']) && is_array($_POST['dirnameR']) ){
		foreach( $_POST['storyidRH'] as $k => $v ){
			$relations[$k]['dirname'] = $_POST['dirnameR'][$k];
			$relations[$k]['linkedid'] = intval($v);
		}
	}elseif( $storyid > 0 && is_array($relation_arr = $story->relation->getRelations($storyid)) && $op == 'form' ){
		$relations = $relation_arr;
	}else{
		$relations = array();
	}
}

if( empty( $storyid ) ){
	// 権限がない場合HTMLをOFF
	if( !$gperm->group_perm(4) ){
		$story->setVar('html', 0);
		$story->setVar('br', 1);
	}
	if( !$gperm->group_perm(2) ){
		$story->setVar('approve', 0);
	}
}

if( $op == 'post' ){

	$time = time();

	$auto['year']  = isset( $_POST['auto']['year'] )  ? intval( $_POST['auto']['year'] )  : formatTimestamp($time, 'Y');
	$auto['month'] = isset( $_POST['auto']['month'] ) ? intval( $_POST['auto']['month'] ) : formatTimestamp($time, 'n');
	$auto['day']   = isset( $_POST['auto']['day'] )   ? intval( $_POST['auto']['day'] )   : formatTimestamp($time, 'd');
	$auto['hour']  = isset( $_POST['auto']['hour'] )  ? intval( $_POST['auto']['hour'] )  : formatTimestamp($time, 'H');
	$auto['min']   = isset( $_POST['auto']['min'] )   ? intval( $_POST['auto']['min'] )   : formatTimestamp($time, 'i');
	$auto['sec']   = isset( $_POST['auto']['sec'] )   ? intval( $_POST['auto']['sec'] )   : date('s');
	$autoexp['year']  = isset( $_POST['autoexp']['year'] )  ? intval( $_POST['autoexp']['year'] )  : formatTimestamp($time, 'Y');
	$autoexp['month'] = isset( $_POST['autoexp']['month'] ) ? intval( $_POST['autoexp']['month'] ) : formatTimestamp($time, 'n');
	$autoexp['day']   = isset( $_POST['autoexp']['day'] )   ? intval( $_POST['autoexp']['day'] )   : formatTimestamp($time, 'd');
	$autoexp['hour']  = isset( $_POST['autoexp']['hour'] )  ? intval( $_POST['autoexp']['hour'] )  : formatTimestamp($time, 'H');
	$autoexp['min']   = isset( $_POST['autoexp']['min'] )   ? intval( $_POST['autoexp']['min'] )   : formatTimestamp($time, 'i');
	$autoexp['sec']   = isset( $_POST['autoexp']['sec'] )   ? intval( $_POST['autoexp']['sec'] )   : date('s');

	// new post
	if ( empty( $storyid ) ){

		$story->setVar('hostname', xoops_getenv('REMOTE_ADDR'));
		$story->setVar('uid', $my_uid);
		$story->devideHomeTextAndBodyText();

		// 自動承認かどうか
		if( $gperm->group_perm(2) ){
			$story->setVar('type', 1);
		}else{
			$story->setVar('type', 0);
		}

		// 掲載予定日設定のルーチン
		if ( $story->getVar('autodate') == 1 && $gperm->group_perm(3) ){
			$pubdate = mktime( $auto['hour'], $auto['min'], $auto['sec'], $auto['month'], $auto['day'], $auto['year'] );
			$offset  = $xoopsUser->timezone() - $xoopsConfig['server_TZ'];
			$pubdate = $pubdate - ( $offset * 3600 );
			$story->setVar('published', $pubdate);
		}else{
			$story->setVar('published', time());
		}
		// 掲載終了日設定のルーティン
		if ( $story->getVar('autoexpdate') == 1 && $gperm->group_perm(3) ){
			$expdate = mktime( $autoexp['hour'], $autoexp['min'], $autoexp['sec'], $autoexp['month'], $autoexp['day'], $autoexp['year'] );
			$offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
			$expdate = $expdate - ( $offset * 3600 );
			$story->setVar('expired', $expdate);
		}else{
			$story->setVar('expired', 0);
		}

		$is_new = true;

	// edited post
	}else{

		$story->devideHomeTextAndBodyText();

		// approve this article
		$approved = 0;
		if ( $story->getVar('approve') == 1 ){
			if( $story->getVar('type') == 0) $approved = 1;
			$story->setVar('type', 1);
		}else{
			$story->setVar('type', 0);
		}

		// 掲載予定日設定のルーチン
		if ( $story->getVar('autodate') == 1 ){
			$pubdate = mktime( $auto['hour'], $auto['min'], $auto['sec'], $auto['month'], $auto['day'], $auto['year'] );
			$offset = $xoopsUser -> timezone();
			$offset = $offset - $xoopsConfig['server_TZ'];
			$pubdate = $pubdate - ( $offset * 3600 );
			$story->setVar('published', $pubdate);
		} else {
			$story->setVar('published', $time);
		}

		// 掲載終了日設定のルーティン
		if ( $story->getVar('autoexpdate') == 1 ){
			$expdate = mktime( $autoexp['hour'], $autoexp['min'], $autoexp['sec'], $autoexp['month'], $autoexp['day'], $autoexp['year'] );
			if ( !empty( $autoexpdate ) ) $offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
			$expdate = $expdate - ( $offset * 3600 );
			$story->setVar('expired', $expdate);
		} else {
			$story->setVar('expired', 0);
		}

		$is_new = false;

	}
	
	//DB挿入時にエラーが発生したら
	if(!$story->store()) {
		die(_MD_THANKS_BUT_ERROR);
	}

	// relation
	if( $gperm->group_perm(7) && $bulletin_use_relations ){
		$story->relation->storyid = $story->getVar('storyid');
		$story->relation->cleanup();
		$story->relation->store($relations);
	}

	if( $is_new ){

		// イベント通知処理
		$notification_handler =& xoops_gethandler('notification');
		$tags = array();
		$tags['STORY_NAME'] = $myts->stripSlashesGPC($story->getVar('title', 'n'));
		$tags['STORY_URL']  = $mydirurl.'/index.php?page=article&storyid=' . $story->getVar('storyid');
		if($gperm->group_perm(2)){
			$notification_handler->triggerEvent('global', 0, 'new_story', $tags);
		} else {
			// admin only
			$tags['WAITINGSTORIES_URL'] = $mydirurl.'/index.php?mode=admin&op=newarticle';
			$notification_handler->triggerEvent('global', 0, 'story_submit', $tags, $gperm->getAdminUsers());
		}

		// 承認したときに通知を受け取る
		if ($story->getVar('notifypub') == 1 && !$gperm->group_perm(2)) {
			require_once XOOPS_ROOT_PATH.'/include/notification_constants.php';
			$notification_handler->subscribe('story', $story->getVar('storyid'), 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
		}

		//投稿数加算処理
		if ($gperm->group_perm(2) && is_object($xoopsUser) && $bulletin_plus_posts == 1) {
			$xoopsUser->incrementPost();
		}

		// 自動承認のときはメッセージを変える
		if($gperm->group_perm(2)){
			redirect_header($mydirurl.'/index.php', 2, _MD_THANKS_AUTOAPPROVE);
			exit;
		}
		redirect_header($mydirurl.'/index.php', 3, _MD_THANKS);
		exit;

	}else{

		// イベント通知処理
		$notification_handler =& xoops_gethandler('notification');
		$tags = array();
		$tags['STORY_NAME'] = $myts->stripSlashesGPC($story->getVar('title', 'n'));
		$tags['STORY_URL']  = $mydirurl.'/index.php?page=article&storyid=' . $story->getVar('storyid');
		// 承認の通知
		if ( $approved == 1 ){
			$notification_handler->triggerEvent( 'story', $story->getVar('storyid'), 'approve', $tags );
			$notification_handler->triggerEvent('global', 0, 'new_story', $tags);
		}

		if ( $return == 1 || $story->getVar('published') > time() ){
			redirect_header($mydirurl.'/index.php?mode=admin&op=list', 3, _MD_DBPUDATED);
		}else{
			redirect_header($mydirurl.'/index.php?page=article&storyid='.$story->getVar('storyid'), 3, _MD_DBPUDATED);
		}
		exit;

	}

}

if( $op == 'preview' ){

	require_once XOOPS_ROOT_PATH.'/header.php';

	$p_title    = $myts->makeTboxData4Preview($story->getVar('title', 'n'), 0, 0);
	$p_hometext = str_replace('[pagebreak]', '<br style="page-break-after:always;" />', $myts->previewTarea($story->getVar('text', 'n'), $story->getVar('html'), $story->getVar('smiley'), $story->getVar('xcode'), 1, $story->getVar('br')));
	themecenterposts($p_title, $p_hometext);
	echo '<br />';
	
	$op = 'form';
}

if( $op == 'form' ){

	// for edit
	if( $storyid  && $story->getVar('text', 'n') == '' ){
		$story->unifyHomeTextAndBodyText();
	}

	// 掲載日時
	if( isset($_POST['auto']) && is_array($_POST['auto']) ){
		$auto = mktime( $_POST['auto']['hour'], $_POST['auto']['min'], @$_POST['auto']['sec'], $_POST['auto']['month'], $_POST['auto']['day'], $_POST['auto']['year'] );
	} elseif ( $story->getVar('published') > 0 ) {
		$auto = $story->getVar('published');
		$story->setVar('autodate', 1);
	} else {
		$auto = time();
	}

	// 掲載終了日時
	if( isset($_POST['auto']) && is_array($_POST['autoexp']) ){
		$autoexp = mktime( $_POST['autoexp']['hour'], $_POST['autoexp']['min'], @$_POST['autoexp']['sec'], $_POST['autoexp']['month'], $_POST['autoexp']['day'], $_POST['autoexp']['year'] );
	} elseif ( $story->getVar('expired') > 0 ) {
		$autoexp = $story->getVar('expired');
		$story->setVar('autoexpdate', 1);
	} else {
		$autoexp = time();
	}

//	$xoopsOption['template_main'] = "{$mydirname}_submit.html";

	require_once XOOPS_ROOT_PATH.'/header.php';
	if( !empty($errors) ) xoops_error($errors);
	require $mytrustdirpath.'/include/storyform.inc.php';
	require_once XOOPS_ROOT_PATH.'/footer.php';
}

if( $op == 'delete' ){

	if(!$isadmin){
		die(_NOPERM);
		exit();
	}
	$storyid = isset( $_GET['storyid'] ) ? intval( $_GET['storyid'] ) : 0 ;
	
	if ( !empty( $_POST['ok'] ) ){

		//check ticket
		if ( ! $xoopsGTicket->check() ) {
			die('Ticket Error');
			exit();
		}

		$storyid = isset( $_POST['storyid'] ) ? intval( $_POST['storyid'] ) : 0 ;

		if ( empty($storyid) ){
			die( _MD_EMPTYNODELETE );
			exit();
		}
		$story = new Bulletin( $storyid );
		if (!$story){
			die( _MD_EMPTYNODELETE );
			exit();
		}
		// 関連記事削除
		$story->relation->queryUnlinkById($storyid);
		$story->relation->queryDelete(1);
		$story -> delete();
		xoops_comment_delete( $xoopsModule->getVar('mid'), $storyid );
		xoops_notification_deletebyitem( $xoopsModule->getVar('mid'), 'story', $storyid );
		if( $return == 1){
			redirect_header( $mydirurl.'/index.php?mode=admin&op=list', 1, _MD_DBPUDATED );
		}else{
			redirect_header( $mydirurl.'/index.php', 1, _MD_DBPUDATED );
		}
		exit();
	}else{
		require_once XOOPS_ROOT_PATH.'/header.php';
		xoops_confirm( array( 'op' => 'delete', 'storyid' => $storyid, 'ok' => 1, 'return' => $return, 'XOOPS_G_TICKET'=>$xoopsGTicket->issue( __LINE__ ) ), 'index.php?page=submit', _MD_RUSUREDEL );
		require_once XOOPS_ROOT_PATH.'/footer.php';
	}
}
?>