<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
if( ! defined( 'BULLETIN_BLOCK_COMMENTS_INCLUDED' ) ) {

define( 'BULLETIN_BLOCK_COMMENTS_INCLUDED' , 1 ) ;

function b_bulletin_recent_comments_show() {

	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;

	require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/include/configs.inc.php';
	require_once XOOPS_ROOT_PATH.'/include/comment_constants.php';


	$block = array();
	
	$comment_handler =& xoops_gethandler('comment');
	$member_handler  =& xoops_gethandler('member');
//	$module_handler  =& xoops_gethandler('module');
//	$module =& $module_handler->getByDirname($mydirname);

	$criteria = new CriteriaCompo(new Criteria('com_status', XOOPS_COMMENT_ACTIVE));
	$criteria->add(new Criteria('com_modid', $bulletin_mid));
	$criteria->setLimit(10);
	$criteria->setSort('com_created');
	$criteria->setOrder('DESC');
	$comments =& $comment_handler->getObjects($criteria, true);

	foreach (array_keys($comments) as $i) {
		$mid = $comments[$i]->getVar('com_modid');

		$com['id']     = $i;
		$com['title']  = $comments[$i]->getVar('com_title');
		$com['time']   = formatTimestamp($comments[$i]->getVar('com_created'),'m');
		$com['poster'] = $GLOBALS['xoopsConfig']['anonymous'];
		$com['uid']    = $comments[$i]->getVar('com_uid');
		$com['itemid'] = $comments[$i]->getVar('com_itemid');
		$com['rootid'] = $comments[$i]->getVar('com_rootid');
		$com['url']    = $myurl.'/article.php?storyid='.$com['itemid'].'&amp;com_id='.$i.'&amp;com_rootid='.$com['rootid'].'#comment'.$i;
		if ($comments[$i]->getVar('com_uid') > 0) {
			$poster =& $member_handler->getUser($comments[$i]->getVar('com_uid'));
			if (is_object($poster)) {
				$com['poster'] = $poster->getVar('uname');
			}
		}
		
		$block['comments'][] =& $com;
		unset($com);
	}
	
	return $block;
}


function b_bulletin_recent_comments_edit($options) {
    $form  = '<table>';

    $form .= '</table>';
    return $form;
}

}
?>