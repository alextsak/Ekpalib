<?php
session_start();
/*Destroy Session*/
session_destroy();
//reinitialize the session array
$_SESSION = array();
header("Location: ../index.php");
?>