<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define( 'BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Crea un sistema de noticias tipo Slashdot, donde los usuarios puedan comentar libremente.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Categorías de noticias");
define("_MI_BULLETIN_BDESC1","Bloque de categorías de noticias");
define("_MI_BULLETIN_BNAME2","Gran noticia de hoy");
define("_MI_BULLETIN_BDESC2","Bloque de gran noticia de hoy");
define("_MI_BULLETIN_BNAME3","Calendario");
define("_MI_BULLETIN_BDESC3","Bloque de calendario");
define("_MI_BULLETIN_BNAME4","Noticias recientes");
define("_MI_BULLETIN_BDESC4","Bloque de noticias recientes");
define("_MI_BULLETIN_BNAME5","Noticias recientes por categoría");
define("_MI_BULLETIN_BDESC5","Bloque de noticias recientes por categoría");
define("_MI_BULLETIN_BNAME6","Comentarios recientes de Bulletin");
define("_MI_BULLETIN_BDESC6","Bloque de comentarios recientes de Bulletin");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Enviar noticia");
define("_MI_BULLETIN_SMNAME2","Archivo");

//
define("_MI_BULLETIN_TEMPLATE1","Página de archivo");
define("_MI_BULLETIN_TEMPLATE2","Página de noticia solitaria");
define("_MI_BULLETIN_TEMPLATE3","Portada");
define("_MI_BULLETIN_TEMPLATE4","Plantilla de noticias");
define("_MI_BULLETIN_TEMPLATE5","Página de impresión");
define("_MI_BULLETIN_TEMPLATE6","Página de RSS");
define("_MI_BULLETIN_TEMPLATE7","Encabezado común a todas las páginas"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Preferencias");
define("_MI_BULLETIN_ADMENU1_D","Definición de las configuraciones básicas.");
define("_MI_BULLETIN_ADMENU2","Gestor de categorías");
define("_MI_BULLETIN_ADMENU2_D","Manejo de categorías.");
define("_MI_BULLETIN_ADMENU3","Publicar nueva noticia");
define("_MI_BULLETIN_ADMENU3_D","Envío de una nueva noticia.");
define("_MI_BULLETIN_ADMENU4","Gestor de permisos de envío");
define("_MI_BULLETIN_ADMENU4_D","Definición de permisos para el envío de noticias.");
define("_MI_BULLETIN_ADMENU5","Gestor de noticias");
define("_MI_BULLETIN_ADMENU5_D","Edición/eliminación/aprobación de noticias.");
define("_MI_BULLETIN_ADMENU6","Gestor de grupos/bloques");
define("_MI_BULLETIN_ADMENU6_D","Definición de las configuraciones de bloques y permisos de los grupos.");
define("_MI_BULLETIN_ADMENU7","Importar desde news");
define("_MI_BULLETIN_ADMENU7_D","Convierte datos de noticias y categorías desde news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1", "Nº de noticias mostradas en la portada");
define("_MI_BULLETIN_CONFIG1_D", "Define la cantidad de noticias mostradas en la portada.");
define("_MI_BULLETIN_CONFIG2", "¿Mostrar caja de navegación?");
define("_MI_BULLETIN_CONFIG2_D", "Para mostrar una caja de navegación de selección de categorías en el tope de las noticias, elige \"Sí\".");
define("_MI_BULLETIN_CONFIG3","Altura del textarea para envío/edición");
define("_MI_BULLETIN_CONFIG3_D", "Define el nº de líneas de textarea de la página de submit.php.");
define("_MI_BULLETIN_CONFIG4","Anchura del textarea para envío/edición");
define("_MI_BULLETIN_CONFIG4_D", "Define el nº de columnas de textarea de la página de submit.php.");
define("_MI_BULLETIN_CONFIG5","Formato de fecha/hora");
define("_MI_BULLETIN_CONFIG5_D", "Usa como referencia la función date de PHP/formatTimestamp de XOOPS.");
define("_MI_BULLETIN_CONFIG6","Reflejar envíos en el cuento de envíos de los usuarios");
define("_MI_BULLETIN_CONFIG6_D", "Cuando se aprobe una noticia enviada desde submit.php, se la sumará al \"Nº de envíos\" del usuario.");
define("_MI_BULLETIN_CONFIG7","Camino de la carpeta de iconos de categoría");
define("_MI_BULLETIN_CONFIG7_D", "Define el camino absoluto.");
define("_MI_BULLETIN_CONFIG8","Dirección del imagen de la página de impresión");
define("_MI_BULLETIN_CONFIG8_D", "Define la dirección del logotipo mostrado en la página de impresión.");
define("_MI_BULLETIN_CONFIG9","Utilizar el nombre de la noticia como título del sítio");
define("_MI_BULLETIN_CONFIG9_D", "Sustituye el título del sítio por el asunto de la noticia. Se dice efectivo para SEO.");
define("_MI_BULLETIN_CONFIG10","assign URL de RSS en xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D", "");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Mostrar icono \"Imprimir\"?");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Mostrar icono \"Enviar a un amigo\"?");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Utilizar el módulo Tell A Friend?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Mostrar enlace para RSS?");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY", "Global");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC", "Opciones de notificación globales para el módulo de noticias.");

define("_MI_BULLETIN_STORY_NOTIFY", "Noticia actual");
define("_MI_BULLETIN_STORY_NOTIFYDSC", "Opciones de notificación para la noticia actual.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY", "Nueva categoría");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Notificarme cuando se cree una nueva categoría.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Notificarme cuando se cree una nueva categoría.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva categoría creada");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY", "Nueva noticia enviada");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Notificarme cuando se envíe una nova noticia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Notificarme cuando se envíe una nova noticia.");
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva noticia enviada");

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY", "Nueva noticia publicada");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP", "Notificarme cuando se publique una nueva noticia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC", "Notificarme cuando se publique una nueva noticia.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: nueva noticia publicada");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY", "Aprobación de noticia");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP", "Notificarme cuando se aprobe esta noticia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC", "Notificarme cuando se aprobe esta noticia.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE}: noticia aprobada");

}

?>