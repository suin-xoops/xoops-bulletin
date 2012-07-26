<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","ブリティン");

// A brief description of this module
define("_MI_BULLETIN_DESC","ユーザが自由にコメントできる、スラッシュドット風のニュース記事システムを構築します");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","ニュースカテゴリ");
define("_MI_BULLETIN_BDESC1","ニュースカテゴリブロック");
define("_MI_BULLETIN_BNAME2","本日のトップニュース");
define("_MI_BULLETIN_BDESC2","本日のトップニュースブロック");
define("_MI_BULLETIN_BNAME3","カレンダー");
define("_MI_BULLETIN_BDESC3","カレンダーブロック");
define("_MI_BULLETIN_BNAME4","最新ニュース");
define("_MI_BULLETIN_BDESC4","最新ニュースブロック");
define("_MI_BULLETIN_BNAME5","カテゴリ別最新ニュース");
define("_MI_BULLETIN_BDESC5","カテゴリ別最新ニュースブロック");
define("_MI_BULLETIN_BNAME6","ブリティン新着コメント");
define("_MI_BULLETIN_BDESC6","ブリティン新着コメントブロック");

// Sub menu
define("_MI_BULLETIN_SMNAME1","ニュース投稿");
define("_MI_BULLETIN_SMNAME2","アーカイブ");

//
define("_MI_BULLETIN_TEMPLATE1","アーカイブページ");
define("_MI_BULLETIN_TEMPLATE2","単数記事ページ");
define("_MI_BULLETIN_TEMPLATE3","トップページ");
define("_MI_BULLETIN_TEMPLATE4","記事のテンプレート");
define("_MI_BULLETIN_TEMPLATE5","印刷ページ");
define("_MI_BULLETIN_TEMPLATE6","RSSページ");
define("_MI_BULLETIN_TEMPLATE7","全ページ共通のヘッダ"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","一般設定");
define("_MI_BULLETIN_ADMENU1_D","基本的な設定を行います。");
define("_MI_BULLETIN_ADMENU2","カテゴリ管理");
define("_MI_BULLETIN_ADMENU2_D","カテゴリの管理を行います。");
define("_MI_BULLETIN_ADMENU3","新しいニュース記事の投稿");
define("_MI_BULLETIN_ADMENU3_D","ニュース記事の投稿を行います。");
define("_MI_BULLETIN_ADMENU4","投稿権限の管理");
define("_MI_BULLETIN_ADMENU4_D","ニュース記事の投稿に関する権限の設定を行います。");
define("_MI_BULLETIN_ADMENU5","ニュース記事の管理");
define("_MI_BULLETIN_ADMENU5_D","記事の編集・削除・承認等を行います。");
define("_MI_BULLETIN_ADMENU6","グループ管理/ブロック管理");
define("_MI_BULLETIN_ADMENU6_D","グループの権限・ブロックの設定を行います。");
define("_MI_BULLETIN_ADMENU7","newsからインポート");
define("_MI_BULLETIN_ADMENU7_D","news1.1から記事・カテゴリの情報を取り込みます。");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "トップページに掲載する記事数");
define("_MI_BULLETIN_CONFIG1_D", "トップページに表示する記事の数を指定してください。");
define("_MI_BULLETIN_CONFIG2", "ナビゲーションボックスを表示する");
define("_MI_BULLETIN_CONFIG2_D", "カテゴリを選択するナビゲーションボックスを記事の上部に表示するには「はい」を選択してください。");
define("_MI_BULLETIN_CONFIG3","投稿・編集用テキストエリアの高さ");
define("_MI_BULLETIN_CONFIG3_D", "submit.phpページのテキストエリアの行数を設定します。");
define("_MI_BULLETIN_CONFIG4","投稿・編集用テキストエリアの幅");
define("_MI_BULLETIN_CONFIG4_D", "submit.phpページのテキストエリアのカラム数を設定します。");
define("_MI_BULLETIN_CONFIG5","日付・日時の書式");
define("_MI_BULLETIN_CONFIG5_D", "文字の書式はPHPのdate関数・XOOPSのformatTimestamp関数を参照してください。");
define("_MI_BULLETIN_CONFIG6","投稿をユーザーの投稿数に反映");
define("_MI_BULLETIN_CONFIG6_D", "submit.phpから投稿された記事が承認された際に、そのユーザの「投稿数」に加算します。");
define("_MI_BULLETIN_CONFIG7","カテゴリアイコンがあるディレクトリのパス");
define("_MI_BULLETIN_CONFIG7_D", "絶対パスで指定します。");
define("_MI_BULLETIN_CONFIG8","印刷ページの画像のURL");
define("_MI_BULLETIN_CONFIG8_D", "印刷用ページに表示されるロゴ画像をURLで指定します。");
define("_MI_BULLETIN_CONFIG9","記事名をサイトのタイトルにする");
define("_MI_BULLETIN_CONFIG9_D", "記事の題名をサイトのタイトルに置き換えます。SEOの面で有効だと言われています。");
define("_MI_BULLETIN_CONFIG10","xoops_module_headerにRSSのURLをassingする");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","「印刷する」アイコンを表示する");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","「友達に知らせる」アイコンを表示する");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Tell A Friendモジュールを利用する");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","RSSのリンクを表示する");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "モジュール全体");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "ニュースモジュール全体における通知オプション");

define("_MI_BULLETIN_STORY_NOTIFY", "表示中のニュース記事");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "表示中のニュース記事に対する通知オプション");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "新規カテゴリ");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "新規カテゴリが作成された場合に通知する");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "新規カテゴリが作成された場合に通知する");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: 新規カテゴリが作成されました");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "新規ニュース記事投稿");       
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "新規ニュースの投稿があった場合に通知する");                           
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "新規ニュースの投稿があった場合に通知する");                
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: 新規ニュースの投稿がありました");                              

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "新規ニュース記事掲載");       
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "新規ニュース記事が掲載された場合に通知する");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "新規ニュース記事が掲載された場合に通知する");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: 新規ニュースが掲載されました");                              

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "ニュース記事の承認");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "このニュース記事が承認された場合に通知する");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "このニュース記事が承認された場合に通知する");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: ニュース記事が承認されました");

}

?>