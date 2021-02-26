<?php
session_start();

require_once "include/header.php";
require_once "assets/php/Page Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";

if(!LoggedIn()) header("Location: index.php");
$user = GetUser();

if(isset($_GET["username"]) and $_GET["username"] != $user->GetUsername())
    $user = new User($_GET["username"]);

$username = $user->GetUsername();
SetCurrentPage($username);
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
            <li class="breadcrumb-item font-weight-bold">
                <a class="black-text text-uppercase" href="profile.php">profile</a>
            </li>
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="profile.php?username=<?php echo $username; ?>"><?php echo $username; ?></a></li>
        </div>
        <div class="col-md-4 d-flex justify-content-end font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </div>
    </div>
</nav>

<script src="assets/js/profile.js"></script>
</body>
</html>
