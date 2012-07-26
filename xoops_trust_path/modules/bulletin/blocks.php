<?php

$mytrustdirname = basename( dirname( __FILE__ ) ) ;
$mytrustdirpath = dirname( __FILE__ ) ;

// language files
$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
if( file_exists( "$mydirpath/language/$language/blocks.php" ) ) {
	// user customized language file (already read by common.php)
	// include_once "$mydirpath/language/$language/blocks.php" ;
} else if( file_exists( "$mytrustdirpath/language/$language/blocks.php" ) ) {
	// default language file
	include_once "$mytrustdirpath/language/$language/blocks.php" ;
} else {
	// fallback english
	include_once "$mytrustdirpath/language/english/blocks.php" ;
}

// language files
$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
if( file_exists( "$mydirpath/language/$language/main.php" ) ) {
	// user customized language file (already read by common.php)
	// include_once "$mydirpath/language/$language/main.php" ;
} else if( file_exists( "$mytrustdirpath/language/$language/main.php" ) ) {
	// default language file
	include_once "$mytrustdirpath/language/$language/main.php" ;
} else {
	// fallback english
	include_once "$mytrustdirpath/language/english/main.php" ;
}

// include all block files
$block_path = $mytrustdirpath.'/blocks' ;

if( $handler = @opendir( $block_path . '/' ) ) {
	while( ( $file = readdir( $handler ) ) !== false ) {
		if( substr( $file , 0 , 1 ) == '.' ) continue ;
		$file_path = $block_path . '/' . $file ;
		if( is_file( $file_path ) && substr( $file , -4 ) == '.php' ) {
			include_once $file_path ;
		}
	}
}
?>