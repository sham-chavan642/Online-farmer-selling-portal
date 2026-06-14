<?php
session_start();

if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "You have to Login to view this page!";
    header("Location: ./error.php");
}
?>

<!DOCTYPE HTML>

<html lang="en">

<head>
    <title>Profile:
        <?php echo $_SESSION['Username']; ?>
    </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="./login.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>

    <link rel="stylesheet" href="./skel.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./style-xlarge.css" />


</head>


<body>


    <?php
    require 'menu.php';
    ?>
    <section id="one" class="align w-100">

        <div class="box  m-5 ">

            <div class="row">
                <header>
                    <center>
                        <span>
                            <?php if ($_SESSION['Category'] == 1) { ?>

                                <img src="<?php echo 'images/profileImages/' . $_SESSION['picName'] . '?' . mt_rand(); ?>" class="image-circle" class="img-responsive" height="200%">
                        </span>

                    <?php } else { ?>

                        <img src="./imagesAg/user.png" class="rounded-circle image-circle" class="img-responsive" height="200px"></span>

                    <?php } ?>

                    <h2 class="m-0">
                        <?php echo $_SESSION['Name']; ?>
                    </h2>
                    <h4 style="color: black;">
                        <?php echo $_SESSION['Username']; ?>
                    </h4>
                    <br>
                    </center>
                </header>
                <div class="row uniform text-center ">

                    <?php if ($_SESSION['Category'] == 1) { ?>

                        <div class="col-sm-4">
                            <b>
                                <font size="+1" color="black">RATINGS : </font>
                            </b>
                            <font size="+1">
                                <?php echo $_SESSION['Rating']; ?>
                            </font>
                        </div>
                    <?php } ?>

                    <div class="col-sm-4">
                        <b>
                            <font size="+1" color="black">Email ID : </font>
                        </b>
                        <font size="+1">
                            <?php echo $_SESSION['Email']; ?>
                        </font>
                    </div>

                    <div class="col-sm-4">
                        <b>
                            <font size="+1" color="black">Mobile No : </font>
                        </b>
                        <font size="+1">
                            <?php echo $_SESSION['Mobile']; ?>
                        </font>
                    </div>

                    <div class="col-sm-4">
                        <b>
                            <font size="+1" color="black">ADDRESS : </font>
                        </b>
                        <font size="+1">
                            <?php echo $_SESSION['Addr']; ?>
                        </font>
                    </div>
                    <div class="col-sm-3"></div>
                </div>


                <div class="row">

                    <div class="d-flex justify-content-center  flex-row my-4">


                        <div class="p-1 m-1">
                            <a href="./Profile/changePass.php" class="btn btn-danger" style="text-decoration: none;">Change
                                Password</a>
                        </div>
                        <div class="p-1 m-1">
                            <a href="profileEdit.php" class="btn btn-danger" style="text-decoration: none;">Edit
                                Profile</a>
                        </div>



                        <?php if ($_SESSION['Category'] == 1) { ?>
                            <div class="p-1 m-1">
                                <a href="uploadProduct.php" class="btn btn-danger" style="text-decoration: none;">Upload
                                    Product</a>
                            </div>
                            <div class="p-1 m-1">
                                <a href="Orders.php" class="btn btn-danger" style="text-decoration: none;"> Orders
                                    Recived</a>
                            </div>

                        <?php } ?>
                        <div class="p-1 m-1">
                            <a href="YourOrders.php" class="btn btn-danger" style="text-decoration: none;">Orders</a>
                        </div>


                        <div class="p-1 m-1">
                            <a href="Login/logout.php" class="btn btn-danger" style="text-decoration: none;">LOG
                                OUT</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>



</body>

</html>