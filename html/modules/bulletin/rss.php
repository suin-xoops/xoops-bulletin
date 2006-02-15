<?php
// $Id: backend.php,v 1.2 2005/03/18 12:51:55 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
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

require 'header.php';
require_once XOOPS_ROOT_PATH.'/class/template.php';

if (function_exists('mb_http_output')) {
	mb_http_output('pass');
}
header ('Content-Type:text/xml; charset=utf-8');
$tpl = new XoopsTpl();
$tpl->xoops_setCaching(2);
$tpl->xoops_setCacheTime(3600);
if (!$tpl->is_cached("db:bulletin{$mydirnumber}_rss.html")) {
	$articles = Bulletin::getAllPublished(10, 0);
	if (is_array($articles)) {
		$tpl->assign('channel_title', xoops_utf8_encode(htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES)));
		$tpl->assign('channel_link', XOOPS_URL.'/');
		$tpl->assign('channel_desc', xoops_utf8_encode(htmlspecialchars($xoopsConfig['slogan'], ENT_QUOTES)));
		$tpl->assign('channel_lastbuild', formatTimestamp(time(), 'rss'));
		$tpl->assign('channel_webmaster', $xoopsConfig['adminmail']);
		$tpl->assign('channel_editor', $xoopsConfig['adminmail']);
		$tpl->assign('channel_category', 'News');
		$tpl->assign('channel_generator', 'XOOPS');
		$tpl->assign('channel_language', _LANGCODE);
		$tpl->assign('image_url', XOOPS_URL.'/images/logo.gif');
		$dimention = getimagesize(XOOPS_ROOT_PATH.'/images/logo.gif');
		if (empty($dimention[0])) {
			$width = 88;
		} else {
			$width = ($dimention[0] > 144) ? 144 : $dimention[0];
		}
		if (empty($dimention[1])) {
			$height = 31;
		} else {
			$height = ($dimention[1] > 400) ? 400 : $dimention[1];
		}
		$tpl->assign('image_width', $width);
		$tpl->assign('image_height', $height);
		$count = $articles;
		foreach ($articles as $article) {
			$tpl->append('items', array(
				'title' => xoops_utf8_encode($article->getVar('title', 'n')), 
				'link' => $myurl.'/article.php?storyid='.$article->getVar('storyid'), 
				'guid' => $myurl.'/article.php?storyid='.$article->getVar('storyid'), 
				'pubdate' => formatTimestamp($article->getVar('published'), 'rss'), 
				'description' => xoops_utf8_encode($article->getVar('hometext'))));
		}
	}
}
$tpl->display("db:bulletin{$mydirnumber}_rss.html");
?>