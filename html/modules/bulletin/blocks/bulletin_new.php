<?php
// $Id: news_top_r.php,v 1.3 2003/08/26 17:07:26 Ryuji Exp $
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
if( ! defined( 'BULLETIN_BLOCK_TOP_INCLUDED' ) ) {

define( 'BULLETIN_BLOCK_TOP_INCLUDED' , 1 ) ;

function b_bulletin_new_show($options) {

	$mydirname = $options[0] ;
	if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
	require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/include/configs.inc.php';

	$module_handler  =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
		
	$block = array();

	// 本文を表示する
	if($options[4] > 0){

		$sql  = sprintf('SELECT s.storyid, s.topicid, s.title, s.hometext, s.bodytext, s.published, s.expired, s.counter, s.comments, s.uid, s.topicimg, s.html, s.smiley, s.br, s.xcode, t.topic_title, t. topic_imgurl FROM %s s, %s t WHERE s.published < %u AND s.published > 0 AND (s.expired = 0 OR s.expired > %3$u) AND s.topicid = t.topic_id AND s.ihome = 1 ORDER BY %s DESC', $table_stories, $table_topics, time(), $options[1]);

		$result = $xoopsDB->query($sql,$options[4],0);

		
		while ( $myrow = $xoopsDB->fetchArray($result) ) {
			$fullstory['id']       = $myrow['storyid'];
			$fullstory['posttime'] = formatTimestamp($myrow['published']);
			$fullstory['topicid']  = $myrow['topicid'];
			$fullstory['topic']    = $myts->makeTboxData4Show($myrow['topic_title']);
			$fullstory['title']    = $myts->makeTboxData4Show($myrow['title']);
			$fullstory['text']     = $myts->displayTarea($myrow['hometext'],$myrow['html'],$myrow['smiley'],$myrow['xcode'],1,$myrow['br']);
			$fullstory['hits']     = $myrow['counter'];
			$fullstory['title_link'] = true;
			//ユーザ情報をアサイン
			$fullstory['uid']      = $myrow['uid'];
			$fullstory['uname']    = XoopsUser::getUnameFromId($myrow['uid']);
			$fullstory['realname'] = XoopsUser::getUnameFromId($myrow['uid'], 1);
			$fullstory['morelink'] = '';
		
			// 文字数カウント処理
			if ( myStrlenText($myrow['bodytext']) > 1 ) {
				$fullstory['bytes']    = sprintf(_MB_BYTESMORE, myStrlenText($myrow['bodytext']));
				$fullstory['readmore'] = true;
			}else{
				$fullstory['bytes']    = 0;
				$fullstory['readmore'] = false;
			}
	
			// コメントの数をアサイン
			$ccount = $myrow['comments'];
			if( $ccount == 0 ){
				$fullstory['comentstotal'] = _MB_COMMENTS;
			}elseif( $ccount == 1 ) {
				$fullstory['comentstotal'] = _MB_ONECOMMENT;
			}else{
				$fullstory['comentstotal'] = sprintf(_MB_NUMCOMMENTS, $ccount);
			}
		
			// 管理者用のリンク
			$fullstory['adminlink'] = 0;
		
			// トピック画像
			if ( $myrow['topicimg'] ) {
				$fullstory['topic_url'] = makeTopicImgURL($bulletin_topicon_path, $myrow['topic_imgurl']);
				$fullstory['align']     = topicImgAlign($myrow['topicimg']);
			}

			$block['fullstories'][] = $fullstory;

		}
	}

	if( $options[2] - $options[4] > 0 ){

		$sql  = sprintf('SELECT storyid, title, published, expired, counter, uid FROM %s WHERE published < %u AND published > 0 AND (expired = 0 OR expired > %2$u) AND ihome = 1 ORDER BY %s DESC', $table_stories, time(), $options[1]);

		$result = $xoopsDB->query($sql,$options[2]-$options[4],$options[4]);

		while ( $myrow = $xoopsDB->fetchArray($result) ) {
			$story = array();

			// マルチバイト環境に対応
			$story['title']    = $myts->makeTboxData4Show(xoops_substr($myrow['title'], 0 ,$options[3] + 3, '...'));
			$story['id']       = $myrow['storyid'];
			$story['date']     = formatTimestamp($myrow['published'],"s");
			$story['hits']     = $myrow['counter'];
			$story['uid']      = $myrow['uid'];
			$story['uname']    = XoopsUser::getUnameFromId($myrow['uid']);
			$story['realname'] = XoopsUser::getUnameFromId($myrow['uid'], 1);

			$block['stories'][] = $story;
		}

	}

	$block['lang_postedby'] = _POSTEDBY;
	$block['lang_on']       = _ON;
	$block['lang_reads']    = _READS;
	$block['lang_readmore'] = _MB_READMORE;
	$block['type']  = $options[1];
	$block['myurl'] = $myurl;

	return $block;
}

function b_bulletin_new_edit($options) {
	
	$form  = "<input type='hidden' name='options[]' value='".$options[0]."' />";
	$form .= ""._MB_BULLETIN_ORDER."&nbsp;<select name='options[]'>";
	$form .= "<option value='published'";
	if ( $options[1] == "published" ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_DATE."</option>\n";
	$form .= "<option value='counter'";
	if($options[1] == "counter"){
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_HITS."</option>\n";
	$form .= "</select>";
	
	$form .= "<br />"._MB_BULLETIN_DISP."&nbsp;<input type='text' name='options[]' value='".$options[2]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";
	$form .= "<br />"._MB_BULLETIN_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[3]."' />&nbsp;"._MB_BULLETIN_LENGTH."";
	$form .= "<br />"._MB_BULLETIN_DISP_HOMETEXT."&nbsp;<input type='text' name='options[]' value='".$options[4]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";

	return $form;
}

}
?>