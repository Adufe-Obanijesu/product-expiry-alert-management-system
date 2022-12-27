<?php
	include("./db.php");

	if($_POST['name'] !== "" && $_POST['productionDate'] !== "" && $_POST['expiryDate'] !== "" && $_POST['number'] !== "" && $_POST['price'] !== ""){
		
		$name = $_POST['name'];
		$productionDate = $_POST['productionDate'];
		$expiryDate = $_POST['expiryDate'];
		$number = $_POST['number'];
		$price = $_POST['price'];
		$image = $_FILES['productImage'];

		// Extracting image's information
		$file_name = $image['name'];
		$file_size = $image['size'];
		$file_tmp = $image['tmp_name'];
		$file_type = $image['type'];

		if(move_uploaded_file($file_tmp, "../img/".$file_name)){
			$sql = "insert into products (name, productionDate, expiryDate, number, price, image) values('$name', '$productionDate', '$expiryDate', '$number', '$price', '$file_name')";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				echo "Product successfully added";
				header("Location: http://localhost/expiry/");
			} else {
				echo "Query not successfully executed";
			}
		} else {
			echo "Image not successfully uploaded";
		}
	} else {
		echo "Please fill out all the fields";
	}



?>