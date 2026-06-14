<?php
session_start();
require 'db.php';
$pid = $_GET['pid'];
?>


<!DOCTYPE html>
<html>

<head>
	<title>AgroCulture: Product</title>
	<meta lang="eng">
	<meta charset="UTF-8">

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap\js\bootstrap.min.js"></script>
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
	<link rel="stylesheet" href="Blog/commentBox.css" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


	<noscript>
		<link rel="stylesheet" href="./skel.css" />
		<link rel="stylesheet" href="./style.css" />
		<link rel="stylesheet" href="./style-xlarge.css" />
	</noscript>
</head>

<body>


	<?php
	require 'menu.php';

	$sql = "SELECT * FROM fproduct WHERE pid = '$pid'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$fid = $row['fid'];
	$sql = "SELECT * FROM farmer WHERE fid = '$fid'";
	$result = mysqli_query($conn, $sql);
	$frow = mysqli_fetch_assoc($result);

	$picDestination = "images/productImages/" . $row['pimage'];

	?>
	<section id="main" class="wrapper style1 align-center">

		<div class="container">


			<div class="row">

				<div class="card d-flex flex-column flex-lg-row justify-content-around ">
					<div clas="flex-1">

						<img class="image card-img-top img-fit" style=" width:350px;" src="<?php echo $picDestination . ''; ?>" alt="" />
					</div>

					<div class="card-body align-left ">
						<p class="card-title fw-bold mb-4 " style="font: 35px Times new roman;">
							<?= $row['product']; ?>
						</p>

						<div class="text-bg-light rounded p-2 m-2">

							<p style="font-size: 25px ; ">Product Owner :
								<?= $frow['fname']; ?>
							</p>
							<p style="font-size: 25px ;">Price :
								<?= $row['price'] . ' /-'; ?>
							</p>

							<p style="font-size: 25px;">Price :
								<?= $row['price'] . ' /-'; ?>
							</p>

						</div>

						<div class="text-bg-light rounded p-2 m-2">

							<p style="font-size: 25px ;font-weight:500;">
								Product Description :

							<div class="" style="font-size: 22px ; ">
								<?= $row['pinfo']; ?>

							</div>



						</div>

						<div class="d-flex ">

							<!-- Remove from Cart Button -->
							<a class="m-1" href="myCart.php?flag=1&pid=<?= $pid; ?>" style="text-decoration: none;">
								<button type="button" class="btn btn-danger btn-lg">
									Add to Cart
								</button>
							</a>
							<!-- Buy Now Button -->
							<a class="m-1" href="buyNow.php?pid=<?= $pid; ?>&fid=<?= $fid; ?>" style="text-decoration: none;">
								<button type="button" class="btn btn-success btn-lg">

									Buy Now

								</button>
							</a>
						</div>
					</div>

				</div>


			</div>


			<!-- </div> -->


		</div>

		<br /><br />

		<div class=" 12u$">

		</div>

		<div class="container">
			<h1>Product Reviews</h1>
			<div class="row">
				<?php
				$sql = "SELECT * FROM review WHERE pid='$pid'";
				$result = mysqli_query($conn, $sql);
				?>
				<div class="col-0 col-sm-3"></div>
				<div class="col-12 col-sm-6">
					<?php
					if ($result) :
						while ($row1 = $result->fetch_array()) :
					?>
							<div class="con">
								<div class="row">
									<div class="col-sm-4">
										<em style="color: black;">
											<?= $row1['comment']; ?>
										</em>
									</div>
									<div class="col-sm-4">
										<em style="color: black;">
											<?php echo "Rating : " . $row1['rating'] . ' out of 10'; ?>
										</em>
									</div>
								</div>
								<span class="time-right" style="color: black;">
									<?php echo "From: " . $row1['name']; ?>
								</span>
								<br /><br />
							</div>
					<?php endwhile;
					endif; ?>
				</div>
			</div>
		</div>
		<?php

		?>
		<div class="container">
			<p style="font: 20px Times new roman; align: left;">Rate this product</p>
			<form method="POST" action="reviewInput.php?pid=<?= $pid; ?>">
				<div class="row">
					<div class="col-sm-7">
						<textarea style="background-color:white;color: black;" cols="5" name="comment" placeholder="Write a review"></textarea>
					</div>
					<div class="col-sm-5">
						<br />
						Rating: <input type="number" min="0" max="10" name="rating" value="0" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<br />
						<input type="submit" />
					</div>
				</div>
			</form>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>