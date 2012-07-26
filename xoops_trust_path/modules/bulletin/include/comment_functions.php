<?php

// comment callback functions

require_once $mytrustdirpath.'/class/bulletin.php';
function bulletin_com_update($story_id, $total_num){

	$article = new Bulletin($story_id);
	
	if (!$article->updateComments($total_num)) {
		return false;
	}
	return true;
}

function bulletin_com_approve(&$comment){
	// notification mail here
}
?>