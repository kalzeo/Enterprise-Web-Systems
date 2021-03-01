<?php
session_start();

use Tmdb\Repository\GenreRepository;

require_once "include/header.php";
require_once "assets/php/Page Functions.php";
require_once('vendor/autoload.php');

// Setup the TMDB API client using the php-TMDB wrapper
$client = require_once("assets/vendor/php-tmdb/setup-client.php");

// API call to fetch the available movie genres
$genreRepository = new GenreRepository($client);
$genreList = $genreRepository->loadMovieCollection();

SetCurrentPage("Home");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
<?php include_once "include/navbar.php"; ?>

<!--Start: Page breadcrumb-->
<nav aria-label="page-breadcrumb" class="first d-md-flex">
    <div class="breadcrumb indigo lighten-6 first-1 shadow-lg d-flex justify-content-end">
        <li class="breadcrumb-item font-weight-bold">
            <?php include_once "include/dark_mode.php"; ?>
        </li>
    </div>
</nav>
<!--End: Page breadcrumb-->

<div class="container my-5">
    <?php
    // Only display the sign up offer when the user isn't logged in
    if (!LoggedIn())
        include_once "include/offer_header.php";
    ?>

    <div class="row gutters-sm">
        <!--Start: Movie Genre Sidebar-->
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <?php
                        // Loop through each genre and add create a sidebar option for it
                        foreach ($genreList as $index => &$genre)
                        {
                            // Give the first element the active class (selects the first option on the sidebar)
                            $idx = $index == 0 ? "active" : "";

                            $genreID = $genre->GetID();
                            $genreName = $genre->GetName();
                            echo "<a class='nav-link {$idx}' id='{$genreID}-tab' data-toggle='pill' href='#{$genreName}-pill'>{$genreName}</a>";
                        }
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <!--End: Movie Genre Sidebar-->

        <!--Start: Movies Card-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body tab-content movieCard">
                    <?php
                    // Loop through each genre and get available movies for the category
                    foreach ($genreList as $index => &$genre)
                    {
                        /*
                         * ~IMPORTANT~ Used to assign the active class to the first category of movies, without the active class
                         * assigned, no movies will show up until you press on a different category.
                         */
                        $idx = $index == 0 ? "active" : "";

                        $genreID = $genre->GetID();
                        $genreName = $genre->GetName();

                        // Fetch movies belonging to a Genre ID from the Genre Repository
                        $movies = $genreRepository->getMovies($genreID);

                        // Start building the movie card
                        $movieBox = "<div class='tab-pane {$idx}' id='{$genreName}-pill'>
                                    <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>{$genreName}</h6>
                                    <hr class='dark-grey-text'>";

                        // Loop through the returned movies and create a box for each one on the card
                        foreach ($movies as $index2 => &$movie)
                        {
                            $title = $movie->GetTitle();

                            $movieBox = $movieBox . "<a href='movie_profile.php?movie_id={$movie->GetID()}'><div class='card hoverable mt-3'>
                                          <img src='https://image.tmdb.org/t/p/w500{$movie->GetPosterPath()}' class='card-img-top' alt='{$title} Movie Poster'/>
                                          <div class='card-body'>
                                            <h5 class='card-title'>{$title}</h5>
                                            <p class='card-text movie-description mb-2'>{$movie->GetOverview()}</p>
                                          </div>
                                        </div></a>
                                       ";
                        }

                        // Finish building the movie card
                        $movieBox = $movieBox . "</div>";
                        echo $movieBox;
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--End: Movies Card-->
    </div>
</div>

<script src="assets/js/index.js"></script>
</body>
</html>
