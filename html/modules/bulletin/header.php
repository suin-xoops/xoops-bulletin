<?php

require '../../mainfile.php';

//モジュール名取得
$mydirname  = basename( dirname( __FILE__ ) ) ;
$myurl  = XOOPS_URL . '/modules/' . $mydirname ;
$myroot = XOOPS_ROOT_PATH . '/modules/' . $mydirname ;

require_once $myroot.'/class/bulletin.php';
require_once $myroot.'/class/bulletingp.php';
require_once $myroot.'/class/bulletinTopic.php';
require_once $myroot.'/include/configs.inc.php';

$assing_array = array(
	'lang_articles' => _MD_ARTICLES,
	'lang_actions' => _MD_ACTIONS,
	'lang_date' => _MD_DATE,
	'lang_views' => _MD_VIEWS,
	'lang_printer' => _MD_PRINTERFRIENDLY,
	'lang_sendstory' =>_MD_SENDSTORY ,
	'lang_newsarchives' => _MD_NEWSARCHIVES,
	'lang_printerpage' => _MD_PRINTERFRIENDLY,
	'lang_on' => _ON,
	'lang_postedby' => _POSTEDBY,
	'lang_reads' => _READS,
	'lang_edit' => _EDIT,
	'lang_delete' => _DELETE,
	'lang_go' => _GO,
	'lang_printerpage' => _MD_PRINTERFRIENDLY,
	'lang_readmore' => _MD_READMORE,
	'lang_topic' => _MD_TOPICC,
	'lang_url_for_story' => _MD_URLFORSTORY,
	'lang_rss' => _MD_RSS,
	
	'disp_rss_link' => $bulletin_disp_rss_link,
	'myurl' => $myurl,
	
	);
?>