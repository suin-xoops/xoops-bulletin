<?php
function b_bulletin_category_new_show($options) {

	$mydirname = $options[0] ;

	require dirname( dirname( __FILE__ ) ).'/include/configs.inc.php';
	require_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
	
	$mytree = new XoopsTree($table_topics,'topic_id','topic_pid');

	$arr = array();
	// �롼�ȥ��ƥ�������륯����
	if( empty($options[4]) ){
		// ���롼�ȥ��ƥ��������
		$result = $xoopsDB->query("SELECT topic_id, topic_title, topic_imgurl FROM $table_topics WHERE topic_pid=0 ORDER BY topic_title");
	}else{
		// ���ꥫ�ƥ���Τ�
		$result = $xoopsDB->query("SELECT topic_id, topic_title, topic_imgurl FROM $table_topics WHERE topic_id=".$options[4]);
	}

	$block = array();

	while( list($topic_id, $topic_title, $topic_imgurl) = $xoopsDB->fetchRow($result) ){
		$topic = array();
		$topic['title'] = $myts->makeTboxData4Show($topic_title);
		$topic['id'] = $topic_id;

		// �ȥԥå������򥻥å�
		if ($topic_imgurl != '' && file_exists($bulletin_topicon_path.$topic_imgurl) && $options[6]) {
			$topic['topic_url'] = str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$bulletin_topicon_path).$topic_imgurl;
		}

		$where = sprintf("s.type > 0 AND s.published < %u AND s.published > 0 AND (s.expired = 0 OR s.expired > %1\$u) AND s.ihome = 1 AND(s.topicid=%u", time(), $topic_id);

		// �ҥǥ��쥯�ȥ���оݤ˴ޤ��
		$arr = $mytree->getAllChildId($topic_id);
		$size = count($arr);
		for($i=0;$i<$size;$i++){
			$where .= " OR s.topicid=".$arr[$i];
		}

		$where .= ")";
		$order = "ORDER BY ".$options[1]." DESC";

		// more �򥻥å�
		$sql = sprintf('SELECT COUNT(*) FROM %s s WHERE %s', $table_stories, $where);
		list($count) = $xoopsDB->fetchRow($xoopsDB->query($sql));
		if($count>$options[2]){
			$topic['morelink'] = 1;
		}

		// ��ʸ��ɽ������
		if($options[5] > 0){

			$sql  = sprintf('SELECT s.storyid, s.topicid, s.title, s.hometext, s.bodytext, s.published, s.expired, s.counter, s.comments, s.uid, s.topicimg, s.html, s.smiley, s.br, s.xcode, t.topic_title, t. topic_imgurl FROM %s s, %s t WHERE %s AND s.topicid = t.topic_id %s', $table_stories, $table_topics, $where, $order);

			$result2 = $xoopsDB->query($sql,$options[5],0);

			while ( $myrow = $xoopsDB->fetchArray($result2) ) {
				$fullstory['id']       = $myrow['storyid'];
				$fullstory['posttime'] = formatTimestamp($myrow['published']);
				$fullstory['topicid']  = $myrow['topicid'];
				$fullstory['topic']    = $myts->makeTboxData4Show($myrow['topic_title']);
				$fullstory['title']    = $myts->makeTboxData4Show($myrow['title']);
				$fullstory['text']     = $myts->displayTarea($myrow['hometext'],$myrow['html'],$myrow['smiley'],$myrow['xcode'],1,$myrow['br']);
				$fullstory['hits']     = $myrow['counter'];
				$fullstory['title_link'] = true;
				//�桼������򥢥�����
				$fullstory['uid']      = $myrow['uid'];
				$fullstory['uname']    = XoopsUser::getUnameFromId($myrow['uid']);
				$fullstory['realname'] = XoopsUser::getUnameFromId($myrow['uid'], 1);
				$fullstory['morelink'] = '';

				// ʸ����������Ƚ���
				if ( myStrlenText($myrow['bodytext']) > 1 ) {
					$fullstory['bytes']    = sprintf(_MB_BULLETIN_BYTESMORE, myStrlenText($myrow['bodytext']));
					$fullstory['readmore'] = true;
				}else{
					$fullstory['bytes']    = 0;
					$fullstory['readmore'] = false;
				}

				// �����Ȥο��򥢥�����
				$ccount = $myrow['comments'];
				if( $ccount == 0 ){
					$fullstory['comentstotal'] = _MB_BULLETIN_COMMENTS;
				}elseif( $ccount == 1 ) {
					$fullstory['comentstotal'] = _MB_BULLETIN_ONECOMMENT;
				}else{
					$fullstory['comentstotal'] = sprintf(_MB_BULLETIN_NUMCOMMENTS, $ccount);
				}

				// �������ѤΥ��
				$fullstory['adminlink'] = 0;

				// �ȥԥå�����
				if ( $myrow['topicimg'] ) {
					$fullstory['topic_url'] = makeTopicImgURL($bulletin_topicon_path, $myrow['topic_imgurl']);
					$fullstory['align']     = topicImgAlign($myrow['topicimg']);
				}

				$topic['fullstories'][] = $fullstory;

			}
		}

		if( $options[2] - $options[5] > 0 ){

			$sql  = sprintf('SELECT s.storyid, s.title, s.published, s.expired, s.counter, s.uid FROM %s s WHERE %s %s', $table_stories, $where, $order);

			$result3 = $xoopsDB->query($sql,$options[2]-$options[5],$options[5]);

			while ( $myrow = $xoopsDB->fetchArray($result3) ) {

				// �ޥ���Х��ȴĶ����б�
				$story['title']    = $myts->makeTboxData4Show(xoops_substr($myrow['title'], 0 ,$options[3] + 3, '...'));
				$story['id']       = $myrow['storyid'];
				$story['date']     = formatTimestamp($myrow['published'],"s");
				$story['hits']     = $myrow['counter'];
				$story['uid']      = $myrow['uid'];
				$story['uname']    = XoopsUser::getUnameFromId($myrow['uid']);
				$story['realname'] = XoopsUser::getUnameFromId($myrow['uid'], 1);

				$topic['stories'][] = $story;
			}

		}

		$block['topics'][] = $topic;
	}

	$block['lang_postedby'] = _POSTEDBY;
	$block['lang_on'] = _ON;
	$block['lang_reads'] = _READS;
	$block['lang_morelink'] = _MB_BULLETIN_MORE;
	$block['lang_readmore'] = _MB_BULLETIN_READMORE;
	$block['mydirurl'] = XOOPS_URL.'/modules/'.$mydirname;;
	$block['mydirname'] = $mydirname;
	$block['type'] = $options[1];

	return $block;
}

function b_bulletin_category_new_edit($options) {

	$form  = "<input type='hidden' name='options[]' value='".$options[0]."' />";
	$form .= ""._MB_BULLETIN_ORDER."&nbsp;<select name='options[]'>";
	$form .= "<option value='published'";
	if ( $options[1] == 'published' ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_DATE."</option>\n";
	$form .= "<option value='counter'";
	if($options[1] == "counter"){
		$form .= " selected='selected'";
	}
	$form .= ">"._MB_BULLETIN_HITS."</option>\n";
	$form .= "</select>\n";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP."&nbsp;<input type='text' name='options[]' value='".$options[2]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[3]."' />&nbsp;"._MB_BULLETIN_LENGTH."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP_TOPICID."&nbsp;<input type='text' name='options[]' value='".$options[4]."' />&nbsp;"."";
	$form .= "&nbsp;<br>"._MB_BULLETIN_DISP_HOMETEXT."&nbsp;<input type='text' name='options[]' value='".$options[5]."' />&nbsp;"._MB_BULLETIN_ARTCLS."";

	$form .= "<br>"._MB_BULLETIN_DIPS_ICON."&nbsp;<select name='options[]'>";
	$form .= "<option value='0'";
	if ( $options[6] == "0" ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._NO."</option>\n";
	$form .= "<option value='1'";
	if($options[6] == "1"){
		$form .= " selected='selected'";
	}
	$form .= ">"._YES."</option>\n";
	$form .= "</select>\n";

	return $form;
}
?>