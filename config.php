<?php
	$database = "snort";
	$username = "root";
	$password = "root";
	$host = "localhost";

	$conn = mysqli_connect($host, $username, $password, $database);

	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQLI: " . mysqli_connect_errno();
	}