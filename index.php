<?php
session_start();

require_once "include/header.php";
require_once "assets/php/Page Functions.php";

/*
 * if (LoggedIn()) {
    header('Location: home.php');
}
 */
SetCurrentPage("Login");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php CreateHeader(); ?>
    </head>

    <body>
        <div class="container my-5 px-0">
            <!--Section: Content-->
            <section class="p-5 my-md-5 text-center">
                <!-- Form -->
                <form class="my-5 mx-md-5" action="">
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
                                        <small id="signupButton" class="form-text text-right blue-text">
                                            <a href="">Don't have an account? Sign up here.</a>
                                        </small>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-orange btn-rounded my-4 waves-effect">Login</button>
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
        </div>
    </body>
</html>
