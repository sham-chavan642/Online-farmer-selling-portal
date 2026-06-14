<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>AgroCulture</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap\js\bootstrap.min.js"></script> -->

	<link rel="stylesheet" href="login.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
	</noscript>


</head>

<body>
	<?php
	require 'menu.php';
	function dataFilter($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>

	<!-- One -->
	<section id="main" class="wrapper style1 align-center">
		<div class="container">
			<h2>Welcome to digital market</h2>

			<?php
			if (isset($_GET['n']) and $_GET['n'] == 1) :
			?>
				<h3>Select Filter</h3>
				<form method="GET" action="productMenu.php?">
					<input type="text" value="1" name="n" style="display: none;" />
					<center>
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<div class="select-wrapper" style="width: auto">
									<select name="type" id="type" required style="background-color:white;color: black;">
										<option value="all" style="color: black;">List All</option>
										<option value="fruit" style="color: black;">Fruit</option>
										<option value="vegetable" style="color: black;">Vegetable</option>
										<option value="grain" style="color: black;">Grains</option>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<input class="button special" type="submit" value="Go!" />
							</div>
							<div class="col-sm-4"></div>
						</div>
					</center>
				</form>
			<?php endif; ?>

			<section id="two" class=" style2 align-center">
				<div class="container">
					<?php
					if (!isset($_GET['type']) or $_GET['type'] == "all") {
						$sql = "SELECT * FROM fproduct WHERE 1";
					}
					if (isset($_GET['type']) and $_GET['type'] == "fruit") {
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Fruit'";
					}
					if (isset($_GET['type']) and $_GET['type'] == "vegetable") {
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Vegetable'";
					}
					if (isset($_GET['type']) and $_GET['type'] == "grain") {
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Grains'";
					}
					$result = mysqli_query($conn, $sql);

					?>
					<div class="row">
						<?php

						while ($row = $result->fetch_array()) :
							$picDestination = "images/productImages/" . $row['pimage'];
						?>


							<div class="col-md-4 p-4 ">

								<div class="card shadow-lg p-3 mb-5 bg-light p-3 rounded text-primary-emphasis text-decoration-none">
									<a href="review.php?pid=<?php echo $row['pid']; ?>">

										<img class="image fit card-img-top" src="<?php echo $picDestination; ?>" height="220px;" />
										<div class="card-body align-left text-decoration-none">
											<h2 class="card-title text-2xl text-primary-emphasis">
												<?php echo $row['product'] . ''; ?>
											</h2>

											<div class="d-flex justify-content-between font-weight-bold">

												<div class="flex-1 text-decoration-none">
													<p class=" text-primary-emphasis m-0 fs-3 text-decoration-none">
														<?php echo "Type : " . $row['pcat'] . ''; ?>
													</p>
													<p class="text-primary-emphasis mb-4 fs-3">
														<br><?php echo "Price : " . $row['price'] . ' /-'; ?><br>
													</p>
												</div>

												<div class="flex-1">

													<a href=" review.php?pid=<?php echo $row['pid']; ?>" class="btn btn-primary">
														Show
													</a>
												</div>
											</div>
										</div>
									</a>
								</div>

							</div>

						<?php endwhile;	?>


					</div>

			</section>
			</header>

	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>