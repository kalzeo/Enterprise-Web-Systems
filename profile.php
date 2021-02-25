<?php
session_start();

require_once "include/header.php";
require_once "assets/php/Page Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";

$user = GetUser();
if(!LoggedIn())
    header("Location: index.php");

SetCurrentPage($user->GetUsername());
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
        <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="index.php"><span>Profile</span></a></li>
        <?php include "include/dark_mode.php"; ?>
    </ol>
</nav>

<script src="assets/js/profile.js"></script>
</body>
</html>
