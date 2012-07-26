<?php /* Catalan Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Crea un sistema de notícies tipus Slashdot, on els usuaris poden comentar lliurement.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Categories de les notícies");
define("_MI_BULLETIN_BDESC1","Bloc de categories de les notícies");
define("_MI_BULLETIN_BNAME2","Gran notícia d'avui");
define("_MI_BULLETIN_BDESC2","Bloc de gran notícia d'avui");
define("_MI_BULLETIN_BNAME3","Calendari");
define("_MI_BULLETIN_BDESC3","Bloc de calendari");
define("_MI_BULLETIN_BNAME4","Notícies recents");
define("_MI_BULLETIN_BDESC4","Bloc de notícies recents");
define("_MI_BULLETIN_BNAME5","Notícies recents per categoria");
define("_MI_BULLETIN_BDESC5","Bloc de notícies recents per categoria");
define("_MI_BULLETIN_BNAME6","Comentaris recents de Bulletin");
define("_MI_BULLETIN_BDESC6","Bloc de comentaris recents de Bulletin");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Enviar notícia");
define("_MI_BULLETIN_SMNAME2","Arxiu");

//
define("_MI_BULLETIN_TEMPLATE1","Pàgina d'arxiu");
define("_MI_BULLETIN_TEMPLATE2","Pàgina de notícia solta");
define("_MI_BULLETIN_TEMPLATE3","Portada");
define("_MI_BULLETIN_TEMPLATE4","Plantilla de notícies");
define("_MI_BULLETIN_TEMPLATE5","Pàgina d'impressió");
define("_MI_BULLETIN_TEMPLATE6","Pàgina d'RSS");
define("_MI_BULLETIN_TEMPLATE7","Encapçalament comú a totes les pàgines"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Preferències");
define("_MI_BULLETIN_ADMENU1_D","Definició de les configuracions bàsiques.");
define("_MI_BULLETIN_ADMENU2","Gestor de les categories");
define("_MI_BULLETIN_ADMENU2_D","Maneig de les categories.");
define("_MI_BULLETIN_ADMENU3","Publicar una nova notícia");
define("_MI_BULLETIN_ADMENU3_D","Enviament d'una nova notícia.");
define("_MI_BULLETIN_ADMENU4","Gestor dels permisos d'enviament");
define("_MI_BULLETIN_ADMENU4_D","Definició dels permisos per a l'enviament de notícies.");
define("_MI_BULLETIN_ADMENU5","Gestor de les notícies");
define("_MI_BULLETIN_ADMENU5_D","Edició/esborrament/aprovació de les notícies.");
define("_MI_BULLETIN_ADMENU6","Gestor dels grups/blocs");
define("_MI_BULLETIN_ADMENU6_D","Definició de les configuracions dels blocs i de permisos dels grups.");
define("_MI_BULLETIN_ADMENU7","Importar des de news");
define("_MI_BULLETIN_ADMENU7_D","Converteix dades de notícies i categories des de news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "N. de notícies mostrades en la portada");
define("_MI_BULLETIN_CONFIG1_D", "Defineix la quantitat de notícies mostrades a la pàgina principal.");
define("_MI_BULLETIN_CONFIG2", "Mostrar caixa de navegació?");
define("_MI_BULLETIN_CONFIG2_D", "Per a mostrar una caixa de navegació de selecció de categories a la part superior de les notícies, tria \"Sí\".");
define("_MI_BULLETIN_CONFIG3","Altura del textarea per a enviament/edició");
define("_MI_BULLETIN_CONFIG3_D", "Defineix el nº de línies de textarea de la pàgina de submit.php.");
define("_MI_BULLETIN_CONFIG4","Amplària del textarea per a enviament/edició");
define("_MI_BULLETIN_CONFIG4_D", "Defineix el nº de columnes de textarea de la pàgina de submit.php.");
define("_MI_BULLETIN_CONFIG5","Format de data/hora");
define("_MI_BULLETIN_CONFIG5_D", "Fes servir com a referència la funció date de PHP/formatTimestamp de XOOPS.");
define("_MI_BULLETIN_CONFIG6","Reflectir enviaments en el xiframent d'enviaments dels usuaris");
define("_MI_BULLETIN_CONFIG6_D", "Quan s'aprovi una notícia enviada des de submit.php, se sumarà a \"Nº d'enviaments\" de l'usuari.");
define("_MI_BULLETIN_CONFIG7","Camí de la carpeta d'icones de categories");
define("_MI_BULLETIN_CONFIG7_D", "Defineix amb camí absolut.");
define("_MI_BULLETIN_CONFIG8","Adreça de la imatge de la pàgina d'impressió");
define("_MI_BULLETIN_CONFIG8_D", "Defineix l'adreça del logotip mostrat a la pàgina d'impressió.");
define("_MI_BULLETIN_CONFIG9","Fer servir el nom de la notícia com a títol de la pàgina");
define("_MI_BULLETIN_CONFIG9_D", "Substituïx el títol de la pàgina per l'assumpte de la notícia. Es diu efectiu per a SEO.");
define("_MI_BULLETIN_CONFIG10","assign URL d'RSS a xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Mostrar la icona \"Imprimir\"?");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Mostrar la icona \"Enviar a un amic\"?");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Fer servir el mòdul Tell A Friend?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Mostrar el enllaç per a l'RSS?");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "Opcions d'avís globals per tot el mòdul de notícies.");

define("_MI_BULLETIN_STORY_NOTIFY", "Notícia actual");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "Opcions d'avís per la notícia actual.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quan es creï una nova categoria.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quan es creï una nova categoria.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria creada");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "Nova notícia enviada");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quan s'enviï una nova notícia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quan s'enviï una nova notícia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia enviada");

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "Nova notícia publicada");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quan es publiqui una nova notícia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quan es publiqui una nova notícia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova notícia publicada");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "Aprovació de notícia");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "Avisar-me quan s'aprovi aquesta notícia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "Avisar-me quan s'aprovi aquesta notícia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: notícia aprovada");

}

?>