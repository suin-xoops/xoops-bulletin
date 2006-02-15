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
	
	$block['myurl'] = $myurl;
	
	//
	$sql  = sprintf('SELECT storyid, title, published, expired, counter FROM %s WHERE published < %u AND published > 0 AND (expired = 0 OR expired > %2$u) ORDER BY %s DESC', $table_stories, time(), $options[0]);
	
	$result = $xoopsDB->query($sql,$options[1],0);

	if($options[3]){

		$myrow = $xoopsDB->fetchArray($result);

		require_once  $myroot."/class/bulletin.php";

		$article = new Bulletin($myrow["storyid"]);
		$block['TopStory']['id']       = $myrow["storyid"];
		$block['TopStory']['posttime'] = formatTimestamp($article->getVar('published'));
		$block['TopStory']['topicid']  = $article->getVar('topicid');
		$block['TopStory']['topic']    = $article->topic_title();
		$block['TopStory']['title']    = $article->getVar('title');
		$block['TopStory']['text']     = $article->getVar('hometext');
		$block['TopStory']['hits']     = $article->getVar('counter');
		$block['TopStory']['title_link'] = true;
		//ユーザ情報をアサイン
		$block['TopStory']['uid']      = $article->getVar('uid');
		$block['TopStory']['uname']    = $article->getUname();
		$block['TopStory']['realname'] = $article->getRealname();
		$block['TopStory']['morelink'] = '';
		
		// 文字数カウント処理
		if ( $article->strlenBodytext() > 1 ) {
			$block['TopStory']['bytes']    = sprintf(_MB_BYTESMORE, $article->strlenBodytext());
			$block['TopStory']['readmore'] = true;
		}
	
		// コメントの数をアサイン
		$ccount = $article->getVar('comments');
		if( $ccount == 0 ){
			$block['TopStory']['comentstotal'] = _MB_COMMENTS;
		}elseif( $ccount == 1 ) {
			$block['TopStory']['comentstotal'] = _MB_ONECOMMENT;
		}else{
			$block['TopStory']['comentstotal'] = sprintf(_MB_NUMCOMMENTS, $ccount);
		}
	
		// 管理者用のリンク
		$block['TopStory']['adminlink'] = 0;
	
		// トピック画像
		if ( $article->showTopicimg()  ) {
			$block['TopStory']['imglink'] = $article->imglink($bulletin_topicon_path);
			$block['TopStory']['align']   = $article->getTopicalign();
		}
		
		$block['disphometext'] = 1;
	}

	while ( $myrow = $xoopsDB->fetchArray($result) ) {
		$news = array();
		$title = $myts->makeTboxData4Show($myrow["title"]);
		if ( !XOOPS_USE_MULTIBYTES ) {
			if (strlen($myrow['title']) >= $options[2]) {
				$title = $myts->makeTboxData4Show(substr($myrow['title'],0,($options[2] -1)))."...";
			}
		}
		$news['title'] = $title;
		$news['id'] = $myrow['storyid'];
		if ( $options[0] == "published" ) {
			$news['date'] = formatTimestamp($myrow['published'],"s");
		} elseif ( $options[0] == "counter" ) {
			$news['hits'] = $myrow['counter'];
		}
		$block['stories'][] = $news;
	}

	$block['lang_postedby'] = _POSTEDBY;
	$block['lang_on']       = _ON;
	$block['lang_reads']    = _READS;
	$block['lang_readmore'] = _MB_READMORE;
	$block['type'] = $options[0];

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
	$form .= "<br />"._MB_BULLETIN_WITH_HOMETEXT."&nbsp;<select name='options[]'>";
	$form .= "<option value='0'";
	if ( $options[3] == "0" ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._NO."</option>\n";
	$form .= "<option value='1'";
	if($options[3] == "1"){
		$form .= " selected='selected'";
	}
	$form .= ">"._YES."</option>\n";
	$form .= "</select>\n";

	return $form;
}

}
?>