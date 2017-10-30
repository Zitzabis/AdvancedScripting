<?php
	// Author:      Stephen Floyd
	// This is the standard connection file that I use for all my MySQL/PHP work.
	// As it is a repeat file, there is no date or assignment number attached.

	$connecterror = "Could not connect to the database. Please report this to the database admin."; // Error message
	$server = "localhost"; // Server
	$username = "submitter"; // Username
	$password = "qkOPElAp0C5knhP9"; // Password
	$database = "midterm"; // DB to access

	$mysqli = new mysqli($server, $username, $password, $database); // Make connection
	// If it errors out, display the error
	if ($mysqli->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>