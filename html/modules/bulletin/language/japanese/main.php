<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MB_LOADED' ) ) {

define( 'BULLETIN_MB_LOADED' , 1 ) ;

//%%%%%%		File Name index.php 		%%%%%
define("_MD_PRINTER","印刷用ページ");
define("_MD_SENDSTORY","このニュースを友達に送る");
define("_MD_READMORE","続きを読む");
define("_MD_COMMENTS","0コメント");
define("_MD_ONECOMMENT","1コメント");
define("_MD_BYTESMORE","残り%s字");
define("_MD_NUMCOMMENTS","%sコメント");

//%%%%%%		File Name submit.php		%%%%%
define("_MD_SUBMITNEWS","ニュース投稿");
define("_MD_TITLE","表題");
define("_MD_TOPIC","カテゴリ");
define("_MD_THESCOOP","メッセージ本文");
define("_MD_NOTIFYPUBLISH","ニュースが承認された旨をメールで受け取る");
define("_MD_POST","投稿する");
define("_MD_GO","送信");
define("_MD_THANKS","投稿を受付けました。当サイトスタッフによる承認を経た後に正式掲載となることをご了承ください。"); //submission of news article
// Added 2.0.11jp
define("_MD_THANKS_AUTOAPPROVE", "投稿ありがとうございました。");

define("_MD_NOTIFYSBJCT","NEWS for my site"); // Notification mail subject
define("_MD_NOTIFYMSG","新規ニュースの投稿がありました。"); // Notification mail message

//%%%%%%		File Name archive.php		%%%%%
define("_MD_NEWSARCHIVES","ニュースアーカイブ");
define("_MD_ARTICLES","ニュース");
define("_MD_VIEWS","ヒット");
define("_MD_DATE","投稿日時");
define("_MD_ACTIONS","");
define("_MD_PRINTERFRIENDLY","印刷用ページ");
define("_MD_THEREAREINTOTAL","計 %s 件のニュース記事があります");

// %s is your site name
define("_MD_INTARTICLE","%sで見つけた興味深いニュース");
define("_MD_INTARTFOUND","以下は%sで見つけた非常に興味深いニュース記事です：");

define("_MD_TOPICC","カテゴリ：");
define("_MD_URL","URL：");
define("_MD_NOSTORY","選択されたニュース記事は存在しません");

//%%%%%%	File Name print.php 	%%%%%

define("_MD_URLFORSTORY","このニュース記事が掲載されているURL：");

// %s represents your site name
define("_MD_THISCOMESFROM","%sにて更に多くのニュース記事をよむことができます");

// Added language definitions for news expiry date
define("_AM_EXPARTS","表示期限が過ぎた記事");
define("_AM_EXPIRED","期限切れ");
define("_AM_CHANGEEXPDATETIME","表示期限(日付/時刻)を変更");
define("_AM_SETEXPDATETIME","表示期限(日付/時刻)を設定");
define("_AM_NOWSETEXPTIME","設定済の表示期限: %s");

// Added by suin
define("_MD_YEAR_X","%s年");
define("_MD_NO_ARCIVES","アーカイブはありません。");
define("_MD_THANKS_BUT_ERROR", "投稿ありがとうございました。しかし、<span style=\"color:red\">エラー</span>が発生したため記事が送信されませんでした。お手数ですが管理者にお問い合わせください。");
define("_MD_USE_HTML","HTMLを有効にする");
define("_MD_USE_SMILEY","顔アイコンを有効にする");
define("_MD_USE_BR","改行を自動挿入する");
define("_MD_USE_XCODE","XOOPSコードを有効にする");
define("_MD_JANUARY", "1月");
define("_MD_FEBRUARY", "2月");
define("_MD_MARCH", "3月");
define("_MD_APRIL", "4月");
define("_MD_MAY", "5月");
define("_MD_JUNE", "6月");
define("_MD_JULY", "7月");
define("_MD_AUGUST", "8月");
define("_MD_SEPTEMBER", "9月");
define("_MD_OCTOBER", "10月");
define("_MD_NOVEMBER", "11月");
define("_MD_DECEMBER", "12月");
define("_MD_NO_TOPICS","カテゴリがありません。");

// ver 1.01 added
define("_MD_RSS", "RSS");

}
?>