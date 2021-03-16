<?php
session_start();

require_once "assets/php/Page Functions.php";
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";

if (!LoggedIn()) header("Location: index.php");

$ownAccount = True;

$user = GetUser();
if (isset($_GET["username"]) and $_GET["username"] != $user->GetUsername()) {
    $user = new User($_GET["username"]);
    $ownAccount = False;
}

$username = $user->GetUsername();
$userID = $user->GetID();

SetCurrentPage($username);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "include/header.php"; ?>
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
            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase"
                                                            href="profile.php?username=<?php echo $username; ?>"><?php echo $username; ?></a>
            </li>
        </div>
        <div class="col-md-4 d-flex justify-content-end font-weight-bold">
            <?php include "include/dark_mode.php"; ?>
        </div>
    </div>
</nav>


<div class="container my-5">
    <!--Section: Name Header -->
    <section class="px-md-5 mx-md-5 py-5 text-center white-text elegant-color z-depth-1 rounded">
        <h3>Profile of <?php echo "{$username}"; ?></h3>
        <?php if ($ownAccount): ?>
            <script>var userID = <?= $userID ?></script>
            <button class="btn btn-red btn-md" data-toggle="modal" data-target="#exampleCentralModal1">Delete Account
            </button>
        <?php endif; ?>
    </section>
    <!--Section: Name Header -->
</div>

<div class="modal fade" id="exampleCentralModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content text-center">
            <div class="modal-header bg-danger text-white d-flex justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to delete your account?<br><br>There is no going back.</h6>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="delete_account_button">Yes</button>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/profile.js"></script>
</body>
</html>
