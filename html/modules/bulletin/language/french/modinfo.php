<?php /* French Translation by Nuno Luciano <http://xoopserver.com> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'BULLETIN_MI_LOADED' ) ) {

define('BULLETIN_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_BULLETIN_NAME","Bulletin");

// A brief description of this module
define("_MI_BULLETIN_DESC","Cr&eacute;e une section d'articles, o&ugrave; les utilisateurs peuvent poster des articles/commentaires.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_BULLETIN_BNAME1","Sujets d'articles");
define("_MI_BULLETIN_BDESC1","Bloc Sujets d'articles");
define("_MI_BULLETIN_BNAME2","Article du jour");
define("_MI_BULLETIN_BDESC2","Bloc Articles du jour");
define("_MI_BULLETIN_BNAME3","Calendrier");
define("_MI_BULLETIN_BDESC3","Bloc Calendrier");
define("_MI_BULLETIN_BNAME4","Articles r&eacute;cents");
define("_MI_BULLETIN_BDESC4","Bloc Articles r&eacute;cents");
define("_MI_BULLETIN_BNAME5","Articles r&eacute;cents par sujets");
define("_MI_BULLETIN_BDESC5","Bloc Articles r&eacute;cents par sujets");
define("_MI_BULLETIN_BNAME6","Commentaires r&eacute;cents");
define("_MI_BULLETIN_BDESC6","Bloc Commentaires r&eacute;cents");

// Sub menu
define("_MI_BULLETIN_SMNAME1","Envoyer un article");
define("_MI_BULLETIN_SMNAME2","Archives");

//
define("_MI_BULLETIN_TEMPLATE1","Page Archives");
define("_MI_BULLETIN_TEMPLATE2","Page unique d'articles");
define("_MI_BULLETIN_TEMPLATE3","Page Top");
define("_MI_BULLETIN_TEMPLATE4","Template Articles");
define("_MI_BULLETIN_TEMPLATE5","Page d'impression");
define("_MI_BULLETIN_TEMPLATE6","Page RSS");
define("_MI_BULLETIN_TEMPLATE7","En-t&ecirc; te commun"); // 1.01 added

// Admin
define("_MI_BULLETIN_ADMENU1","Pr&eacute;f&eacute;rences");
define("_MI_BULLETIN_ADMENU1_D","Configuration de base.");
define("_MI_BULLETIN_ADMENU2","Gestion des Sujets");
define("_MI_BULLETIN_ADMENU2_D","Autoriser la gestion de Sujets.");
define("_MI_BULLETIN_ADMENU3","Publier un nouveau Article");
define("_MI_BULLETIN_ADMENU3_D","Autoriser la publication de nouveaux Articles.");
define("_MI_BULLETIN_ADMENU4","Gestion de Permissions");
define("_MI_BULLETIN_ADMENU4_D","Configuration des Permissions de publication.");
define("_MI_BULLETIN_ADMENU5","Gestion d'Articles");
define("_MI_BULLETIN_ADMENU5_D","Envoyer/Editer/Effacer/Approuver Articles");
define("_MI_BULLETIN_ADMENU6","Gestion de Groupes/blocs");
define("_MI_BULLETIN_ADMENU6_D","Configuration des Groupes et blocs.");
define("_MI_BULLETIN_ADMENU7","Importer depuis News");
define("_MI_BULLETIN_ADMENU7_D","Charger Sujets et Articles depuis news1.1.");

// Title of config items
define("_MI_BULLETIN_CONFIG1","Nombre d'Article(s) sur la page principale");
define("_MI_BULLETIN_CONFIG1_D","Indiquez le nombre d'Article(s) qui s'affichent sur la page principale.");
define("_MI_BULLETIN_CONFIG2","Afficher la bo&icirc;te de navigation");
define("_MI_BULLETIN_CONFIG2_D","Choisir \"Oui\" pour afficher la bo&icirc;te de navigation de Sujets en haut de chaque page.");
define("_MI_BULLETIN_CONFIG3","Hauteur de la zone de texte d'Envoyer/Editer des Articles");
define("_MI_BULLETIN_CONFIG3_D","Indiquez le nombre de lignes de la zone de texte dans la page submit.php");
define("_MI_BULLETIN_CONFIG4","Largeur de la zone de texte d'Envoyer/Editer des articles");
define("_MI_BULLETIN_CONFIG4_D","Indiquez le nombre de colonnes de la zone de texte dans la page submit.php");
define("_MI_BULLETIN_CONFIG5","Format de la Date/Heure");
define("_MI_BULLETIN_CONFIG5_D","Utiliser un format php de la date valide pour XOOPSCube. Ref. formatTimestamp");
define("_MI_BULLETIN_CONFIG6","Addicionner au nombre de publications de l'utilisateur");
define("_MI_BULLETIN_CONFIG6_D","Lorsqu'un Article publi&eacute; depuis submit.php est approuv&eacute;, le nombre de \"Publications/Postes\" de l'\utilisateur augmente.");
define("_MI_BULLETIN_CONFIG7","Chemin du rep&eacute;toire d'images des Sujets");
define("_MI_BULLETIN_CONFIG7_D","Indiquer le chemin absolut.");
define("_MI_BULLETIN_CONFIG8","Image de la page Version Imprimable");
define("_MI_BULLETIN_CONFIG8_D","Indiquer le lien/URL du logo pour afficher dans la page Version Imprimable.");
define("_MI_BULLETIN_CONFIG9","Changer le nom du site par le titre de l'Article");
define("_MI_BULLETIN_CONFIG9_D","Remplace le nom du site par l'Article du Sujet. Il est dit améliorer la promotion du site (SEO).");
define("_MI_BULLETIN_CONFIG10","assignez le lien RSS dans xoops_module_header");
define("_MI_BULLETIN_CONFIG10_D","");
// 1.01 added
define("_MI_BULLETIN_CONFIG11","Afficher l'icon \"imprimer\" ");
define("_MI_BULLETIN_CONFIG11_D", "");
define("_MI_BULLETIN_CONFIG12","Afficher l'icon \"Informer un ami\" ");
define("_MI_BULLETIN_CONFIG12_D", "");
define("_MI_BULLETIN_CONFIG13","Utiliser le module \"Informer un ami\"?");
define("_MI_BULLETIN_CONFIG13_D", "");
define("_MI_BULLETIN_CONFIG14","Afficher le lien RSS");
define("_MI_BULLETIN_CONFIG14_D", "");

// Text for notifications
define("_MI_BULLETIN_GLOBAL_NOTIFY","Globale");
define("_MI_BULLETIN_GLOBAL_NOTIFYDSC","Options de notification globale des Articles.");

define("_MI_BULLETIN_STORY_NOTIFY","Article");
define("_MI_BULLETIN_STORY_NOTIFYDSC","'Options de notification s'appliquant &agrave; l'Article.");

define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFY","Nouveau Sujet");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYCAP","Notifiez-moi quand un nouveau Sujet est cr&eacute;&eacute;.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYDSC","Notification par mail lorsqu'un nouveau sujet est cr&eacute;&eacute;.");
define("_MI_BULLETIN_GLOBAL_NEWCATEGORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouveau sujet est cr&eacute;&eacute;");

define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFY","Nouvel article propos&eacute;");       
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYCAP","Notifiez-moi lorsqu'un nouvel article est propos&eacute;.");                           
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYDSC","Notification par mail lorsqu'un nouvel article est propos&eacute;.");                
define("_MI_BULLETIN_GLOBAL_STORYSUBMIT_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouvel article est propos&eacute;");                      

define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFY","Nouvel article publi&eacute;");       
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYCAP","Notifiez-moi quand un nouvel article est publi&eacute;.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYDSC","Notification par mail lorsqu'un nouvel article est publi&eacute;.");
define("_MI_BULLETIN_GLOBAL_NEWSTORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouvel article est publi&eacute;");

define("_MI_BULLETIN_STORY_APPROVE_NOTIFY","Article approuv&eacute;");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYCAP","Notifiez-moi lorsque cet article est approuv&eacute;.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYDSC","Notification par mail lorsque cet article est approuv&eacute;.");
define("_MI_BULLETIN_STORY_APPROVE_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: L'article est approuv&eacute;");

}

?>