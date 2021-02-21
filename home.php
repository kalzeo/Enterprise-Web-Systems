<?php require "assets/php/Database Functions.php"; ?>

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
