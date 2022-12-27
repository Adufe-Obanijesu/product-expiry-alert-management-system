<?php
	error_reporting(0);
	// Connection to Database;
	$conn = mysqli_connect("localhost", "root", "", "expiry");
	if(!$conn) {
		die("Error Connecting to Database");
	}
		

?>