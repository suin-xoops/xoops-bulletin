<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Cria um sistema de notícias tipo Slashdot, onde os usuários podem comentar livremente.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Categorias das notícias");
define("_MI_BULLETIN_BDESC1","Bloco de categorias das notícias");
define("_MI_BULLETIN_BNAME2","Grande notícia de hoje");
define("_MI_BULLETIN_BDESC2","Bloco de grande notícia de hoje");
define("_MI_BULLETIN_BNAME3","Calendário");
define("_MI_BULLETIN_BDESC3","Bloco de calendário");
define("_MI_BULLETIN_BNAME4","Notícias recentes");
define("_MI_BULLETIN_BDESC4","Bloco de notícias recentes");
define("_MI_BULLETIN_BNAME5","Notícias recentes por categoria");
define("_MI_BULLETIN_BDESC5","Bloco de notícias recentes por categoria");
define("_MI_BULLETIN_BNAME6","Comentários recentes do Bulletin");
define("_MI_BULLETIN_BDESC6","Bloco de comentários recentes do Bulletin");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Enviar notícias");
define("_MI_BULLETIN_SMNAME2","Arquivo");

//
define("_MI_BULLETIN_TEMPLATE1","Página de arquivo");
define("_MI_BULLETIN_TEMPLATE2","Página de notícia avulsa");
define("_MI_BULLETIN_TEMPLATE3","Página principal");
define("_MI_BULLETIN_TEMPLATE4","Template das notícias");
define("_MI_BULLETIN_TEMPLATE5","Página de impressão");
define("_MI_BULLETIN_TEMPLATE6","Página de RSS");
define("_MI_BULLETIN_TEMPLATE7","Header comum à todas as páginas"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Preferências");
define("_MI_BULLETIN_ADMENU1_D","Definição de configurações básicas.");
define("_MI_BULLETIN_ADMENU2","Gerenciador de categorias");
define("_MI_BULLETIN_ADMENU2_D","Gerenciamento dos categorias.");
define("_MI_BULLETIN_ADMENU3","Postar nova notícia");
define("_MI_BULLETIN_ADMENU3_D","Envio de uma nova notícia.");
define("_MI_BULLETIN_ADMENU4","Gerenciador de permissões de postagem");
define("_MI_BULLETIN_ADMENU4_D","Definição das permissões para o envio de notícias.");
define("_MI_BULLETIN_ADMENU5","Gerenciador de notícias");
define("_MI_BULLETIN_ADMENU5_D","Edição/exclusão/aprovação de notícias.");
define("_MI_BULLETIN_ADMENU6","Gerenciador de grupos/blocos");
define("_MI_BULLETIN_ADMENU6_D","Definição de configurações de blocos e permissões dos grupos.");
define("_MI_BULLETIN_ADMENU7","Importar do news");
define("_MI_BULLETIN_ADMENU7_D","Converte dados de notícias e categorias do news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "Nº de notícias exibidas na página principal");
define("_MI_BULLETIN_CONFIG1_D", "Defina a quantidade de notícias a serem exibidas na página principal.");
define("_MI_BULLETIN_CONFIG2", "Exibir caixa de navegação?");
define("_MI_BULLETIN_CONFIG2_D", "Para exibir uma caixa de navegação de seleção de categorias no topo das notícias, escolha \"Sim\".");
define("_MI_BULLETIN_CONFIG3","Altura do textarea para envio/edição");
define("_MI_BULLETIN_CONFIG3_D", "Defina o nº de linhas do textarea da página do submit.php.");
define("_MI_BULLETIN_CONFIG4","Largura do textarea para envio/edição");
define("_MI_BULLETIN_CONFIG4_D", "Defina o nº de colunas do textarea da página do submit.php.");
define("_MI_BULLETIN_CONFIG5","Formato de data/hora");
define("_MI_BULLETIN_CONFIG5_D", "Use como referência as funções date do PHP/formatTimestamp do XOOPS.");
define("_MI_BULLETIN_CONFIG6","Refletir envios na contagem de posts dos usuários");
define("_MI_BULLETIN_CONFIG6_D", "Quando uma notícia enviada através do submit.php for aprovada, ela será somada ao \"Nº de posts\" do usuário.");
define("_MI_BULLETIN_CONFIG7","Caminho para o diretório de ícones das categorias");
define("_MI_BULLETIN_CONFIG7_D", "Defina com o caminho absoluto.");
define("_MI_BULLETIN_CONFIG8","Endereço da imagem da página de impressão");
define("_MI_BULLETIN_CONFIG8_D", "Defina a endereço do logotipo a ser exibido na página de impressão.");
define("_MI_BULLETIN_CONFIG9","Usar o nome da notícia como título do site");
define("_MI_BULLETIN_CONFIG9_D", "Substitui o título do site pelo assunto da notícia. Diz-se efetivo para SEO.");
define("_MI_BULLETIN_CONFIG10","assign endereço do RSS no xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Mostrar ícone \"Imprimir\"?");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Mostrar ícone \"Enviar à um amigo\"?");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Usar o módulo Tell A Friend?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Mostrar link para o RSS?");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "Opções de aviso globais para o módulo de notícias.");

define("_MI_BULLETIN_STORY_NOTIFY", "Notícia atual");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "Opções de aviso para a notícia atual.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quando uma nova categoria for criado.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quando uma nova categoria for criado.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria criada");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "Nova notícia enviada");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quando uma nova notícia for enviada.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quando uma nova notícia for enviada.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia enviada");

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "Nova notícia publicada");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quando uma nova notícia for publicada.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quando uma nova notícia for publicada.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia publicada");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "Aprovação de notícia");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "Avisar-me quando esta notícia for aprovada.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "Avisar-me quando esta notícia for aprovada.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: notícia aprovada");

}

?>