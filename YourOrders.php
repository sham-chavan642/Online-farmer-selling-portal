<?php
session_start();
require './db.php';
if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: ./error.php");
}

$bid = $_SESSION['id'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


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
    require './menu.php';
    ?>

    <section id="main" class="wrapper style1 align-center">

        <div class="container">
            <div class="fs-1 bg-light text-primary rounded p-4 mb-1">Your Orders</div>

            <div class="container row">
                <?php
                $sql = "SELECT * from transaction WHERE  bid = '$bid';";

                $result = mysqli_query($conn, $sql);

                $num_result = mysqli_num_rows($result);


                if ($num_result <= 0) {
                ?>
                    <div class="alert alert-danger fs-3 shadow-lg">
                        NO Orders Placed
                    </div>

                    <?php } else {
                    while ($row = $result->fetch_array()) :
                        $pid = $row['pid'];
                        $sql = "SELECT * FROM fproduct WHERE pid = '$pid'";
                        $result1 = mysqli_query($conn, $sql);
                        $product = $result1->fetch_array();
                        $picDestination = "images/productImages/" . $product['pimage'];
                    ?>

                        <div class="col-md-4 p-4 ">

                            <div class="card shadow-lg p-3 mb-5 bg-light p-3 rounded text-primary-emphasis text-decoration-none">

                                <a href="review.php?pid=<?php echo $product['pid']; ?>">

                                    <img class="image fit card-img-top" src="<?php echo $picDestination; ?>" height="220px;" />
                                    <div class="card-body align-left text-decoration-none">
                                        <h2 class="card-title text-2xl text-primary-emphasis">
                                            <?php echo $product['product'] . ''; ?>
                                        </h2>

                                        <div class=" justify-content-between  row">

                                            <div class="flex-1 text-decoration-none col-md-9 p-0 mb-4">
                                                <h2 class="card-title text-2xl text-primary-emphasis mb-0">
                                                    <?php echo "Type : " . $product['pcat'] . ''; ?>
                                                </h2>
                                                <h2 class="card-title text-2xl text-primary-emphasis mt-0">
                                                    <br><?php echo "Price : " . $product['price'] . ' /-'; ?><br>
                                                </h2>
                                            </div>

                                            <div>

                                                <div class="d-flex ">


                                                    <!-- Buy Now Button -->
                                                    <a class="m-1" href="./review.php?pid=<?= $pid; ?>" style="text-decoration: none;">
                                                        <button type="button" class="btn btn-success btn-lg">

                                                            Buy Again

                                                        </button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    <?php endwhile;    ?>


                <?php } ?>


            </div>
        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>