<?php
include 'connect.php';
//Routes
$tpl='includes/templates/'; //templetes directory
$func='includes/fuctions/'; //function directory
$css='layout/css/'; //css directory
$js='layout/js/'; //js directory


//include the import files
include $func . 'function.php';
include $tpl . 'header.php';
//inclede navbar the pages no include the $noNavbar
if(!isset($noNavbar)){include $tpl . 'navbar.php';}



?>