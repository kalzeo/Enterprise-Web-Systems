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

        $result = SelectFromTable("heroku_7e12094ae71a8cd.users", "*", "id = 1");
        if(NumRows($result) != 0)
        {
            while($row = mysqli_fetch_object($result))
            {
                $row = SanitizeRowObject($row);
                echo $row->username . "<br>";
            }
        }
        ?>

        <script src="assets/js/index.js"></script>
    </body>
</html>
