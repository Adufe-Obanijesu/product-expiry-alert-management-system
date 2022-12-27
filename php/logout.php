<?php
	session_start();
	if(session_destroy()){
		header("Location: http://localhost/expiry/login.php");
	} else {
		echo "Error logging out";
	}

?>