<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
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
if( ! defined( 'BULLETIN_BLOCK_CALENDER_INCLUDED' ) ) {

define( 'BULLETIN_BLOCK_CALENDER_INCLUDED' , 1 ) ;


function b_bulletin_calendar_show() {

	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;

	require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/include/configs.inc.php';
	require_once $myroot.'/class/bulletin_cal.php';
	
	$block = array();
	
	$today = isset( $_GET['today'] ) ? $_GET['today'] : date('Y-m') ;
	
	$year  = date('Y');
	$month = date('m');
	
	if(preg_match('/([0-9]{4})-([0-9]{2})/', $today, $todayarr)){
		$year  = $todayarr[1];
		$month = $todayarr[2];
	}	
	if(!checkdate($month,1,$year)){
		$year  = date('Y');
		$month = date('m');
	}
	
	$weekname = array(_MB_BULLETIN_SUN,_MB_BULLETIN_MON,_MB_BULLETIN_TUE,_MB_BULLETIN_WED,_MB_BULLETIN_THE,_MB_BULLETIN_FRI,_MB_BULLETIN_SAT);
	
	//ŒfÚ’†‚Ì‹LŽ–‚ÉŒÀ’è‚·‚é‚±‚Æ
	$sql = "SELECT published FROM $table_stories ORDER BY published ASC";
	list($startday) = $xoopsDB->fetchRow($xoopsDB->query($sql));
	
	$sql = "SELECT published FROM $table_stories ORDER BY published DESC";
	list($endday) = $xoopsDB->fetchRow($xoopsDB->query($sql));
	
	$starttimestamp4sql = mktime(0,0,0,$month,1,$year);
	$endtimestamp4sql   = mktime(0,0,0,$month+1,1,$year);
	
	$sql = "SELECT storyid, published FROM $table_stories WHERE published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().") AND $starttimestamp4sql <= published AND published < $endtimestamp4sql";
	$result = $xoopsDB->query($sql);
	
	
	$cal = new Bulletin_Cal;
	$cal->setDate($today, $startday, $endday);
	$cal->setWeekName( $weekname );
	while(list($storyid, $published) = $xoopsDB->fetchRow($result)){
		$day = intval(date('d', $published));
		$cal->setLink($day, $myurl.'/index.php?caldate='.date('Y-m-d', $published));
	}
	$cal->setTitle(_MB_BULLETIN_DATE_FORMAT);
	$block['content'] = $cal->getThemeCalendar();

	return $block;

}

}
?>