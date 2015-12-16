<?php

function add_registered_user($name, $email){
	# SECURE FILE mailing_list.php to an external space, adding ../
	file_put_contents('mailing_list.php', "$name: $email\n", FILE_APPEND);
}

function old($key) {
	if(!empty($_REQUEST[$key])) {
		return htmlspecialchars($_REQUEST[$key]);
	}
	return '';
}

function valid_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}