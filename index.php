<?php
session_start();

require_once "include/header.php";
require "assets/php/Database Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";

SetCurrentPage("Home");
$json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".getenv("TMDB_API")."&language=en-US");
$obj = json_decode($json);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
    <?php include "include/navbar.php"; ?>
    <nav aria-label="breadcrumb" class="first d-md-flex">
        <ol class="breadcrumb first-1 shadow-lg">
            <?php include "include/dark_mode.php"; ?>
        </ol>
    </nav>

    <div class="container my-5">
        <?php if(!LoggedIn()) include "include/random_movie_header.php" ?>


        <!--Section: Content-->
        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <?php
                            foreach($obj->genres as $index=>&$genre)
                            {
                                # Give the first element the active class
                                $idx = $index == 0 ? 'active' : '';
                                $selected = $index == 0 ? 'true' : 'false';

                                $genreID = $genre->id;
                                $genreName = $genre->name;
                                echo "<a class='nav-link {$idx}' id='{$genreID}-tab' data-toggle='pill' href='#{$genreName}-pill' role='tab' aria-controls='{$genreName}-pill' aria-selected='{$selected}'>{$genreName}</a>";
                            }
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body tab-content movieCard">
                        <?php
                        foreach($obj->genres as $index=>&$genre) {

                            # Give the first element the active class
                            $idx = $index == 0 ? 'active' : '';

                            $genreID = $genre->id;
                            $genreName = $genre->name;

                            $json2 = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=" . getenv("TMDB_API") . "&with_genres={$genreID}");
                            $obj2 = json_decode($json2);

                            echo "<div class='tab-pane {$idx}' id='{$genreName}-pill' role='tabpanel' aria-labelledby='{$genreName}-tab'>
                                    <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>{$genreName}</h6>
                                    <hr class='dark-grey-text'>";

                            foreach ($obj2->results as $index2 => &$movie)
                            {
                                if($index2 == 10) break;

                                echo "<a href='movie_profile.php?movie_id={$movie->id}'><div class='card hoverable mt-3'>
                                          <img src='https://image.tmdb.org/t/p/w500{$movie->poster_path}' class='card-img-top' alt='{$movie->title} Movie Poster'/>
                                          <div class='card-body'>
                                            <h5 class='card-title'>{$movie->title}</h5>
                                            <p class='card-text movie-description mb-2'>{$movie->overview}</p>
                                          </div>
                                        </div></a>
                                       ";
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/index.js"></script>
</body>
</html>
