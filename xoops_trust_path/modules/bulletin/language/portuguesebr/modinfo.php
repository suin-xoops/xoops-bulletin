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
define($constpref."_DESC","Cria um sistema de notícias tipo Slashdot, onde os usuários podem comentar livremente.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Categorias das notícias");
define($constpref."_BDESC1","Bloco de categorias das notícias");
define($constpref."_BNAME2","Grande notícia de hoje");
define($constpref."_BDESC2","Bloco de grande notícia de hoje");
define($constpref."_BNAME3","Calendário");
define($constpref."_BDESC3","Bloco de calendário");
define($constpref."_BNAME4","Notícias recentes");
define($constpref."_BDESC4","Bloco de notícias recentes");
define($constpref."_BNAME5","Notícias recentes por categoria");
define($constpref."_BDESC5","Bloco de notícias recentes por categoria");
define($constpref."_BNAME6","Comentários recentes do Bulletin");
define($constpref."_BDESC6","Bloco de comentários recentes do Bulletin");

// Sub menu
define($constpref."_SMNAME1","Enviar notícias");
define($constpref."_SMNAME2","Arquivo");

//
define($constpref."_TEMPLATE1","Página de arquivo");
define($constpref."_TEMPLATE2","Página de notícia avulsa");
define($constpref."_TEMPLATE3","Página principal");
define($constpref."_TEMPLATE4","Template das notícias");
define($constpref."_TEMPLATE5","Página de impressão");
define($constpref."_TEMPLATE6","Página de RSS");
define($constpref."_TEMPLATE7","Header comum à todas as páginas"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Preferências");
define($constpref."_ADMENU1_D","Definição de configurações básicas.");
define($constpref."_ADMENU2","Gerenciador de categorias");
define($constpref."_ADMENU2_D","Gerenciamento dos categorias.");
define($constpref."_ADMENU3","Postar nova notícia");
define($constpref."_ADMENU3_D","Envio de uma nova notícia.");
define($constpref."_ADMENU4","Gerenciador de permissões de postagem");
define($constpref."_ADMENU4_D","Definição das permissões para o envio de notícias.");
define($constpref."_ADMENU5","Gerenciador de notícias");
define($constpref."_ADMENU5_D","Edição/exclusão/aprovação de notícias.");
define($constpref."_ADMENU6","Gerenciador de grupos/blocos");
define($constpref."_ADMENU6_D","Definição de configurações de blocos e permissões dos grupos.");
define($constpref."_ADMENU7","Importar do news");
define($constpref."_ADMENU7_D","Converte dados de notícias e categorias do news1.1.");

// Title of config items
define($constpref."_CONFIG1", "Nº de notícias exibidas na página principal");
define($constpref."_CONFIG1_D", "Defina a quantidade de notícias a serem exibidas na página principal.");
define($constpref."_CONFIG2", "Exibir caixa de navegação?");
define($constpref."_CONFIG2_D", "Para exibir uma caixa de navegação de seleção de categorias no topo das notícias, escolha \"Sim\".");
define($constpref."_CONFIG3","Altura do textarea para envio/edição");
define($constpref."_CONFIG3_D", "Defina o nº de linhas do textarea da página do submit.php.");
define($constpref."_CONFIG4","Largura do textarea para envio/edição");
define($constpref."_CONFIG4_D", "Defina o nº de colunas do textarea da página do submit.php.");
define($constpref."_CONFIG5","Formato de data/hora");
define($constpref."_CONFIG5_D", "Use como referência as funções date do PHP/formatTimestamp do XOOPS.");
define($constpref."_CONFIG6","Refletir envios na contagem de posts dos usuários");
define($constpref."_CONFIG6_D", "Quando uma notícia enviada através do submit.php for aprovada, ela será somada ao \"Nº de posts\" do usuário.");
define($constpref."_CONFIG7","Caminho para o diretório de ícones das categorias");
define($constpref."_CONFIG7_D", "Defina com o caminho absoluto.");
define($constpref."_CONFIG8","Endereço da imagem da página de impressão");
define($constpref."_CONFIG8_D", "Defina a endereço do logotipo a ser exibido na página de impressão.");
define($constpref."_CONFIG9","Usar o nome da notícia como título do site");
define($constpref."_CONFIG9_D", "Substitui o título do site pelo assunto da notícia. Diz-se efetivo para SEO.");
define($constpref."_CONFIG10","assign endereço do RSS no xoops_module_header");
define($constpref."_CONFIG10_D", "");
// 1.01 added
define($constpref."_CONFIG11","Mostrar ícone \"Imprimir\"?");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Mostrar ícone \"Enviar à um amigo\"?");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Usar o módulo Tell A Friend?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Mostrar link para o RSS?");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY", "Global");
define($constpref."_GLOBAL_NOTIFYDSC", "Opções de aviso globais para o módulo de notícias.");

define($constpref."_STORY_NOTIFY", "Notícia atual");
define($constpref."_STORY_NOTIFYDSC", "Opções de aviso para a notícia atual.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quando uma nova categoria for criado.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quando uma nova categoria for criado.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria criada");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY", "Nova notícia enviada");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quando uma nova notícia for enviada.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quando uma nova notícia for enviada.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia enviada");

define($constpref."_GLOBAL_NEWSTORY_NOTIFY", "Nova notícia publicada");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quando uma nova notícia for publicada.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quando uma nova notícia for publicada.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia publicada");

define($constpref."_STORY_APPROVE_NOTIFY", "Aprovação de notícia");
define($constpref."_STORY_APPROVE_NOTIFYCAP", "Avisar-me quando esta notícia for aprovada.");
define($constpref."_STORY_APPROVE_NOTIFYDSC", "Avisar-me quando esta notícia for aprovada.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: notícia aprovada");

}

?>