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


}
?>