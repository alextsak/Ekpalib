<?php
require_once '../utilities/helpers.php';
session_start();
/*Destroy Session*/
session_destroy();
//reinitialize the session array
$_SESSION = array();
$base = get_basename();
header("Location: " . $base);
?>