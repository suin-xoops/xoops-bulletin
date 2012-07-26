<?php

require 'header.php';

$storyid   = isset($_GET['storyid']) ? intval($_GET['storyid']) : 0 ;
$storypage = isset($_GET['page'])    ? intval($_GET['page'])    : 0 ;

// 記事が存在しない場合
if( !Bulletin::isPublishedExists($storyid) ){
	redirect_header($myurl.'/index.php',2,_MD_NOSTORY);
	exit();
}

//テンプレート
$xoopsOption['template_main'] = "bulletin{$mydirnumber}_article.html";

require_once XOOPS_ROOT_PATH.'/header.php';

$article = new Bulletin($storyid);

// 閲覧数をカウントアップする
if (empty($_GET['com_id']) && $storypage == 0) {
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

	// [pagebreak]で複数ページのコンテンツが構成されている場合
	if ($story_pages > 1 ) {
		require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
		$pagenav = new XoopsPageNav($story_pages, 1, $storypage, 'page', 'storyid='.$storyid);
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

//ユーザ情報をアサイン
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

// Tell A Frinedを使う場合
if($bulletin_use_tell_a_frined){
	$mail_link = XOOPS_URL.'/modules/tellafriend/index.php?target_uri='.rawurlencode( "$myurl/article.php?storyid=$storyid" ).'&amp;subject='.rawurlencode(sprintf(_MD_INTARTFOUND,$xoopsConfig['sitename'])) ;
}else{
	$mail_link = 'mailto:?subject='.sprintf(_MD_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_MD_INTARTFOUND, $xoopsConfig['sitename']).':  '.$myurl.'/article.php?storyid='.$storyid;
}

$xoopsTpl->assign('story', $story);
$xoopsTpl->assign('mail_link', $mail_link);
$xoopsTpl->assign('disp_print_icon', $bulletin_disp_print_icon);
$xoopsTpl->assign('disp_tell_icon', $bulletin_disp_tell_icon );

if( $bulletin_titile_as_sitename ) $xoopsTpl->assign('xoops_pagetitle', $article->getVar('title'));

require_once XOOPS_ROOT_PATH.'/include/comment_view.php';

if($bulletin_assing_rssurl_head){
	$xoopsTpl->assign('xoops_module_header', '<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="'.$myurl.'/rss.php" />' . $xoopsTpl->get_template_vars( "xoops_module_header" ));
}
$xoopsTpl->assign($assing_array);

require_once XOOPS_ROOT_PATH.'/footer.php';
?>