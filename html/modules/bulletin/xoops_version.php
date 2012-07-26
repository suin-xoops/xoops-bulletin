<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;
$mydirname = basename( dirname( __FILE__ ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

$modversion['name']        = _MI_BULLETIN_NAME.$mydirnumber;
$modversion['version']     = 1.06;
$modversion['description'] = _MI_BULLETIN_DESC;
$modversion['credits']     = "suin";
$modversion['help']        = "help.html";
$modversion['license']     = "GPL see LICENSE";
$modversion['official']    = 0;
$modversion['image']       = "images/bulletin{$mydirnumber}_logo.png";
$modversion['dirname']     = $mydirname;

// Sql file
$modversion['sqlfile']['mysql'] = "sql/mysql{$mydirnumber}.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "bulletin{$mydirnumber}_stories";
$modversion['tables'][1] = "bulletin{$mydirnumber}_topics";

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

// Templates
$modversion['templates'][1]['file']        = "bulletin{$mydirnumber}_archive.html";
$modversion['templates'][1]['description'] = _MI_BULLETIN_TEMPLATE1;
$modversion['templates'][2]['file']        = "bulletin{$mydirnumber}_article.html";
$modversion['templates'][2]['description'] = _MI_BULLETIN_TEMPLATE2;
$modversion['templates'][3]['file']        = "bulletin{$mydirnumber}_index.html";
$modversion['templates'][3]['description'] = _MI_BULLETIN_TEMPLATE3;
$modversion['templates'][4]['file']        = "bulletin{$mydirnumber}_item.html";
$modversion['templates'][4]['description'] = _MI_BULLETIN_TEMPLATE4;
$modversion['templates'][5]['file']        = "bulletin{$mydirnumber}_print.html";
$modversion['templates'][5]['description'] = _MI_BULLETIN_TEMPLATE5;
$modversion['templates'][6]['file']        = "bulletin{$mydirnumber}_rss.html";
$modversion['templates'][6]['description'] = _MI_BULLETIN_TEMPLATE6;
$modversion['templates'][7]['file']        = "bulletin{$mydirnumber}_head.html";
$modversion['templates'][7]['description'] = _MI_BULLETIN_TEMPLATE7;
// Blocks
$i = 1;
$modversion['blocks'][$i]['file']        = "bulletin_topics.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME1.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC1.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_topics_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "bulletin{$mydirnumber}_block_topics.html";
$i++;
$modversion['blocks'][$i]['file']        = "bulletin_bigstory.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME2.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC2.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_bigstory_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "bulletin{$mydirnumber}_block_bigstory.html";
$i++;
$modversion['blocks'][$i]['file']        = "bulletin_calendar.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME3.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC3.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_calendar_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$i++;
$modversion['blocks'][$i]['file']        = "bulletin_new.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME4.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC4.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_new_show";
$modversion['blocks'][$i]['edit_func']   = "b_bulletin_new_edit";
$modversion['blocks'][$i]['options']     = "$mydirname|published|10|25|0";
$modversion['blocks'][$i]['template']    = "bulletin{$mydirnumber}_block_new.html";
$modversion['blocks'][$i]['can_clone']   = true ;
$i++;
$modversion['blocks'][$i]['file']        = "bulletin_ctop.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME5.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC5.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_Ctop_show";
$modversion['blocks'][$i]['edit_func']   = "b_bulletin_Ctop_edit";
$modversion['blocks'][$i]['options']     = "$mydirname|published|3|25|0|0|1";
$modversion['blocks'][$i]['template']    = "bulletin{$mydirnumber}_block_cnew.html";
$modversion['blocks'][$i]['can_clone']   = true ;
$i++;
$modversion['blocks'][$i]['file']        = "bulletin_comment.php";
$modversion['blocks'][$i]['name']        = _MI_BULLETIN_BNAME6.$mydirnumber;
$modversion['blocks'][$i]['description'] = _MI_BULLETIN_BDESC6.$mydirnumber;
$modversion['blocks'][$i]['show_func']   = "b_bulletin_recent_comments_show";
$modversion['blocks'][$i]['options']     = $mydirname;
$modversion['blocks'][$i]['template']    = "bulletin{$mydirnumber}_block_comments.html";

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = _MI_BULLETIN_SMNAME1;
$modversion['sub'][1]['url']  = "submit.php";
$modversion['sub'][2]['name'] = _MI_BULLETIN_SMNAME2;
$modversion['sub'][2]['url']  = "archive.php";

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "bulletin{$mydirnumber}_search";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'article.php';
$modversion['comments']['itemName'] = 'storyid';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'bulletin_com_approve';
$modversion['comments']['callback']['update']  = 'bulletin_com_update';

// Config Settings
$i = 1;
$modversion['config'][$i]['name']        = 'storyhome';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG1';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG1_D';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 5;
$modversion['config'][$i]['options']     = array('5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30);
$i++;
$modversion['config'][$i]['name']        = 'displaynav';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG2';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG2_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'post_tray_row';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG3';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG3_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 15;
$i++;
$modversion['config'][$i]['name']        = 'post_tray_col';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG4';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG4_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 60;
$i++;
$modversion['config'][$i]['name']        = 'date_format';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG5';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG5_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'Y-m-d H:i:s';
$i++;
$modversion['config'][$i]['name']        = 'plus_posts';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG6';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG6_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
$i++;
$modversion['config'][$i]['name']        = 'topicon_path';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG7';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG7_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = XOOPS_ROOT_PATH . '/modules/'.$mydirname.'/images/topics/';
$i++;
$modversion['config'][$i]['name']        = 'imgurl_on_print';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG8';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG8_D';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = XOOPS_URL.'/images/logo.gif';
$i++;
$modversion['config'][$i]['name']        = 'titile_as_sitename';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG9';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG9_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'assing_rssurl_head';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG10';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG10_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'disp_print_icon';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG11';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG11_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'disp_tell_icon';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG12';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG12_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$i++;
$modversion['config'][$i]['name']        = 'use_tell_a_frined';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG13';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG13_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
$i++;
$modversion['config'][$i]['name']        = 'disp_rss_link';
$modversion['config'][$i]['title']       = '_MI_BULLETIN_CONFIG14';
$modversion['config'][$i]['description'] = '_MI_BULLETIN_CONFIG14_D';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;


// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = "bulletin{$mydirnumber}_notify_iteminfo";

$modversion['notification']['category'][1]['name']           = 'global';
$modversion['notification']['category'][1]['title']          = _MI_BULLETIN_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description']    = _MI_BULLETIN_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'article.php');

$modversion['notification']['category'][2]['name']           = 'story';
$modversion['notification']['category'][2]['title']          = _MI_BULLETIN_STORY_NOTIFY;
$modversion['notification']['category'][2]['description']    = _MI_BULLETIN_STORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = array('article.php');
$modversion['notification']['category'][2]['item_name']      = 'storyid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name']          = 'new_category';
$modversion['notification']['event'][1]['category']      = 'global';
$modversion['notification']['event'][1]['title']         = _MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption']       = _MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP;
$modversion['notification']['event'][1]['description']   = _MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject']  = _MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ;

$modversion['notification']['event'][2]['name']          = 'story_submit';
$modversion['notification']['event'][2]['category']      = 'global';
$modversion['notification']['event'][2]['admin_only']    = 1;
$modversion['notification']['event'][2]['title']         = _MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY;
$modversion['notification']['event'][2]['caption']       = _MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][2]['description']   = _MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'global_storysubmit_notify';
$modversion['notification']['event'][2]['mail_subject']  = _MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][3]['name']          = 'new_story';
$modversion['notification']['event'][3]['category']      = 'global';
$modversion['notification']['event'][3]['title']         = _MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY;
$modversion['notification']['event'][3]['caption']       = _MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP;
$modversion['notification']['event'][3]['description']   = _MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'global_newstory_notify';
$modversion['notification']['event'][3]['mail_subject']  = _MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ;

$modversion['notification']['event'][4]['name']          = 'approve';
$modversion['notification']['event'][4]['category']      = 'story';
$modversion['notification']['event'][4]['invisible']     = 1;
$modversion['notification']['event'][4]['title']         = _MI_BULLETIN_STORY_APPROVE_NOTIFY;
$modversion['notification']['event'][4]['caption']       = _MI_BULLETIN_STORY_APPROVE_NOTIFYCAP;
$modversion['notification']['event'][4]['description']   = _MI_BULLETIN_STORY_APPROVE_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'story_approve_notify';
$modversion['notification']['event'][4]['mail_subject']  = _MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ;

// On Install
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'install_ok' && $_POST['module'] == $modversion['dirname'] ) {
	$_SESSION['bulletin_mydirname'] = $mydirname ; // store $mydirname in session
}

// On Update
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}
?>