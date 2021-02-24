<?php
session_start();
require_once "include/header.php";
require_once "assets/php/General Functions.php";

// If we're already logged in then there's no point seeing the login page so redirect back to the homepage
if(LoggedIn())
{
    header("Location: index.php", true);
    die();
}

SetCurrentPage("Login");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
    <?php include_once "include/navbar.php"; ?>


    <div class="container my-5 px-0">
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
                                    <h3 class="font-weight-bold my-4 pb-2 text-center dark-grey-text">Log In</h3>
                                    <!-- Username -->
                                    <input type="text" id="username" class="form-control mb-4" placeholder="Username">
                                    <!-- Password -->
                                    <input type="password" id="password" class="form-control" placeholder="Password">
                                    <small id="passwordHelpBlock" class="form-text text-right blue-text">
                                        <a href="">Not got an account? Sign up here!</a>
                                    </small>
                                    <div class="text-center">
                                        <button type="button" id="loginSubmitButton" class="btn btn-outline-orange my-4 waves-effect">Login</button>
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

    <script src="assets/js/login.js"></script>
    <script src="assets/js/dark-mode-switch.js" type="text/javascript"></script>
</body>
</html>
