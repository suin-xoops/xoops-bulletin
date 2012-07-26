<?php

if (!defined('XOOPS_ROOT_PATH'))exit();

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

require_once XOOPS_ROOT_PATH."/class/xoopstopic.php";
require_once XOOPS_ROOT_PATH."/class/xoopsuser.php";
require_once XOOPS_ROOT_PATH."/class/xoopsobject.php";

if (!defined('DB_BULLETIN_STORIES')) define('DB_BULLETIN_STORIES',"bulletin{$mydirnumber}_stories");
if (!defined('DB_BULLETIN_TOPICS')) define('DB_BULLETIN_TOPICS',"bulletin{$mydirnumber}_topics");
if (!defined('BULLETIN_DIR')) define('BULLETIN_DIR',$mydirname);

class Bulletin extends XoopsObject{
	
	// ����ȥ饹��
	function Bulletin($id=null)
	{
		$this->db =& Database::getInstance();
		$this->initVar("storyid",   XOBJ_DTYPE_INT,     null, false);
		$this->initVar("uid",       XOBJ_DTYPE_INT,     null, false);
		$this->initVar("title",     XOBJ_DTYPE_TXTBOX,  null, false, 255);
		$this->initVar("created",   XOBJ_DTYPE_INT,     null, false);
		$this->initVar("published", XOBJ_DTYPE_INT,     null, false);
		$this->initVar("expired",   XOBJ_DTYPE_INT,     null, false);
		$this->initVar("hostname",  XOBJ_DTYPE_TXTBOX,  null, false, 20);
		$this->initVar("html",      XOBJ_DTYPE_INT,     0,    false);
		$this->initVar("smiley",    XOBJ_DTYPE_INT,     1,    false);
		$this->initVar("br",        XOBJ_DTYPE_INT,     1,    false);
		$this->initVar("xcode",     XOBJ_DTYPE_INT,     1,    false);
		$this->initVar("hometext",  XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("bodytext",  XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("counter",   XOBJ_DTYPE_INT,     0,    false);
		$this->initVar("topicid",   XOBJ_DTYPE_INT,     1,    false);
		$this->initVar("ihome",     XOBJ_DTYPE_INT,     1,    false);
		$this->initVar("notifypub", XOBJ_DTYPE_INT,     0,    false);
		$this->initVar("type",      XOBJ_DTYPE_INT,     null, false);
		$this->initVar("topicimg",  XOBJ_DTYPE_INT,     null, false);
		$this->initVar("comments",  XOBJ_DTYPE_INT,     0,    false);
		if ( !empty($id) ) {
			if ( is_array($id) ) {
				$this->assignVars($id);
				$this->newstopic = $this->topic();
				$this->vars['dohtml']['value'] = $this->getVar('html');
				$this->vars['dosmiley']['value'] = $this->getVar('smiley');
				$this->vars['dobr']['value'] = $this->getVar('br');
				$this->vars['doxcode']['value'] = $this->getVar('xcode');
			} else {
				$this->load(intval($id));
				$this->newstopic = $this->topic();
				$this->vars['dohtml']['value'] = $this->getVar('html');
				$this->vars['dosmiley']['value'] = $this->getVar('smiley');
				$this->vars['dobr']['value'] = $this->getVar('br');
				$this->vars['doxcode']['value'] = $this->getVar('xcode');
			}
		}
		
	}
	
	// ���ܽ���
	function topic()
	{
		return new XoopsTopic($this->db->prefix(DB_BULLETIN_TOPICS), $this->getVar('topicid'));
	}
	
	// ���ܽ���
	function store()
	{
		if ( !$this->cleanVars() ) {
			return false;
		}
		
		foreach ( $this->cleanVars as $k=>$v ) {
			$$k = $v;
		}
		if ( empty($storyid) ) {
			$storyid = $this->db->genId($this->db->prefix(DB_BULLETIN_STORIES)."_storyid_seq");
			
			$sql = sprintf("INSERT INTO %s (storyid, uid, title, created, published, expired, hostname, html, smiley, hometext, bodytext, counter, topicid, ihome, notifypub, type, topicimg, comments, br, xcode) VALUES (%u, %u, %s, %u, %u, %u, %s, %u, %u, %s, %s, %u, %u, %u, %u, %u, %u, %u, %u, %u)", $this->db->prefix(DB_BULLETIN_STORIES), $storyid, $uid, $this->db->quoteString($title), time(), $published, $expired, $this->db->quoteString($hostname), $html, $smiley, $this->db->quoteString($hometext), $this->db->quoteString($bodytext), $counter, $topicid, $ihome, $notifypub, $type, $topicimg, $comments, $br, $xcode);
		} else {
			$sql = sprintf("UPDATE %s SET uid=%u, title=%s, created=%u, published=%u, expired=%u, hostname=%s, html=%u, smiley=%u, hometext=%s, bodytext=%s, counter=%u, topicid=%u, ihome=%u, notifypub=%u, type=%u, topicimg=%u, comments=%u, br=%u, xcode=%u WHERE storyid=%u", $this->db->prefix(DB_BULLETIN_STORIES), $uid, $this->db->quoteString($title), $created, $published, $expired, $this->db->quoteString($hostname), $html, $smiley, $this->db->quoteString($hometext), $this->db->quoteString($bodytext), $counter, $topicid, $ihome, $notifypub, $type, $topicimg, $comments, $br, $xcode, $storyid);
		}
		//echo $sql;
		if ( !$result = $this->db->query($sql) ) {
			$this->setErrors("Could not store data in the database.");
			return false;
		}
		if ( empty($storyid) ) {
			$storyid = $this->db->getInsertId();
		}
		
		$this->setVar('storyid', $storyid);
		
		return $storyid;
	}
	
	// ���ܽ���
	function load($id)
	{
		$sql = "SELECT * FROM ".$this->db->prefix(DB_BULLETIN_STORIES)." WHERE storyid=".$id."";
		$myrow = $this->db->fetchArray($this->db->query($sql));
		$this->assignVars($myrow);
	}
	
	// ���ܽ���
	function delete()
	{
		$sql = sprintf("DELETE FROM %s WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $this->getVar("storyid"));
        	if ( !$this->db->query($sql) ) {
			return false;
		}
		return true;
	}
	
	// ���ܽ���
	function &getAll($criteria=array(), $asobject=true, $orderby="published DESC", $limit=0, $start=0)
	{
		$db =& Database::getInstance();
		$ret = array();
		$where_query = "";
		if ( is_array($criteria) && count($criteria) > 0 ) {
			$where_query = " WHERE";
			foreach ( $criteria as $c ) {
				$where_query .= " $c AND";
			}
			$where_query = substr($where_query, 0, -4);
		}
		if ( !$asobject ) {
			$sql = "SELECT storyid FROM ".$db->prefix(DB_BULLETIN_STORIES)."$where_query ORDER BY $orderby";
			$result = $db->query($sql,intval($limit),intval($start));
			while ( $myrow = $db->fetchArray($result) ) {
				$ret[] = $myrow['storyid'];
			}
		} else {
			$sql = "SELECT * FROM ".$db->prefix(DB_BULLETIN_STORIES)."".$where_query." ORDER BY $orderby";
			$result = $db->query($sql,$limit,$start);
			while ( $myrow = $db->fetchArray($result) ) {
				$ret[] = new Bulletin($myrow);
			}
		}
		//echo $sql;
		return $ret;
	}

	// ���ܽ���
	function &countAll($criteria=array())
	{
		$db =& Database::getInstance();
		$where_query = "";
		if ( is_array($criteria) && count($criteria) > 0 ) {
			$where_query = " WHERE";
			foreach ( $criteria as $c ) {
				$where_query .= " $c AND";
			}
			$where_query = substr($where_query, 0, -4);
		}
		
		$sql = "SELECT COUNT(*) FROM ".$db->prefix(DB_BULLETIN_STORIES)."".$where_query;
		$result = $db->query($sql);
		list($ret) = $db->fetchRow($result);
		
		//echo $sql;
		return $ret;
	}
	
	// �Ǻ���ε������������
	function getAllPublished($limit4sql=0, $start4sql=0, $topic4sql=0, $ihome=1, $asobject=true)
	{
		$topic4sql = intval($topic4sql);
		$limit4sql = intval($limit4sql);
		$start4sql = intval($start4sql);
				
		$criteria = array();
		$criteria[] = "published > 0";
		$criteria[] = "published <= ".time();
		$criteria[] = "(expired = 0 OR expired > ".time().")";
		
		if ( !empty($topic4sql) ) {
			$criteria[] = "topicid=$topic4sql";
			$criteria[] = "(ihome=1 OR ihome=0)";
		} else {
			if ( $ihome == 1 ) {
				$criteria[] = "ihome=1";
			}
		}

		return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, $start4sql);
	}
	
	// �����������ѵ������������
	function getArchives($monstart4sql=null, $monend4sql=null, $limit4sql=0, $start4sql=0, $asobject=true)
	{
		$monstart4sql = intval($monstart4sql);
		$monend4sql   = intval($monend4sql);
		$limit4sql    = intval($limit4sql);
		$start4sql    = intval($start4sql);
				
		$criteria = array();
		$criteria[] = "published > $monstart4sql";
		$criteria[] = "published < $monend4sql";		
		$criteria[] = "published > 0";
		$criteria[] = "published <= ".time();
		$criteria[] = "(expired = 0 OR expired > ".time().")";
		return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, $start4sql);
	}
	
	// ��ǧ�Ԥ��ε������������
	function getAllSubmitted($limit4sql=0, $asobject=true)
	{
		$limit4sql = intval($limit4sql);

		$criteria = array();
		$criteria[] = "published=0";
		return Bulletin::getAll($criteria, $asobject, "created DESC", $limit4sql, 0);
	}
	
	// �Ǻ�ͽ��ε������������
	function getAllAutoStory($limit4sql=0, $asobject=true)
	{
		$limit4sql = intval($limit4sql);

		$criteria = array();
		$criteria[] = "published > ".time();
		return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, 0);
	}
	
	// �����ڤ�ε������������
	function getAllExpired($limit4sql=0, $start4sql=0, $topic4sql=0, $ihome=0, $asobject=true)
	{
		$limit4sql = intval($limit4sql);
		$start4sql = intval($start4sql);
		$topic4sql = intval($topic4sql);

		$criteria = array();
		$criteria[] = "expired <= ".time();
		$criteria[] = "expired > 0";
		if ( !empty($topic4sql) ) {
			$criteria[] = "topicid=$topic4sql";
			$criteria[] = "(ihome=1 OR ihome=0)";
		} else {
			if ( $ihome == 1 ) {
				$criteria[] = "ihome=1";
			}
		}
		return Bulletin::getAll($criteria, $asobject, "expired DESC", $limit4sql, $start4sql);
	}
	
	// ���դ��Ȥ˵������������
	function getAllToday($limit4sql=0, $start4sql=0, $caldate, $asobject=true)
	{
		$limit4sql    = intval($limit4sql);
		$start4sql    = intval($start4sql);
		
		if( preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $caldate, $datearr) ){
			$year  = $datearr[1];
			$month = $datearr[2];
			$day   = $datearr[3];
			$startday4sql = mktime(0,0,0,$month,$day,$year);
			$endday4sql   = mktime(0,0,0,$month,$day+1,$year);
			
			$criteria = array();
			$criteria[] = "published > 0";
			$criteria[] = "published <= ".time();
			$criteria[] = "(expired = 0 OR expired > ".time().")";
			$criteria[] = "$startday4sql <= published";
			$criteria[] = "published < $endday4sql";

			return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, $start4sql);
		}else{
		
			return false;
		}
	}

	// �ȥԥå���°���뵭�����٤Ƥ����
	function getAllByTopic($topicid)
	{
		$criteria = array();
		$criteria[] = "topicid=".intval($topicid);
		return Bulletin::getAll($criteria, true);
	}

	// �ȥԥå��������������
	function imglink($topic_path)
	{
		if ($this->newstopic->topic_imgurl() != '' && file_exists($topic_path.$this->newstopic->topic_imgurl())) {
			return str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$topic_path).$this->newstopic->topic_imgurl();
		}
		return false;
	}

	// �桼������̾���������
	function getRealname()
	{
		return XoopsUser::getUnameFromId($this->getVar('uid'), 1);
	}
	
	// uname���������
	function getUname()
	{
		return XoopsUser::getUnameFromId($this->getVar('uid'));
	}
	
	// �桼����¸�ߤ��뤫
	function isActiveUser()
	{
		$uid = $this->getVar('uid');
		$member_handler =& xoops_gethandler('member');
		$thisUser =& $member_handler->getUser($uid);
		if (!is_object($thisUser) || !$thisUser->isActive() ) {
			return false;
		}
		return true;
	}
	
	// �ȥԥå������ΰ��֤����
	function getTopicalign()
	{
		$ret = "";
		
		if( $this->getVar('topicimg') == 1 ){
			$ret = "right";
		}elseif( $this->getVar('topicimg') == 2 ){
			$ret = "left";
		}
		
		return $ret;
	}
	
	// �ȥԥå�������ɽ�����뤫�ɤ���
	function showTopicimg()
	{
		
		if( $this->getVar('topicimg') == 1 ){
			return true;
		}elseif( $this->getVar('topicimg') == 2 ){
			return true;
		}
		
		return false;
	}
	
	// �ȥԥå��Υ����ȥ�����
	function topic_title()
	{
		return $this->newstopic->topic_title();
	}
	
	// ��������û�
	function updateCounter()
	{
		$sql = sprintf("UPDATE %s SET counter = counter+1 WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $this->getVar('storyid'));
		//echo $sql;
		if ( !$result = $this->db->queryF($sql) ) {
			return false;
		}
		return true;
	}
	
	// hometext������
	function hometext()
	{
		$html = 1;
		$xcodes = 1;
		return $this->getVar('hometext', 'show');
	}
	
	// ������¸�ߤ��뤫�ɤ���
	function isPublishedExists($storyid=0)
	{
		$storyid = intval($storyid);
		
		if( empty($storyid) ){
			return false;
		}
		
		$db =& Database::getInstance();
		$sql = "SELECT COUNT(*) FROM ".$db->prefix(DB_BULLETIN_STORIES)." WHERE published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().") AND storyid =".$storyid;
		$result = $db->query($sql);
		list($count) = $db->fetchRow($result);
		
		if( $count > 0 ){
			return true;
		}
		
		return false;
	}
	
	// �ȥԥå��Υ��쥯�ȥܥå������֤�
	function makeTopicSelBox($none=0, $seltopic=-1, $selname="", $onchange=""){
	
		$db =& Database::getInstance();
		$xt = new XoopsTopic($db->prefix(DB_BULLETIN_TOPICS));
		
		ob_start();
		$xt->makeTopicSelBox($none=0, $seltopic, $selname, $onchange);
		$ret = ob_get_contents();
		ob_end_clean();	
		
		$ret = str_replace('topic_id','topicid', $ret);
		
		return $ret;
	}
	
	// �Ǻ���ε������������
	function countPublished($topicid=0)
	{
		$criteria = array();
		$criteria[] = 'published > 0';
		$criteria[] = 'published <= '.time();
		$criteria[] = '(expired = 0 OR expired > '.time().')';
		if ( !empty($topicid) ) {
			$criteria[] = 'topicid='.intval($topicid);
		} else {
			$criteria[] = 'ihome=1';
		}
		return Bulletin::countAll($criteria);
	}
	
	// ��ǧ�Ԥ��ε������������
	function countSubmitted()
	{
		$criteria = array();
		$criteria[] = "published=0";
		return Bulletin::countAll($criteria);
	}
	
	// �Ǻ�ͽ��ε������������
	function countAutoStory()
	{
		$criteria = array();
		$criteria[] = "published > ".time();
		return Bulletin::countAll($criteria);
	}
	
	// �����ڤ�ε������������
	function countExpired($topic4sql=0, $ihome=0)
	{
		$topic4sql = intval($topic4sql);
		
		$criteria = array();
		$criteria[] = "expired <= ".time();
		$criteria[] = "expired > 0";
		if ( !empty($topic4sql) ) {
			$criteria[] = "topicid=$topic4sql";
			$criteria[] = "(ihome=1 OR ihome=0)";
		} else {
			if ( $ihome == 0 ) {
				$criteria[] = "ihome=0";
			}
		}
		return Bulletin::countAll($criteria);
	}
	
	// �������ε������������
	function countPublishedByDate($caldate)
	{
		if( preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $caldate, $datearr) ){
			$year  = $datearr[1];
			$month = $datearr[2];
			$day   = $datearr[3];
			$startday4sql = mktime(0,0,0,$month,$day,$year);
			$endday4sql   = mktime(0,0,0,$month,$day+1,$year);
			
			$criteria = array();
			$criteria[] = 'published > 0';
			$criteria[] = 'published <= '.time();
			$criteria[] = '(expired = 0 OR expired > '.time().')';
			$criteria[] = $startday4sql.' <= published';
			$criteria[] = 'published < '.$endday4sql;
			return Bulletin::countAll($criteria);
		}
		
		return false;
	}
	
	// �����ȿ���û�
	function updateComments($total)
	{
		$sql = sprintf("UPDATE %s SET comments = %u WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $total, $this->getVar('storyid'));
		if ( !$result = $this->db->queryF($sql) ) {
			return false;
		}
		return true;
	}
	
	// ��������ƤΥ����ॹ����פ�������֤�
	function getPublishedDays($limit=0, $start=0)
	{
		$db =& Database::getInstance();
		$sql = "SELECT published FROM ".$db->prefix(DB_BULLETIN_STORIES)." WHERE published>0 AND published<=".time()." AND expired <= ".time()." ORDER BY published ASC";
		$result = $db->query($sql,intval($limit),intval($start));
		$ret = array();
		while ( list($myrow) = $db->fetchRow($result) ) {
			$ret[] = $myrow;
		}
		return $ret;
	}
	
	// hometext ��ʸ�����򥫥���Ȥ���
	function strlenHometext(){
		
		// HTML��������
		$hometext = strip_tags($this->getVar('hometext'));
		// HTML�ü�ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$hometext = ereg_replace("&[a-zA-Z]{1,5};", " ", $hometext);
		// Unicode10��ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$hometext = ereg_replace("&#[0-9]{1,5};", " ", $hometext);
		// PHP�ޥ���Х����б�
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($hometext);
		}else{
			$result = strlen($hometext);
		}
		
		return $result;
	
	}
	
	// bodytext ��ʸ�����򥫥���Ȥ���
	function strlenBodytext(){
		
		// HTML��������
		$bodytext = strip_tags($this->getVar('bodytext'));
		// HTML�ü�ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$bodytext = ereg_replace("&[a-zA-Z]{1,5};", " ", $bodytext);
		// Unicode10��ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$bodytext = ereg_replace("&#[0-9]{1,5};", " ", $bodytext);
		// [pagebreak]�򥫥�����оݳ��ˤ���
		$bodytext = str_replace('[pagebreak]', '', $bodytext);
		// PHP�ޥ���Х����б�
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($bodytext);
		}else{
			$result = strlen($bodytext);	
		}
		
		return $result;
	}
	
	// hometext �� bodytext ��ʸ���������¤����
	function strlenHomeAndBody(){
	
		return $this->strlenHometext() + $this->strlenBodytext();
	
	}
	
	// [pagebreak]��Ǥ�դ�ʸ������Ѵ�����
	function getDividedBodytext($dividing_str = '<br style="page-break-after:always;" />'){
	
		return str_replace('[pagebreak]', $dividing_str, $this->getVar('bodytext'));
	
	}
}
?>