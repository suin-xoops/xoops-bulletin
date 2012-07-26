<?php /* Catalan Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Crea un sistema de not�cies tipus Slashdot, on els usuaris poden comentar lliurement.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Categories de les not�cies");
define("_MI_BULLETIN_BDESC1","Bloc de categories de les not�cies");
define("_MI_BULLETIN_BNAME2","Gran not�cia d'avui");
define("_MI_BULLETIN_BDESC2","Bloc de gran not�cia d'avui");
define("_MI_BULLETIN_BNAME3","Calendari");
define("_MI_BULLETIN_BDESC3","Bloc de calendari");
define("_MI_BULLETIN_BNAME4","Not�cies recents");
define("_MI_BULLETIN_BDESC4","Bloc de not�cies recents");
define("_MI_BULLETIN_BNAME5","Not�cies recents per categoria");
define("_MI_BULLETIN_BDESC5","Bloc de not�cies recents per categoria");
define("_MI_BULLETIN_BNAME6","Comentaris recents de Bulletin");
define("_MI_BULLETIN_BDESC6","Bloc de comentaris recents de Bulletin");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Enviar not�cia");
define("_MI_BULLETIN_SMNAME2","Arxiu");

//
define("_MI_BULLETIN_TEMPLATE1","P�gina d'arxiu");
define("_MI_BULLETIN_TEMPLATE2","P�gina de not�cia solta");
define("_MI_BULLETIN_TEMPLATE3","Portada");
define("_MI_BULLETIN_TEMPLATE4","Plantilla de not�cies");
define("_MI_BULLETIN_TEMPLATE5","P�gina d'impressi�");
define("_MI_BULLETIN_TEMPLATE6","P�gina d'RSS");
define("_MI_BULLETIN_TEMPLATE7","Encap�alament com� a totes les p�gines"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Prefer�ncies");
define("_MI_BULLETIN_ADMENU1_D","Definici� de les configuracions b�siques.");
define("_MI_BULLETIN_ADMENU2","Gestor de les categories");
define("_MI_BULLETIN_ADMENU2_D","Maneig de les categories.");
define("_MI_BULLETIN_ADMENU3","Publicar una nova not�cia");
define("_MI_BULLETIN_ADMENU3_D","Enviament d'una nova not�cia.");
define("_MI_BULLETIN_ADMENU4","Gestor dels permisos d'enviament");
define("_MI_BULLETIN_ADMENU4_D","Definici� dels permisos per a l'enviament de not�cies.");
define("_MI_BULLETIN_ADMENU5","Gestor de les not�cies");
define("_MI_BULLETIN_ADMENU5_D","Edici�/esborrament/aprovaci� de les not�cies.");
define("_MI_BULLETIN_ADMENU6","Gestor dels grups/blocs");
define("_MI_BULLETIN_ADMENU6_D","Definici� de les configuracions dels blocs i de permisos dels grups.");
define("_MI_BULLETIN_ADMENU7","Importar des de news");
define("_MI_BULLETIN_ADMENU7_D","Converteix dades de not�cies i categories des de news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "N. de not�cies mostrades en la portada");
define("_MI_BULLETIN_CONFIG1_D", "Defineix la quantitat de not�cies mostrades a la p�gina principal.");
define("_MI_BULLETIN_CONFIG2", "Mostrar caixa de navegaci�?");
define("_MI_BULLETIN_CONFIG2_D", "Per a mostrar una caixa de navegaci� de selecci� de categories a la part superior de les not�cies, tria \"S�\".");
define("_MI_BULLETIN_CONFIG3","Altura del textarea per a enviament/edici�");
define("_MI_BULLETIN_CONFIG3_D", "Defineix el n� de l�nies de textarea de la p�gina de submit.php.");
define("_MI_BULLETIN_CONFIG4","Ampl�ria del textarea per a enviament/edici�");
define("_MI_BULLETIN_CONFIG4_D", "Defineix el n� de columnes de textarea de la p�gina de submit.php.");
define("_MI_BULLETIN_CONFIG5","Format de data/hora");
define("_MI_BULLETIN_CONFIG5_D", "Fes servir com a refer�ncia la funci� date de PHP/formatTimestamp de XOOPS.");
define("_MI_BULLETIN_CONFIG6","Reflectir enviaments en el xiframent d'enviaments dels usuaris");
define("_MI_BULLETIN_CONFIG6_D", "Quan s'aprovi una not�cia enviada des de submit.php, se sumar� a \"N� d'enviaments\" de l'usuari.");
define("_MI_BULLETIN_CONFIG7","Cam� de la carpeta d'icones de categories");
define("_MI_BULLETIN_CONFIG7_D", "Defineix amb cam� absolut.");
define("_MI_BULLETIN_CONFIG8","Adre�a de la imatge de la p�gina d'impressi�");
define("_MI_BULLETIN_CONFIG8_D", "Defineix l'adre�a del logotip mostrat a la p�gina d'impressi�.");
define("_MI_BULLETIN_CONFIG9","Fer servir el nom de la not�cia com a t�tol de la p�gina");
define("_MI_BULLETIN_CONFIG9_D", "Substitu�x el t�tol de la p�gina per l'assumpte de la not�cia. Es diu efectiu per a SEO.");
define("_MI_BULLETIN_CONFIG10","assign URL d'RSS a xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Mostrar la icona \"Imprimir\"?");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Mostrar la icona \"Enviar a un amic\"?");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Fer servir el m�dul Tell A Friend?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Mostrar el enlla� per a l'RSS?");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "Opcions d'av�s globals per tot el m�dul de not�cies.");

define("_MI_BULLETIN_STORY_NOTIFY", "Not�cia actual");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "Opcions d'av�s per la not�cia actual.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "Nova categoria");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Avisar-me quan es cre� una nova categoria.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Avisar-me quan es cre� una nova categoria.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova categoria creada");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "Nova not�cia enviada");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Avisar-me quan s'envi� una nova not�cia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Avisar-me quan s'envi� una nova not�cia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia enviada");

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "Nova not�cia publicada");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "Avisar-me quan es publiqui una nova not�cia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "Avisar-me quan es publiqui una nova not�cia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nova not�cia publicada");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "Aprovaci� de not�cia");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "Avisar-me quan s'aprovi aquesta not�cia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "Avisar-me quan s'aprovi aquesta not�cia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: not�cia aprovada");

}

?>