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
define($constpref."_DESC","Crea un sistema de not�cies tipus Slashdot, on els usuaris poden comentar lliurement.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Categories de les not�cies");
define($constpref."_BDESC1","Bloc de categories de les not�cies");
define($constpref."_BNAME2","Gran not�cia d'avui");
define($constpref."_BDESC2","Bloc de gran not�cia d'avui");
define($constpref."_BNAME3","Calendari");
define($constpref."_BDESC3","Bloc de calendari");
define($constpref."_BNAME4","Not�cies recents");
define($constpref."_BDESC4","Bloc de not�cies recents");
define($constpref."_BNAME5","Not�cies recents per categoria");
define($constpref."_BDESC5","Bloc de not�cies recents per categoria");
define($constpref."_BNAME6","Comentaris recents de Bulletin");
define($constpref."_BDESC6","Bloc de comentaris recents de Bulletin");

// Sub menu
define($constpref."_SMNAME1","Enviar not�cia");
define($constpref."_SMNAME2","Arxiu");

//
define($constpref."_TEMPLATE1","P�gina d'arxiu");
define($constpref."_TEMPLATE2","P�gina de not�cia solta");
define($constpref."_TEMPLATE3","Portada");
define($constpref."_TEMPLATE4","Plantilla de not�cies");
define($constpref."_TEMPLATE5","P�gina d'impressi�");
define($constpref."_TEMPLATE6","P�gina d'RSS");
define($constpref."_TEMPLATE7","Encap�alament com� a totes les p�gines"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Prefer�ncies");
define($constpref."_ADMENU1_D","Definici� de les configuracions b�siques.");
define($constpref."_ADMENU2","Gestor de les categories");
define($constpref."_ADMENU2_D","Maneig de les categories.");
define($constpref."_ADMENU3","Publicar una nova not�cia");
define($constpref."_ADMENU3_D","Enviament d'una nova not�cia.");
define($constpref."_ADMENU4","Gestor dels permisos d'enviament");
define($constpref."_ADMENU4_D","Definici� dels permisos per a l'enviament de not�cies.");
define($constpref."_ADMENU5","Gestor de les not�cies");
define($constpref."_ADMENU5_D","Edici�/esborrament/aprovaci� de les not�cies.");
define($constpref."_ADMENU6","Gestor dels grups/blocs");
define($constpref."_ADMENU6_D","Definici� de les configuracions dels blocs i de permisos dels grups.");
define($constpref."_ADMENU7","Importar des de news");
define($constpref."_ADMENU7_D","Converteix dades de not�cies i categories des de news1.1.");

// Title of config items
define($constpref."_CONFIG1", "N. de not�cies mostrades en la portada");
define($constpref."_CONFIG1_D", "Defineix la quantitat de not�cies mostrades a la p�gina principal.");
define($constpref."_CONFIG2", "Mostrar caixa de navegaci�?");
define($constpref."_CONFIG2_D", "Per a mostrar una caixa de navegaci� de selecci� de categories a la part superior de les not�cies, tria \"S�\".");
define($constpref."_CONFIG3","Altura del textarea per a enviament/edici�");
define($constpref."_CONFIG3_D", "Defineix el n� de l�nies de textarea de la p�gina de submit.php.");
define($constpref."_CONFIG4","Ampl�ria del textarea per a enviament/edici�");
define($constpref."_CONFIG4_D", "Defineix el n� de columnes de textarea de la p�gina de submit.php.");
define($constpref."_CONFIG5","Format de data/hora");
define($constpref."_CONFIG5_D", "Fes servir com a refer�ncia la funci� date de PHP/formatTimestamp de XOOPS.");
define($constpref."_CONFIG6","Reflectir enviaments en el xiframent d'enviaments dels usuaris");
define($constpref."_CONFIG6_D", "Quan s'aprovi una not�cia enviada des de submit.php, se sumar� a \"N� d'enviaments\" de l'usuari.");
define($constpref."_CONFIG7","Cam� de la carpeta d'icones de categories");
define($constpref."_CONFIG7_D", "Defineix amb cam� absolut.");
define($constpref."_CONFIG8","Adre�a de la imatge de la p�gina d'impressi�");
define($constpref."_CONFIG8_D", "Defineix l'adre�a del logotip mostrat a la p�gina d'impressi�.");
define($constpref."_CONFIG9","Fer servir el nom de la not�cia com a t�tol de la p�gina");
define($constpref."_CONFIG9_D", "Substitu�x el t�tol de la p�gina per l'assumpte de la not�cia. Es diu efectiu per a SEO.");
define($constpref."_CONFIG10","assign URL d'RSS a xoops_module_header");
define($constpref."_CONFIG10_D", "");
// 1.01 added
define($constpref."_CONFIG11","Mostrar la icona \"Imprimir\"?");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Mostrar la icona \"Enviar a un amic\"?");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Fer servir el m�dul Tell A Friend?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Mostrar el enlla� per a l'RSS?");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY", "Global");
define($constpref."_GLOBAL_NOTIFYDSC", "Opcions d'av�s globals per tot el m�dul de not�cies.");

define($constpref."_STORY_NOTIFY", "Not�cia actual");
define($constpref."_STORY_NOTIFYDSC", "Opcions d'av�s per la not�cia actual.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quan es cre� una nova categoria.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quan es cre� una nova categoria.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria creada");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY", "Nova not�cia enviada");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quan s'envi� una nova not�cia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quan s'envi� una nova not�cia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia enviada");

define($constpref."_GLOBAL_NEWSTORY_NOTIFY", "Nova not�cia publicada");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quan es publiqui una nova not�cia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quan es publiqui una nova not�cia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia publicada");

define($constpref."_STORY_APPROVE_NOTIFY", "Aprovaci� de not�cia");
define($constpref."_STORY_APPROVE_NOTIFYCAP", "Avisar-me quan s'aprovi aquesta not�cia.");
define($constpref."_STORY_APPROVE_NOTIFYDSC", "Avisar-me quan s'aprovi aquesta not�cia.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: not�cia aprovada");

}

?>