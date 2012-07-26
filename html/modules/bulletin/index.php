<?php

require 'header.php';

//�ƥ�ץ졼��
$xoopsOption['template_main'] = "bulletin{$mydirnumber}_index.html";

require XOOPS_ROOT_PATH.'/header.php';

$storytopic = isset($_GET['storytopic']) ? intval($_GET['storytopic']) : 0 ;
$storynum   = isset($_GET['storynum'])   ? intval($_GET['storynum'])   : $bulletin_storyhome;
$start      = isset($_GET['start'])      ? intval($_GET['start'])      : 0 ;
$caldate    = isset($_GET['caldate'])    ? $_GET['caldate']            : '' ;
$storynum   = ($storynum > 30)           ? $bulletin_storyhome         : $storynum ;

// �ʥӥ�����
if ( $bulletin_displaynav == 1 ) {
	
	// �ʥӤ�Ȥ������
	$xoopsTpl->assign('displaynav', true);
	
	// ���쥯���򥢥�����
	$xoopsTpl->assign('topic_select', Bulletin::makeTopicSelBox(1, $storytopic, 'storytopic'));
	
	// ���ץ����򥢥�����
	for ( $i = 5; $i <= 30; $i = $i + 5 ) {
		$option = array();
		$option['sel']    = ($i == $storynum) ? ' selected="selected"' : '' ;
		$option['option'] = $i ;
		$xoopsTpl->append('option', $option);
	}
	
} else {
	$xoopsTpl->assign('displaynav', false);
}

// ����������Υ�󥯡����ջ��꤬ͭ�ä�����
if( !empty($caldate) && preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $caldate, $datearr) ){
	$articles = Bulletin::getAllToday($storynum, $start, $caldate);
	$xoopsTpl->assign('displaynav', false);
}else{
// �̾�ɽ���ξ��
	$articles = Bulletin::getAllPublished($storynum, $start, $storytopic);
}

$scount = count($articles);

// �����Υ롼��
for ( $i = 0; $i < $scount; $i++ ) {
	$story = array();
	
	$story['id']         = $articles[$i]->getVar('storyid');
	$story['posttime']   = formatTimestamp($articles[$i]->getVar('published'), $bulletin_date_format);
	$story['text']       = $articles[$i]->getVar('hometext');
	$story['topicid']    = $articles[$i]->getVar('topicid');
	$story['topic']      = $articles[$i]->topic_title();
	$story['title']      = $articles[$i]->getVar('title');
	$story['hits']       = $articles[$i]->getVar('counter');
	$story['title_link'] = true;
	
	//�桼������򥢥�����
	$story['uid']        = $articles[$i]->getVar('uid');
	$story['uname']      = $articles[$i]->getUname();
	$story['realname']   = $articles[$i]->getRealname();
	
	// ʸ����������Ƚ���
	if ( $articles[$i]->strlenBodytext() > 1 ) {
		$story['bytes']    = sprintf(_MD_BYTESMORE, $articles[$i]->strlenBodytext());
		$story['readmore'] = true;
	}
	
	// �����Ȥο��򥢥�����
	$ccount = $articles[$i]->getVar('comments');
	if( $ccount == 0 ){
		$story['comentstotal'] = _MD_COMMENTS;
	}elseif( $ccount == 1 ) {
		$story['comentstotal'] = _MD_ONECOMMENT;
	}else{
		$story['comentstotal'] = sprintf(_MD_NUMCOMMENTS, $ccount);
	}
	
	// �������ѥ��
	$story['adminlink'] = 0;
	if ( $xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid()) ) {
		$story['adminlink'] = 1;
	}
	
	// �����������
	if ( $articles[$i]->showTopicimg() ) {
		$story['topic_url'] = $articles[$i]->imglink($bulletin_topicon_path);
		$story['align']     = $articles[$i]->getTopicalign();
	}
	
	$xoopsTpl->append('stories', $story);
}

// �ڡ����ʥ�
if( !empty($caldate) && preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $caldate, $datearr) ){
	$totalcount = Bulletin::countPublishedByDate($caldate);
	$query      = 'caldate='.$caldate;
}else{
	$totalcount = Bulletin::countPublished($storytopic);
	$query      = 'storytopic='.$storytopic;
}
if ( $totalcount > $scount ) {
	require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
	$pagenav = new XoopsPageNav($totalcount, $storynum, $start, 'start', $query);
	$xoopsTpl->assign('pagenav', $pagenav->renderNav());

} else {
	$xoopsTpl->assign('pagenav', '');
}

$xoopsTpl->assign($assing_array);

if($bulletin_assing_rssurl_head){
	$xoopsTpl->assign('xoops_module_header', '<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="'.$myurl.'/rss.php" />' . $xoopsTpl->get_template_vars( "xoops_module_header" ));
}
require_once XOOPS_ROOT_PATH.'/footer.php';
?>