<?php

if( !function_exists('myStrlenText') ){

	function myStrlenText($str){

		// HTML��������
		$str = strip_tags($str);
		// ���Ԥ���
		$str = preg_replace("/(\015\012)|(\015)|(\012)/", "", $str);
		// Ϣ³����Ⱦ�ѥ��ڡ�����Ⱦ�ѥ��ڡ������Ȥ��ƥ������
		$str = preg_replace('!\s+!', " ", $str);
		// HTML�ü�ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$str = ereg_replace("&[a-zA-Z]{1,5};", " ", $str);
		// Unicode10��ʸ����Ⱦ��1ʸ���Ȥ��ƥ������
		$str = ereg_replace("&#[0-9]{1,5};", " ", $str);
		// PHP�ޥ���Х����б�
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($str);
		}else{
			$result = strlen($str);
		}

		return $result;
	}

	function makeTopicImgURL($topic_path, $imgurl)
	{
		if ($imgurl != '' && file_exists($topic_path.$imgurl)) {
			return str_replace(XOOPS_ROOT_PATH,XOOPS_URL,$topic_path).$imgurl;
		}
		return false;
	}

	function topicImgAlign($int)
	{
		switch($int){
			case 1 : return "right";
			case 2 : return "left";
		}
		
		return fasle;
	}

}

?>