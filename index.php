<?php require_once "assets/php/Database Functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="author" content="Kyle McPherson">
    <meta name="description" content="Enterprise Web System Coursework">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href="css/style.css" rel="stylesheet">-->
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
