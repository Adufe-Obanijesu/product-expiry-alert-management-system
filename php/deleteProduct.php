<?php

	include("./db.php");

	$id = $_POST['id'];

	$sql = "select * from products where id='$id'";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		$image = "";
		while($row = mysqli_fetch_array($query)) {
			$image = $row['image'];
		}

		if(unlink("../img/$image")){
			$sql2 = "delete from products where id='$id'";
			$query2 = mysqli_query($conn, $sql2);
			if ($query2) {
				echo "successful";
				header("Status: 200");
			} else {
				echo "Unable to remove product from database";
				header("Status: 400");
			}
		} else {
			echo "Cannot delete image that does not exist";
			header("Status: 400");
		}
	} else {
		echo "Query not successfully executed";
		header("Status: 400");
	}



?>