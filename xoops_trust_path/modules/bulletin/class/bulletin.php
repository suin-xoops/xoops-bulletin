<?php

require_once XOOPS_ROOT_PATH."/class/xoopstopic.php";
require_once XOOPS_ROOT_PATH."/class/xoopsuser.php";
require_once XOOPS_ROOT_PATH."/class/xoopsobject.php";
require_once "$mytrustdirpath/class/relation.php";
require_once "$mytrustdirpath/class/bulletinTopic.php";

if (!defined('DB_BULLETIN_STORIES')) define('DB_BULLETIN_STORIES',"{$mydirname}_stories");
if (!defined('DB_BULLETIN_TOPICS')) define('DB_BULLETIN_TOPICS',"{$mydirname}_topics");
if (!defined('BULLETIN_DIR')) define('BULLETIN_DIR',$mydirname);

class Bulletin extends XoopsObject{

	var $relation ;

	// コントラスタ
	function Bulletin($id=null)
	{
		$this->db =& Database::getInstance();
		$this->initVar("storyid", XOBJ_DTYPE_INT, null, false);
		$this->initVar("uid", XOBJ_DTYPE_INT, null, false);
		$this->initVar("title", XOBJ_DTYPE_TXTBOX, null, false, 255);
		$this->initVar("created", XOBJ_DTYPE_INT, null, false);
		$this->initVar("published", XOBJ_DTYPE_INT, null, false);
		$this->initVar("expired", XOBJ_DTYPE_INT, null, false);
		$this->initVar("hostname", XOBJ_DTYPE_TXTBOX, null, false, 20);
		$this->initVar("html", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("smiley", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("br", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("xcode", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("hometext", XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("bodytext", XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("counter", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("topicid", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("ihome", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("type", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("topicimg", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("comments", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("block", XOBJ_DTYPE_INT, 1, false);
		//extra
		$this->initVar("notifypub", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("autodate", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("autoexpdate", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("approve", XOBJ_DTYPE_INT, 0, false);
		$this->initVar("text", XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("dirname", XOBJ_DTYPE_TXTBOX, null, false, 25);

		$this->relation = new relation(BULLETIN_DIR);
		$this->topics = new BulletinTopic();

		if ( !empty($id) ) {
			if ( is_array($id) ) {
				$this->assignVars($id);
				$this->newstopic = $this->topic();
				$this->vars['dohtml']['value'] = $this->getVar('html');
				$this->vars['dosmiley']['value'] = $this->getVar('smiley');
				$this->vars['dobr']['value'] = $this->getVar('br');
				$this->vars['doxcode']['value'] = $this->getVar('xcode');
				$this->vars['dohtml']['changed'] = false;
				$this->vars['dosmiley']['changed'] = false;
				$this->vars['dobr']['changed'] = false;
				$this->vars['doxcode']['changed'] = false;
			} else {
				$this->load(intval($id));
				$this->newstopic = $this->topic();
				$this->vars['dohtml']['value'] = $this->getVar('html');
				$this->vars['dosmiley']['value'] = $this->getVar('smiley');
				$this->vars['dobr']['value'] = $this->getVar('br');
				$this->vars['doxcode']['value'] = $this->getVar('xcode');
				$this->vars['dohtml']['changed'] = false;
				$this->vars['dosmiley']['changed'] = false;
				$this->vars['dobr']['changed'] = false;
				$this->vars['doxcode']['changed'] = false;
			}
		}
		
	}
	
	// 基本処理
	function topic()
	{
		return new XoopsTopic($this->db->prefix(DB_BULLETIN_TOPICS), $this->getVar('topicid'));
	}
	
	// 基本処理
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
			
			$sql = sprintf("INSERT INTO %s (storyid, uid, title, created, published, expired, hostname, html, smiley, hometext, bodytext, counter, topicid, ihome, type, topicimg, comments, br, xcode, block) VALUES (%u, %u, %s, %u, %u, %u, %s, %u, %u, %s, %s, %u, %u, %u, %u, %u, %u, %u, %u, %u)", $this->db->prefix(DB_BULLETIN_STORIES), $storyid, $uid, $this->db->quoteString($title), time(), $published, $expired, $this->db->quoteString($hostname), $html, $smiley, $this->db->quoteString($hometext), $this->db->quoteString($bodytext), $counter, $topicid, $ihome, $type, $topicimg, $comments, $br, $xcode, $block);
		} else {
			$sql = sprintf("UPDATE %s SET uid=%u, title=%s, created=%u, published=%u, expired=%u, hostname=%s, html=%u, smiley=%u, hometext=%s, bodytext=%s, counter=%u, topicid=%u, ihome=%u, type=%u, topicimg=%u, comments=%u, br=%u, xcode=%u, block=%u WHERE storyid=%u", $this->db->prefix(DB_BULLETIN_STORIES), $uid, $this->db->quoteString($title), $created, $published, $expired, $this->db->quoteString($hostname), $html, $smiley, $this->db->quoteString($hometext), $this->db->quoteString($bodytext), $counter, $topicid, $ihome, $type, $topicimg, $comments, $br, $xcode, $block, $storyid);
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
	
	// 基本処理
	function load($id)
	{
		$sql = "SELECT * FROM ".$this->db->prefix(DB_BULLETIN_STORIES)." WHERE storyid=".intval($id)."";
		$myrow = $this->db->fetchArray($this->db->query($sql));
		$this->assignVars($myrow);
	}
	
	// 基本処理
	function delete()
	{
		$sql = sprintf("DELETE FROM %s WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $this->getVar("storyid"));
        	if ( !$this->db->query($sql) ) {
			return false;
		}
		return true;
	}
	
	// 基本処理
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

	// 基本処理
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
	
	// 掲載中の記事一覧を取得
	function getAllPublished($limit4sql=0, $start4sql=0, $topic4sql=0, $ihome=1, $asobject=true)
	{
		$topic4sql = intval($topic4sql);
		$limit4sql = intval($limit4sql);
		$start4sql = intval($start4sql);
				
		$criteria = array();
		$criteria[] = "type > 0";
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
	
	// アーカイブ用記事一覧を取得
	function getArchives($monstart4sql=null, $monend4sql=null, $limit4sql=0, $start4sql=0, $asobject=true)
	{
		$monstart4sql = intval($monstart4sql);
		$monend4sql   = intval($monend4sql);
		$limit4sql    = intval($limit4sql);
		$start4sql    = intval($start4sql);
				
		$criteria = array();
		$criteria[] = "type > 0";
		$criteria[] = "published > $monstart4sql";
		$criteria[] = "published < $monend4sql";		
		$criteria[] = "published > 0";
		$criteria[] = "published <= ".time();
		$criteria[] = "(expired = 0 OR expired > ".time().")";
		return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, $start4sql);
	}
	
	// 承認待ちの記事一覧を取得
	function getAllSubmitted($limit4sql=0, $asobject=true)
	{
		$limit4sql = intval($limit4sql);

		$criteria = array();
		$criteria[] = "type = 0";
		return Bulletin::getAll($criteria, $asobject, "created DESC", $limit4sql, 0);
	}
	
	// 掲載予定の記事一覧を取得
	function getAllAutoStory($limit4sql=0, $asobject=true)
	{
		$limit4sql = intval($limit4sql);

		$criteria = array();
		$criteria[] = "type > 0";
		$criteria[] = "published > ".time();
		return Bulletin::getAll($criteria, $asobject, "published DESC", $limit4sql, 0);
	}
	
	// 期限切れの記事一覧を取得
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
	
	// 日付をもとに記事一覧を取得
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

	// トピックに属する記事すべてを取得
	function getAllByTopic($topicid)
	{
		$criteria = array();
		$criteria[] = "topicid=".intval($topicid);
		return Bulletin::getAll($criteria, true);
	}

	// トピック画像を取得する
	function imglink($topic_path)
	{
		if ($this->newstopic->topic_imgurl() != '' && file_exists($topic_path.$this->newstopic->topic_imgurl())) {
			return str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$topic_path).$this->newstopic->topic_imgurl();
		}
		return false;
	}

	// ユーザの本名を取得する
	function getRealname()
	{
		return XoopsUser::getUnameFromId($this->getVar('uid'), 1);
	}
	
	// unameを取得する
	function getUname()
	{
		return XoopsUser::getUnameFromId($this->getVar('uid'));
	}
	
	// ユーザが存在するか
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
	
	// トピック画像の位置を取得
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
	
	// トピック画像を表ｦするかどうか
	function showTopicimg()
	{
		
		if( $this->getVar('topicimg') == 1 ){
			return true;
		}elseif( $this->getVar('topicimg') == 2 ){
			return true;
		}
		
		return false;
	}
	
	// トピックのタイトルを取得
	function topic_title()
	{
		return $this->newstopic->topic_title();
	}
	
	// 閲覧数を加算
	function updateCounter()
	{
		$sql = sprintf("UPDATE %s SET counter = counter+1 WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $this->getVar('storyid'));
		//echo $sql;
		if ( !$result = $this->db->queryF($sql) ) {
			return false;
		}
		return true;
	}
	
	// hometextを得る
	function hometext()
	{
		$html = 1;
		$xcodes = 1;
		return $this->getVar('hometext', 'show');
	}
	
	// 記事が存在するかどうか
	function isPublishedExists($storyid=0)
	{
		$storyid = intval($storyid);
		
		if( empty($storyid) ){
			return false;
		}
		
		$db =& Database::getInstance();
		$sql = "SELECT COUNT(*) FROM ".$db->prefix(DB_BULLETIN_STORIES)." WHERE type > 0 AND published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().") AND storyid =".$storyid;
		$result = $db->query($sql);
		list($count) = $db->fetchRow($result);
		
		if( $count > 0 ){
			return true;
		}
		
		return false;
	}

	// トピックのセレクトボックスを返す
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

	function getTreeCategories($topic_pid = 0, $so = 0 ,$cat_tree = array()){
	
		$db =& Database::getInstance();

		$result = ( "SELECT `topic_id`, `topic_title` FROM ".$db->prefix(DB_BULLETIN_TOPICS)." WHERE `topic_pid` = '$topic_pid'" );
		$result = $db->query($result);
		while(list($topic_id, $topic_title) = $db->fetchRow($result) ){
			$cat_tree[] = array( 'topic_id' => $topic_id, 'title' => $topic_title, 'fukasa' => $so );
			$result2 = $db->query( "SELECT COUNT(*) FROM ".$db->prefix(DB_BULLETIN_TOPICS)." WHERE `topic_pid` = '$topic_id'" );
			list($count) = $db->fetchRow($result2);
			if($count > 0){
				$cat_tree = Bulletin::getTreeCategories($topic_id, $so+1, $cat_tree);
			}
		}
		return $cat_tree;

	}

	function makeCategoryArrayForSelect($pad_string = '--'){

		$ts =& MyTextSanitizer::getInstance();
		$cat_tree = Bulletin::getTreeCategories();
		$ret = array();
		foreach($cat_tree as $cat){
			$ret[$cat['topic_id']] = str_repeat($pad_string, $cat['fukasa']).' '.$ts->htmlspecialchars($cat['title']);
		}
		return $ret;
	}

	// 掲載中の記事数を数える
	function countPublished($topicid=0)
	{
		$criteria = array();
		$criteria[] = 'type > 0';
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
	
	// 承認待ちの記事数を数える
	function countSubmitted()
	{
		$criteria = array();
		$criteria[] = "type=0";
		return Bulletin::countAll($criteria);
	}
	
	// 掲載予定の記事数を数える
	function countAutoStory()
	{
		$criteria = array();
		$criteria[] = 'type > 0';
		$criteria[] = "published > ".time();
		return Bulletin::countAll($criteria);
	}
	
	// 期限切れの記事数を数える
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
			if ( $ihome == 1 ) {
				$criteria[] = "ihome=1";
			}
		}
		return Bulletin::countAll($criteria);
	}
	
	// その日の記事数を数える
	function countPublishedByDate($caldate)
	{
		if( preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $caldate, $datearr) ){
			$year  = $datearr[1];
			$month = $datearr[2];
			$day   = $datearr[3];
			$startday4sql = mktime(0,0,0,$month,$day,$year);
			$endday4sql   = mktime(0,0,0,$month,$day+1,$year);
			
			$criteria = array();
			$criteria[] = 'type > 0';
			$criteria[] = 'published > 0';
			$criteria[] = 'published <= '.time();
			$criteria[] = '(expired = 0 OR expired > '.time().')';
			$criteria[] = $startday4sql.' <= published';
			$criteria[] = 'published < '.$endday4sql;
			return Bulletin::countAll($criteria);
		}
		
		return false;
	}
	
	// コメント数を加算
	function updateComments($total)
	{
		$sql = sprintf("UPDATE %s SET comments = %u WHERE storyid = %u", $this->db->prefix(DB_BULLETIN_STORIES), $total, $this->getVar('storyid'));
		if ( !$result = $this->db->queryF($sql) ) {
			return false;
		}
		return true;
	}
	
	// 記事が投稿のタイムスタンプを配列で返す
	function getPublishedDays($limit=0, $start=0)
	{
		$db =& Database::getInstance();
		$sql = "SELECT published FROM ".$db->prefix(DB_BULLETIN_STORIES)." WHERE type > 0 AND published>0 AND published<=".time()." AND expired <= ".time()." ORDER BY published ASC";
		$result = $db->query($sql,intval($limit),intval($start));
		$ret = array();
		while ( list($myrow) = $db->fetchRow($result) ) {
			$ret[] = $myrow;
		}
		return $ret;
	}
	
	// hometext の文字数をカウントする
	function strlenHometext(){
		
		// HTMLタグを削除
		$hometext = strip_tags($this->getVar('hometext'));
		// 改行を削除
		$hometext = preg_replace("/(\015\012)|(\015)|(\012)/", "", $hometext);
		// 連続する半角スペースを半角スペース１としてカウント
		$hometext = preg_replace('!\s+!', " ", $hometext);
		// HTML特殊文字を半角1文字としてカウント
		$hometext = ereg_replace("&[a-zA-Z]{1,5};", " ", $hometext);
		// Unicode10進文字を半角1文字としてカウント
		$hometext = ereg_replace("&#[0-9]{1,5};", " ", $hometext);
		// PHPマルチバイト対応
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($hometext);
		}else{
			$result = strlen($hometext);
		}
		
		return $result;
	
	}
	
	// bodytext の文字数をカウントする
	function strlenBodytext(){
		
		// HTMLタグを削除
		$bodytext = strip_tags($this->getVar('bodytext'));
		// 改行を削除
		$bodytext = preg_replace("/(\015\012)|(\015)|(\012)/", "", $bodytext);
		// 連続する半角スペースを半角スペース１としてカウント
		$bodytext = preg_replace('!\s+!', " ", $bodytext);
		// HTML特殊文字を半角1文字としてカウント
		$bodytext = ereg_replace("&[a-zA-Z]{1,5};", " ", $bodytext);
		// Unicode10進文字を半角1文字としてカウント
		$bodytext = ereg_replace("&#[0-9]{1,5};", " ", $bodytext);
		// [pagebreak]をカウント対象外にする
		$bodytext = str_replace('[pagebreak]', '', $bodytext);
		// PHPマルチバイト対応
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($bodytext);
		}else{
			$result = strlen($bodytext);	
		}
		
		return $result;
	}
	
	// hometext と bodytext の文字数の総和を求める
	function strlenHomeAndBody(){
	
		return $this->strlenHometext() + $this->strlenBodytext();
	
	}
	
	// [pagebreak]を任意の文字列に変換する
	function getDividedBodytext($dividing_str = '<br style="page-break-after:always;" />'){
	
		return str_replace('[pagebreak]', $dividing_str, $this->getVar('bodytext'));
	
	}

	// $text と $hometext と $bodytext に分解する
	function devideHomeTextAndBodyText(){

		$text_arr = explode('[pagebreak]', $this->getVar('text', 'n'));

		$this->setVar('hometext', array_shift($text_arr));
		$this->setVar('bodytext', implode('[pagebreak]', $text_arr));

	}

	// $hometext と $bodytext を $text に統一する
	function unifyHomeTextAndBodyText(){

		$text = $this->getVar('hometext', 'n');
		$bodytext = $this->getVar('bodytext', 'n');
		if( !empty($bodytext) ){
			$text .= "[pagebreak]" . $bodytext;
		}
		$this->setVar('text', $text );

	}

	function getRelated(){
	
		$relations = $this->relation->getRelations($this->getVar('storyid'));

		$ret = array();
		foreach($relations as $relation){
			$sql = sprintf("SELECT storyid, title, published, uid, topicid, counter, comments FROM %s WHERE storyid = %u AND type > 0 AND published > 0 AND published <= %u AND (expired = 0 OR expired > %u)", $this->db->prefix("{$relation['dirname']}_stories"), intval($relation['linkedid']), time(), time());
			$result = $this->db->fetchArray($this->db->query($sql));
			$result['dirname'] = $relation['dirname'];
			$ret[] = new Bulletin($result);
		}
		
		return $ret;
	}
	
	function getRelatedTitle($storyid, $dirname){
		$dirname = addslashes($dirname);
		$sql = sprintf("SELECT title FROM %s WHERE storyid = %u", $this->db->prefix("{$dirname}_stories"), intval($storyid));
		list($title) = $this->db->fetchRow($this->db->query($sql));
		return htmlspecialchars($title);
	}

}
?>