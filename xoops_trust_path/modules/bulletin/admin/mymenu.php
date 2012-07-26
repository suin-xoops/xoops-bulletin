<?php

// Skip for ORETEKI XOOPS
if( defined( 'XOOPS_ORETEKI' ) ) return ;

if( ! isset( $module ) || ! is_object( $module ) ) $module = $xoopsModule ;
else if( ! is_object( $xoopsModule ) ) die( '$xoopsModule is not set' )  ;

// language files (modinfo.php)
$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
if( file_exists( "$mydirpath/language/$language/modinfo.php" ) ) {
	// user customized language file
	include_once "$mydirpath/language/$language/modinfo.php" ;
} else if( file_exists( "$mytrustdirpath/language/$language/modinfo.php" ) ) {
	// default language file
	include_once "$mytrustdirpath/language/$language/modinfo.php" ;
} else {
	// fallback english
	include_once "$mytrustdirpath/language/english/modinfo.php" ;
}

include './admin_menu.php' ; // fixme or TODO :-)

if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/mytplsadmin.php' ) ) {
	// mytplsadmin (TODO check if this module has tplfile)
	$title = defined( '_MD_A_MYMENU_MYTPLSADMIN' ) ? _MD_A_MYMENU_MYTPLSADMIN : 'tplsadmin' ;
	array_push( $adminmenu , array( 'title' => $title , 'link' => 'index.php?mode=admin&lib=altsys&page=mytplsadmin' ) ) ;
}

if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/myblocksadmin.php' ) ) {
	// myblocksadmin
	$title = defined( '_MD_A_MYMENU_MYBLOCKSADMIN' ) ? _MD_A_MYMENU_MYBLOCKSADMIN : 'blocksadmin' ;
	array_push( $adminmenu , array( 'title' => $title , 'link' => 'index.php?mode=admin&lib=altsys&page=myblocksadmin' ) ) ;
}

// preferences
$config_handler =& xoops_gethandler('config');
if( count( $config_handler->getConfigs( new Criteria( 'conf_modid' , $module->mid() ) ) ) > 0 ) {
	if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/mypreferences.php' ) ) {
		// mypreferences
		$title = defined( '_MD_A_MYMENU_MYPREFERENCES' ) ? _MD_A_MYMENU_MYPREFERENCES : _PREFERENCES ;
		array_push( $adminmenu , array( 'title' => $title , 'link' => 'index.php?mode=admin&lib=altsys&page=mypreferences' ) ) ;
	} else {
		// system->preferences
		array_push( $adminmenu , array( 'title' => _PREFERENCES , 'link' => XOOPS_URL.'/modules/system/admin.php?fct=preferences&op=showmod&mod='.$module->mid() ) ) ;
	}
}

$mymenu_uri = empty( $mymenu_fake_uri ) ? $_SERVER['REQUEST_URI'] : $mymenu_fake_uri ;
$mymenu_link = substr( strstr( $mymenu_uri , '/admin/' ) , 1 ) ;



// highlight (you can customize the colors)
foreach( array_keys( $adminmenu ) as $i ) {
	if( $mymenu_link == $adminmenu[$i]['link'] ) {
		$adminmenu[$i]['color'] = '#FFCCCC' ;
		$adminmenu_hilighted = true ;
	} else {
		$adminmenu[$i]['color'] = '#DDDDDD' ;
	}
}
if( empty( $adminmenu_hilighted ) ) {
	foreach( array_keys( $adminmenu ) as $i ) {
		if( stristr( $mymenu_uri , $adminmenu[$i]['link'] ) ) {
			$adminmenu[$i]['color'] = '#FFCCCC' ;
		}
	}
}


// display (you can customize htmls)
echo "<div style='text-align:left;width:98%;'>" ;
foreach( $adminmenu as $menuitem ) {
	echo "<div style='float:left;height:1.5em;'><nobr><a href='".htmlspecialchars($menuitem['link'],ENT_QUOTES)."' style='background-color:{$menuitem['color']};font:normal normal bold 9pt/12pt;'>".htmlspecialchars($menuitem['title'],ENT_QUOTES)."</a> | </nobr></div>\n" ;
}
echo "</div>\n<hr style='clear:left;display:block;' />\n" ;

?>