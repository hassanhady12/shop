<?php
session_start(); //start the session
session_unset(); //unset the data
session_destroy(); //destroy session
header('Location: index.php');
exit();
?>