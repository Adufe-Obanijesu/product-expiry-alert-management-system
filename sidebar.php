<?php 
	// Connection to Database;
	$conn = mysqli_connect("localhost", "root", "", "expiry");
	if(!$conn) {
		echo "Error Connecting to Database";
	} else {
		$five_days = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") + 5, date("Y")));
		$current_date = date('Y-m-d');
		
		$sql = "select * from products where expiryDate between '$current_date' AND '$five_days'";
		$query = mysqli_query($conn, $sql);

		if($query) {
			$no_of_soon_expired = mysqli_num_rows($query);
		} else {
			$no_of_soon_expired = "error";
		}

		$sql2 = "select * from products where expiryDate < '$current_date'";
        $query2 = mysqli_query($conn, $sql2);

        if($query) {
			$no_of_expired = mysqli_num_rows($query2);
		} else {
			$no_of_expired = "error";
		}

		$sql3 = "select * from products order by id desc";
		$query3 = mysqli_query($conn, $sql3);
		if($query3) {
			$no_of_products = mysqli_num_rows($query3);
		}		

		// echo $no_of_expired.$no_of_soon_expired;

?>

<div id='sidebar' class="col-span-1">
	<div class="w-1/6">
		<div class="bg-gradient-to-b from-blue-600 to-blue-800 text-gray-200 py-6 fixed filter drop-shadow-lg" style="height: 100vh; width: inherit">
			<div class="px-6">
				<h3 class="pb-4 flex items-center"><img src="http://localhost/expiry/img/avatar.png" width="40" height="40" class="rounded-full" alt="user" /> <span class="ml-2">PEAMS</span></h3>
				<hr class="border-gray-200" />
			</div>
			<ul class="px-8">
				<Link href="/admin">
					<a href="http://localhost/expiry/"><li class="my-8 cursor-pointer hover:text-blue-200">All Products <span class="rounded-full bg-white py-1 px-3 text-gray-800 font-semibold"><?php echo $no_of_products; ?></span></li></a>
					<a href="http://localhost/expiry/soonExpire.php">
						<li class="my-8 cursor-pointer hover:text-blue-200">Soon Expired <?php if($no_of_soon_expired === 0) {} else{ ?><span class="rounded-full bg-orange-400 py-1 px-3 text-white font-semibold"><?php echo $no_of_soon_expired; ?></span><?php } ?></li>
					</a>
					<a href="http://localhost/expiry/expired.php">
						<li class="my-8 cursor-pointer hover:text-blue-200">Expired Products <?php if($no_of_expired === 0) {} else{ ?><span class="rounded-full bg-red-500 py-1 px-3 text-white font-semibold"><?php echo $no_of_expired; ?></span><?php } ?></li>
					</a>
				<!-- <a href="http://localhost/expiry/php/logout.php"><li class="my-8 cursor-pointer hover:text-red-300">Logout</li></a> -->
				<li class="my-8 cursor-pointer hover:text-red-300" onclick="logout()">Logout</li>
			</ul>
		</div>
	</div>
</div>

<?php
}
?>

<script>
	const logout = () => {
		if (addStatus === false) {
			document.getElementById("logout").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center block";
			addStatus = !addStatus;
		} else {
			document.getElementById("logout").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden";
			addStatus = !addStatus;
		}
	}
</script>