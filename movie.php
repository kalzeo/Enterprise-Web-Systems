<?php
session_start();

require_once "include/header.php";
require "assets/php/Database Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";
require_once "assets/php/MovieClass.php";

SetCurrentPage("Movie");
$user = unserialize($_SESSION["user"]);

if(!isset($_GET["movie_id"]))
{
    header("Location: index.php", true);
    die();
}

$movie = new MovieClass($_GET["movie_id"]);
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
        <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="movie.php?movie_id=<?php echo "4"; ?>"><span>Movie</span></a></li>
    </ol>
</nav>

<div class="container my-5">
    <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="list-group-item active d-flex justify-content-start align-items-center py-3">
                <div class="d-flex flex-column pl-3">
                    <p class="font-weight-normal mb-0"><?php echo $movie->GetTitle(); ?></p>
                    <p class="small mb-0"><?php echo $movie->GetTagline(); ?></p>
                </div>
            </div>
            <img src="<?php echo $movie->GetPoster(); ?>" class='img-fluid' alt="Movie Poster" />
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body tab-content" id="movieCard">
                    <?php
                        echo "{$movie->GetOverview()}<br><br>{$movie->GetRuntime()} minutes<br><br>{$movie->GetVoteAverage()} / 10";

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/movie.js"></script>
</body>
</html>
