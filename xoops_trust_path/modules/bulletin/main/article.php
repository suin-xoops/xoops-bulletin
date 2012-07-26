<?php

$storyid   = isset($_GET['storyid']) ? intval($_GET['storyid']) : 0 ;
$storypage = isset($_GET['storypage']) ? intval($_GET['storypage']) : 0 ;

// ������¸�ߤ��ʤ����
if( !Bulletin::isPublishedExists($storyid) ){
	redirect_header($mydirurl.'/index.php',2,_MD_NOSTORY);
	exit();
}

//�ƥ�ץ졼��
$xoopsOption['template_main'] = "{$mydirname}_article.html";

require_once XOOPS_ROOT_PATH.'/header.php';

$article = new Bulletin($storyid);

// �������򥫥���ȥ��åפ���
if (empty($_GET['com_id']) && !isset($_GET['storypage'])) {
	$article->updateCounter();
}

$story['id']       = $storyid;
$story['posttime'] = formatTimestamp($article->getVar('published'), $bulletin_date_format);
$story['topicid']  = $article->getVar('topicid');
$story['topic']    = $article->topic_title();
$story['title']    = $article->getVar('title');
$story['text']     = $article->getVar('hometext');
$story['hits']     = $article->getVar('counter');
$bodytext = $article->getVar('bodytext');

if ( $bodytext != '' ) {
	$articletext = explode('[pagebreak]', $bodytext);
	$story_pages = count($articletext);
	$storypage   = ( $story_pages - 1 >= $storypage ) ? $storypage : 0 ;

	// [pagebreak]��ʣ���ڡ����Υ���ƥ�Ĥ���������Ƥ�����
	if ($story_pages > 1 ) {
		require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
		$pagenav = new XoopsPageNav($story_pages, 1, $storypage, 'storypage', 'page=article&storyid='.$storyid);
		$xoopsTpl->assign('pagenav', $pagenav->renderNav());

		if ($storypage == 0) {
			$story['text'] = $story['text'].'<br /><br />'.$articletext[$storypage];
		} else {
			$story['text'] = $articletext[$storypage];
		}
	} else {
		$story['text'] = $story['text'].'<br /><br />'.$bodytext;
    }
}

//�桼������򥢥�����
$story['uid']      = $article->getVar('uid');
$story['uname']    = $article->getUname();
$story['realname'] = $article->getRealname();
$story['morelink'] = '';

$story['adminlink'] = 0;
if ( $xoopsUser && $xoopsUser->isAdmin($xoopsModule->getVar('mid')) ) {
	$story['adminlink'] = 1;
}

if ( $article->showTopicimg()  ) {
	$story['topic_url'] = $article->imglink($bulletin_topicon_path);
	$story['align']     = $article->getTopicalign();
}

// ��Ϣ����
if($bulletin_use_relations){
	$relations = $article->getRelated();
	foreach($relations as $relation){
		$relation_asign = array();
		$relation_asign['storyid'] = $relation->getVar('storyid');
		$relation_asign['title'] = $relation->getVar('title');
		$relation_asign['published'] = formatTimestamp($relation->getVar('published'), $bulletin_date_format);
		$relation_asign['uid'] = $relation->getVar('uid');
		$relation_asign['uname'] = $relation->getUname();
//		$relation_asign['topicid'] = $relation->getVar('topicid');
//		$relation_asign['topic'] = $relation->topic_title();
		$relation_asign['counter'] = $relation->getVar('counter');
		$relation_asign['comments'] = $relation->getVar('comments');
		$relation_asign['dirname'] = $relation->getVar('dirname');
		$relation_asign['url'] = XOOPS_URL.'/modules/'.$relation->getVar('dirname');
		$xoopsTpl->append('relations', $relation_asign);
	}
}

// Tell A Frined��Ȥ����
if($bulletin_use_tell_a_frined){
	$mail_link = XOOPS_URL.'/modules/tellafriend/index.php?target_uri='.rawurlencode( "$mydirurl/index.php?page=article&amp;storyid=$storyid" ).'&amp;subject='.rawurlencode(sprintf(_MD_INTARTFOUND,$xoopsConfig['sitename'])) ;
}else{
	$mail_link = 'mailto:?subject='.sprintf(_MD_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_MD_INTARTFOUND, $xoopsConfig['sitename']).':  '.$mydirurl.'/index.php?page=article&amp;storyid='.$storyid;
}

$xoopsTpl->assign('story', $story);
$xoopsTpl->assign('mail_link', $mail_link);
$xoopsTpl->assign('disp_print_icon', $bulletin_disp_print_icon);
$xoopsTpl->assign('disp_tell_icon', $bulletin_disp_tell_icon );

if( $bulletin_titile_as_sitename ) $xoopsTpl->assign('xoops_pagetitle', $article->getVar('title'));

require_once XOOPS_ROOT_PATH.'/include/comment_view.php';

if($bulletin_assing_rssurl_head){
	$xoopsTpl->assign('xoops_module_header', $rss_feed . $xoopsTpl->get_template_vars( "xoops_module_header" ));
}
$xoopsTpl->assign($assing_array);

require_once XOOPS_ROOT_PATH.'/footer.php';
?>