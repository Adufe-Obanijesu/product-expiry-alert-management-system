<?php

	$username = $_POST['username'];
	$password = $_POST['password'];
echo $username.$password;
	if($_POST['username'] !== "" && $_POST['password'] !== ""){
		$verify = password_verify($password, '$2y$10$cyOuinmV6iO1LuAGmvO84uIbf0xFZ/QS3QdVa9ES4io4Acb2atS/C');
		if($username === "Banji Oluwatimilehin" && $verify == true) {
			session_start();
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("Location: http://localhost/expiry/");
		} else {
			header("Location: http://localhost/expiry/login.php?status=false");
		}
	}

?>