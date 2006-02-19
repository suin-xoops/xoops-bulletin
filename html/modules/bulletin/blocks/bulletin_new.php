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

	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/include/configs.inc.php';

	$module_handler  =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
		
	$block = array();

	// 本文を表示する
	if($options[3] > 0){

		require_once  $myroot."/class/bulletin.php";

		$articles = Bulletin::getAllPublished($options[3], 0);
		
		$total = count($articles);
		
		for ( $i = 0; $i < $total; $i++ ) {
			$block['items'][$i]['id']       = $articles[$i]->getVar('storyid');
			$block['items'][$i]['posttime'] = formatTimestamp( $articles[$i]->getVar('published'));
			$block['items'][$i]['topicid']  = $articles[$i]->getVar('topicid');
			$block['items'][$i]['topic']    = $articles[$i]->topic_title();
			$block['items'][$i]['title']    = $articles[$i]->getVar('title');
			$block['items'][$i]['text']     = $articles[$i]->getVar('hometext');
			$block['items'][$i]['hits']     = $articles[$i]->getVar('counter');
			$block['items'][$i]['title_link'] = true;
			//ユーザ情報をアサイン
			$block['items'][$i]['uid']      = $articles[$i]->getVar('uid');
			$block['items'][$i]['uname']    = $articles[$i]->getUname();
			$block['items'][$i]['realname'] = $articles[$i]->getRealname();
			$block['items'][$i]['morelink'] = '';
		
			// 文字数カウント処理
			if ( $articles[$i]->strlenBodytext() > 1 ) {
				$block['items'][$i]['bytes']    = sprintf(_MB_BYTESMORE, $articles[$i]->strlenBodytext());
				$block['items'][$i]['readmore'] = true;
			}
	
			// コメントの数をアサイン
			$ccount = $articles[$i]->getVar('comments');
			if( $ccount == 0 ){
				$block['items'][$i]['comentstotal'] = _MB_COMMENTS;
			}elseif( $ccount == 1 ) {
				$block['items'][$i]['comentstotal'] = _MB_ONECOMMENT;
			}else{
				$block['items'][$i]['comentstotal'] = sprintf(_MB_NUMCOMMENTS, $ccount);
			}
		
			// 管理者用のリンク
			$block['items'][$i]['adminlink'] = 0;
		
			// トピック画像
			if ( $articles[$i]->showTopicimg()  ) {
				$block['items'][$i]['imglink'] = $articles[$i]->imglink($bulletin_topicon_path);
				$block['items'][$i]['align']   = $articles[$i]->getTopicalign();
			}
		}
	}

	if( $options[1] - $options[3] > 0 ){

		$sql  = sprintf('SELECT storyid, title, published, expired, counter, uid FROM %s WHERE published < %u AND published > 0 AND (expired = 0 OR expired > %2$u) ORDER BY %s DESC', $table_stories, time(), $options[0]);

		$result = $xoopsDB->query($sql,$options[1]-$options[3],$options[3]);

		while ( $myrow = $xoopsDB->fetchArray($result) ) {
			$story = array();

			// マルチバイト環境に対応
			$story['title']    = $myts->makeTboxData4Show(xoops_substr($myrow['title'], 0 ,$options[2] + 3, '...'));
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
	$block['type']  = $options[0];
	$block['myurl'] = $myurl;

	return $block;
}

function b_bulletin_new_edit($options) {
	
	$form = ""._MB_BULLETIN_ORDER."&nbsp;<select name='options[]'>";
	$form .= "<option value='published'";
	if ( $options[0] == "published" ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_DATE."</option>\n";
	$form .= "<option value='counter'";
	if($options[0] == "counter"){
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_HITS."</option>\n";
	$form .= "</select>";
	
	$form .= "<br />"._MB_BULLETIN_DISP."&nbsp;<input type='text' name='options[]' value='".$options[1]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";
	$form .= "<br />"._MB_BULLETIN_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[2]."' />&nbsp;"._MB_BULLETIN_LENGTH."";
	$form .= "<br />"._MB_BULLETIN_DISP_HOMETEXT."&nbsp;<input type='text' name='options[]' value='".$options[3]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";

	return $form;
}

}
?>