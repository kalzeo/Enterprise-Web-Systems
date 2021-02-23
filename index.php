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
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <!-- Section: Block Content -->
                <section>

                    <div class="list-group list-group-flush z-depth-1 rounded">
                        <div class="list-group-item active d-flex justify-content-start align-items-center py-3">
                            <div class="d-flex flex-column">
                                <p class="font-weight-bold mb-0">Browse Movie Genres</p>
                            </div>
                        </div>
                        <?php
                        $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".getenv("TMDB_API")."&language=en-US");
                        $obj = json_decode($json);

                        foreach($obj->genres as &$genre)
                        {
                            echo "<a href='#' class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>$genre->name</a>";
                        }
                        ?>
                    </div>

                </section>
                <!-- Section: Block Content -->
            </div>
            <div class="col-md-8 col-lg-6 z-depth-1">
                <!-- Section: Block Content -->
                <section>



                </section>
                <!-- Section: Block Content -->
            </div>
        </div>
    </div>

    <script src="assets/js/index.js"></script>
</body>
</html>
