<?php

$mysqli = new mysqli('localhost', 'burner', 'burner_pw', 'calendar');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

?>