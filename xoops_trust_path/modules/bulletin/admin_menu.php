<?php
$constpref = '_MI_' . strtoupper( $mydirname ) ;

$i=1;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU5');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=list";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU2');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=topicsmanager";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU4');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=permition";
$i++;
$adminmenu[$i]['title'] = constant( $constpref.'_ADMENU7');
$adminmenu[$i]['link']  = "index.php?mode=admin&op=convert";
$i++;
?>