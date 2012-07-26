<?php

	if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
	$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

	global $xoopsConfig , $xoopsDB , $xoopsUser ;

	// module information
	$myurl  = XOOPS_URL .'/modules/'. $mydirname ;
	$myroot = XOOPS_ROOT_PATH .'/modules/'. $mydirname ;
	$mycopyright = '' ;

	// read from xoops_config
	// get my mid
	$rs = $xoopsDB->query( "SELECT mid FROM ".$xoopsDB->prefix('modules')." WHERE dirname='$mydirname'" ) ;
	list( $bulletin_mid ) = $xoopsDB->fetchRow( $rs ) ;

	// read configs from xoops_config directly
	$rs = $xoopsDB->query( "SELECT conf_name,conf_value FROM ".$xoopsDB->prefix('config')." WHERE conf_modid=$bulletin_mid" ) ;
	while( list( $key , $val ) = $xoopsDB->fetchRow( $rs ) ) {
		$bulletin_configs[ $key ] = $val ;
	}

	foreach( $bulletin_configs as $key => $val ) {
		${'bulletin_'.$key} = $val ;
	}

	// User Informations
	if( empty( $xoopsUser ) ) {
		$my_uid  = 0 ;
		$isadmin = false ;
	} else {
		$my_uid  = $xoopsUser->uid() ;
		$isadmin = $xoopsUser->isAdmin( $bulletin_mid ) ;
	}

	// DB table name
	$table_stories  = $xoopsDB->prefix( "bulletin{$mydirnumber}_stories" ) ;
	$table_topics   = $xoopsDB->prefix( "bulletin{$mydirnumber}_topics" ) ;
	$table_comments = $xoopsDB->prefix( "xoopscomments" ) ;

	//サニタイザー
	$myts =& MyTextSanitizer::getInstance();

	require_once $myroot.'/include/function.php';

?>