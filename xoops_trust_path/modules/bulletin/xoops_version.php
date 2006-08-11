<?php

// language file (modinfo.php)
if( file_exists( dirname(__FILE__).'/language/'.@$xoopsConfig['language'].'/modinfo.php' ) ) {
	include dirname(__FILE__).'/language/'.@$xoopsConfig['language'].'/modinfo.php' ;
} else if( file_exists( dirname(__FILE__).'/language/english/modinfo.php' ) ) {
	include dirname(__FILE__).'/language/english/modinfo.php' ;
}
$constpref = '_MI_' . strtoupper( $mydirname ) ;

$modversion['name']        = $mydirname;
$modversion['version']     = 2.04;
$modversion['description'] = constant($constpref.'_DESC');
$modversion['credits']     = 'suin';
$modversion['help']        = '';
$modversion['license']     = 'GPL see LICENSE';
$modversion['official']    = 0;
$modversion['image']       = 'module_icon.php';
$modversion['dirname']     = $mydirname;

// Any tables can't be touched by modulesadmin.
$modversion['sqlfile'] = false ;
$modversion['tables'] = array() ;

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'index.php?mode=admin';
$modversion['adminmenu']  = 'admin_menu.php';

// All Templates can't be touched by modulesadmin.
$modversion['templates'] = array() ;

// Blocks
$i = 1;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME1');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC1');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_topics_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "{$mydirname}_block_topics.html";
$i++;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME2');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC2');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_bigstory_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "{$mydirname}_block_bigstory.html";
$i++;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME3');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC3');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_calendar_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$i++;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME4');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC4');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_new_show";
$modversion['blocks'][$i]['edit_func']   = "b_bulletin_new_edit";
$modversion['blocks'][$i]['options']     = "$mydirname|published|10|25|0";
$modversion['blocks'][$i]['template']    = "{$mydirname}_block_new.html";
$modversion['blocks'][$i]['can_clone']   = true ;
$i++;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME5');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC5');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_category_new_show";
$modversion['blocks'][$i]['edit_func']   = "b_bulletin_category_new_edit";
$modversion['blocks'][$i]['options']     = "$mydirname|published|3|25|0|0|1";
$modversion['blocks'][$i]['template']    = "{$mydirname}_block_category_new.html";
$modversion['blocks'][$i]['can_clone']   = true ;
$i++;
$modversion['blocks'][$i]['file']        = "blocks.php";
$modversion['blocks'][$i]['name']        = constant($constpref.'_BNAME6');
$modversion['blocks'][$i]['description'] = constant($constpref.'_BDESC6');
$modversion['blocks'][$i]['show_func']   = "b_bulletin_recent_comments_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "{$mydirname}_block_comments.html";

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = constant($constpref.'_SMNAME1');
$modversion['sub'][1]['url']  = 'index.php?page=submit';
$modversion['sub'][2]['name'] = constant($constpref.'_SMNAME2');
$modversion['sub'][2]['url']  = 'index.php?page=archive';

// Search
$modversion['hasSearch'] = 1 ;
$modversion['search']['file'] = 'search.php' ;
$modversion['search']['func'] = $mydirname.'_global_search' ;

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'index.php';
$modversion['comments']['itemName'] = 'storyid';
$modversion['comments']['extraParams'] = array('page');
// Comment callback functions
$modversion['comments']['callbackFile'] = 'comment_functions.php';
$modversion['comments']['callback']['approve'] = 'bulletin_com_approve';
$modversion['comments']['callback']['update']  = 'bulletin_com_update';

// Config Settings
$i = 1;
$modversion['config'][$i]['name']        = 'storyhome';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG1';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG1_D';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 5;
$modversion['config'][$i]['options']     = array('5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30);
$i++;
$modversion['config'][$i]['name']        = 'displaynav';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG2';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG2_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'post_tray_row';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG3';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG3_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 15;
$i++;
$modversion['config'][$i]['name']        = 'post_tray_col';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG4';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG4_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 60;
$i++;
$modversion['config'][$i]['name']        = 'date_format';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG5';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG5_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'Y-m-d H:i:s';
$i++;
$modversion['config'][$i]['name']        = 'plus_posts';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG6';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG6_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
$i++;
$modversion['config'][$i]['name']        = 'topicon_path';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG7';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG7_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = XOOPS_ROOT_PATH . '/modules/'.$mydirname.'/images/topics/';
$i++;
$modversion['config'][$i]['name']        = 'imgurl_on_print';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG8';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG8_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = XOOPS_URL.'/images/logo.gif';
$i++;
$modversion['config'][$i]['name']        = 'titile_as_sitename';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG9';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG9_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'assing_rssurl_head';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG10';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG10_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'disp_print_icon';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG11';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG11_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'disp_tell_icon';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG12';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG12_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'use_tell_a_frined';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG13';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG13_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
$i++;
$modversion['config'][$i]['name']        = 'disp_rss_link';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG14';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG14_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'use_relations';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG15';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG15_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'disp_list_of_cat';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG16';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG16_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'stories_of_cat';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG17';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG17_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 10;
$i++;
$modversion['config'][$i]['name']        = 'use_pankuzu';
$modversion['config'][$i]['title']       = $constpref.'_CONFIG18';
$modversion['config'][$i]['description'] = $constpref.'_CONFIG18_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'notification.php';
$modversion['notification']['lookup_func'] = '{$mydirname}_notify_iteminfo';

$modversion['notification']['category'][1]['name']           = 'global';
$modversion['notification']['category'][1]['title']          = constant($constpref.'_GLOBAL_NOTIFY');
$modversion['notification']['category'][1]['description']    = constant($constpref.'_GLOBAL_NOTIFYDSC');
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'article.php');

$modversion['notification']['category'][2]['name']           = 'story';
$modversion['notification']['category'][2]['title']          = constant($constpref.'_STORY_NOTIFY');
$modversion['notification']['category'][2]['description']    = constant($constpref.'_STORY_NOTIFYDSC');
$modversion['notification']['category'][2]['subscribe_from'] = array('index.php', 'article.php');
$modversion['notification']['category'][2]['item_name']      = 'storyid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name']          = 'new_category';
$modversion['notification']['event'][1]['category']      = 'global';
$modversion['notification']['event'][1]['title']         = constant($constpref.'_GLOBAL_NEWCATEGORY_NOTIFY');
$modversion['notification']['event'][1]['caption']       = constant($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYCAP');
$modversion['notification']['event'][1]['description']   = constant($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYDSC');
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject']  = constant($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYSBJ');

$modversion['notification']['event'][2]['name']          = 'story_submit';
$modversion['notification']['event'][2]['category']      = 'global';
$modversion['notification']['event'][2]['admin_only']    = 1;
$modversion['notification']['event'][2]['title']         = constant($constpref.'_GLOBAL_STORYSUBMIT_NOTIFY');
$modversion['notification']['event'][2]['caption']       = constant($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYCAP');
$modversion['notification']['event'][2]['description']   = constant($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYDSC');
$modversion['notification']['event'][2]['mail_template'] = 'global_storysubmit_notify';
$modversion['notification']['event'][2]['mail_subject']  = constant($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYSBJ');

$modversion['notification']['event'][3]['name']          = 'new_story';
$modversion['notification']['event'][3]['category']      = 'global';
$modversion['notification']['event'][3]['title']         = constant($constpref.'_GLOBAL_NEWSTORY_NOTIFY');
$modversion['notification']['event'][3]['caption']       = constant($constpref.'_GLOBAL_NEWSTORY_NOTIFYCAP');
$modversion['notification']['event'][3]['description']   = constant($constpref.'_GLOBAL_NEWSTORY_NOTIFYDSC');
$modversion['notification']['event'][3]['mail_template'] = 'global_newstory_notify';
$modversion['notification']['event'][3]['mail_subject']  = constant($constpref.'_GLOBAL_NEWSTORY_NOTIFYSBJ');

$modversion['notification']['event'][4]['name']          = 'approve';
$modversion['notification']['event'][4]['category']      = 'story';
$modversion['notification']['event'][4]['invisible']     = 1;
$modversion['notification']['event'][4]['title']         = constant($constpref.'_STORY_APPROVE_NOTIFY');
$modversion['notification']['event'][4]['caption']       = constant($constpref.'_STORY_APPROVE_NOTIFYCAP');
$modversion['notification']['event'][4]['description']   = constant($constpref.'_STORY_APPROVE_NOTIFYDSC');
$modversion['notification']['event'][4]['mail_template'] = 'story_approve_notify';
$modversion['notification']['event'][4]['mail_subject']  = constant($constpref.'_STORY_APPROVE_NOTIFYSBJ');

$modversion['notification']['event'][5]['name']          = 'comment';
$modversion['notification']['event'][5]['category']      = 'story';
$modversion['notification']['event'][5]['title']         = constant($constpref.'_NOTIFY5_TITLE');
$modversion['notification']['event'][5]['caption']       = constant($constpref.'_NOTIFY5_CAPTION');
$modversion['notification']['event'][5]['description']   = constant($constpref.'_NOTIFY5_DESC');
$modversion['notification']['event'][5]['mail_template'] = 'story_comment';
$modversion['notification']['event'][5]['mail_subject']  = constant($constpref.'_NOTIFY5_SUBJECT');

$modversion['onInstall'] = 'oninstall.php' ;
$modversion['onUpdate'] = 'onupdate.php' ;
$modversion['onUninstall'] = 'onuninstall.php' ;
?>