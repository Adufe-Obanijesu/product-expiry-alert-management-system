<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/expiry/public/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://localhost/expiry/css/output.css">
	<title>Document</title>
</head>
<body class="">
	<div class="flex justify-center items-center h-screen md:hidden">
		<div class="p-6 shadow w-3/4">
			<h2 class="font-semibold text-gray-600">Your screen resolution can not view this page.</h2>
		</div>
	</div>
	<section class="bg-gradient-to-b from-blue-600 to-blue-800 md:flex hidden items-center justify-center h-screen">
		<div class="w-1/3">
			<?php
				if(isset($_GET['status']) && $_GET['status'] === "false") {

			?>
			<div class="bg-red-200 text-center py-2 mb-2 rounded text-gray-600 text-xl">
				Access Denied!
			</div>
			<?php
				} else {

				}
			?>

			<?php
				if(isset($_GET['status']) && $_GET['status'] === "expired") {

			?>
			<div class="bg-red-200 text-center py-2 mb-2 rounded text-gray-600 text-xl">
				Sorry, your session has expired.
			</div>
			<?php
				} else {

				}
			?>
			<div class="shadow-lg bg-white rounded px-6 py-6 text-xl">
				<h3 class="uppercase text-green-500 text-2xl font-bold text-center pb-4">Hidden brand</h3>
				<form action="./php/verifyUser.php" method="POST">
					<div>
						<input type="text" class="border border-gray-200 text-gray-500 w-full mb-3 p-3 focus:outline-none" placeholder="Username" name="username" required />
					</div>
					<div>
						<input type="password" class="border border-gray-200 text-gray-500 w-full mb-3 p-3 focus:outline-none" placeholder="Password" name="password" required />
					</div>
					<button type="submit" class="text-md bg-green-400 py-2 rounded-sm px-6 text-white hover:shadow hover:bg-green-500 transition ease-in duration-300" type="submit">Login</button>
				</form>
			</div>
		</div>
	</section>

</body>
</html>