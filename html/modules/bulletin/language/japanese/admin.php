<?php
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_AM_LOADED' ) ) {

define( 'BULLETIN_AM_LOADED' , 1 ) ;

//%%%%%%	Admin Module Name  Articles 	%%%%%
define("_AM_DBUPDATED","データベースを更新しました");

define("_AM_AUTOARTICLES","掲載予定の記事");
define("_AM_STORYID","ID");
define("_AM_TITLE","表題");
define("_AM_TOPIC","カテゴリ");
define("_AM_POSTER","投稿者");
define("_AM_PROGRAMMED","掲載予定日時");
define("_AM_ACTION","管理");
define("_AM_EDIT","編集");
define("_AM_DELETE","削除");
define("_AM_POSTED","投稿日時");
define("_AM_PUBLISHED","掲載日時"); // Published Date
define("_AM_GO","送信");

define("_AM_RUSUREDEL","このニュース記事および記事に対するコメントを全て削除してもいいですか？");
define("_AM_YES","はい");
define("_AM_NO","いいえ");
define("_AM_INTROTEXT","本文");
define("_AM_EXTEXT","本文2");

define("_AM_DISAMILEY","顔アイコンを無効にする");
define("_AM_DISHTML","HTMLタグを無効にする");
define("_AM_APPROVE","この記事を承認する");
define("_AM_MOVETOTOP","この記事をトップページ最上部に移動する");
define("_AM_CHANGEDATETIME","掲載日時を変更する");
define("_AM_NOWSETTIME","現在の掲載予定日時： Y年m月d日 H:i"); 
define("_AM_CURRENTTIME","現在日時： Y年m月d日 H:i");  
define("_AM_SETDATETIME","掲載日時を設定する");

define("_AM_PREVIEW","プレビュー");
define("_AM_SAVE","保存");
define("_AM_PUBINHOME","トップページに掲載する");
define("_AM_ADD","追加");

//%%%%%%	Admin Module Name  Topics 	%%%%%

define("_AM_ADDMTOPIC","カテゴリの作成");
define("_AM_TOPICNAME","カテゴリ名");
define("_AM_MAX40CHAR","（最大20文字（全角））");
define("_AM_TOPICIMG","カテゴリアイコン");
define("_AM_IMGNAEXLOC","%s 下にある画像ファイル名");

define("_AM_MODIFYTOPIC","カテゴリの編集");
define("_AM_MODIFY","送信");
define("_AM_PARENTTOPIC","親カテゴリ");
define("_AM_SAVECHANGE","変更を保存");
define("_AM_DEL","削除");
define("_AM_CANCEL","キャンセル");
define("_AM_WAYSYWTDTTAL","このカテゴリおよびこのカテゴリ内の全てのニュース記事およびコメントを削除してもいいですか？");

define("_AM_EXPARTS","期限切れの記事");
define("_AM_EXPIRED","掲載期限");
define("_AM_CHANGEEXPDATETIME","有効期限を変更する");
define("_AM_SETEXPDATETIME","有効期限を設定する");

define("_AM_ERRORTOPICNAME", "カテゴリ名が記入されていません。");
define("_AM_EMPTYNODELETE", "削除できません");

// Added by SUIN

define("_AM_TOPIC_IMAGE","カテゴリアイコン");
define("_AM_TOPIC_DISABLE","カテゴリアイコンを表示しない");
define("_AM_TOPIC_LEFT","カテゴリアイコンを左側に表示する");
define("_AM_TOPIC_RIGHT","カテゴリアイコンを右側に表示する");
define("_AM_OPTIONSETTINGS","オプション");
define("_AM_DISP_CONTENUE","[全ての記事を表示]");
define("_AM_PUB_ARTICLES","掲載中のニュース記事");
define("_AM_WAITING_ARTICLES","承認待ちのニュース記事");
define("_AM_ARTICLE_ADMIN","ニュース記事の管理");
define("_AM_NOSUBJECT","題名なし");
define("_AM_RIGHT_TO_POST","投稿を許可する");
define("_AM_RIGHT_TO_APPROVE","掲載を自動承認する");
define("_AM_RIGHT_TO_CHOSE_DATE","掲載日時設定を許可する");
define("_AM_RIGHT_HTML","HTMLの使用を許可する");
define("_AM_RIGHT_XCODE","XOOPSコードの使用を許可する");
define("_AM_RIGHT_SMILEY","顔アイコンの使用を許可する");
define("_AM_DATE_FORMAT","%y 年 %m 月 %d 日 %h 時 %i 分");
define("_AM_POST_NOW","この記事を今すぐトップページ最上部に掲載する");
define("_AM_USE_SAMILEY","顔アイコンを有効にする");
define("_AM_USE_HTML","HTMLタグを有効にする");
define("_AM_USE_BR","改行を自動挿入する");
define("_AM_USE_XCODE","XOOPSコードを有効にする");
define("_AM_SELECTTOPIC","カテゴリを選択してください。");
define("_AM_NO_TOPICS","カテゴリがありません。");
define("_AM_DO_YOU_CONVERT","newsから記事・カテゴリの情報を取り込みますか？");
define("_AM_EDIT_ARTICLE","ニュース記事の編集");
define("_AM_NO_ARTICLES","記事はありません。");
define("_AM_CONFIG","%s管理");

// v 1.01 added
define("_AM_TOPICS_DELETE","カテゴリ削除");
define("_AM_TOPICID","ID");
define("_AM_DESTINATION_OF_STORIES","カテゴリに属する記事の送り先");
define("_AM_FOLLOW_TOPICS_IS_DELETED","以下のカテゴリは削除されます。");


define("_AM_CREDIT","Bulletin(www.suin.jp)");
// 以下の行は翻訳者の名前やURLなどに変更できます。以下は管理画面に表示されます。
// It is able to change a following line into the TRANSLATER's name and website. Follow appears at admin page.
define("_AM_TRANSLATER","Japanese patch(www.suin.jp)");
// example : define("_AM_TRANSLATER","English patch(www.english-tranlater.com)");

}
?>