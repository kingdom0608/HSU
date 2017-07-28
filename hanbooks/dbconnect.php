<?php
	header('Content-Type: text/html; charset=utf-8');
	$db = mysqli_connect('localhost', 'root', 'ajs141749', 'swp_project_db');

	if ($db->connect_error) {
		die('DB ERROR');
	}
	$db->set_charset('utf8');
?>
