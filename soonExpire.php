<?php
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		if($_SESSION['username'] !== "" && $_SESSION['password'] !== ""){
			$verify = password_verify($_SESSION['password'], '$2y$10$cyOuinmV6iO1LuAGmvO84uIbf0xFZ/QS3QdVa9ES4io4Acb2atS/C');
			if($_SESSION['username'] === "Banji Oluwatimilehin" && $verify == true) {
				
			} else {
				header("Location: http://localhost/expiry/login.php?status=expired");
			}
		}
	} else {
		header("Location: http://localhost/expiry/login.php?status=expired");	
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/expiry/public/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://localhost/expiry/css/output.css">
	<title>Document</title>
</head>
<body>
	<div class="flex justify-center items-center h-screen md:hidden">
		<div class="p-6 shadow w-3/4">
			<h2 class="font-semibold text-gray-600">Your screen resolution can not view this page.</h2>
		</div>
	</div>
	<div class="bg-gray-50 min-h-screen hidden md:block">
		<div class="grid grid-cols-6">
			
			<?php include("./sidebar.php"); ?>

			<div class="col-span-5 py-4 px-10 relative">

				<div class="shadow-lg rounded bg-white p-10">
			<div class="flex justify-between items-center mb-4">
				<h2 class="text-gray-400 font-semibold text-2xl mb-3">Soon Expired Products</h2>
				<span class="bg-blue-500 text-white p-1 rounded hover:bg-blue-600 cursor-pointer px-2" onclick="addProduct()">Add a Product +</span>
			</div>

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
							if(mysqli_num_rows($query) > 0){
								while($row = mysqli_fetch_array($query)) {
									$name = $row['name'];
									$productionDate = $row['productionDate'];
									$expiryDate = $row['expiryDate'];
									$number = $row['number'];
									$price = $row['price'];
									$productImage = $row['image'];

									?>

				<div class="rounded-md mb-4">
					<div class="grid grid-cols-7 gap-2 p-2 shadow hover:shadow-md">
					<div class="h-100">
							<img class="cursor-pointer h-32 w-100" src="http://localhost/expiry/img/<?php echo $productImage; ?>" style="object-fit: cover; width: 100%" class="h-full" onclick="viewProduct(<?php echo $row['id']; ?>)" />
					</div>
					<div class="flex items-center justify-center">
						<p class="font-bold tracking-md text-center"><?php echo $name; ?></p>
					</div>
					<div class="flex items-center justify-center">
						<div>
							<h3 class="font-semibold">Production Date</h3>
							<p class="text-gray-500 tracking-md text-center"><?php echo $productionDate; ?></p>
						</div>
					</div>
					<div class="flex items-center justify-center">
						<div>
							<h3 class="font-semibold">Expiry Date</h3>
							<p class="text-gray-500 tracking-md text-center"><?php echo $expiryDate; ?></p>
						</div>
					</div>
					<div class="flex items-center justify-center">
						<div>
							<h3 class="font-semibold">Number in Stock</h3>
							<p class="text-gray-500 tracking-md text-center"><?php echo $number; ?></p>
						</div>
					</div>
					<div class="flex items-center justify-center text-xl font-bold" style="color: #007bff"><h3 class="text-center">$<?php echo $price; ?></h3></div>
					<div class="flex items-center justify-center">
						<div class="flex justify-between text-lg">
							<span class="fa fa-eye text-blue-600 hover:text-blue-800 cursor-pointer" onclick="viewProduct(<?php echo $row['id']; ?>)"></span> <span class="fa fa-trash ml-4 text-red-600 hover:text-red-800 cursor-pointer" onclick="deleteProduct()"> </span>
						</div>
					</div>
				</div>
				</div>

				<!-- Modal for viewing the product -->
				<div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden" id="<?php echo $row['id']; ?>" style="zIndex: 1000">
					<div class="h-screen w-full absolute z-50 bg-black bg-opacity-50 cursor-pointer" onclick="viewProduct(<?php echo $row['id']; ?>)"></div>
					<div class="relative bg-white rounded-lg w-3/6 z-50">
						<div class="flex justify-between items-center p-4">
							<h3 class="text-gray-800 text-xl"><?php echo $name ?></h3>
							<div class="flex justify-between text-lg">
								<span class="fa fa-trash ml-4 text-red-600 hover:text-red-800 cursor-pointer" onclick="deleteProduct()"> </span>
							</div>
						</div>
						<div class="relative h-96">
							<img src="http://localhost/expiry/img/<?php echo $productImage; ?>" class="h-96 w-full" style="object-fit: cover" alt="dish" layout="fill" />
						</div>
						<div class="bg-red-100 py-2 absolute right-0">
							
						</div>
					</div>
				</div>

				<?php
                            }
                        } else {
                            echo "<h2 class='font-bold text-lg text-gray-600'>There are no products expiring soon</h2>";
                        }
                        } else {
                            echo "Query not successful";
                        }
                    }

                ?>

			</div>


			<div class="shadow-lg rounded bg-white p-10">
				
					<div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden" id="logout" style="zIndex: 1000">
                        <div class="h-screen w-full absolute z-50 bg-black bg-opacity-50 cursor-pointer" onclick="logout()"></div>
                        <div class="bg-white shadow-lg w-2/7 z-50 rounded-lg">
                            <div class="p-6">
                                <h4 class="tracking-md text-xl text-center mb-3 font-semibold">Are you sure you want to logout?</h4>
                                <div class="flex justify-center">
                                    <a href="http://localhost/expiry/php/logout.php" class="w-1/3 mr-3"><button class="py-2 px-4 bg-red-400 hover:bg-red-500 rounded-md text-white transition ease-in duration-300 w-full">Yes</button></a>
                                    <button class="py-2 px-4 bg-green-400 hover:bg-green-500 rounded-md text-white transition ease-in duration-300 w-1/3" onclick="logout()">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden" id="product" style="zIndex: 1000">
						<div class="h-screen w-full absolute z-50 bg-black bg-opacity-50 cursor-pointer" onclick="viewProduct()"></div>
						<div class="bg-white rounded-lg w-3/6 z-50">
							<h3 class="text-gray-800 text-xl p-4">Amala & Gbegiri</h3>
							<div class="relative h-96">
								<img src="http://localhost/expiry/img/1.jpg" class="h-96 w-full" style="object-fit: cover" alt="dish" layout="fill" />
							</div>
							<div class="p-4 text-gray-500">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quas temporibus eum corrupti repellat labore adipisci, at deserunt, reprehenderit nihil et ratione, quaerat placeat explicabo dicta optio quae corporis voluptatum.
							</div>
						</div>
					</div> -->

					<div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden" id="deleteButton" style="zIndex: 1000">
						<div class="h-screen w-full absolute z-50 bg-black bg-opacity-50 cursor-pointer" onclick="deleteProduct()"></div>
						<div class="bg-white shadow-lg w-2/7 z-50 rounded-lg">
							<div class="p-6">
								<h4 class="tracking-md text-xl text-center mb-3 font-semibold">Are you sure you want to delete?</h4>
								<div class="flex justify-center">
									<button class="py-2 px-4 bg-red-400 hover:bg-red-500 rounded-md text-white transition ease-in duration-300 w-1/3 mr-3">Yes</button>
									<button class="py-2 px-4 bg-green-400 hover:bg-green-500 rounded-md text-white transition ease-in duration-300 w-1/3">No</button>
								</div>
							</div>
						</div>
					</div>

			</div>


			<!-- Adding new product -->
			<div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden" id="addProduct" style="zIndex: 1000">
				<div class="h-screen w-full absolute z-50 bg-black bg-opacity-50 cursor-pointer" onclick="addProduct()"></div>
				<div class="bg-white shadow-lg w-2/5 p-3 z-50">

					<div class="border-b border-1 border-gray-200 py-2 mb-2">
						<h3 class="text-xl font-bold tracking-md">Add a Product</h3>
					</div>

					<div class="mt-4">
					<form method="post" action="http://localhost/expiry/php/addProduct.php" enctype="multipart/form-data">
						<div class="shadow rounded bg-white py-1 mb-3">
							<label htmlFor="name" class="font-bold px-3 text-gray-600 text-sm">Name</label>
							<input type="text" class="px-3 text-gray-400 w-full focus:outline-none" name="name" required />
						</div>

						<div class="shadow rounded bg-white py-1 mb-3">
							<label htmlFor="productionDate" class="font-bold px-3 text-gray-600 text-sm">Production Date</label>
							<input type="date" class="px-3 text-gray-400 w-full focus:outline-none" name="productionDate" required />
						</div>

						<div class="shadow rounded bg-white py-1 mb-3">
							<label htmlFor="expiryDate" class="font-bold px-3 text-gray-600 text-sm">Expriry Date</label>
							<input type="date" class="px-3 text-gray-400 w-full focus:outline-none" name="expiryDate" required />
						</div>

						<div class="shadow rounded bg-white py-1 mb-3">
							<label htmlFor="number" class="font-bold px-3 text-gray-600 text-sm">Number of Product</label>
							<input type="number" class="px-3 text-gray-400 w-full focus:outline-none" min="1" value="1" name="number" required />
						</div>
						
						<div class="shadow rounded bg-white py-1 mb-3">
							<label htmlFor="price" class="font-bold px-3 text-gray-600 text-sm">Price</label>
							<input type="text" class="px-3 text-gray-400 w-full focus:outline-none" name="price" required />
						</div>

						<div class="mb-3">
							<input type="file" size="20" name="productImage" required />
						</div>

						<button type="submit" class="text-md bg-green-400 py-2 rounded-sm px-6 text-white rounded hover:shadow hover:bg-green-500 transition ease-in duration-300">Add +</button>
					</form>
					</div>

				</div>
			</div>

		</div>
		
		</div>
	</div>

<script type="text/javascript">
// Setting global variables
	let viewStatus = false;
	let deleteStatus = false;
	let addStatus = false;

// Functions to view or hide modals
	const viewProduct = (id) => {
		if (viewStatus === false) {
			document.getElementById(id).className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center block";
			viewStatus = !viewStatus;
		} else {
			document.getElementById(id).className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden";
			viewStatus = !viewStatus;
		}
	}

	const deleteProduct = () => {
		if (deleteStatus === false) {
			document.getElementById("deleteButton").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center block";
			deleteStatus = !deleteStatus;
		} else {
			document.getElementById("deleteButton").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden";
			deleteStatus = !deleteStatus;
		}
	}

	const addProduct = () => {
		if (addStatus === false) {
			document.getElementById("addProduct").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center block";
			addStatus = !addStatus;
		} else {
			document.getElementById("addProduct").className = "h-screen w-full fixed left-0 top-0 flex justify-center items-center hidden";
			addStatus = !addStatus;
		}
	}
</script>
</body>
</html>