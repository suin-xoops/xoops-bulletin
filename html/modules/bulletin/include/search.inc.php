<?php
// $Id: search.inc.php,v 1.2 2005/03/18 12:52:38 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

eval( '
function bulletin'.$mydirnumber.'_search( $keywords , $andor , $limit , $offset , $userid )
{
	return bulletin_search_base( "'.$mydirname.'", "'.$mydirnumber.'" , $keywords , $andor , $limit , $offset , $userid ) ;
}
' ) ;

if( ! function_exists( 'bulletin_search_base' ) ) {

function bulletin_search_base( $mydirname , $mydirnumber, $queryarray , $andor , $limit , $offset , $userid ){
	global $xoopsDB;

	$showcontext = isset( $_GET['showcontext'] ) ? $_GET['showcontext'] : 0 ;
	if( $showcontext == 1 && function_exists('search_make_context')){
		$sql = "SELECT storyid,uid,title,published,hometext,bodytext,html,smiley FROM ".$xoopsDB->prefix("bulletin{$mydirnumber}_stories")." WHERE published > 0 AND published <= ".time()."";
	}else{
		$sql = "SELECT storyid,uid,title,published FROM ".$xoopsDB->prefix("bulletin{$mydirnumber}_stories")." WHERE published > 0 AND published <= ".time()."";
	}
	
	if ( $userid != 0 ) {
		$sql .= " AND uid=".$userid." ";
	}
	// because count() returns 1 even if a supplied variable
	// is not an array, we must check if $querryarray is really an array
	if ( is_array($queryarray) && $count = count($queryarray) ) {
		$sql .= " AND ((hometext LIKE '%$queryarray[0]%' OR bodytext LIKE '%$queryarray[0]%' OR title LIKE '%$queryarray[0]%')";
		for($i=1;$i<$count;$i++){
			$sql .= " $andor ";
			$sql .= "(hometext LIKE '%$queryarray[$i]%' OR bodytext LIKE '%$queryarray[$i]%' OR title LIKE '%$queryarray[$i]%')";
		}
		$sql .= ") ";
	}
	$sql .= "ORDER BY published DESC";
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$i = 0;
	
	$myts =& MyTextSanitizer::getInstance();
	
	
 	while($myrow = $xoopsDB->fetchArray($result)){
		$ret[$i]['image'] = 'images/forum.gif';
		$ret[$i]['link']  = 'article.php?storyid='.$myrow['storyid'];
		$ret[$i]['title'] = $myrow['title'];
		$ret[$i]['time']  = $myrow['published'];
		$ret[$i]['uid']   = $myrow['uid'];
		if( !empty( $myrow['hometext'] ) ){
			$context = $myrow['hometext'].$myrow['bodytext'];
			$context = strip_tags($myts->displayTarea(strip_tags($context),$myrow['html'],$myrow['smiley'],1));
			$ret[$i]['context'] = search_make_context($context,$queryarray);
		}
		$i++;
	}
	return $ret;
}

}
?>