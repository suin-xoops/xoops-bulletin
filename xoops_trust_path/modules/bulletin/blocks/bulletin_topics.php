<?php

function b_bulletin_topics_show($options) {

	global $xoopsDB;

	$mydirname = $options[0] ;
	require_once XOOPS_ROOT_PATH.'/class/xoopstopic.php';

	$block = array();
	$xt = new XoopsTopic($xoopsDB->prefix("{$mydirname}_topics"));
	$jump = XOOPS_URL.'/modules/'.$mydirname.'/index.php?storytopic=';
	$storytopic = isset($_GET['storytopic']) ? intval($_GET['storytopic']) : 0;
	ob_start();
	$xt->makeTopicSelBox(1, $storytopic,"storytopic","location=\"".$jump."\"+this.options[this.selectedIndex].value");
	$block['selectbox'] = ob_get_contents();
	$block['mydirname'] = $mydirname;
	ob_end_clean();
	return $block;

}
?>