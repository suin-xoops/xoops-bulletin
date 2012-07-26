<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Bulletin");

// A brief description of this module
define($constpref."_DESC","Cria um sistema de not�cias tipo Slashdot, onde os usu�rios podem comentar livremente.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Categorias das not�cias");
define($constpref."_BDESC1","Bloco de categorias das not�cias");
define($constpref."_BNAME2","Grande not�cia de hoje");
define($constpref."_BDESC2","Bloco de grande not�cia de hoje");
define($constpref."_BNAME3","Calend�rio");
define($constpref."_BDESC3","Bloco de calend�rio");
define($constpref."_BNAME4","Not�cias recentes");
define($constpref."_BDESC4","Bloco de not�cias recentes");
define($constpref."_BNAME5","Not�cias recentes por categoria");
define($constpref."_BDESC5","Bloco de not�cias recentes por categoria");
define($constpref."_BNAME6","Coment�rios recentes do Bulletin");
define($constpref."_BDESC6","Bloco de coment�rios recentes do Bulletin");

// Sub menu
define($constpref."_SMNAME1","Enviar not�cias");
define($constpref."_SMNAME2","Arquivo");

//
define($constpref."_TEMPLATE1","P�gina de arquivo");
define($constpref."_TEMPLATE2","P�gina de not�cia avulsa");
define($constpref."_TEMPLATE3","P�gina principal");
define($constpref."_TEMPLATE4","Template das not�cias");
define($constpref."_TEMPLATE5","P�gina de impress�o");
define($constpref."_TEMPLATE6","P�gina de RSS");
define($constpref."_TEMPLATE7","Header comum � todas as p�ginas"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Prefer�ncias");
define($constpref."_ADMENU1_D","Defini��o de configura��es b�sicas.");
define($constpref."_ADMENU2","Gerenciador de categorias");
define($constpref."_ADMENU2_D","Gerenciamento dos categorias.");
define($constpref."_ADMENU3","Postar nova not�cia");
define($constpref."_ADMENU3_D","Envio de uma nova not�cia.");
define($constpref."_ADMENU4","Gerenciador de permiss�es de postagem");
define($constpref."_ADMENU4_D","Defini��o das permiss�es para o envio de not�cias.");
define($constpref."_ADMENU5","Gerenciador de not�cias");
define($constpref."_ADMENU5_D","Edi��o/exclus�o/aprova��o de not�cias.");
define($constpref."_ADMENU6","Gerenciador de grupos/blocos");
define($constpref."_ADMENU6_D","Defini��o de configura��es de blocos e permiss�es dos grupos.");
define($constpref."_ADMENU7","Importar do news");
define($constpref."_ADMENU7_D","Converte dados de not�cias e categorias do news1.1.");

// Title of config items
define($constpref."_CONFIG1", "N� de not�cias exibidas na p�gina principal");
define($constpref."_CONFIG1_D", "Defina a quantidade de not�cias a serem exibidas na p�gina principal.");
define($constpref."_CONFIG2", "Exibir caixa de navega��o?");
define($constpref."_CONFIG2_D", "Para exibir uma caixa de navega��o de sele��o de categorias no topo das not�cias, escolha \"Sim\".");
define($constpref."_CONFIG3","Altura do textarea para envio/edi��o");
define($constpref."_CONFIG3_D", "Defina o n� de linhas do textarea da p�gina do submit.php.");
define($constpref."_CONFIG4","Largura do textarea para envio/edi��o");
define($constpref."_CONFIG4_D", "Defina o n� de colunas do textarea da p�gina do submit.php.");
define($constpref."_CONFIG5","Formato de data/hora");
define($constpref."_CONFIG5_D", "Use como refer�ncia as fun��es date do PHP/formatTimestamp do XOOPS.");
define($constpref."_CONFIG6","Refletir envios na contagem de posts dos usu�rios");
define($constpref."_CONFIG6_D", "Quando uma not�cia enviada atrav�s do submit.php for aprovada, ela ser� somada ao \"N� de posts\" do usu�rio.");
define($constpref."_CONFIG7","Caminho para o diret�rio de �cones das categorias");
define($constpref."_CONFIG7_D", "Defina com o caminho absoluto.");
define($constpref."_CONFIG8","Endere�o da imagem da p�gina de impress�o");
define($constpref."_CONFIG8_D", "Defina a endere�o do logotipo a ser exibido na p�gina de impress�o.");
define($constpref."_CONFIG9","Usar o nome da not�cia como t�tulo do site");
define($constpref."_CONFIG9_D", "Substitui o t�tulo do site pelo assunto da not�cia. Diz-se efetivo para SEO.");
define($constpref."_CONFIG10","assign endere�o do RSS no xoops_module_header");
define($constpref."_CONFIG10_D", "");
// 1.01 added
define($constpref."_CONFIG11","Mostrar �cone \"Imprimir\"?");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Mostrar �cone \"Enviar � um amigo\"?");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Usar o m�dulo Tell A Friend?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Mostrar link para o RSS?");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY", "Global");
define($constpref."_GLOBAL_NOTIFYDSC", "Op��es de aviso globais para o m�dulo de not�cias.");

define($constpref."_STORY_NOTIFY", "Not�cia atual");
define($constpref."_STORY_NOTIFYDSC", "Op��es de aviso para a not�cia atual.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quando uma nova categoria for criado.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quando uma nova categoria for criado.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria criada");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY", "Nova not�cia enviada");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quando uma nova not�cia for enviada.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quando uma nova not�cia for enviada.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia enviada");

define($constpref."_GLOBAL_NEWSTORY_NOTIFY", "Nova not�cia publicada");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quando uma nova not�cia for publicada.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quando uma nova not�cia for publicada.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia publicada");

define($constpref."_STORY_APPROVE_NOTIFY", "Aprova��o de not�cia");
define($constpref."_STORY_APPROVE_NOTIFYCAP", "Avisar-me quando esta not�cia for aprovada.");
define($constpref."_STORY_APPROVE_NOTIFYDSC", "Avisar-me quando esta not�cia for aprovada.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: not�cia aprovada");

}

?>