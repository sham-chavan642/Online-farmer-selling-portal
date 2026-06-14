<?php
session_start();
require './db.php';
if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: ./error.php");
}

$fid = $_SESSION['id'];

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
            <div class="fs-1 bg-light text-primary rounded p-4 mb-1">Orders Recived</div>

            <div class="container row">
                <?php
                $sql = "SELECT * from transaction WHERE  fid = '$fid';";

                $result = mysqli_query($conn, $sql);

                $num_result = mysqli_num_rows($result);


                if ($num_result <= 0) {
                ?>
                    <div class="alert alert-danger fs-3 shadow-lg">
                        NO Orders Recived

                    </div>

                    <?php } else {
                    $x = 0;
                    while ($row = $result->fetch_array()) :
                        $pid = $row['pid'];
                        $sql = "SELECT * FROM fproduct WHERE pid = '$pid'";
                        $result1 = mysqli_query($conn, $sql);
                        $product = $result1->fetch_array();
                        $picDestination = "images/productImages/" . $product['pimage'];
                        $x++;
                    ?>

                        <section id="main" class="wrapper style1 align-center">

                            <div class="container">


                                <div class="row">

                                    <div class="card d-flex flex-column flex-lg-row justify-content-around box mb-1">
                                        <div clas="flex-1">
                                            <span class="p-1 fs-3"><?= $x ?></span>

                                            <img class="image card-img-top img-fit" style=" width:350px;" src="<?php echo $picDestination . ''; ?>" alt="" />
                                        </div>

                                        <div class="card-body align-left ">



                                            <div class="text-bg-light rounded p-2 m-2">

                                                <p style="font-size: 25px ;font-weight:500;">
                                                    Product Description :

                                                <p class="card-title fw-bold mb-4 " style="font: 35px Times new roman;">
                                                    <?= $product['product']; ?>
                                                </p>
                                                <div class="" style="font-size: 22px ; ">
                                                    <?= $product['pinfo']; ?>

                                                </div>

                                                <p style="font-size: 25px ;">Price :
                                                    <?= $product['price'] . ' /-'; ?>
                                                </p>


                                            </div>

                                            <div class="text-bg-light rounded p-2 m-2">

                                                <div class="text-bg-light rounded ">

                                                    <p style="font-size: 25px ;font-weight:500;">
                                                        Order Details:

                                                    <div class="" style="font-size: 22px ; ">
                                                        <b>Order Placed By:</b> <?= $row['name']; ?>

                                                    </div>

                                                    <p style="font-size: 22px ;">
                                                        <b>Email :</b>
                                                        <?= $row['email']; ?>
                                                    </p>




                                                    <p style="font-size: 22px ;">
                                                        <b>Phone No :</b>
                                                        <?= $row['mobile']; ?>
                                                    </p>

                                                    <p style="font-size: 22px ;">
                                                        <b>Address:</b>
                                                        <?= $row['addr']; ?>
                                                    </p>

                                                    <p style="font-size: 22px ;">
                                                        <b>City :</b>
                                                        <?= $row['city']; ?>
                                                    </p>

                                                    <p style="font-size: 22px ;">
                                                        <b>Pin Code :</b>
                                                        <?= $row['pincode']; ?>
                                                    </p>


                                                </div>
                                            </div>
                                        </div>

                                    </div>


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