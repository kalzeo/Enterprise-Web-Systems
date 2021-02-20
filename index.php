<?php require_once "scripts/db_connection.php"; ?>

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
    $result = $conn->query("select * from heroku_7e12094ae71a8cd.users");
    if($result->num_rows != 0)
    {
        while($row = mysqli_fetch_object($result))
        {
            echo $row->username . "<br>";
        }
    }
    ?>

    <!--<script src="js/script.js"></script>-->
</body>
</html>
