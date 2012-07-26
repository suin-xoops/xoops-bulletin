<?php

define('MODULE_ROOT_PATH', $mydirpath);
define('MODULE_URL', $mydirurl);
$constpref = '_MI_' . strtoupper( $mydirname ) ;

// ����ե������ɤ߹���
if ( file_exists( $mytrustdirpath.'/language/'.$xoopsConfig['language'].'/modinfo.php') ) {
	require_once $mytrustdirpath.'/language/'.$xoopsConfig['language'].'/modinfo.php';
} else {
	require_once $mytrustdirpath.'/language/english/modinfo.php';
}

require_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
require_once XOOPS_ROOT_PATH.'/class/template.php';
require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
require_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
require_once $mytrustdirpath.'/class/bulletin.php';
require_once $mytrustdirpath.'/class/bulletinTopic.php';

// ���˥�������
$myts =& MyTextSanitizer::getInstance();

// �ƥ�ץ졼��
$tpl = new XoopsTpl();

// ���ڥ졼���������
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'default';

// �����åȤγ�ǧ
if ($op == 'preview' || $op == 'save') {
	if (!XoopsMultiTokenHandler::quickValidate('news_admin_submit')) {
		$op = 'newarticle';
	}
}

// �ȥԥå����ҤȤĤ�ʤ�
if( $op == 'form' ) {
	$BTopic = new BulletinTopic();
	if( !$BTopic->topicExists() ){
		redirect_header('index.php?mode=admin&op=topicsmanager', 3, _AM_NO_TOPICS);
		exit;
	}
}

switch ( $op ){

case 'default':
case 'list':
default:

	xoops_cp_header();
	include dirname(__FILE__).'/mymenu.php' ;
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
	include dirname(__FILE__).'/mymenu.php' ;
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
		$pagenav = new XoopsPageNav($total, $limit, $start, 'start', 'mode=admin&amp;op=listall&amp;statu='.$statu);
		$navi = $pagenav->renderNav();
	}
	
	$asssigns = array(
		'table_title' => $table_title,
		'stories' => $story_list,
		'mode' => $mode,
		'navi' => $navi
	);
	
    break;

//���롼�פˤ����Ƶ����������
case 'permition':
	xoops_cp_header();
	include dirname(__FILE__).'/mymenu.php' ;
	$template = 'bulletin_permition.html';

	$module_id = $xoopsModule->getVar('mid');

	$form = new XoopsGroupPermForm('', $module_id, 'bulletin_permit', '');
	$form->addItem(1, _AM_RIGHT_TO_POST);
	$form->addItem(2, _AM_RIGHT_TO_APPROVE);
	$form->addItem(3, _AM_RIGHT_TO_CHOSE_DATE);
	$form->addItem(4, _AM_RIGHT_HTML);
//	$form->addItem(5, _AM_RIGHT_XCODE);
//	$form->addItem(6, _AM_RIGHT_SMILEY);
	$form->addItem(7, _AM_RIGHT_RELATION);
	
	$asssigns = array(
		'form' => $form->render()
	);
	break;

case 'topicsmanager':
	xoops_cp_header();
	include dirname(__FILE__).'/mymenu.php' ;
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
	include dirname(__FILE__).'/mymenu.php' ;
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
		redirect_header( "index.php?mode=admin&op=topicsmanager", 2, _AM_ERRORTOPICNAME );
	}
	
	$BTopic->setTopicTitle( $_POST['topic_title'] );
	
	if( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" ){
		$BTopic -> setTopicImgurl( $_POST['topic_imgurl'] );
	}
	
	$BTopic->store();
	
	$notification_handler = & xoops_gethandler( 'notification' );
	
	$tags = array();
	$tags['TOPIC_NAME'] = $_POST['topic_title'];
	
	// �������ȥԥå������줿�������٥������
	$notification_handler->triggerEvent( 'global', 0, 'new_category', $tags );
		
	redirect_header( 'index.php?mode=admin&op=topicsmanager', 1, _AM_DBUPDATED );

	break;

case 'delTopic':

	if( empty($_POST['ok']) ){
	
		xoops_cp_header();
		include dirname(__FILE__).'/mymenu.php' ;
		$template = 'bulletin_deltopic.html';

		$BTopic = new BulletinTopic( $_GET['topic_id'] );
		
		// ���٤ƤΥ��֥ȥԥå������
		$topic_arr = $BTopic->getAllChildTopics();

		// �Ĥ�ȥԥå������
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
		
		// ���٤ƤΥ��֥ȥԥå������
		$topic_arr = $BTopic->getAllChildTopics();

		// ������Ĥ��ȥԥå�
		$move_topics = $_POST['topics'];

		array_push( $topic_arr, $BTopic );
		
		foreach( $topic_arr as $eachtopic ){
		
			if( $move_topics[$eachtopic->topic_id()] == 0 ){
			
				// ���٤Ƥε��������
				$story_arr = Bulletin::getAllByTopic( $eachtopic->topic_id() );
				foreach( $story_arr as $eachstory ){
					if ( false != $eachstory->delete() ){
						//�����Ȥ���
						xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $eachstory->getVar('storyid') );
						//���٥�����Τ���
						xoops_notification_deletebyitem( $xoopsModule->getVar( 'mid' ), 'story', $eachstory->getVar('storyid') );
					}
				}
			
			}else{
			
				// ���٤Ƥε��������
				$story_arr = Bulletin::getAllByTopic( $eachtopic->topic_id() );
				foreach( $story_arr as $eachstory ){
					$eachstory->setVar('topicid', $move_topics[$eachtopic->topic_id()]);
					$eachstory->store();
				}
			}
			
			// �ȥԥå�����
			$eachtopic->delete();
			xoops_notification_deletebyitem( $xoopsModule->getVar( 'mid' ), 'category', $eachtopic->topic_id );
		}
		redirect_header( 'index.php?mode=admin&op=topicsmanager', 1, _AM_DBUPDATED );

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
		redirect_header( "index.php?mode=admin&op=topicsmanager", 2, _AM_ERRORTOPICNAME );
	}
	$BTopic -> setTopicTitle( $_POST['topic_title'] );
	if ( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" )
	{
		$BTopic -> setTopicImgurl( $_POST['topic_imgurl'] );
	}
	$BTopic -> store();
	redirect_header( 'index.php?mode=admin&op=topicsmanager', 1, _AM_DBUPDATED );

	break;
	
case 'convert':
	xoops_cp_header();
	include dirname(__FILE__).'/mymenu.php' ;

	if( empty($_POST['ok']) ){
	
		xoops_confirm( array( 'op' => 'convert', 'ok' => 1 ), 'index.php?mode=admin', _AM_DO_YOU_CONVERT );
		
	}else{

		// �ȥԥå��Υ���С���
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
		
		// �˥塼�������Υ���С���
		$sql = "SELECT * FROM ".$xoopsDB->prefix('stories')." ORDER BY published";
		$result =$xoopsDB->query($sql);

		while( $story = $xoopsDB->fetchArray($result)){

			$html      = ($story['nohtml'] == 0) ? 1 : 0;
			$smiley    = ($story['nosmiley'] == 0) ? 1 : 0;
			$ihome     = ($story['ihome'] == 0) ? 1 : 0;
			$type      = ($story['story_type'] == 1 && $story['published'] == 0) ? 0 : 1;
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
			$new_story->setVar('type', $type);
			$new_story->setVar('topicimg',  $topicimg);
			$new_story->setVar('comments', $story['comments']);
			if($new_story->store()) {
				echo '<br />Story "'.htmlspecialchars($story['title']).'" was successfully converted : '.$new_story->getVar('storyid');
			}else{
				echo '<br /><b>Failed to convert : '.htmlspecialchars($story['title']).'</b>';
			}
		
		}
		
		echo '<br /><a href="index.php?mode=admin">'._BACK.'</a>';
	}

	break;

}

$credit = _AM_CREDIT;
$translater = _AM_TRANSLATER;

$assing_global = array(
	'ADMENU7' => constant( $constpref.'_ADMENU7'),
	'ADMENU2' => constant( $constpref.'_ADMENU2'),
	'ADMENU4' => constant( $constpref.'_ADMENU4'),
	'ADMENU5' => constant( $constpref.'_ADMENU5'),
	'imagelocation' => sprintf( _AM_IMGNAEXLOC,str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$xoopsModuleConfig['topicon_path']) ),
	'imagebase' => basename(str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$xoopsModuleConfig['topicon_path'])),
	'imagedirname' => dirname(str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$xoopsModuleConfig['topicon_path'])),
	'credit' => $myts->previewTarea($credit,0,1,0,0,0),
	'translater' => $myts->previewTarea($translater,0,1,0,0,0),
	'admin_title' => sprintf(_AM_CONFIG, $xoopsModule->name()),
	'xoops_url' => XOOPS_URL,
	'template_path' => $mytrustdirpath."/admin/templates",
	'mydirurl' => $mydirurl
);

$tpl->assign($assing_global);
if(!empty( $asssigns )) $tpl->assign($asssigns);
if(!empty( $template )) $tpl->display("file:".$mytrustdirpath."/admin/templates/".$template);
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
	if($obj->getVar('type') != 0 && $obj->getVar('published')<time() && $obj->getVar('published') != 0 && ($obj->getVar('expired') == 0 || $obj->getVar('expired') > time() ) ){
	
		if( $obj->getVar('title') == '' ){
			$obj->setVar('title', _AM_NOSUBJECT);
		}
		$ret = @sprintf("<a href='%s'>%s</a>",
			XOOPS_URL."/modules/".$xoopsModule->dirname()."/index.php?page=article&amp;storyid=".$obj->getVar('storyid'),
			$obj->getVar('title') );

	}else{

		if( $obj->getVar('title') == '' ){
			$obj->setVar('title', _AM_NOSUBJECT);
		}
		$ret = $obj->getVar('title');
		
	}

	return $ret;
}

?>