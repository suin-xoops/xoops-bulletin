<?php
$constpref = '_MI_' . strtoupper( $mydirname ) ;

$i=1;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU5');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=list";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU2');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=topicsmanager";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU4');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=permition";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU7');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=convert";
$i++;
/*
if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/mytplsadmin.php' ) ) {
	// mytplsadmin (TODO check if this module has tplfile)
	$adminmenu[$i]['title'] = defined( '_MD_A_MYMENU_MYTPLSADMIN' ) ? _MD_A_MYMENU_MYTPLSADMIN : 'tplsadmin' ;
	$adminmenu[$i]['link']  = 'index.php?mode=admin&lib=altsys&page=mytplsadmin' ;
	$i++;
}

if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/myblocksadmin.php' ) ) {
	// myblocksadmin
	$adminmenu[$i]['title'] = defined( '_MD_A_MYMENU_MYBLOCKSADMIN' ) ? _MD_A_MYMENU_MYBLOCKSADMIN : 'blocksadmin' ;
	$adminmenu[$i]['link']  = 'index.php?mode=admin&lib=altsys&page=myblocksadmin' ;
	$i++;
}*/
?>