<?php
session_start();

use Tmdb\Client;


require_once "include/header.php";
require_once "assets/php/Page Functions.php";
require_once "assets/vendor/php-tmdb/tmdb.php";
require_once('vendor/autoload.php');
SetCurrentPage("Home");
$client = require('assets/vendor/php-tmdb/setup-client.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
<?php include "include/navbar.php"; ?>
<nav aria-label="page-breadcrumb" class="first d-md-flex">
    <div class="breadcrumb indigo lighten-6 first-1 shadow-lg d-flex justify-content-end">
        <li class="breadcrumb-item font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </li>
    </div>
</nav>

<div class="container my-5">
    <?php if (!LoggedIn()) include "include/offer_header.php" ?>

    <div class="row gutters-sm">
        <!--Movie Genre Sidebar-->
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <?php $genres = BuildGenreSidebar($client); ?>
                    </nav>
                </div>
            </div>
        </div>
        <!--Movie Genre Sidebar-->
        <!--Movies Card -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body tab-content movieCard">
                    <?php GetGenreMovies($genres, $client); ?>
                </div>
            </div>
        </div>
        <!--Movies Card -->
    </div>
</div>

<script src="assets/js/index.js"></script>
</body>
</html>
