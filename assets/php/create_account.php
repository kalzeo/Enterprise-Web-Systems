<?php
/**
 * Script to add a user to the database.
 */
require "Database Functions.php";

if(isset($_POST["username"], $_POST["password"]) and !empty($_POST["username"]) and !empty($_POST["password"]))
{
    $result = InsertUser($_POST["username"], $_POST["password"]);

    if ($result)
        echo "Successfully Added Account";
    else
        echo "Failed to create your account";
}
else
    echo "Fill in all fields"
?>