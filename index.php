<?php
session_start();

require_once "include/header.php";
require "assets/php/Database Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";

SetCurrentPage("Home");
$user = unserialize($_SESSION["user"]);

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
                <img class="ml-md-3 arrow-icon" src="https://img.icons8.com/offices/30/000000/double-right.png" width="20" height="20" alt="Breadcrumb Arrow">
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="index.php"><span>index</span></a></li>
        </ol>
    </nav>

    <?php
    /*
    $result = SelectFromTable("heroku_7e12094ae71a8cd.users", "*", "id = 1");
    if(NumRows($result) != 0)
    {
        while($row = mysqli_fetch_object($result))
        {
            $row = SanitizeRowObject($row);
            echo $row->username . "<br>";
        }
    }
    */
    $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".getenv("TMDB_API")."&language=en-US");
    $obj = json_decode($json);
    ?>

    <div class="container my-5">
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
                    <div class="card-body tab-content" id="movieCard">
                        <?php
                        foreach($obj->genres as $index=>&$genre) {

                            # Give the first element the active class
                            $idx = $index == 0 ? 'active' : '';

                            $genreID = $genre->id;
                            $genreName = $genre->name;

                            $json2 = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=" . getenv("TMDB_API") . "&with_genres={$genreID}");
                            $obj2 = json_decode($json2);

                            echo "<div class='tab-pane {$idx}' id='{$genreName}-pill' role='tabpanel' aria-labelledby='{$genreName}-tab'>
                                    <h6 class='dark-grey-text pt-3'><b>{$genreName}</b></h6>
                                    <hr>";

                            foreach ($obj2->results as $index2 => &$movie)
                            {
                                if($index2 == 10) break;

                                echo "<a href='movie.php?movie_id={$movie->id}'><div class='card hoverable mt-3'>
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
