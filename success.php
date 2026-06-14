<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>AgroCulture</title>
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

    <section id="banner" class="wrapper">
        <div class="container">
            <header class="major">
                <h2>SUCCESS</h2>
            </header>
            <p>
                <?php
                if (isset($_SESSION['message']) and !empty($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } else {
                    header("Location: ./index.php");
                }
                ?>
            </p><br />
            <a href="./index.php" class="button special">HOME</a>


            <?php $_SESSION['message'] = ""; ?>

</body>

</html>