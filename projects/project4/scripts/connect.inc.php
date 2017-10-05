<?php
	$connecterror = "Could not connect to the database. Please report this to the database admin.";
	$server = "localhost";
	$username = "submitter";
	$password = "qkOPElAp0C5knhP9";
	$database = "project4_6";

	$mysqli = new mysqli($server, $username, $password, $database);
	if ($mysqli->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>