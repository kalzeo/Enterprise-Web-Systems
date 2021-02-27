<?php
session_start();

require_once "include/header.php";
require_once "assets/php/Page Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";

$user = GetUser();
if(!LoggedIn() || $user->GetPermission() != "Admin")
    header("Location: index.php");

SetCurrentPage("A/B Metric Dashboard");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php CreateHeader(); ?>
</head>

<body>
    <?php include "include/navbar.php"; ?>

    <nav class="first d-md-flex">
        <div class="row breadcrumb indigo lighten-6 first-1 shadow-lg">
            <div class="col-md-8 d-flex justify-content-start">
                <li class="breadcrumb-item font-weight-bold">
                    <a class="black-text text-uppercase" href="index.php">home</a>
                </li>
                <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="metrics.php">AB Metric Dashboard</a></li>
            </div>
            <div class="col-md-4 d-flex justify-content-end font-weight-bold">
                <?php include "include/dark_mode.php"; ?>
            </div>
        </div>
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
                    <div class="card-body tab-content">
                        <div class='tab-pane active' id='lightvsdark-pill' role='tabpanel' aria-labelledby='lightvsdark-tab'>
                            <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Light Mode vs Dark Mode</h6>
                            <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine whether or not users prefer a light or dark theme on the website.</p>
                            <hr class='dark-grey-text'>
                            <canvas id='lightvsdark_graph'></canvas>
                            <p id="overview"></p>
                        </div>
                        <div class='tab-pane' id='homepageheader-pill' role='tabpanel' aria-labelledby='homepageheader-tab'>
                            <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Header 1 vs Header 2</h6>
                            <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine what homepage header offer gets more people to press the sign up button based on the deal (% or £).<br>For reference, Homepage header 1 has the % offer, Homepage header 2 has the £ offer.</p>
                            <hr class='dark-grey-text'>
                            <canvas id='homepage_header_graph'></canvas>
                            <p id="overview"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/metrics.js"></script>
</body>
</html>
