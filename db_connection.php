<?php
    $url = parse_url(getenv("DB_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $db);
    echo $conn ? "connected" : "not connected";
?>