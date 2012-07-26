<?php

require '../../../include/cp_header.php';

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
$myurl = XOOPS_URL.'/modules/'.$mydirname ;
define('MODULE_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/'.$mydirname);
define('MODULE_URL', XOOPS_URL.'/modules/'.$mydirname);

if( ! isset( $module ) || ! is_object( $module ) ) $module = $xoopsModule ;
elseif( ! is_object( $xoopsModule ) ) die( '$xoopsModule is not set' )  ;

// 言語ファイル読み込み
if ( file_exists( MODULE_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/modinfo.php') ) {
	require_once MODULE_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/modinfo.php';
} else {
	require_once MODULE_ROOT_PATH.'/language/english/modinfo.php';
}

require_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
require_once XOOPS_ROOT_PATH.'/class/template.php';
require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
require_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
require_once MODULE_ROOT_PATH.'/class/bulletin.php';
require_once MODULE_ROOT_PATH.'/class/bulletinTopic.php';
require_once MODULE_ROOT_PATH.'/admin/menu.php';

// サニタイザー
$myts =& MyTextSanitizer::getInstance();

// テンプレート
$tpl = new XoopsTpl();

// オペレーションを決める
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'default';

// チケットの確認
if ($op == 'preview' || $op == 'save') {
	if (!XoopsMultiTokenHandler::quickValidate('news_admin_submit')) {
		$op = 'newarticle';
	}
}

// トピックがひとつもない
if( $op == 'form' ) {
	$BTopic = new BulletinTopic();
	if( !$BTopic->topicExists() ){
		redirect_header($myurl.'/admin/index.php?op=topicsmanager', 3, _AM_NO_TOPICS);
		exit;
	}
}

switch ( $op ){

case 'default':
default:

	xoops_cp_header();
	$template = 'bulletin_default.html';
	
	foreach( $adminmenu as $i => $v ) $adminmenu[$i]['link'] = $myurl.'/'.$adminmenu[$i]['link'];
	
	$asssigns = array(
		'module_id' => $module->getvar('mid'),
		'items' => $adminmenu
	);

	break;

case 'list':

	xoops_cp_header();
	$template = 'bulletin_list.html';

	$asssigns = array(
		'submissions' => newSubmissions('newSubmissions'),
		'autostories' => newSubmissions('autoStories'),
		'published' => newSubmissions('Published', 10),
		'expired' => newSubmissions('Expired')
	);
	
	break;
	
case 'listall':
	xoops_cp_header();
	$template = 'bulletin_listall.html';

	$limit = isset( $_GET['limit'] ) ? intval( $_GET['limit'] ) : 20 ;
	$start = isset( $_GET['start'] ) ? intval( $_GET['start'] ) : 0 ;
	$statu = isset( $_GET['statu'] ) ? trim( $_GET['statu'] )   : 'Published' ;
	
	switch( $statu ){
	case 'newsubmission':
	
		$total = Bulletin::countSubmitted();
		$story_list = newSubmissions('newSubmissions', $limit, $start);
		$table_title = _AM_WAITING_ARTICLES;
		$mode = 'newsubmission';
		break;
	
	case 'autostory':
	
		$total = Bulletin::countAutoStory();
		$story_list = newSubmissions('autoStories', $limit, $start);
		$table_title = _AM_AUTOARTICLES;
		$mode = 'autostory';
		break;
		
	case 'expstory':
	
		$total = Bulletin::countExpired();
		$story_list = newSubmissions('Expired', $limit, $start);
		$table_title = _AM_EXPARTS;
		$mode = '';
		break;
	
	default:
	
		$total = Bulletin::countPublished();
		$story_list = newSubmissions('Published', $limit, $start);
		$table_title = _AM_PUB_ARTICLES;
		$mode = '';
		break;
		
	}

	$navi = '';
	if ( $total > $limit ) {
		$pagenav = new XoopsPageNav($total, $limit, $start, 'start', 'op=listall&amp;statu='.$statu);
		$navi = $pagenav->renderNav();
	}
	
	$asssigns = array(
		'table_title' => $table_title,
		'stories' => $story_list,
		'mode' => $mode,
		'navi' => $navi
	);
	
    break;
		
case 'form':
	xoops_cp_header();
	$template = 'bulletin_form.html';

	$storyid = isset( $_REQUEST['storyid'] ) ? intval( $_REQUEST['storyid'] ) : 0 ;
	$isedit  = !empty($storyid) ? 1 : 0 ;
	$time    = time();

	$story = new Bulletin( $storyid );

	// ホワイトリストによるサニタイズ
	$str_arr = array('title','hometext','bodytext');
	$int_arr = array('topicid','type','ihome','topicimg','published','expired');
	$bai_arr = array('html','smiley','br','xcode');
	$etc_arr = array('autodate','autoexpdate','approve','movetotop');

	foreach( $str_arr as $k ){
		if( isset($_POST[$k]) ) $story->setVar($k, $_POST[$k]);
		$$k = $story->getVar($k, 'f');
	}
	foreach( $int_arr as $k ){
		if( isset($_POST[$k]) ) $story->setVar($k, $_POST[$k]);
		$$k = $story->getVar($k);
	}
	foreach( $bai_arr as $k ){
		if( isset($_POST[$k]) ){
			$story->setVar($k, 1);
		}elseif( isset($_POST['preview']) ){
			$story->setVar($k, 0);
		}
		$$k = $story->getVar($k);
	}
	foreach( $etc_arr as $k ){
		$$k = ( isset($_POST[$k]) ) ? 1 : 0 ;
	}

	// 掲載日時
	if ( !empty($published) ) {
		$auto = $published;
	} elseif( isset($_POST['auto']) && is_array($_POST['auto']) ){
		$auto = gmmktime( $_POST['auto']['hour'], $_POST['auto']['min'], 0, $_POST['auto']['month'], $_POST['auto']['day'], $_POST['auto']['year'] );
	} else {
		$auto = time();
	}

	// 掲載終了日時
	if ( !empty($expired) ) {
		$autoexp = $expired;
	} elseif( isset($_POST['auto']) && is_array($_POST['autoexp']) ){
		$autoexp = gmmktime( $_POST['autoexp']['hour'], $_POST['autoexp']['min'], 0, $_POST['autoexp']['month'], $_POST['autoexp']['day'], $_POST['autoexp']['year'] );
	}  else {
		$autoexp = time();
	}

	if( isset($_POST['preview']) ){
		// プレビューのとき
		$title4disp    = $myts->makeTareaData4Preview($_POST['title'], 0, 0, 0);
		$hometext4disp = $myts->previewTarea($_POST['hometext'], $html, $smiley, 1, 1, $br);
		$bodytext4disp = $myts->previewTarea($_POST['bodytext'], $html, $smiley, 1, 1, $br);
		
	}

	require MODULE_ROOT_PATH.'/admin/include/storyform.inc.php';

	$asssigns = array(
		'title' => @$title4disp,
		'hometext' => @$hometext4disp,
		'bodytext' => @$bodytext4disp,
		'preview' => isset($_POST['preview']),
		'form' => $form,
		'page_title' => ($isedit) ? _AM_EDIT_ARTICLE : _MI_BULLETIN_ADMENU3
	);

	break;

case 'save':
	
	// ホワイトリストによるサニタイズ
	$int_arr = array('storyid','topicid','ihome','topicimg','type');
	$bai_arr = array('html','smiley','br','xcode','autodate','autoexpdate','approve','movetotop');

	foreach ($int_arr as $k) $$k = !empty($_POST[$k]) ? intval($_POST[$k]) : 0 ;
	foreach ($bai_arr as $k) $$k = !empty($_POST[$k]) ? 1 : 0 ;

	$auto['year']  = isset( $_POST['auto']['year'] )  ? intval( $_POST['auto']['year'] )  : formatTimestamp($time, 'Y');
	$auto['month'] = isset( $_POST['auto']['month'] ) ? intval( $_POST['auto']['month'] ) : formatTimestamp($time, 'n');
	$auto['day']   = isset( $_POST['auto']['day'] )   ? intval( $_POST['auto']['day'] )   : formatTimestamp($time, 'd');
	$auto['hour']  = isset( $_POST['auto']['hour'] )  ? intval( $_POST['auto']['hour'] )  : formatTimestamp($time, 'H');
	$auto['min']   = isset( $_POST['auto']['min'] )   ? intval( $_POST['auto']['min'] )   : formatTimestamp($time, 'i');

	$autoexp['year']  = isset( $_POST['autoexp']['year'] )  ? intval( $_POST['autoexp']['year'] )  : formatTimestamp($time, 'Y');
	$autoexp['month'] = isset( $_POST['autoexp']['month'] ) ? intval( $_POST['autoexp']['month'] ) : formatTimestamp($time, 'n');
	$autoexp['day']   = isset( $_POST['autoexp']['day'] )   ? intval( $_POST['autoexp']['day'] )   : formatTimestamp($time, 'd');
	$autoexp['hour']  = isset( $_POST['autoexp']['hour'] )  ? intval( $_POST['autoexp']['hour'] )  : formatTimestamp($time, 'H');
	$autoexp['min']   = isset( $_POST['autoexp']['min'] )   ? intval( $_POST['autoexp']['min'] )   : formatTimestamp($time, 'i');
	// サニタイズ終わり

	// 新しい記事
	if ( empty( $storyid ) ){
		$story = new Bulletin();
		$story->setVar('uid', $xoopsUser->uid() );

		// 掲載予定日設定のルーチン
		if ( !empty( $autodate ) && is_array( $_POST['auto'] )){
			$pubdate = mktime( $auto['hour'], $auto['min'], 0, $auto['month'], $auto['day'], $auto['year'] );
			$offset  = $xoopsUser->timezone() - $xoopsConfig['server_TZ'];
			$pubdate = $pubdate - ( $offset * 3600 );
			$story->setVar('published', $pubdate);
		}else{
			$story->setVar('published', time());
		}

		// 掲載終了日設定のルーティン
		if ( !empty( $autoexpdate ) && is_array( $_POST['autoexp'] )){
			$expdate = mktime( $autoexp['hour'], $autoexp['min'], 0, $autoexp['month'], $autoexp['day'], $autoexp['year'] );
			$offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
			$expdate = $expdate - ( $offset * 3600 );
			$story->setVar('expired', $expdate);
		}else{
			$story->setVar('expired', 0);
		}

		$story->setVar('type', 2);
		$story->setVar('hostname', xoops_getenv('REMOTE_ADDR'));
//		$story->setVar('notifypub', $notifypub);
	}else{
	// 編集記事
		$story = new Bulletin( $storyid );

		// 掲載予定日設定のルーチン
		if ( !empty( $autodate ) && is_array( $_POST['auto'] )){
			$pubdate = mktime( $auto['hour'], $auto['min'], 0, $auto['month'], $auto['day'], $auto['year'] );
			$offset = $xoopsUser -> timezone();
			$offset = $offset - $xoopsConfig['server_TZ'];
			$pubdate = $pubdate - ( $offset * 3600 );
			$story->setVar('published', $pubdate);
		} elseif( ( $story->getVar('published') == 0 ) && isset($_POST['approve']) ){
			$story->setVar('published', time());
			$isnew = 1;
		}else{
			if ( isset( $_POST['movetotop'] ) ){
				$story->setVar('published', time());
			}
		}

		// 掲載終了日設定のルーティン
		if ( !empty( $autoexpdate ) && is_array( $_POST['autoexp'] )){
			$expdate = mktime( $autoexp['hour'], $autoexp['min'], 0, $autoexp['month'], $autoexp['day'], $autoexp['year'] );
			if ( !empty( $autoexpdate ) ) $offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
			$expdate = $expdate - ( $offset * 3600 );
			$story->setVar('expired', $expdate);
		}
	}

	$story->setVar('topicid', $topicid);
	$story->setVar('title', $_POST['title']);
	$story->setVar('hometext', $_POST['hometext']);
	$story->setVar('bodytext', $_POST['bodytext']);
	$story->setVar('html', $html);
	$story->setVar('smiley', $smiley);
	$story->setVar('br', $br);
	$story->setVar('xcode', $xcode);
	$story->setVar('ihome', $ihome);
	$story->setVar('topicimg', $topicimg);
	
	// 保存時に問題が生じた場合
	if(!$story->store()){
		redirect_header( 'index.php?op=newarticle', 100, 'error' );
		exit;
	}

	// イベント通知
	$notification_handler = & xoops_gethandler('notification');
	$tags = array();
	$tags['STORY_NAME'] = $story->getVar('title');
	$tags['STORY_URL']  = $myurl.'/article.php?storyid='.$story->getVar('storyid');
	if ( !empty( $isnew ) ){
		$notification_handler->triggerEvent( 'story', $story->getVar('storyid'), 'approve', $tags );
	}
	$notification_handler->triggerEvent( 'global', 0, 'new_story', $tags );

	// 投稿数加算処理
	if ( !empty( $isnew ) && $xoopsModuleConfig['plus_posts'] == 1 ){

		$user = new XoopsUser($story->getVar('uid'));
		$user->incrementPost();

	}

	// リダイレクト
	redirect_header( 'index.php?op=list', 3, _AM_DBUPDATED );
	exit;
	break;

case 'delete':
	$storyid = isset( $_GET['storyid'] ) ? intval( $_GET['storyid'] ) : 0 ;
	
	if ( !empty( $_POST['ok'] ) ){
		
		$storyid = isset( $_POST['storyid'] ) ? intval( $_POST['storyid'] ) : 0 ;
		
		if ( empty( $storyid ) ){
			redirect_header( 'index.php?op=list', 2, _AM_EMPTYNODELETE );
			exit();
		}
		$story = new Bulletin( $storyid );
		$story -> delete();
		xoops_comment_delete( $xoopsModule->getVar('mid'), $storyid );
		xoops_notification_deletebyitem( $xoopsModule->getVar('mid'), 'story', $storyid );
		redirect_header( 'index.php?op=list', 1, _AM_DBUPDATED );
		exit();
	}else{
		xoops_cp_header();
		xoops_confirm( array( 'op' => 'delete', 'storyid' => $storyid, 'ok' => 1 ), 'index.php', _AM_RUSUREDEL );
	}
	break;

//グループによる投稿許可設定画面
case 'permition':
	xoops_cp_header();
	$template = 'bulletin_permition.html';

	$module_id = $xoopsModule->getVar('mid');

	$form = new XoopsGroupPermForm('', $module_id, 'bulletin_permit', '');
	$form->addItem(1, _AM_RIGHT_TO_POST);
	$form->addItem(2, _AM_RIGHT_TO_APPROVE);
//	$form->addItem(3, _AM_RIGHT_TO_CHOSE_DATE);
	$form->addItem(4, _AM_USE_HTML);
//	$form->addItem(5, _AM_RIGHT_XCODE);
//	$form->addItem(6, _AM_RIGHT_SMILEY);
	
	$asssigns = array(
		'form' => $form->render()
	);
	break;

case 'topicsmanager':
	xoops_cp_header();
	$template = 'bulletin_topicsmanager.html';

	$BTopic = new BulletinTopic();
	$topics_array = XoopsLists :: getImgListAsArray( $xoopsModuleConfig['topicon_path'] );
	$images = array();
	foreach($topics_array as $v) $images[]['image'] = htmlspecialchars($v);
	$topics_exists = ( $BTopic->topicExists() ) ? 1 : 0 ;
	ob_start();
	$BTopic->makeTopicSelBox( 1, 0, 'topic_pid' );
	$topicselbox = ob_get_contents();
	ob_end_clean();
	ob_start();
	$BTopic->makeTopicSelBox();
	$topicselbox2 = ob_get_contents();
	ob_end_clean();

	$asssigns = array(
		'images' => $images,
		'topics_exists' => $topics_exists,
		'topicselbox' => $topicselbox,
		'topicselbox2' => $topicselbox2
	);

	break;

case 'modTopic':
	$template = 'bulletin_modtopic.html';

	$BTopic = new BulletinTopic($_GET['topic_id']);
	$topics_array = XoopsLists :: getImgListAsArray( $xoopsModuleConfig['topicon_path'] );
	xoops_cp_header();
	$images = array();

	foreach($topics_array as $v){
		$images[] = array('image' => htmlspecialchars($v), 'option' => $BTopic->topic_imgurl() ? 'selected="selected"' : '');
	}

	ob_start();
	$BTopic->makeTopicSelBox( 1, $BTopic->topic_pid(), 'topic_pid' );
	$topicselbox = ob_get_contents();
	ob_end_clean();

	$asssigns = array(
		'images' => $images,
		'topic_id' => $BTopic->topic_id(),
		'topic_pid' => $BTopic->topic_pid(),
		'topic_title' => $BTopic->topic_title('E'),
		'topic_imgurl' => $BTopic->topic_imgurl(),
		'topic_imgdir' => str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$xoopsModuleConfig['topicon_path']),
		'topicselbox' => $topicselbox
	);
	break;

case 'addTopic':

	$BTopic = new BulletinTopic();
	
	$BTopic->setTopicPid( $_POST['topic_pid'] );
	
	if( empty( $_POST['topic_title'] ) ){
		redirect_header( "index.php?op=topicsmanager", 2, _AM_ERRORTOPICNAME );
	}
	
	$BTopic->setTopicTitle( $_POST['topic_title'] );
	
	if( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" ){
		$BTopic -> setTopicImgurl( $_POST['topic_imgurl'] );
	}
	
	$BTopic->store();
	
	$notification_handler = & xoops_gethandler( 'notification' );
	
	$tags = array();
	$tags['TOPIC_NAME'] = $_POST['topic_title'];
	
	// 新しいトピックが作られた時、イベント通知
	$notification_handler->triggerEvent( 'global', 0, 'new_category', $tags );
		
	redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );

	break;

case 'delTopic':

	if( empty($_POST['ok']) ){
	
		xoops_cp_header();
		$template = 'bulletin_deltopic.html';

		$BTopic = new BulletinTopic( $_GET['topic_id'] );
		
		// すべてのサブトピックを取得
		$topic_arr = $BTopic->getAllChildTopics();

		// 残るトピックを取得
		$remain_topics = $BTopic->getTopicsList();

		array_push( $topic_arr, $BTopic );

		foreach( $topic_arr as $eachtopic ){
			$topics[] = array(
				'title' => $eachtopic->topic_title(),
				'id' => $eachtopic->topic_id()
				);
			unset($remain_topics[$eachtopic->topic_id()]);
		}

		$asssigns = array(
			'topics' => $topics,
			'remain_topics' => $remain_topics,
			'topicid' => intval($_GET['topic_id'])
		);

	}else{
	
		$BTopic = new BulletinTopic( $_POST['topic_id'] );
		
		// すべてのサブトピックを取得
		$topic_arr = $BTopic->getAllChildTopics();

		// 記事を残すトピック
		$move_topics = $_POST['topics'];

		array_push( $topic_arr, $BTopic );
		
		foreach( $topic_arr as $eachtopic ){
		
			if( $move_topics[$eachtopic->topic_id()] == 0 ){
			
				// すべての記事を取得
				$story_arr = Bulletin::getAllByTopic( $eachtopic->topic_id() );
				foreach( $story_arr as $eachstory ){
					if ( false != $eachstory->delete() ){
						//コメントを削除
						xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $eachstory->getVar('storyid') );
						//イベント通知を削除
						xoops_notification_deletebyitem( $xoopsModule->getVar( 'mid' ), 'story', $eachstory->getVar('storyid') );
					}
				}
			
			}else{
			
				// すべての記事を取得
				$story_arr = Bulletin::getAllByTopic( $eachtopic->topic_id() );
				foreach( $story_arr as $eachstory ){
					$eachstory->setVar('topicid', $move_topics[$eachtopic->topic_id()]);
					$eachstory->store();
				}
			}
			
			// トピックを削除
			$eachtopic->delete();
			xoops_notification_deletebyitem( $xoopsModule->getVar( 'mid' ), 'category', $eachtopic->topic_id );
		}
		redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );

	}

	break;

case 'modTopicS':

	$BTopic = new BulletinTopic($_POST['topic_id']);
	if ( $_POST['topic_pid'] == $_POST['topic_id'] )
	{
		echo "ERROR: Cannot select this topic for parent topic!";
		exit();
	}
	$BTopic -> setTopicPid( $_POST['topic_pid'] );
	if ( empty( $_POST['topic_title'] ) )
	{
		redirect_header( "index.php?op=topicsmanager", 2, _AM_ERRORTOPICNAME );
	}
	$BTopic -> setTopicTitle( $_POST['topic_title'] );
	if ( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" )
	{
		$BTopic -> setTopicImgurl( $_POST['topic_imgurl'] );
	}
	$BTopic -> store();
	redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );

	break;
	
case 'convert':
	xoops_cp_header();

	if( empty($_POST['ok']) ){
	
		xoops_confirm( array( 'op' => 'convert', 'ok' => 1 ), 'index.php', _AM_DO_YOU_CONVERT );
		
	}else{

		// トピックのコンバート
		$sql = "SELECT * FROM ".$xoopsDB->prefix('topics')." ORDER BY topic_id";
		$result =$xoopsDB->query($sql);

		while( $topic = $xoopsDB->fetchArray($result)){
		
			$sql = sprintf("INSERT INTO %s (topic_id, topic_pid, topic_imgurl, topic_title) VALUES (%u, %u, %s, %s)", $xoopsDB->prefix(DB_BULLETIN_TOPICS), $topic['topic_id'], $topic['topic_pid'], $xoopsDB->quoteString($topic['topic_imgurl']), $xoopsDB->quoteString($topic['topic_title']));

			if($xoopsDB->query($sql)){
				echo '<br />Topic "'.htmlspecialchars($topic['topic_title']).'" was successfully converted.';
			}else{
				echo '<br /><b>Topic "'.htmlspecialchars($topic['topic_title']).'" Erorr : '.$xoopsDB->error().'</b>';
			}
		
		}
		
		// ニュース記事のコンバート
		$sql = "SELECT * FROM ".$xoopsDB->prefix('stories')." ORDER BY published";
		$result =$xoopsDB->query($sql);

		while( $story = $xoopsDB->fetchArray($result)){

			$html      = ($story['nohtml'] == 0) ? 1 : 0;
			$smiley    = ($story['nosmiley'] == 0) ? 1 : 0;
			$ihome     = ($story['ihome'] == 0) ? 1 : 0;
			$type      = ($story['story_type'] == 'admin') ? 2 : 1;
			if( $story['topicdisplay'] == 0 ) $topicimg = 0;
			if( $story['topicalign'] == 'R' ) $topicimg = 1;
			if( $story['topicalign'] == 'L' ) $topicimg = 2;

			$new_story = new Bulletin();
			$new_story->setVar('uid', $story['uid']);
			$new_story->setVar('title', $story['title']);
			$new_story->setVar('created', $story['created']);
			$new_story->setVar('published', $story['published']);
			$new_story->setVar('expired', $story['expired']);
			$new_story->setVar('hostname', $story['hostname']);
			$new_story->setVar('html', $html);
			$new_story->setVar('br', 1);
			$new_story->setVar('smiley',$smiley);
			$new_story->setVar('xcode', 1);
			$new_story->setVar('hometext', $story['hometext']);
			$new_story->setVar('bodytext', $story['bodytext']);
			$new_story->setVar('counter', $story['counter']);
			$new_story->setVar('topicid', $story['topicid']);
			$new_story->setVar('ihome', $ihome);
			$new_story->setVar('notifypub', $story['notifypub']);
			$new_story->setVar('type', $type);
			$new_story->setVar('topicimg',  $topicimg);
			$new_story->setVar('comments', $story['comments']);
			if($new_story->store()) {
				echo '<br />Story "'.htmlspecialchars($story['title']).'" was successfully converted : '.$new_story->getVar('storyid');
			}else{
				echo '<br /><b>Failed to convert : '.htmlspecialchars($story['title']).'</b>';
			}
		
		}
		
		echo '<br /><a href="'.MODULE_URL.'/admin/">'._BACK.'</a>';
	}

	break;

}

$credit = _AM_CREDIT;
$translater = _AM_TRANSLATER;

$assing_global = array(
	'_MI_BULLETIN_ADMENU1' => _MI_BULLETIN_ADMENU1,
	'_MI_BULLETIN_ADMENU1_D' => _MI_BULLETIN_ADMENU1_D,
	'_MI_BULLETIN_ADMENU7' => _MI_BULLETIN_ADMENU7,
	'_MI_BULLETIN_ADMENU7_D' => _MI_BULLETIN_ADMENU7_D,
	'_MI_BULLETIN_ADMENU2' => _MI_BULLETIN_ADMENU2,
	'_MI_BULLETIN_ADMENU4' => _MI_BULLETIN_ADMENU4,
	'_MI_BULLETIN_ADMENU5' => _MI_BULLETIN_ADMENU5,
	'_AM_WAITING_ARTICLES' => _AM_WAITING_ARTICLES,
	'_AM_DISP_CONTENUE' => _AM_DISP_CONTENUE,
	'_AM_AUTOARTICLES' => _AM_AUTOARTICLES,
	'_AM_PUB_ARTICLES' => _AM_PUB_ARTICLES,
	'_AM_EXPARTS' => _AM_EXPARTS,
	'_AM_EDIT' => _AM_EDIT,
	'_AM_DELETE' => _AM_DELETE,
	'_AM_STORYID' => _AM_STORYID,
	'_AM_TITLE' => _AM_TITLE,
	'_AM_TOPIC' => _AM_TOPIC,
	'_AM_POSTER' => _AM_POSTER,
	'_AM_POSTED' => _AM_POSTED,
	'_AM_ACTION' => _AM_ACTION,
	'_AM_PROGRAMMED' => _AM_PROGRAMMED,
	'_AM_EXPIRED' => _AM_EXPIRED,
	'_AM_PUBLISHED' => _AM_PUBLISHED,
	'_AM_ARTICLE_ADMIN' => _AM_ARTICLE_ADMIN,
	'_AM_ADDMTOPIC' => _AM_ADDMTOPIC,
	'_AM_TOPICNAME' => _AM_TOPICNAME,
	'_AM_MAX40CHAR' => _AM_MAX40CHAR,
	'_AM_PARENTTOPIC' => _AM_PARENTTOPIC,
	'_AM_TOPICIMG' => _AM_TOPICIMG,
	'_AM_ADD' => _AM_ADD,
	'_AM_MODIFYTOPIC' => _AM_MODIFYTOPIC,
	'_AM_MODIFY' => _AM_MODIFY,
	'_AM_IMGNAEXLOC' => sprintf( _AM_IMGNAEXLOC,str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$xoopsModuleConfig['topicon_path']) ),
	'_AM_DEL' => _AM_DEL,
	'_AM_SAVECHANGE' => _AM_SAVECHANGE,
	'_AM_CANCEL' => _AM_CANCEL,
	'_AM_TOPICS_DELETE' => _AM_TOPICS_DELETE,
	'_AM_TOPICID' => _AM_TOPICID,
	'_AM_DESTINATION_OF_STORIES' => _AM_DESTINATION_OF_STORIES,
	'_AM_FOLLOW_TOPICS_IS_DELETED' => _AM_FOLLOW_TOPICS_IS_DELETED,
	'_AM_WAYSYWTDTTAL' => _AM_WAYSYWTDTTAL,
	'_AM_GO' => _AM_GO,
	'_AM_CREDIT' => $myts->previewTarea($credit,0,1,0,0,0),
	'_AM_TRANSLATER' => $myts->previewTarea($translater,0,1,0,0,0),
	'admin_title' => sprintf(_AM_CONFIG, $xoopsModule->name()),
	'xoops_url' => XOOPS_URL,
	'template_path' => MODULE_ROOT_PATH."/admin/templates",
	'myurl' => $myurl
);

$tpl->assign($assing_global);
if(!empty( $asssigns )) $tpl->assign($asssigns);
if(!empty( $template )) $tpl->display("file:".MODULE_ROOT_PATH."/admin/templates/".$template);
xoops_cp_footer();

exit;










function newSubmissions($action, $limit=5, $start=0)
{
	switch($action){
	case 'newSubmissions':
		$articles = Bulletin::getAllSubmitted();
		break;
	case 'autoStories':
		$articles = Bulletin::getAllAutoStory();
		break;
	case 'Published':
		$articles = Bulletin::getAllPublished( $limit, $start, 0, 0 );
		break;
	case 'Expired':
		$articles = Bulletin::getAllExpired( $limit, $start, 0, 0 );
		break;
	}
	
	$ret = array();
	if ( count( $articles ) > 0 ){

		$i = 0;
		foreach( $articles as $article ){
			$ret[$i]['storyid']   = $article->getVar('storyid');
			$ret[$i]['title']     = RENDER_NEWS_TITLE($article);
			$ret[$i]['topic']     = $article->topic_title();
			$ret[$i]['uid']       = $article->getVar('uid');
			$ret[$i]['uname']     = $article->getUname();
			$ret[$i]['created']   = formatTimestamp( $article->getVar('created') );
			$ret[$i]['published'] = formatTimestamp( $article->getVar('published') );
			$ret[$i]['expired']   = ( $article->getVar('expired') > 0 ) ? formatTimestamp( $article->getVar('expired') ) : '---' ;
			$i++;
		}
	}
	return $ret;
}



function RENDER_NEWS_TITLE(&$obj)
{
	global $xoopsModule;
	$ret="";
	if($obj->getVar('published')<time() && $obj->getVar('published') != 0 && ($obj->getVar('expired') == 0 || $obj->getVar('expired') > time() ) ){
	
		if( $obj->getVar('title') == '' ){
			$obj->setVar('title', _AD_NOSUBJECT);
		}
		$ret = @sprintf("<a href='%s'>%s</a>",
			XOOPS_URL."/modules/".$xoopsModule->dirname()."/article.php?storyid=".$obj->getVar('storyid'),
			$obj->getVar('title') );

	}else{

		if( $obj->getVar('title') == '' ){
			$obj->setVar('title', _AD_NOSUBJECT);
		}
		$ret = $obj->getVar('title');
		
	}

	return $ret;
}

?>