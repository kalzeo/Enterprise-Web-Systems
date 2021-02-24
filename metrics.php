<?php
session_start();

require_once "include/header.php";
require "assets/php/Database Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/Page Functions.php";

SetCurrentPage("A/B Metric Dashboard");

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
                <i class="fas fa-angle-right mt-1 ml-3 breadcrumb-arrow"></i>
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="metrics.php"><span>A/B Metric Dashboard</span></a></li>
            <?php include "include/dark_mode.php"; ?>
        </ol>
    </nav>

    <div class="container my-5">

        <!--Section: Content-->
        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <a class='nav-link active' id='lightvsdark-tab' data-toggle='pill' href='#lightvsdark-pill' role='tab' aria-controls='lightvsdark-pill' aria-selected='true'>Light Mode vs Dark Mode</a>
                            <a class='nav-link' id='homepageheader-tab' data-toggle='pill' href='#homepageheader-pill' role='tab' aria-controls='homepageheader-pill' aria-selected='false'>Header 1 vs Header 2</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body tab-content movieCard">
                        <div class='tab-pane active' id='lightvsdark-pill' role='tabpanel' aria-labelledby='lightvsdark-tab'>
                            <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Light Mode vs Dark Mode</h6>
                            <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine whether or not users prefer a light or dark version of the website.</p>
                            <hr class='dark-grey-text'>
                            <canvas id='lightvsdark_graph'></canvas>
                        </div>
                        <div class='tab-pane' id='homepageheader-pill' role='tabpanel' aria-labelledby='homepageheader-tab'>
                            <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Header 1 vs Header 2</h6>
                            <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine what homepage header deal gets more people to press the sign up button based on the deal and colour scheme.</p>
                            <hr class='dark-grey-text'>
                            <canvas id='homepage_header_graph'></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/metrics.js"></script>
</body>
</html>
