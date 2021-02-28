<?php

session_start();
require_once "include/header.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";

// If we're already logged in then there's no point seeing the login page so redirect back to the homepage
if (LoggedIn()) header("Location: index.php");

SetCurrentPage("Sign up");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
<?php include_once "include/navbar.php"; ?>
<nav class="first d-md-flex">
    <div class="row breadcrumb indigo lighten-6 first-1 shadow-lg">
        <div class="col-md-8 d-flex justify-content-start">
            <li class="breadcrumb-item font-weight-bold">
                <a class="black-text text-uppercase " href="index.php">home</a>
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="signup.php">sign
                    up</a></li>
        </div>
        <div class="col-md-4 d-flex justify-content-end font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </div>
    </div>
</nav>



<div class="container my-5 px-0">
    <?php



    ?>
    <!--Section: Content-->
    <section class="p-5 my-md-5 text-center">
        <form class="my-5 mx-md-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- Material form login -->
                    <div class="card">
                        <!--Card content-->
                        <div class="card-body">
                            <!-- Form -->
                            <form class="text-center">
                                <h3 class="font-weight-bold my-4 pb-2 text-center dark-grey-text">Sign up</h3>
                                <!-- Username -->
                                <input type="text" id="username" class="form-control mb-4" placeholder="Username">
                                <!-- Password -->
                                <input type="password" id="password" class="form-control" placeholder="Password">
                                <div class="text-center">
                                    <button type="button" id="loginSubmitButton"
                                            class="btn btn-outline-orange my-4 waves-effect">Sign up
                                    </button>
                                </div>
                            </form>
                            <!-- Form -->
                        </div>
                    </div>
                    <!-- Material form login -->
                </div>
            </div>
        </form>
    </section>
    <!--Section: Content-->
</div>

<script src="assets/js/signup.js"></script>
</body>
</html>
