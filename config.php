<?php
$conn = new mysqli("localhost","root","","shop");
if($conn->connect_error){
    die("Connect Failed".$conn->connect_error);
}


?>