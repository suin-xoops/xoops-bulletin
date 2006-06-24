<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Bulletin");

// A brief description of this module
define($constpref."_DESC","Crea un sistema de noticias tipo Slashdot, donde los usuarios puedan comentar libremente.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Categorías de noticias");
define($constpref."_BDESC1","Bloque de categorías de noticias");
define($constpref."_BNAME2","Gran noticia de hoy");
define($constpref."_BDESC2","Bloque de gran noticia de hoy");
define($constpref."_BNAME3","Calendario");
define($constpref."_BDESC3","Bloque de calendario");
define($constpref."_BNAME4","Noticias recientes");
define($constpref."_BDESC4","Bloque de noticias recientes");
define($constpref."_BNAME5","Noticias recientes por categoría");
define($constpref."_BDESC5","Bloque de noticias recientes por categoría");
define($constpref."_BNAME6","Comentarios recientes de Bulletin");
define($constpref."_BDESC6","Bloque de comentarios recientes de Bulletin");

// Sub menu
define($constpref."_SMNAME1","Enviar noticia");
define($constpref."_SMNAME2","Archivo");

//
define($constpref."_TEMPLATE1","Página de archivo");
define($constpref."_TEMPLATE2","Página de noticia solitaria");
define($constpref."_TEMPLATE3","Portada");
define($constpref."_TEMPLATE4","Plantilla de noticias");
define($constpref."_TEMPLATE5","Página de impresión");
define($constpref."_TEMPLATE6","Página de RSS");
define($constpref."_TEMPLATE7","Encabezado común a todas las páginas"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Preferencias");
define($constpref."_ADMENU1_D","Definición de las configuraciones básicas.");
define($constpref."_ADMENU2","Gestor de categorías");
define($constpref."_ADMENU2_D","Manejo de categorías.");
define($constpref."_ADMENU3","Publicar nueva noticia");
define($constpref."_ADMENU3_D","Envío de una nueva noticia.");
define($constpref."_ADMENU4","Gestor de permisos de envío");
define($constpref."_ADMENU4_D","Definición de permisos para el envío de noticias.");
define($constpref."_ADMENU5","Gestor de noticias");
define($constpref."_ADMENU5_D","Edición/eliminación/aprobación de noticias.");
define($constpref."_ADMENU6","Gestor de grupos/bloques");
define($constpref."_ADMENU6_D","Definición de las configuraciones de bloques y permisos de los grupos.");
define($constpref."_ADMENU7","Importar desde news");
define($constpref."_ADMENU7_D","Convierte datos de noticias y categorías desde news1.1.");

// Title of config items
define($constpref."_CONFIG1", "Nº de noticias mostradas en la portada");
define($constpref."_CONFIG1_D", "Define la cantidad de noticias mostradas en la portada.");
define($constpref."_CONFIG2", "¿Mostrar caja de navegación?");
define($constpref."_CONFIG2_D", "Para mostrar una caja de navegación de selección de categorías en el tope de las noticias, elige \"Sí\".");
define($constpref."_CONFIG3","Altura del textarea para envío/edición");
define($constpref."_CONFIG3_D", "Define el nº de líneas de textarea de la página de submit.php.");
define($constpref."_CONFIG4","Anchura del textarea para envío/edición");
define($constpref."_CONFIG4_D", "Define el nº de columnas de textarea de la página de submit.php.");
define($constpref."_CONFIG5","Formato de fecha/hora");
define($constpref."_CONFIG5_D", "Usa como referencia la función date de PHP/formatTimestamp de XOOPS.");
define($constpref."_CONFIG6","Reflejar envíos en el cuento de envíos de los usuarios");
define($constpref."_CONFIG6_D", "Cuando se aprobe una noticia enviada desde submit.php, se la sumará al \"Nº de envíos\" del usuario.");
define($constpref."_CONFIG7","Camino de la carpeta de iconos de categoría");
define($constpref."_CONFIG7_D", "Define el camino absoluto.");
define($constpref."_CONFIG8","Dirección del imagen de la página de impresión");
define($constpref."_CONFIG8_D", "Define la dirección del logotipo mostrado en la página de impresión.");
define($constpref."_CONFIG9","Utilizar el nombre de la noticia como título del sítio");
define($constpref."_CONFIG9_D", "Sustituye el título del sítio por el asunto de la noticia. Se dice efectivo para SEO.");
define($constpref."_CONFIG10","assign URL de RSS en xoops_module_header");
define($constpref."_CONFIG10_D", "");
// 1.01 added
define($constpref."_CONFIG11","Mostrar icono \"Imprimir\"?");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Mostrar icono \"Enviar a un amigo\"?");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Utilizar el módulo Tell A Friend?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Mostrar enlace para RSS?");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY", "Global");
define($constpref."_GLOBAL_NOTIFYDSC", "Opciones de notificación globales para el módulo de noticias.");

define($constpref."_STORY_NOTIFY", "Noticia actual");
define($constpref."_STORY_NOTIFYDSC", "Opciones de notificación para la noticia actual.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY", "Nueva categoría");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Notificarme cuando se cree una nueva categoría.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Notificarme cuando se cree una nueva categoría.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva categoría creada");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY", "Nueva noticia enviada");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Notificarme cuando se envíe una nova noticia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Notificarme cuando se envíe una nova noticia.");
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva noticia enviada");

define($constpref."_GLOBAL_NEWSTORY_NOTIFY", "Nueva noticia publicada");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP", "Notificarme cuando se publique una nueva noticia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC", "Notificarme cuando se publique una nueva noticia.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva noticia publicada");

define($constpref."_STORY_APPROVE_NOTIFY", "Aprobación de noticia");
define($constpref."_STORY_APPROVE_NOTIFYCAP", "Notificarme cuando se aprobe esta noticia.");
define($constpref."_STORY_APPROVE_NOTIFYDSC", "Notificarme cuando se aprobe esta noticia.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: noticia aprobada");

}

?>