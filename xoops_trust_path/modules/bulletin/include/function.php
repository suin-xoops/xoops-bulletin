<?php

if( !function_exists('myStrlenText') ){

	function myStrlenText($text){

		// HTML�^�O���폜
		$text = strip_tags($text);
		// HTML���ꕶ���𔼊p1�����Ƃ��ăJ�E���g
		$text = ereg_replace("&[a-zA-Z]{1,5};", " ", $text);
		// Unicode10�i�����𔼊p1�����Ƃ��ăJ�E���g
		$text = ereg_replace("&#[0-9]{1,5};", " ", $text);
		// [pagebreak]���J�E���g�ΏۊO�ɂ���
		$text = str_replace('[pagebreak]', '', $text);
		// PHP�}���`�o�C�g�Ή�
		if( function_exists('mb_strlen') ){
			$result = mb_strlen($text);
		}else{
			$result = strlen($text);	
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