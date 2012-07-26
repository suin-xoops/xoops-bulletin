<?php /* English Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref.'_NAME', '新聞區');

// A brief description of this module
define($constpref.'_DESC', '建立一個像 Slashdot 的新聞主題區, 使用者可以張貼新聞及發表評論.');

// Names of blocks for this module (Not all module has blocks)
define($constpref.'_BNAME1', '新增新聞分類');
define($constpref.'_BDESC1', '新聞類別區塊');
define($constpref.'_BNAME2', '今天熱門新聞');
define($constpref.'_BDESC2', '今天熱門新聞區塊');
define($constpref.'_BNAME3', '行事曆');
define($constpref.'_BDESC3', '行事曆區塊');
define($constpref.'_BNAME4', '最新消息');
define($constpref.'_BDESC4', '最新消息區塊');
define($constpref.'_BNAME5', '類別最新消息');
define($constpref.'_BDESC5', '類別最新消息區塊');
define($constpref.'_BNAME6', '審核新聞');
define($constpref.'_BDESC6', '審核新聞區塊');

// Sub menu
define($constpref.'_SMNAME1', '提供新聞');
define($constpref.'_SMNAME2', '新聞櫃');

//
define($constpref.'_TEMPLATE1', '新聞櫃頁面');
define($constpref.'_TEMPLATE2', '單一新聞頁');
define($constpref.'_TEMPLATE3', '首頁');
define($constpref.'_TEMPLATE4', '新聞樣板');
define($constpref.'_TEMPLATE5', '友善列印頁面');
define($constpref.'_TEMPLATE6', 'RSS 頁面');
define($constpref.'_TEMPLATE7', '一般文首'); // 1.01 added

// Admin
define($constpref.'_ADMENU1', '設定');
define($constpref.'_ADMENU1_D', '基本設定');
define($constpref.'_ADMENU2', '新聞分類管理');
define($constpref.'_ADMENU2_D', '允許管理類別。');
define($constpref.'_ADMENU3', '張貼/編輯 新聞');
define($constpref.'_ADMENU3_D', '允許發佈新聞。');
define($constpref.'_ADMENU4', '發佈權限管理');
define($constpref.'_ADMENU4_D', '設定發佈新聞的權限。');
define($constpref.'_ADMENU5', '新聞管理');
define($constpref.'_ADMENU5_D', '編輯/刪除/審核新聞');
define($constpref.'_ADMENU6', '群組/區塊管理');
define($constpref.'_ADMENU6_D', '設定群組/區塊');
define($constpref.'_ADMENU7', '從新聞模組(news）匯入');
define($constpref.'_ADMENU7_D', '從 news1.1 取得新聞與類別資訊');

// Title of config items
define($constpref.'_CONFIG1', '首頁顯示新聞數量');
define($constpref.'_CONFIG1_D', '設定首頁要顯示的新聞文章數量。');
define($constpref.'_CONFIG2', '顯示導覽區塊？');
define($constpref.'_CONFIG2_D', '選擇 "是" 就會在每個新聞頁面的最上方顯示一個類別導覽區塊。');
define($constpref.'_CONFIG3', '編輯文章區塊高度');
define($constpref.'_CONFIG3_D', '設定 submit.php 頁面的新聞內容區塊高度');
define($constpref.'_CONFIG4', '編輯文章區塊寬度');
define($constpref.'_CONFIG4_D', '設定 submit.php 頁面的新聞內容區塊寬度');
define($constpref.'_CONFIG5', '時間格式');
define($constpref.'_CONFIG5_D', '請使用 PHP 的時間格式');
define($constpref.'_CONFIG6', '增加使用者發表文章數量');
define($constpref.'_CONFIG6_D', '當使用者透過 submit.php 提供新聞時，您可以決定是否要增加它個人頁面的發表文章數量。');
define($constpref.'_CONFIG7', '類別圖示的路徑');
define($constpref.'_CONFIG7_D', '設定絕對路徑');
define($constpref.'_CONFIG8', '友善列印頁面的圖片網址');
define($constpref.'_CONFIG8_D', '設定友善列印頁面中的網站圖示檔案位置');
define($constpref.'_CONFIG9', '修改網站名稱為文章名稱');
define($constpref.'_CONFIG9_D', '檢視新聞時的瀏覽器標題名稱是否要以單純文章名稱取代，這樣子搜尋引擎會比較容易找到。');
define($constpref.'_CONFIG10', '在 xoops_module_header 指定 RSS 網址');
define($constpref.'_CONFIG10_D', '');
// 1.01 added
define($constpref.'_CONFIG11', '顯示列印圖示');
define($constpref.'_CONFIG11_D', '');
define($constpref.'_CONFIG12', '顯示轉寄給朋友圖示');
define($constpref.'_CONFIG12_D', '');
define($constpref.'_CONFIG13', '使用轉寄給朋友功能？');
define($constpref.'_CONFIG13_D', '');
define($constpref.'_CONFIG14', '顯示 RSS 連結');
define($constpref.'_CONFIG14_D', '');

// Text for notifications
define($constpref.'_GLOBAL_NOTIFY', '全域的');
define($constpref.'_GLOBAL_NOTIFYDSC', '全域的新聞通知選項.');

define($constpref.'_STORY_NOTIFY', '新聞');
define($constpref.'_STORY_NOTIFYDSC', '套件到目前這篇新聞的通知選項.');

define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFY', '新主題');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYCAP', '當有新分類建立時,就通知我.');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYDSC', '當有新分類建立時接收通知.');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動通知 : 有新分類建立');

define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFY', '新聞送出');       
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYCAP', '當有新聞送出時(等待審核), 就通知我.');                           
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYDSC', '當有新聞送出時(等待審核), 就接收通知.');                
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動通知 : 有新聞送出');                      

define($constpref.'_GLOBAL_NEWSTORY_NOTIFY', '張貼新聞');       
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYCAP', '有新聞張貼就通知我.');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYDSC', '有新聞張貼就接收通知.');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動通知 : 張貼新聞');

define($constpref.'_STORY_APPROVE_NOTIFY', '新聞已核准');
define($constpref.'_STORY_APPROVE_NOTIFYCAP', '新聞核准就通知我.');
define($constpref.'_STORY_APPROVE_NOTIFYDSC', '新聞核准就接收通知.');
define($constpref.'_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動通知 : 新聞已核准');

}

?>