<?php
session_start();

require_once "include/header.php";
require_once "assets/php/Database Functions.php";
require_once "assets/php/Page Functions.php";

/*
 * if (LoggedIn()) {
    header('Location: index.php');
}
 */
SetCurrentPage("Home");
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php CreateHeader(); ?>
    </head>

    <body>
        <?php
        $result = SelectFromTable("heroku_7e12094ae71a8cd.users", "*");
        if(NumRows($result) != 0)
        {
            while($row = mysqli_fetch_object($result))
            {
                $row = SanitizeRowObject($row);
                echo $row->username . "<br>";
            }
        }
        ?>

        <!--<script src="js/script.js"></script>-->
    </body>
</html>
