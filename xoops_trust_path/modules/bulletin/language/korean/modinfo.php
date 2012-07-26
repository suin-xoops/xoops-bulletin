<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref.'_NAME','Bulletin');

// A brief description of this module
define($constpref.'_DESC','유저가 자유롭게 코멘트할 수 있는 뉴스기자 시스템을 구축합니다.');

// Names of blocks for this module (Not all module has blocks)
define($constpref.'_BNAME1','뉴스카테고리');
define($constpref.'_BDESC1','뉴스카테고리 블록');
define($constpref.'_BNAME2','오늘 톱뉴스');
define($constpref.'_BDESC2','오늘 톱슈스 블록');
define($constpref.'_BNAME3','달력');
define($constpref.'_BDESC3','달력 블록');
define($constpref.'_BNAME4','최신뉴스');
define($constpref.'_BDESC4','최신뉴스 블록');
define($constpref.'_BNAME5','카테고리별 최신뉴스');
define($constpref.'_BDESC5','카테고리별 최신뉴스 블록');
define($constpref.'_BNAME6','블리틴 신착코멘트');
define($constpref.'_BDESC6','블리틴 신착코멘트 블록');

// Sub menu
define($constpref.'_SMNAME1','뉴스쓰기');
define($constpref.'_SMNAME2','과거기사');

//
define($constpref.'_TEMPLATE1','과서기사페이지');
define($constpref.'_TEMPLATE2','단수기사페이지');
define($constpref.'_TEMPLATE3','톱페이지');
define($constpref.'_TEMPLATE4','기사템플레이트');
define($constpref.'_TEMPLATE5','인쇄페이지');
define($constpref.'_TEMPLATE6','RSS페이지');
define($constpref.'_TEMPLATE7','전페이지 공통 헤더'); // 1.01 added

// Admin
define($constpref.'_ADMENU2','카테고리 관리');
define($constpref.'_ADMENU3','새로운 뉴스기사쓰기');
define($constpref.'_ADMENU4','권한관리');
define($constpref.'_ADMENU5','뉴스기사 관리');
define($constpref.'_ADMENU7','news모듈의 기사를 임포트하기');

// Title of config items
define($constpref.'_CONFIG1', 톱페이지에 싣는 기사수');
define($constpref.'_CONFIG1_D', '톱페이지에 표시하는 기사수를 고르십시오.');
define($constpref.'_CONFIG2', '나비게이숀박스를 표시함');
define($constpref.'_CONFIG2_D', '카테고리를 고르는 나비게이숀박스를 기사상부에 표시할 때는 "네"를 고르십시오.');
define($constpref.'_CONFIG3','투고, 수정용 텍스트에어리어의 높이');
define($constpref.'_CONFIG3_D', 'submit.php페이지의 텍스트에어리어 행수를 설정해 주십시오.');
define($constpref.'_CONFIG4','투고, 수정용 텍스트에어리어의 폭');
define($constpref.'_CONFIG4_D', 'submit.php페이지의 텍스트에어리어 컬럼수를 설정해 주십시오.');
define($constpref.'_CONFIG5','날짜, 시간의 서식');
define($constpref.'_CONFIG5_D', '서식은 PHP의 date함수, XOOPS의formatTimestamp함수를 참조해 주십시오.');
define($constpref.'_CONFIG6','투고를 유저의 투고수에 반영함');
define($constpref.'_CONFIG6_D', 'submit.php에서 투고된 기사가 승인되었을 때에, 그 유저의 "투고수"에 가산합니다.');
define($constpref.'_CONFIG7','카테고리 화상이 있는 디렉터리의 패스');
define($constpref.'_CONFIG7_D', '절대페스로 가리켜 주십시오.');
define($constpref.'_CONFIG8','인쇄페이지의 화상URL');
define($constpref.'_CONFIG8_D', '인쇄용페이지에 표시되는 로고화상을 URL으로 가리켜 주십시오.');
define($constpref.'_CONFIG9','기사명을 타이틀로 함');
define($constpref.'_CONFIG9_D', '기사 제명을 사이트의 타이틀로 바꿔 놓읍니다.');
define($constpref.'_CONFIG10','xoops_module_header에 RSS의 URL을 assing함');
define($constpref.'_CONFIG10_D', '');
// 1.01 added
define($constpref.'_CONFIG11','"인쇄용 페이지" 아이콘을 표시함');
define($constpref.'_CONFIG11_D', '');
define($constpref.'_CONFIG12','"이 기사를 친구에게 추천" 아이콘을 표시함');
define($constpref.'_CONFIG12_D', '');
define($constpref.'_CONFIG13','Tell A Friend모듈을 이용함');
define($constpref.'_CONFIG13_D', '');
define($constpref.'_CONFIG14','RSS의 린크를 표시함');
define($constpref.'_CONFIG14_D', '');

// Text for notifications
define($constpref.'_GLOBAL_NOTIFY', '모듈 전체');
define($constpref.'_GLOBAL_NOTIFYDSC', '뉴스 모듈 전체에 대한 통지 옵션');

define($constpref.'_STORY_NOTIFY', '현 뉴스기사');
define($constpref.'_STORY_NOTIFYDSC', '현 뉴스기사에 대한 통지 옵션');

define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFY', '신규 카테고리');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYCAP', '신규 카테고리가 작성된 경우 통지함.');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYDSC', '신규 카테고리가 작성된 경우 통지합니다.'');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : 신규 카테고리가 작성되었습니다.');

define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFY', '신규 뉴스기사 투고');       
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYCAP', '신규 뉴스기사의 투고가 있을 경우 통지함.');                           
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYDSC', '신규 뉴스기사의 투고가 있을 경우 통지합니다.');                
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : 신규 뉴스기사가 투고되었습니다.');                              

define($constpref.'_GLOBAL_NEWSTORY_NOTIFY', '신규 뉴스기사 게재');       
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYCAP', '신규 뉴스기사가 정식 게재된 경우 통지함');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYDSC', '신규 뉴스기사가 정식 게재된 경우 통지합니다.');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : 신규 뉴스기사가 정식게재되었습니다.');                              

define($constpref.'_STORY_APPROVE_NOTIFY', '뉴스기사 승인/게재');
define($constpref.'_STORY_APPROVE_NOTIFYCAP', '이 뉴스기사가 정식 승인/게재된 경우 통지함');
define($constpref.'_STORY_APPROVE_NOTIFYDSC', '이 뉴스기사가 정식 승인/게재된 경우 통지합니다.');
define($constpref.'_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : 뉴스기사가 승인/게재되었습니다.');

}

?>