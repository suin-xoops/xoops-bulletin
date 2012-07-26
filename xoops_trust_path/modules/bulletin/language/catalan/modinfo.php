<?php /* Catalan Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Bulletin");

// A brief description of this module
define($constpref."_DESC","Crea un sistema de notícies tipus Slashdot, on els usuaris poden comentar lliurement.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Categories de les notícies");
define($constpref."_BDESC1","Bloc de categories de les notícies");
define($constpref."_BNAME2","Gran notícia d'avui");
define($constpref."_BDESC2","Bloc de gran notícia d'avui");
define($constpref."_BNAME3","Calendari");
define($constpref."_BDESC3","Bloc de calendari");
define($constpref."_BNAME4","Notícies recents");
define($constpref."_BDESC4","Bloc de notícies recents");
define($constpref."_BNAME5","Notícies recents per categoria");
define($constpref."_BDESC5","Bloc de notícies recents per categoria");
define($constpref."_BNAME6","Comentaris recents de Bulletin");
define($constpref."_BDESC6","Bloc de comentaris recents de Bulletin");

// Sub menu
define($constpref."_SMNAME1","Enviar notícia");
define($constpref."_SMNAME2","Arxiu");

//
define($constpref."_TEMPLATE1","Pàgina d'arxiu");
define($constpref."_TEMPLATE2","Pàgina de notícia solta");
define($constpref."_TEMPLATE3","Portada");
define($constpref."_TEMPLATE4","Plantilla de notícies");
define($constpref."_TEMPLATE5","Pàgina d'impressió");
define($constpref."_TEMPLATE6","Pàgina d'RSS");
define($constpref."_TEMPLATE7","Encapçalament comú a totes les pàgines"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Preferències");
define($constpref."_ADMENU1_D","Definició de les configuracions bàsiques.");
define($constpref."_ADMENU2","Gestor de les categories");
define($constpref."_ADMENU2_D","Maneig de les categories.");
define($constpref."_ADMENU3","Publicar una nova notícia");
define($constpref."_ADMENU3_D","Enviament d'una nova notícia.");
define($constpref."_ADMENU4","Gestor dels permisos d'enviament");
define($constpref."_ADMENU4_D","Definició dels permisos per a l'enviament de notícies.");
define($constpref."_ADMENU5","Gestor de les notícies");
define($constpref."_ADMENU5_D","Edició/esborrament/aprovació de les notícies.");
define($constpref."_ADMENU6","Gestor dels grups/blocs");
define($constpref."_ADMENU6_D","Definició de les configuracions dels blocs i de permisos dels grups.");
define($constpref."_ADMENU7","Importar des de news");
define($constpref."_ADMENU7_D","Converteix dades de notícies i categories des de news1.1.");

// Title of config items
define($constpref."_CONFIG1", "N. de notícies mostrades en la portada");
define($constpref."_CONFIG1_D", "Defineix la quantitat de notícies mostrades a la pàgina principal.");
define($constpref."_CONFIG2", "Mostrar caixa de navegació?");
define($constpref."_CONFIG2_D", "Per a mostrar una caixa de navegació de selecció de categories a la part superior de les notícies, tria \"Sí\".");
define($constpref."_CONFIG3","Altura del textarea per a enviament/edició");
define($constpref."_CONFIG3_D", "Defineix el nº de línies de textarea de la pàgina de submit.php.");
define($constpref."_CONFIG4","Amplària del textarea per a enviament/edició");
define($constpref."_CONFIG4_D", "Defineix el nº de columnes de textarea de la pàgina de submit.php.");
define($constpref."_CONFIG5","Format de data/hora");
define($constpref."_CONFIG5_D", "Fes servir com a referència la funció date de PHP/formatTimestamp de XOOPS.");
define($constpref."_CONFIG6","Reflectir enviaments en el xiframent d'enviaments dels usuaris");
define($constpref."_CONFIG6_D", "Quan s'aprovi una notícia enviada des de submit.php, se sumarà a \"Nº d'enviaments\" de l'usuari.");
define($constpref."_CONFIG7","Camí de la carpeta d'icones de categories");
define($constpref."_CONFIG7_D", "Defineix amb camí absolut.");
define($constpref."_CONFIG8","Adreça de la imatge de la pàgina d'impressió");
define($constpref."_CONFIG8_D", "Defineix l'adreça del logotip mostrat a la pàgina d'impressió.");
define($constpref."_CONFIG9","Fer servir el nom de la notícia com a títol de la pàgina");
define($constpref."_CONFIG9_D", "Substituïx el títol de la pàgina per l'assumpte de la notícia. Es diu efectiu per a SEO.");
define($constpref."_CONFIG10","assign URL d'RSS a xoops_module_header");
define($constpref."_CONFIG10_D", "");
// 1.01 added
define($constpref."_CONFIG11","Mostrar la icona \"Imprimir\"?");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Mostrar la icona \"Enviar a un amic\"?");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Fer servir el mòdul Tell A Friend?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Mostrar el enllaç per a l'RSS?");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY", "Global");
define($constpref."_GLOBAL_NOTIFYDSC", "Opcions d'avís globals per tot el mòdul de notícies.");

define($constpref."_STORY_NOTIFY", "Notícia actual");
define($constpref."_STORY_NOTIFYDSC", "Opcions d'avís per la notícia actual.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quan es creï una nova categoria.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quan es creï una nova categoria.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria creada");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY", "Nova notícia enviada");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quan s'enviï una nova notícia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quan s'enviï una nova notícia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia enviada");

define($constpref."_GLOBAL_NEWSTORY_NOTIFY", "Nova notícia publicada");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quan es publiqui una nova notícia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quan es publiqui una nova notícia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia publicada");

define($constpref."_STORY_APPROVE_NOTIFY", "Aprovació de notícia");
define($constpref."_STORY_APPROVE_NOTIFYCAP", "Avisar-me quan s'aprovi aquesta notícia.");
define($constpref."_STORY_APPROVE_NOTIFYDSC", "Avisar-me quan s'aprovi aquesta notícia.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: notícia aprovada");

}

?>