<?php 
require 'functions.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	
	if(empty($name) || empty($email) || !valid_email($email)) {
		$status = 'Please provide name and valid email address.';
	} else {
		add_registered_user($name,$email);
		$status = "Thank you $name for registering to our mailing list.";
	}
}
require 'index.tmpl.php';
?>

