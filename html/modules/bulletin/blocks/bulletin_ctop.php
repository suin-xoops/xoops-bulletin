<?php
// $Id: news_ctop.php,v 1.1 2003/06/18 18:23:32 Ryuji Exp $
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
// options
//	0	ソートカラム
//	1	表示件数
//	2	ニュースタイトル文字数制限
//	3	表示するカテゴリ（0で全カテゴリ）未実装
//	4	hometextを表示する件数
//	5	トピックアイコンの表示

if( ! defined( 'BULLETIN_BLOCK_CTOP_INCLUDED' ) ) {

define( 'BULLETIN_BLOCK_CTOP_INCLUDED' , 1 ) ;


function b_bulletin_Ctop_show($options) {

	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/include/configs.inc.php';
	require_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
	
	$mytree = new XoopsTree($table_topics,'topic_id','topic_pid');

	$block = array();

	$arr=array();
	//ルートカテゴリを得るクエリ
	if(intval($options[3]) ==0){
		//全ルートカテゴリを得る
		$result=$xoopsDB->query("select topic_id, topic_title,topic_imgurl from $table_topics where topic_pid=0 ORDER BY topic_title");
	}else{
		//指定カテゴリのみ
		$result=$xoopsDB->query("select topic_id, topic_title,topic_imgurl from $table_topics where topic_id=".$options[3]);
	}
	$e = 0;
	//$rankings = array();
	while(list($topic_id, $topic_title, $topic_imgurl)=$xoopsDB->fetchRow($result)){
		$block['topics'][$e]['title'] = $myts->makeTboxData4Show($topic_title);
		$block['topics'][$e]['id'] = $topic_id;
		//トピック画像をセット
		$ret = '';
		if ($topic_imgurl != '' && file_exists($bulletin_topicon_path.$topic_imgurl) && $options[5]) {
			$block['topics'][$e]['imglink']  = "<a href='".$myurl."/index.php?storytopic=".$topic_id."'><img src='".str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$bulletin_topicon_path).$topic_imgurl."' alt='".$topic_title."' hspace='10' vspace='10' /></a>";
		}


		$query1 = "SELECT storyid, title, hometext, bodytext, published, expired, counter FROM $table_stories WHERE published < ".time()." AND published > 0 AND (expired = 0 OR expired > ".time().") and (topicid=".$topic_id; // Ryuji_edit(2003-05-08)
		$query2 = "SELECT storyid, title, published, expired, counter FROM $table_stories WHERE published < ".time()." AND published > 0 AND (expired = 0 OR expired > ".time().") and (topicid=".$topic_id; // Ryuji_edit(2003-05-08)
		$query3 = "SELECT count(*) FROM $table_stories WHERE published < ".time()." AND published > 0 AND (expired = 0 OR expired > ".time().") and (topicid=".$topic_id; // Ryuji_edit(2003-05-08)

		// get all child cat ids for a given cat id
		$arr=$mytree->getAllChildId($topic_id);
		$size = count($arr);
		for($i=0;$i<$size;$i++){
			$query1 .= " or topicid=".$arr[$i]."";
			$query2 .= " or topicid=".$arr[$i]."";
			$query3 .= " or topicid=".$arr[$i]."";
		}
		$query1 .= ") ORDER BY ".$options[0]." DESC";
		$query2 .= ") ORDER BY ".$options[0]." DESC";
		$query3 .= ") ORDER BY ".$options[0]." DESC";

		$result2 = $xoopsDB->query($query3,0,0);
		list($count) = $xoopsDB->fetchrow($result2);
		if(intval($count) > $options[1]){
			//続きのニュース有り
			$block['topics'][$e]['morelink'] = "<a href='".$myurl."/index.php?storytopic=".$topic_id."&start=".$options[1]."'>"._MB_BULLETIN_MORE."</a>";
		}

		//本文も表示する
		if ($options[4] > 0){
			require_once  $myroot.'/class/bulletin.php';
			$i = 0;
			$result2 = $xoopsDB->query($query1,$options[4],0);
			while ( $myrow = $xoopsDB->fetchArray($result2) ) {

				$article = new Bulletin($myrow['storyid']);
				
				$block['topics'][$e]['stories1'][$i]['id']       = $myrow['storyid'];
				$block['topics'][$e]['stories1'][$i]['posttime'] = formatTimestamp($article->getVar('published'));
				$block['topics'][$e]['stories1'][$i]['topicid']  = $article->getVar('topicid');
				$block['topics'][$e]['stories1'][$i]['topic']    = $article->topic_title();
				$block['topics'][$e]['stories1'][$i]['title']    = $article->getVar('title');
				$block['topics'][$e]['stories1'][$i]['text']     = $article->getVar('hometext');
				$block['topics'][$e]['stories1'][$i]['hits']     = $article->getVar('counter');
				$block['topics'][$e]['stories1'][$i]['title_link'] = true;
				//ユーザ情報をアサイン
				$block['topics'][$e]['stories1'][$i]['uid']      = $article->getVar('uid');
				$block['topics'][$e]['stories1'][$i]['uname']    = $article->getUname();
				$block['topics'][$e]['stories1'][$i]['realname'] = $article->getRealname();
				$block['topics'][$e]['stories1'][$i]['morelink'] = '';
	
				// 文字数カウント処理
				if ( $article->strlenBodytext() > 1 ) {
					$block['topics'][$e]['stories1'][$i]['bytes']    = sprintf(_MB_BYTESMORE, $article->strlenBodytext());
					$block['topics'][$e]['stories1'][$i]['readmore'] = true;
				}

				// コメントの数をアサイン
				$ccount = $article->getVar('comments');
				if( $ccount == 0 ){
					$block['topics'][$e]['stories1'][$i]['comentstotal'] = _MB_COMMENTS;
				}elseif( $ccount == 1 ) {
					$block['topics'][$e]['stories1'][$i]['comentstotal'] = _MB_ONECOMMENT;
				}else{
					$block['topics'][$e]['stories1'][$i]['comentstotal'] = sprintf(_MB_NUMCOMMENTS, $ccount);
				}
	
				// 管理者用のリンク
				$block['topics'][$e]['stories1'][$i]['adminlink'] = 0;
				
				// トピック画像
				if ( $article->showTopicimg()  ) {
					$block['topics'][$e]['stories1'][$i]['imglink'] = $article->imglink($bulletin_topicon_path);
					$block['topics'][$e]['stories1'][$i]['align']   = $article->getTopicalign();
				}
				
				$i++;
				
			}
		}
		//タイトルのみ表示する
		$limit = $options[1]-$options[4];
		if($limit > 0){
			$result2 = $xoopsDB->query($query2,$limit,$options[4]);
			while ( $myrow = $xoopsDB->fetchArray($result2) ) {
				
				$block['topics'][$e]['stories2'][] = b_bulletin_Ctop_format_story($myrow, $options);
			}
		}

		$e++;
	}

	$block['lang_postedby'] = _POSTEDBY;
	$block['lang_on'] = _ON;
	$block['lang_reads'] = _READS;
	$block['myurl'] = $myurl;
	$block['type'] = $options[0];

	return $block;
}

function b_bulletin_Ctop_edit($options) {
	$form = ""._MB_BULLETIN_ORDER."&nbsp;<select name='options[]'>";
	$form .= "<option value='published'";
	if ( $options[0] == 'published' ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_DATE."</option>\n";
	$form .= "<option value='counter'";
	if($options[0] == "counter"){
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_HITS."</option>\n";
	$form .= "</select>\n";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP."&nbsp;<input type='text' name='options[]' value='".$options[1]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[2]."' />&nbsp;"._MB_BULLETIN_LENGTH."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP_TOPICID."&nbsp;<input type='text' name='options[]' value='".$options[3]."' />&nbsp;"."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP_HOMETEXT."&nbsp;<input type='text' name='options[]' value='".$options[4]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";

	$form .= "<br>"._MB_BULLETIN_DIPS_ICON."&nbsp;<select name='options[]'>";
	$form .= "<option value='0'";
	if ( $options[5] == "0" ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._NO."</option>\n";
	$form .= "<option value='1'";
	if($options[5] == "1"){
		$form .= " selected='selected'";
	}
	$form .= ">"._YES."</option>\n";
	$form .= "</select>\n";

	return $form;
}

function b_bulletin_Ctop_format_story($aStory_array, $options){
	$myts =& MyTextSanitizer::getInstance();

	$news = array();
	$title = $myts->makeTboxData4Show($aStory_array["title"]);
	
	// マルチバイト環境に対応
	$title = $myts->makeTboxData4Show(xoops_substr($aStory_array['title'], 0 ,$options[2] + 3, '...'));
	
	$news['title'] = $title;
	if(!empty($aStory_array['hometext'])){
		$news['hometext'] = $myts->makeTareaData4Show($aStory_array['hometext']); // Ryuji_edit(2003-05-08)
		$news['id'] = $aStory_array['storyid'];
		if($aStory_array['bodytext']){
			$news['morelinkText'] = _MB_BULLETIN_MORE;
		}
	}
	$news['id'] = $aStory_array['storyid'];
	$news['date'] = formatTimestamp($aStory_array['published'],"s");
	$news['hits'] = $aStory_array['counter'];
	
	return $news;
}

}

?>