<?php
session_start();
require 'db.php';
if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: ./error.php");
}
$user = $_SESSION['Username'];

if ($_SESSION['Category'] != 1) {

    $sql = "SELECT * FROM buyer WHERE busername='$user'";

    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows != 0) {
        $User = $result->fetch_assoc();

        $current_name = $User["bname"];
        $current_username = $User["busername"];
        $current_email = $User["bemail"];
        $current_mobile = $User["bmobile"];
        $current_address = $User["baddress"];
    }
} else if ($_SESSION['Category'] == 1) {

    $sql = "SELECT * FROM farmer WHERE fusername='$user'";

    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows != 0) {
        $User = $result->fetch_assoc();

        $current_name = $User["fname"];
        $current_username = $User["fusername"];
        $current_email = $User["femail"];
        $current_mobile = $User["fmobile"];
        $current_address = $User["faddress"];
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST["name"];
    $username = $_POST["username"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    if ((isset($name) && $name !== '') && (isset($username) && $username !== '')  && (isset($email) && $email !== '')  && (isset($mobile) && $mobile !== '')  && (isset($address) && $address !== '')  && (isset($user) && $user !== '')) {

        if ($_SESSION['Category'] != 1) {

            // buyer profile edit

            $sql = "SELECT * FROM buyer WHERE busername='$user'";

            $result = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows == 0) {
                $_SESSION['message'] = "Invalid User Credentials!";
                header("location: ./error.php");
            } else {

                $sql = "UPDATE buyer SET bname='$name', busername='$username', bmobile='$mobile', bemail='$email',baddress='$address' WHERE busername='$user';";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $user = $username;
                    $_SESSION['Username'] = $username;


                    $fetchProfile = "SELECT * FROM buyer WHERE busername='$user'";

                    $fetchProfileResult = mysqli_query($conn, $fetchProfile);

                    $User = $fetchProfileResult->fetch_assoc();

                    $_SESSION['message'] = "Profile Updated Successfully!";
                    $_SESSION['Email'] = $User['bemail'];
                    $_SESSION['Name'] = $User['bname'];
                    $_SESSION['Username'] = $User['busername'];
                    $_SESSION['Mobile'] = $User['bmobile'];
                    $_SESSION['Addr'] = $User['baddress'];

                    header("location: ./success.php");
                } else {
                    $_SESSION['message'] = "Error occurred while updating profile<br>Please try again!";
                    header("location: ./error.php");
                }
            }
        } else {

            // farmer profile edit
            $sql = "SELECT * FROM famer WHERE fusername='$user'";

            $result = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows == 0) {
                $_SESSION['message'] = "Invalid User Credentials!";
                header("location: ./error.php");
            } else {

                $sql = "UPDATE famer SET fname='$name', fusername='$username', fmobile='$mobile', femail='$email',faddress='$address' WHERE fusername='$user';";

                $result = mysqli_query($conn, $sql);

                if ($result) {

                    $user = $username;
                    $_SESSION['Username'] = $username;

                    $fetchProfile = "SELECT * FROM farmer WHERE fusername='$user'";

                    $fetchProfileRresult = mysqli_query($conn, $fetchProfile);

                    $User = $result->fetch_assoc();


                    $_SESSION['message'] = "Profile Updated Successfully!";

                    $_SESSION['Email'] = $User['femail'];
                    $_SESSION['Name'] = $User['fname'];
                    $_SESSION['Username'] = $User['fusername'];
                    $_SESSION['Mobile'] = $User['fmobile'];
                    $_SESSION['Addr'] = $User['faddress'];
                    header("location: ./success.php");
                } else {
                    $_SESSION['message'] = "Error occurred while updating profile<br>Please try again!";
                    header("location: ./error.php");
                }
            }
        }
    } else {
        $_SESSION['message'] = "All Input are Required!";
        header("location: ./error.php");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <!-- Include Bootstrap CSS -->
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
    require "menu.php"
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit Profile</h3>
                    </div>
                    <div class="card-body">

                        <!-- Edit Profile Form -->
                        <form action="profileEdit.php" method="POST" enctype="multipart/form-data">

                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $current_name; ?>" required>
                            </div>

                            <!-- Username Field -->
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $current_username; ?>" required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $current_email; ?>" required>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo $current_mobile; ?>" required>
                            </div>


                            <!-- Address Field -->
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="addres" name="address" value="<?php echo $current_address; ?>" required>
                            </div>



                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>