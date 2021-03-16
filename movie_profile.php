<?php

use Tmdb\Repository\MovieRepository;

session_start();

require_once "assets/php/Page Functions.php";
require_once('vendor/autoload.php');

// If a movie ID isn't set, kick the user back to the index since the API won't return anything
if (!isset($_GET["movie_id"])) header("Location: index.php");

$user = unserialize($_SESSION["user"]);

// Setup the TMDB API client using the php-TMDB wrapper
$client = require("assets/vendor/php-tmdb/setup-client.php");

// Create an API call to the movie and it's information
$movieRepository = new MovieRepository($client);
$movie = $movieRepository->load($_GET["movie_id"]);
$id = $movie->GetID();
$title = $movie->GetTitle();
$tagline = $movie->GetTagline();
$overview = $movie->GetOverview();
$poster = $movie->GetPosterPath();
$rating = $movie->GetVoteAverage();
$runtime = $movie->GetRuntime();

SetCurrentPage($title);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "include/header.php"; ?>
</head>

<body>
<?php include "include/navbar.php"; ?>
<nav class="first d-md-flex">
    <div class="row breadcrumb indigo lighten-6 first-1 shadow-lg">
        <div class="col-md-8 d-flex justify-content-start">
            <li class="breadcrumb-item font-weight-bold">
                <a class="black-text text-uppercase" href="index.php">home</a>
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase"
                                                            href="movie_profile.php?movie_id=<?php echo $id; ?>"><?php echo $title; ?></a>
            </li>
        </div>
        <div class="col-md-4 d-flex justify-content-end font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="list-group-item d-flex justify-content-center align-items-center py-3">
                <div class="d-flex flex-column pl-3 font-weight-bold text-uppercase">
                    <p class="mb-0"><?php echo $title; ?></p>
                    <p class="small mb-0"><?php echo $tagline; ?></p>
                </div>
            </div>
            <img src="https://image.tmdb.org/t/p/w500<?php echo $poster; ?>" class='img-fluid' alt="Movie Poster"/>
            <button class="list-group-item d-flex justify-content-center align-items-center py-3 btn-outline-mdb-color text-uppercase"
                    id="buy_movie"><i class="far fa-credit-card mr-1"></i> Buy
            </button>
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
                                        <p class="grey-text"><?php echo $overview; ?></p>
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
                                        <p class="grey-text"><?php echo "{$runtime} minutes."; ?></p>
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
                                        <p class="grey-text mb-0"><?php echo "{$rating} / 10"; ?></p>
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
