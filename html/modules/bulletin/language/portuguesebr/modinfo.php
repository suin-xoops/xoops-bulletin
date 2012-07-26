<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Cria um sistema de not�cias tipo Slashdot, onde os usu�rios podem comentar livremente.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Categorias das not�cias");
define("_MI_BULLETIN_BDESC1","Bloco de categorias das not�cias");
define("_MI_BULLETIN_BNAME2","Grande not�cia de hoje");
define("_MI_BULLETIN_BDESC2","Bloco de grande not�cia de hoje");
define("_MI_BULLETIN_BNAME3","Calend�rio");
define("_MI_BULLETIN_BDESC3","Bloco de calend�rio");
define("_MI_BULLETIN_BNAME4","Not�cias recentes");
define("_MI_BULLETIN_BDESC4","Bloco de not�cias recentes");
define("_MI_BULLETIN_BNAME5","Not�cias recentes por categoria");
define("_MI_BULLETIN_BDESC5","Bloco de not�cias recentes por categoria");
define("_MI_BULLETIN_BNAME6","Coment�rios recentes do Bulletin");
define("_MI_BULLETIN_BDESC6","Bloco de coment�rios recentes do Bulletin");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Enviar not�cias");
define("_MI_BULLETIN_SMNAME2","Arquivo");

//
define("_MI_BULLETIN_TEMPLATE1","P�gina de arquivo");
define("_MI_BULLETIN_TEMPLATE2","P�gina de not�cia avulsa");
define("_MI_BULLETIN_TEMPLATE3","P�gina principal");
define("_MI_BULLETIN_TEMPLATE4","Template das not�cias");
define("_MI_BULLETIN_TEMPLATE5","P�gina de impress�o");
define("_MI_BULLETIN_TEMPLATE6","P�gina de RSS");
define("_MI_BULLETIN_TEMPLATE7","Header comum � todas as p�ginas"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Prefer�ncias");
define("_MI_BULLETIN_ADMENU1_D","Defini��o de configura��es b�sicas.");
define("_MI_BULLETIN_ADMENU2","Gerenciador de categorias");
define("_MI_BULLETIN_ADMENU2_D","Gerenciamento dos categorias.");
define("_MI_BULLETIN_ADMENU3","Postar nova not�cia");
define("_MI_BULLETIN_ADMENU3_D","Envio de uma nova not�cia.");
define("_MI_BULLETIN_ADMENU4","Gerenciador de permiss�es de postagem");
define("_MI_BULLETIN_ADMENU4_D","Defini��o das permiss�es para o envio de not�cias.");
define("_MI_BULLETIN_ADMENU5","Gerenciador de not�cias");
define("_MI_BULLETIN_ADMENU5_D","Edi��o/exclus�o/aprova��o de not�cias.");
define("_MI_BULLETIN_ADMENU6","Gerenciador de grupos/blocos");
define("_MI_BULLETIN_ADMENU6_D","Defini��o de configura��es de blocos e permiss�es dos grupos.");
define("_MI_BULLETIN_ADMENU7","Importar do news");
define("_MI_BULLETIN_ADMENU7_D","Converte dados de not�cias e categorias do news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "N� de not�cias exibidas na p�gina principal");
define("_MI_BULLETIN_CONFIG1_D", "Defina a quantidade de not�cias a serem exibidas na p�gina principal.");
define("_MI_BULLETIN_CONFIG2", "Exibir caixa de navega��o?");
define("_MI_BULLETIN_CONFIG2_D", "Para exibir uma caixa de navega��o de sele��o de categorias no topo das not�cias, escolha \"Sim\".");
define("_MI_BULLETIN_CONFIG3","Altura do textarea para envio/edi��o");
define("_MI_BULLETIN_CONFIG3_D", "Defina o n� de linhas do textarea da p�gina do submit.php.");
define("_MI_BULLETIN_CONFIG4","Largura do textarea para envio/edi��o");
define("_MI_BULLETIN_CONFIG4_D", "Defina o n� de colunas do textarea da p�gina do submit.php.");
define("_MI_BULLETIN_CONFIG5","Formato de data/hora");
define("_MI_BULLETIN_CONFIG5_D", "Use como refer�ncia as fun��es date do PHP/formatTimestamp do XOOPS.");
define("_MI_BULLETIN_CONFIG6","Refletir envios na contagem de posts dos usu�rios");
define("_MI_BULLETIN_CONFIG6_D", "Quando uma not�cia enviada atrav�s do submit.php for aprovada, ela ser� somada ao \"N� de posts\" do usu�rio.");
define("_MI_BULLETIN_CONFIG7","Caminho para o diret�rio de �cones das categorias");
define("_MI_BULLETIN_CONFIG7_D", "Defina com o caminho absoluto.");
define("_MI_BULLETIN_CONFIG8","Endere�o da imagem da p�gina de impress�o");
define("_MI_BULLETIN_CONFIG8_D", "Defina a endere�o do logotipo a ser exibido na p�gina de impress�o.");
define("_MI_BULLETIN_CONFIG9","Usar o nome da not�cia como t�tulo do site");
define("_MI_BULLETIN_CONFIG9_D", "Substitui o t�tulo do site pelo assunto da not�cia. Diz-se efetivo para SEO.");
define("_MI_BULLETIN_CONFIG10","assign endere�o do RSS no xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Mostrar �cone \"Imprimir\"?");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Mostrar �cone \"Enviar � um amigo\"?");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Usar o m�dulo Tell A Friend?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Mostrar link para o RSS?");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "Op��es de aviso globais para o m�dulo de not�cias.");

define("_MI_BULLETIN_STORY_NOTIFY", "Not�cia atual");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "Op��es de aviso para a not�cia atual.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quando uma nova categoria for criado.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quando uma nova categoria for criado.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria criada");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "Nova not�cia enviada");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quando uma nova not�cia for enviada.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quando uma nova not�cia for enviada.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia enviada");

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "Nova not�cia publicada");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quando uma nova not�cia for publicada.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quando uma nova not�cia for publicada.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia publicada");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "Aprova��o de not�cia");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "Avisar-me quando esta not�cia for aprovada.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "Avisar-me quando esta not�cia for aprovada.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: not�cia aprovada");

}

?>