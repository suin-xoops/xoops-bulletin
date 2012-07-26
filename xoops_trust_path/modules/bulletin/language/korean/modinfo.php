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
define($constpref.'_DESC','������ �����Ӱ� �ڸ�Ʈ�� �� �ִ� �������� �ý����� �����մϴ�.');

// Names of blocks for this module (Not all module has blocks)
define($constpref.'_BNAME1','����ī�װ�');
define($constpref.'_BDESC1','����ī�װ� ���');
define($constpref.'_BNAME2','���� �鴺��');
define($constpref.'_BDESC2','���� �齴�� ���');
define($constpref.'_BNAME3','�޷�');
define($constpref.'_BDESC3','�޷� ���');
define($constpref.'_BNAME4','�ֽŴ���');
define($constpref.'_BDESC4','�ֽŴ��� ���');
define($constpref.'_BNAME5','ī�װ��� �ֽŴ���');
define($constpref.'_BDESC5','ī�װ��� �ֽŴ��� ���');
define($constpref.'_BNAME6','��ƾ �����ڸ�Ʈ');
define($constpref.'_BDESC6','��ƾ �����ڸ�Ʈ ���');

// Sub menu
define($constpref.'_SMNAME1','��������');
define($constpref.'_SMNAME2','���ű��');

//
define($constpref.'_TEMPLATE1','�������������');
define($constpref.'_TEMPLATE2','�ܼ����������');
define($constpref.'_TEMPLATE3','��������');
define($constpref.'_TEMPLATE4','������÷���Ʈ');
define($constpref.'_TEMPLATE5','�μ�������');
define($constpref.'_TEMPLATE6','RSS������');
define($constpref.'_TEMPLATE7','�������� ���� ���'); // 1.01 added

// Admin
define($constpref.'_ADMENU2','ī�װ� ����');
define($constpref.'_ADMENU3','���ο� ������羲��');
define($constpref.'_ADMENU4','���Ѱ���');
define($constpref.'_ADMENU5','������� ����');
define($constpref.'_ADMENU7','news����� ��縦 ����Ʈ�ϱ�');

// Title of config items
define($constpref.'_CONFIG1', ���������� �ƴ� ����');
define($constpref.'_CONFIG1_D', '���������� ǥ���ϴ� ������ ���ʽÿ�.');
define($constpref.'_CONFIG2', '������̼�ڽ��� ǥ����');
define($constpref.'_CONFIG2_D', 'ī�װ��� ���� ������̼�ڽ��� ����ο� ǥ���� ���� "��"�� ���ʽÿ�.');
define($constpref.'_CONFIG3','����, ������ �ؽ�Ʈ������� ����');
define($constpref.'_CONFIG3_D', 'submit.php�������� �ؽ�Ʈ����� ����� ������ �ֽʽÿ�.');
define($constpref.'_CONFIG4','����, ������ �ؽ�Ʈ������� ��');
define($constpref.'_CONFIG4_D', 'submit.php�������� �ؽ�Ʈ����� �÷����� ������ �ֽʽÿ�.');
define($constpref.'_CONFIG5','��¥, �ð��� ����');
define($constpref.'_CONFIG5_D', '������ PHP�� date�Լ�, XOOPS��formatTimestamp�Լ��� ������ �ֽʽÿ�.');
define($constpref.'_CONFIG6','���� ������ ������� �ݿ���');
define($constpref.'_CONFIG6_D', 'submit.php���� ����� ��簡 ���εǾ��� ����, �� ������ "�����"�� �����մϴ�.');
define($constpref.'_CONFIG7','ī�װ� ȭ���� �ִ� ���͸��� �н�');
define($constpref.'_CONFIG7_D', '�����佺�� ������ �ֽʽÿ�.');
define($constpref.'_CONFIG8','�μ��������� ȭ��URL');
define($constpref.'_CONFIG8_D', '�μ���������� ǥ�õǴ� �ΰ�ȭ���� URL���� ������ �ֽʽÿ�.');
define($constpref.'_CONFIG9','������ Ÿ��Ʋ�� ��');
define($constpref.'_CONFIG9_D', '��� ������ ����Ʈ�� Ÿ��Ʋ�� �ٲ� �����ϴ�.');
define($constpref.'_CONFIG10','xoops_module_header�� RSS�� URL�� assing��');
define($constpref.'_CONFIG10_D', '');
// 1.01 added
define($constpref.'_CONFIG11','"�μ�� ������" �������� ǥ����');
define($constpref.'_CONFIG11_D', '');
define($constpref.'_CONFIG12','"�� ��縦 ģ������ ��õ" �������� ǥ����');
define($constpref.'_CONFIG12_D', '');
define($constpref.'_CONFIG13','Tell A Friend����� �̿���');
define($constpref.'_CONFIG13_D', '');
define($constpref.'_CONFIG14','RSS�� ��ũ�� ǥ����');
define($constpref.'_CONFIG14_D', '');

// Text for notifications
define($constpref.'_GLOBAL_NOTIFY', '��� ��ü');
define($constpref.'_GLOBAL_NOTIFYDSC', '���� ��� ��ü�� ���� ���� �ɼ�');

define($constpref.'_STORY_NOTIFY', '�� �������');
define($constpref.'_STORY_NOTIFYDSC', '�� ������翡 ���� ���� �ɼ�');

define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFY', '�ű� ī�װ�');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYCAP', '�ű� ī�װ��� �ۼ��� ��� ������.');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYDSC', '�ű� ī�װ��� �ۼ��� ��� �����մϴ�.'');
define($constpref.'_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : �ű� ī�װ��� �ۼ��Ǿ����ϴ�.');

define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFY', '�ű� ������� ����');       
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYCAP', '�ű� ��������� ���� ���� ��� ������.');                           
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYDSC', '�ű� ��������� ���� ���� ��� �����մϴ�.');                
define($constpref.'_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : �ű� ������簡 ����Ǿ����ϴ�.');                              

define($constpref.'_GLOBAL_NEWSTORY_NOTIFY', '�ű� ������� ����');       
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYCAP', '�ű� ������簡 ���� ����� ��� ������');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYDSC', '�ű� ������簡 ���� ����� ��� �����մϴ�.');
define($constpref.'_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : �ű� ������簡 ���İ���Ǿ����ϴ�.');                              

define($constpref.'_STORY_APPROVE_NOTIFY', '������� ����/����');
define($constpref.'_STORY_APPROVE_NOTIFYCAP', '�� ������簡 ���� ����/����� ��� ������');
define($constpref.'_STORY_APPROVE_NOTIFYDSC', '�� ������簡 ���� ����/����� ��� �����մϴ�.');
define($constpref.'_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : ������簡 ����/����Ǿ����ϴ�.');

}

?>