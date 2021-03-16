<?php
session_start();

require_once "assets/php/Page Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";

$user = GetUser();

// If the users not logged in or an admin then kick them back to the homepage
if (!LoggedIn() || $user->GetPermission() != "Admin")
    header("Location: index.php");

SetCurrentPage("A/B Metric Dashboard");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "include/header.php"; ?>
</head>

<body>
<?php include "include/navbar.php"; ?>

<!--Start: Page breadcrumb-->
<nav class="first d-md-flex">
    <div class="row breadcrumb indigo lighten-6 first-1 shadow-lg">
        <div class="col-md-8 d-flex justify-content-start">
            <li class="breadcrumb-item font-weight-bold">
                <a class="black-text text-uppercase" href="index.php">home</a>
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="metrics.php">AB
                    Metric Dashboard</a></li>
        </div>
        <div class="col-md-4 d-flex justify-content-end font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </div>
    </div>
</nav>
<!--End: Page breadcrumb-->

<div class="container my-5">
    <div class="row gutters-sm">
        <!--Start: AB Test Sidebar-->
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <a class='nav-link active' id='lightvsdark-tab' data-toggle='pill' href='#lightvsdark-pill'
                           role='tab' aria-controls='lightvsdark-pill' aria-selected='true'>Light Mode vs Dark Mode</a>
                        <a class='nav-link' id='homepageheader-tab' data-toggle='pill' href='#homepageheader-pill'
                           role='tab' aria-controls='homepageheader-pill' aria-selected='false'>Offer 1 vs Offer 2</a>
                    </nav>
                </div>
            </div>
        </div>
        <!--End: AB Test Sidebar-->

        <!--Start: Card to show AB test information-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body tab-content" id="metric-card">
                    <!--Start: AB Test 1 (light vs dark mode)-->
                    <div class='tab-pane active' id='lightvsdark-pill' role='tabpanel'
                         aria-labelledby='lightvsdark-tab'>
                        <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Light Mode vs Dark
                            Mode</h6>
                        <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine whether or not users
                            prefer a light or dark theme on the website.</p>
                        <hr class='dark-grey-text'>
                        <p class="small lead font-weight-bold dark-grey-text">For reference:<br><u>Light Mode (control)</u><br><u>Dark Mode (variation)</u><br></p>
                        <hr class='dark-grey-text'>
                        <canvas id='lightvsdark_graph'></canvas>
                        <hr class='dark-grey-text'>
                    </div>
                    <!--End: AB Test 1-->

                    <!--Start: AB Test 2 (offer 1 vs offer 2)-->
                    <div class='tab-pane' id='homepageheader-pill' role='tabpanel' aria-labelledby='homepageheader-tab'>
                        <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>Offer 1 vs Offer 2</h6>
                        <p class='small lead font-weight-bold dark-grey-text'>A/B test to determine what homepage offer gets more people to press the sign up button based on the deal (% or £) and subsequently sign up.</p>
                        <hr class='dark-grey-text'>
                        <!--Start: References-->
                        <p class="small lead font-weight-bold dark-grey-text">For reference:<br><u>Offer 1 (control)</u><br></p>

                        <!--Offer 1-->
                        <section class='text-center white-text d-md-flex justify-content-between p-5 indigo lighten-2 mb-1'>
                            <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive 10% off your first order!</h3>
                            <button type='button' class='btn btn-outline-white waves-effect btn-sm' disabled>Sign up here</button>
                        </section>
                        <br>

                        <!--Offer 2-->
                        <p class="small lead font-weight-bold dark-grey-text"><br><u>Offer 2 (variation)</u><br></p>
                        <section class='text-center white-text d-md-flex justify-content-between p-5 grey darken-3 mb-1'>
                            <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive £10 off your first order!</h3>
                            <button type='button' class='btn btn-red waves-effect btn-sm' disabled>Sign up here</button>
                        </section>

                        <hr class='dark-grey-text'>
                        <!--End: References-->

                        <!--Start: Graphs-->
                        <canvas id='offer_header_graph'></canvas>
                        <hr class='dark-grey-text'>
                        <canvas id='offer_signup_graph'></canvas>
                        <hr class='dark-grey-text'>
                        <!--End: Graphs-->
                    </div>
                    <!--End: AB Test 2-->
                </div>
            </div>
        </div>
        <!--End: Card to show AB test information-->
    </div>
</div>

<script src="assets/js/metrics.js"></script>
</body>
</html>
