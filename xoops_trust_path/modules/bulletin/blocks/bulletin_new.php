<?php

function b_bulletin_new_show($options) {

	$mydirname = $options[0] ;

	require dirname( dirname( __FILE__ ) ).'/include/configs.inc.php';

	$module_handler  =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
		
	$block = array();

	// 
	if($options[4] > 0){

		$sql  = sprintf('SELECT s.storyid, s.topicid, s.title, s.hometext, s.bodytext, s.published, s.expired, s.counter, s.comments, s.uid, s.topicimg, s.html, s.smiley, s.br, s.xcode, t.topic_title, t. topic_imgurl FROM %s s, %s t WHERE s.type > 0 AND s.published < %u AND s.published > 0 AND (s.expired = 0 OR s.expired > %3$u) AND s.topicid = t.topic_id AND s.ihome = 1 ORDER BY %s DESC', $table_stories, $table_topics, time(), $options[1]);

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
			//
			$fullstory['uid']      = $myrow['uid'];
			$fullstory['uname']    = XoopsUser::getUnameFromId($myrow['uid']);
			$fullstory['realname'] = XoopsUser::getUnameFromId($myrow['uid'], 1);
			$fullstory['morelink'] = '';
		
			//
			if ( myStrlenText($myrow['bodytext']) > 1 ) {
				$fullstory['bytes']    = sprintf(_MB_BULLETIN_BYTESMORE, myStrlenText($myrow['bodytext']));
				$fullstory['readmore'] = true;
			}else{
				$fullstory['bytes']    = 0;
				$fullstory['readmore'] = false;
			}
	
			//
			$ccount = $myrow['comments'];
			if( $ccount == 0 ){
				$fullstory['comentstotal'] = _MB_BULLETIN_COMMENTS;
			}elseif( $ccount == 1 ) {
				$fullstory['comentstotal'] = _MB_BULLETIN_ONECOMMENT;
			}else{
				$fullstory['comentstotal'] = sprintf(_MB_BULLETIN_NUMCOMMENTS, $ccount);
			}
		
			//
			$fullstory['adminlink'] = 0;
		
			// 
			if ( $myrow['topicimg'] ) {
				$fullstory['topic_url'] = makeTopicImgURL($bulletin_topicon_path, $myrow['topic_imgurl']);
				$fullstory['align']     = topicImgAlign($myrow['topicimg']);
			}

			$block['fullstories'][] = $fullstory;

		}
	}

	if( $options[2] - $options[4] > 0 ){

		$sql  = sprintf('SELECT storyid, title, published, expired, counter, uid FROM %s WHERE type > 0 AND published < %u AND published > 0 AND (expired = 0 OR expired > %2$u) AND ihome = 1 ORDER BY %s DESC', $table_stories, time(), $options[1]);

		$result = $xoopsDB->query($sql,$options[2]-$options[4],$options[4]);

		while ( $myrow = $xoopsDB->fetchArray($result) ) {
			$story = array();

			// 
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
	$block['lang_readmore'] = _MB_BULLETIN_READMORE;
	$block['type']  = $options[1];
	$block['mydirurl'] = XOOPS_URL.'/modules/'.$mydirname;;
	$block['mydirname'] = $mydirname;

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

?>