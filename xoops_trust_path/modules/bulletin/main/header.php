<?php
require_once "$mytrustdirpath/class/bulletin.php";
require_once "$mytrustdirpath/class/bulletingp.php";
require_once "$mytrustdirpath/class/bulletinTopic.php";
require_once "$mytrustdirpath/include/configs.inc.php";

$assing_array = array(
	'disp_rss_link' => $bulletin_disp_rss_link,
	'mydirurl' => $mydirurl,
	'mydirname' => $mydirname,
	);

//権限クラス
$gperm = new BulletinGP;

// User has the right to post.
if($gperm->group_perm(1)){
	$assing_array['can_post'] = 1;
}

// RSS Feed in <header>
$rss_feed = '<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="'.$mydirurl.'/index.php?page=rss" />'
?>