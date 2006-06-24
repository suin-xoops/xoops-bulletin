<?php

if( !function_exists('myStrlenText') ){

	function myStrlenText($text){

		// HTMLタグを削除
		$text = strip_tags($text);
		// HTML特殊文字を半角1文字としてカウント
		$text = ereg_replace("&[a-zA-Z]{1,5};", " ", $text);
		// Unicode10進文字を半角1文字としてカウント
		$text = ereg_replace("&#[0-9]{1,5};", " ", $text);
		// [pagebreak]をカウント対象外にする
		$text = str_replace('[pagebreak]', '', $text);
		// PHPマルチバイト対応
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