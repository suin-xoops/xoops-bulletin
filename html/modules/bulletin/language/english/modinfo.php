<?php /* English Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define('BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Creates a Slashdot-like news system, where users can post comments freely.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","News categories");
define("_MI_BULLETIN_BDESC1","News categories block");
define("_MI_BULLETIN_BNAME2","Today top story");
define("_MI_BULLETIN_BDESC2","Today top story block");
define("_MI_BULLETIN_BNAME3","Calendar");
define("_MI_BULLETIN_BDESC3","Calender block");
define("_MI_BULLETIN_BNAME4","Recent news");
define("_MI_BULLETIN_BDESC4","Recent news block");
define("_MI_BULLETIN_BNAME5","Recent news by categories");
define("_MI_BULLETIN_BDESC5","Recent news by categories block");
define("_MI_BULLETIN_BNAME6","Bulletin recent comments");
define("_MI_BULLETIN_BDESC6","Bulletin recent comments block");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Submit news");
define("_MI_BULLETIN_SMNAME2","Archives");

//
define("_MI_BULLETIN_TEMPLATE1","Archives page");
define("_MI_BULLETIN_TEMPLATE2","Single news page");
define("_MI_BULLETIN_TEMPLATE3","Top page");
define("_MI_BULLETIN_TEMPLATE4","News template");
define("_MI_BULLETIN_TEMPLATE5","Print friendly page");
define("_MI_BULLETIN_TEMPLATE6","RSS page");
define("_MI_BULLETIN_TEMPLATE7","Common header"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Preferences");
define("_MI_BULLETIN_ADMENU1_D","Basic configuration setup.");
define("_MI_BULLETIN_ADMENU2","Categories manager");
define("_MI_BULLETIN_ADMENU2_D","Allow categories management.");
define("_MI_BULLETIN_ADMENU3","Post a new story");
define("_MI_BULLETIN_ADMENU3_D","Allow posting news.");
define("_MI_BULLETIN_ADMENU4","Posting permission manager");
define("_MI_BULLETIN_ADMENU4_D","Permissions for news posting setup.");
define("_MI_BULLETIN_ADMENU5","News manager");
define("_MI_BULLETIN_ADMENU5_D","Edit/delete/approve news.");
define("_MI_BULLETIN_ADMENU6","Groups/blocks admin");
define("_MI_BULLETIN_ADMENU6_D","Group and blocks configuration setup.");
define("_MI_BULLETIN_ADMENU7","Import from news");
define("_MI_BULLETIN_ADMENU7_D","Get news and categories data from news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1","Number of news to display on top page");
define("_MI_BULLETIN_CONFIG1_D","Set the number of news to display on top page.");
define("_MI_BULLETIN_CONFIG2","Show navigation box?");
define("_MI_BULLETIN_CONFIG2_D","Select \"Yes\" to display a navigation box for category select at the top of each news page.");
define("_MI_BULLETIN_CONFIG3","Submit/edit textarea height");
define("_MI_BULLETIN_CONFIG3_D","Set the number of lines of textarea on submit.php page");
define("_MI_BULLETIN_CONFIG4","Submit/edit textarea width");
define("_MI_BULLETIN_CONFIG4_D","Set the number of columns of textarea on submit.php page");
define("_MI_BULLETIN_CONFIG5","Timestamp");
define("_MI_BULLETIN_CONFIG5_D","Describe it using PHP date/XOOPS formatTimestamp functions as reference.");
define("_MI_BULLETIN_CONFIG6","Sums up to user's post count according to posts");
define("_MI_BULLETIN_CONFIG6_D","When a story posted from submit.php is approved, user's \"Posts\" will be increased.");
define("_MI_BULLETIN_CONFIG7","Path to category image directory");
define("_MI_BULLETIN_CONFIG7_D","Set the absolute path.");
define("_MI_BULLETIN_CONFIG8","Print friendly page image URL");
define("_MI_BULLETIN_CONFIG8_D","Set the URL for the logo image shown on print friendly page.");
define("_MI_BULLETIN_CONFIG9","Change site name to story name");
define("_MI_BULLETIN_CONFIG9_D","Replaces the site name for the story subject. It's said to be effective for SEO.");
define("_MI_BULLETIN_CONFIG10","assign RSS URL on xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D","");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Display \"print\" icon");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Display \"tell a frind\" icon");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Use Tell a Friend module?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Show RSS link");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY","Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC","Global news notification options.");

define("_MI_BULLETIN_STORY_NOTIFY","Current story");
define("_MI_BULLETIN_STORY_NOTIFYDSC","Notification options that apply to the current story.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY","New category");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP","Notify me when a new category is created.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC","Notify me when a new category is created.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: New category created");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY","New story submitted");       
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP","Notify me when a new story is submitted.");                           
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC","Notify me when a new story is submitted.");                
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: New story submitted");                      

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY","New story published");       
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP","Notify me when a new story is published.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC","Notify me when a new story is published.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: New news published");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY","News approved");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP","Notify me when this news is approved.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC","Notify me when this news is approved.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: News approved");

}

?>