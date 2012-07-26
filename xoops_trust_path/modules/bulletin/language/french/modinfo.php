<?php /* French Translation by Nuno Luciano <http://xoopserver.com> */
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'bulletin' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Bulletin");

// A brief description of this module
define($constpref."_DESC","Cr&eacute;e une section d'articles, o&ugrave; les utilisateurs peuvent poster des articles/commentaires.");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME1","Sujets d'articles");
define($constpref."_BDESC1","Bloc Sujets d'articles");
define($constpref."_BNAME2","Article du jour");
define($constpref."_BDESC2","Bloc Articles du jour");
define($constpref."_BNAME3","Calendrier");
define($constpref."_BDESC3","Bloc Calendrier");
define($constpref."_BNAME4","Articles r&eacute;cents");
define($constpref."_BDESC4","Bloc Articles r&eacute;cents");
define($constpref."_BNAME5","Articles r&eacute;cents par sujets");
define($constpref."_BDESC5","Bloc Articles r&eacute;cents par sujets");
define($constpref."_BNAME6","Commentaires r&eacute;cents");
define($constpref."_BDESC6","Bloc Commentaires r&eacute;cents");

// Sub menu
define($constpref."_SMNAME1","Envoyer un article");
define($constpref."_SMNAME2","Archives");

//
define($constpref."_TEMPLATE1","Page Archives");
define($constpref."_TEMPLATE2","Page unique d'articles");
define($constpref."_TEMPLATE3","Page Top");
define($constpref."_TEMPLATE4","Template Articles");
define($constpref."_TEMPLATE5","Page d'impression");
define($constpref."_TEMPLATE6","Page RSS");
define($constpref."_TEMPLATE7","En-t&ecirc; te commun"); // 1.01 added

// Admin
define($constpref."_ADMENU1","Pr&eacute;f&eacute;rences");
define($constpref."_ADMENU1_D","Configuration de base.");
define($constpref."_ADMENU2","Gestion des Sujets");
define($constpref."_ADMENU2_D","Autoriser la gestion de Sujets.");
define($constpref."_ADMENU3","Publier un nouveau Article");
define($constpref."_ADMENU3_D","Autoriser la publication de nouveaux Articles.");
define($constpref."_ADMENU4","Gestion de Permissions");
define($constpref."_ADMENU4_D","Configuration des Permissions de publication.");
define($constpref."_ADMENU5","Gestion d'Articles");
define($constpref."_ADMENU5_D","Envoyer/Editer/Effacer/Approuver Articles");
define($constpref."_ADMENU6","Gestion de Groupes/blocs");
define($constpref."_ADMENU6_D","Configuration des Groupes et blocs.");
define($constpref."_ADMENU7","Importer depuis News");
define($constpref."_ADMENU7_D","Charger Sujets et Articles depuis news1.1.");

// Title of config items
define($constpref."_CONFIG1","Nombre d'Article(s) sur la page principale");
define($constpref."_CONFIG1_D","Indiquez le nombre d'Article(s) qui s'affichent sur la page principale.");
define($constpref."_CONFIG2","Afficher la bo&icirc;te de navigation");
define($constpref."_CONFIG2_D","Choisir \"Oui\" pour afficher la bo&icirc;te de navigation de Sujets en haut de chaque page.");
define($constpref."_CONFIG3","Hauteur de la zone de texte d'Envoyer/Editer des Articles");
define($constpref."_CONFIG3_D","Indiquez le nombre de lignes de la zone de texte dans la page submit.php");
define($constpref."_CONFIG4","Largeur de la zone de texte d'Envoyer/Editer des articles");
define($constpref."_CONFIG4_D","Indiquez le nombre de colonnes de la zone de texte dans la page submit.php");
define($constpref."_CONFIG5","Format de la Date/Heure");
define($constpref."_CONFIG5_D","Utiliser un format php de la date valide pour XOOPSCube. Ref. formatTimestamp");
define($constpref."_CONFIG6","Addicionner au nombre de publications de l'utilisateur");
define($constpref."_CONFIG6_D","Lorsqu'un Article publi&eacute; depuis submit.php est approuv&eacute;, le nombre de \"Publications/Postes\" de l'\utilisateur augmente.");
define($constpref."_CONFIG7","Chemin du rep&eacute;toire d'images des Sujets");
define($constpref."_CONFIG7_D","Indiquer le chemin absolut.");
define($constpref."_CONFIG8","Image de la page Version Imprimable");
define($constpref."_CONFIG8_D","Indiquer le lien/URL du logo pour afficher dans la page Version Imprimable.");
define($constpref."_CONFIG9","Changer le nom du site par le titre de l'Article");
define($constpref."_CONFIG9_D","Remplace le nom du site par l'Article du Sujet. Il est dit am�liorer la promotion du site (SEO).");
define($constpref."_CONFIG10","assignez le lien RSS dans xoops_module_header");
define($constpref."_CONFIG10_D","");
// 1.01 added
define($constpref."_CONFIG11","Afficher l'icon \"imprimer\" ");
define($constpref."_CONFIG11_D", "");
define($constpref."_CONFIG12","Afficher l'icon \"Informer un ami\" ");
define($constpref."_CONFIG12_D", "");
define($constpref."_CONFIG13","Utiliser le module \"Informer un ami\"?");
define($constpref."_CONFIG13_D", "");
define($constpref."_CONFIG14","Afficher le lien RSS");
define($constpref."_CONFIG14_D", "");

// Text for notifications
define($constpref."_GLOBAL_NOTIFY","Globale");
define($constpref."_GLOBAL_NOTIFYDSC","Options de notification globale des Articles.");

define($constpref."_STORY_NOTIFY","Article");
define($constpref."_STORY_NOTIFYDSC","'Options de notification s'appliquant &agrave; l'Article.");

define($constpref."_GLOBAL_NEWCATEGORY_NOTIFY","Nouveau Sujet");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYCAP","Notifiez-moi quand un nouveau Sujet est cr&eacute;&eacute;.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYDSC","Notification par mail lorsqu'un nouveau sujet est cr&eacute;&eacute;.");
define($constpref."_GLOBAL_NEWCATEGORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouveau sujet est cr&eacute;&eacute;");

define($constpref."_GLOBAL_STORYSUBMIT_NOTIFY","Nouvel article propos&eacute;");       
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYCAP","Notifiez-moi lorsqu'un nouvel article est propos&eacute;.");                           
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYDSC","Notification par mail lorsqu'un nouvel article est propos&eacute;.");                
define($constpref."_GLOBAL_STORYSUBMIT_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouvel article est propos&eacute;");                      

define($constpref."_GLOBAL_NEWSTORY_NOTIFY","Nouvel article publi&eacute;");       
define($constpref."_GLOBAL_NEWSTORY_NOTIFYCAP","Notifiez-moi quand un nouvel article est publi&eacute;.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYDSC","Notification par mail lorsqu'un nouvel article est publi&eacute;.");
define($constpref."_GLOBAL_NEWSTORY_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: un nouvel article est publi&eacute;");

define($constpref."_STORY_APPROVE_NOTIFY","Article approuv&eacute;");
define($constpref."_STORY_APPROVE_NOTIFYCAP","Notifiez-moi lorsque cet article est approuv&eacute;.");
define($constpref."_STORY_APPROVE_NOTIFYDSC","Notification par mail lorsque cet article est approuv&eacute;.");
define($constpref."_STORY_APPROVE_NOTIFYSBJ","[{X_SITENAME}] {X_MODULE}: L'article est approuv&eacute;");

}

?>