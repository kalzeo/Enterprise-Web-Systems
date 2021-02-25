<?php
session_start();

require_once "include/header.php";
require "assets/php/Database Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";
require_once "assets/php/Movie.php";


$user = unserialize($_SESSION["user"]);

if(!isset($_GET["movie_id"]))
{
    header("Location: index.php", true);
    die();
}

$movie = new Movie($_GET["movie_id"]);
SetCurrentPage($movie->GetTitle());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
<?php include "include/navbar.php"; ?>
<nav aria-label="breadcrumb " class="first d-md-flex">
    <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg">
        <li class="breadcrumb-item font-weight-bold">
            <a class="black-text text-uppercase " href="index.php"><span>home</span></a>
            <i class="fas fa-angle-right mt-1 ml-3 breadcrumb-arrow"></i>
        </li>
        <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="movie.php?movie_id=<?php echo $movie->GetID(); ?>"><span><?php echo $movie->GetTitle(); ?></span></a></li>
        <?php include "include/dark_mode.php"; ?>
    </ol>
</nav>

<div class="container my-5">
    <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="list-group-item d-flex justify-content-center align-items-center py-3">
                <div class="d-flex flex-column pl-3 font-weight-bold text-uppercase">
                    <p class="mb-0"><?php echo $movie->GetTitle(); ?></p>
                    <p class="small mb-0"><?php echo $movie->GetTagline(); ?></p>
                </div>
            </div>
            <img src="<?php echo $movie->GetPoster(); ?>" class='img-fluid' alt="Movie Poster" />
            <button class="list-group-item d-flex justify-content-center align-items-center py-3 btn-outline-mdb-color text-uppercase" id="buy_movie"><i class="far fa-credit-card mr-1"></i> Buy</button>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!--Section: Content-->
                    <section class="dark-grey-text">
                        <!-- Grid row -->
                        <div class="row">
                            <!-- Grid column -->
                            <div class="col-md-12">
                                <!-- Grid row -->
                                <div class="row mb-3">
                                    <!-- Grid column -->
                                    <div class="col-1">
                                        <i class="far fa-file-alt fa-lg indigo-text"></i>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-xl-10 col-md-11 col-10">
                                        <h5 class="font-weight-bold mb-3 movie-information-header">Overview</h5>
                                        <p class="grey-text"><?php echo $movie->GetOverview(); ?></p>
                                    </div>
                                    <!-- Grid column -->

                                </div>
                                <!-- Grid row -->

                                <!-- Grid row -->
                                <div class="row mb-3">

                                    <!-- Grid column -->
                                    <div class="col-1">
                                        <i class="far fa-clock fa-lg indigo-text"></i>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-xl-10 col-md-11 col-10">
                                        <h5 class="font-weight-bold mb-3 movie-information-header">Runtime</h5>
                                        <p class="grey-text"><?php echo "{$movie->GetRuntime()} minutes."; ?></p>
                                    </div>
                                    <!-- Grid column -->
                                </div>
                                <!-- Grid row -->

                                <!--Grid row-->
                                <div class="row">
                                    <!-- Grid column -->
                                    <div class="col-1">
                                        <i class="far fa-star fa-lg indigo-text"></i>
                                    </div>
                                    <!-- Grid column -->

                                    <!-- Grid column -->
                                    <div class="col-xl-10 col-md-11 col-10">
                                        <h5 class="font-weight-bold mb-3 movie-information-header">Rating</h5>
                                        <p class="grey-text mb-0"><?php echo "{$movie->GetVoteAverage()} / 10"; ?></p>
                                    </div>
                                    <!-- Grid column -->

                                </div>
                                <!--Grid row-->

                            </div>
                            <!--Grid column-->

                        </div>
                        <!-- Grid row -->

                    </section>
                    <!--Section: Content-->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/dark-mode-switch.js" type="text/javascript"></script>
</body>
</html>
