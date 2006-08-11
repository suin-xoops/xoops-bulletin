<?php

require_once XOOPS_ROOT_PATH."/class/xoopstopic.php";

if (!defined('DB_BULLETIN_STORIES')) define('DB_BULLETIN_STORIES',"{$mydirname}_stories");
if (!defined('DB_BULLETIN_TOPICS')) define('DB_BULLETIN_TOPICS',"{$mydirname}_topics");
if (!defined('BULLETIN_DIR')) define('BULLETIN_DIR',$mydirname);

class BulletinTopic extends XoopsTopic{
	
	function BulletinTopic($topicid=0)
	{
		$this->db =& Database::getInstance();
		$this->table = $this->db->prefix(DB_BULLETIN_TOPICS);
		$this->ts =& MyTextSanitizer::getInstance();
		
		if ( is_array($topicid) ) {
			$this->makeTopic($topicid);
		} elseif ( $topicid != 0 ) {
			$this->getTopic(intval($topicid));
		} else {
			$this->topic_id = $topicid;
		}
	}

	function topicExists() 
	{
		$sql = "SELECT COUNT(*) from ".$this->table;
		$result = $this->db->query($sql);
		list($count) = $this->db->fetchRow($result);
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	function makePankuzu($topic_id=0, $ret = array())
	{
		$result = ( "SELECT `topic_pid`, `topic_title` FROM ".$this->db->prefix(DB_BULLETIN_TOPICS)." WHERE `topic_id` = ".intval($topic_id) );
		$result = $this->db->query($result);
		list($topic_pid, $topic_title) = $this->db->fetchRow($result);
		$ret[] = array('topic_id' => $topic_id, 'topic_title' => $topic_title);
		if($topic_pid > 0){
			$ret = $this->makePankuzu($topic_pid, $ret);
		}else{
			$ret = array_reverse($ret);
		}

		return $ret;

	}

	function makePankuzuForHTML($topic_id=0)
	{
		$pankuzu = $this->makePankuzu($topic_id);
		foreach($pankuzu as $k => $v){
			$pankuzu[$k]['topic_title'] = $this->ts->htmlSpecialChars($pankuzu[$k]['topic_title']);
		}
		return $pankuzu;
	}

}
?>