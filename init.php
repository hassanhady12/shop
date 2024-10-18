<?php
//error reporting
ini_set('display_errors','Off');
error_reporting(0);
include 'admin/connect.php';
$sessionUser='';
if(isset($_SESSION['user'])){
    $sessionUser=$_SESSION['user'];
}
//Routes
$tpl='includes/templates/'; //templetes directory

$func='includes/fuctions/'; //function directory
$css='layout/css/'; //css directory
$js='layout/js/'; //js directory


//include the import files
include $func . 'function.php';

include $tpl . 'header.php'; 





?>