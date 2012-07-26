<?php
require 'header.php';

$com_itemid = isset($_GET['com_itemid']) ? intval($_GET['com_itemid']) : 0 ;

// ������̵�����
if( !Bulletin::isPublishedExists($com_itemid) ){
	redirect_header($myurl.'/index.php',2,_MD_NOSTORY);
	exit();
}

$article = new Bulletin($com_itemid);

$com_replytext = _POSTEDBY.'&nbsp;<b>'.$article->getUname().'</b>&nbsp;'._DATE.'&nbsp;<b>'.formatTimestamp($article->getvar('published')).'</b><br /><br />'.$article->getVar('hometext');
$bodytext = $article->getDividedBodytext();
if ($bodytext != '') {
	$com_replytext .= '<br /><br />'.$bodytext.'';
}
$com_replytitle = $article->getVar('title');

require XOOPS_ROOT_PATH.'/include/comment_new.php';

?>