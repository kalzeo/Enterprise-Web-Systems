<?php
// Script to delete a user from the database.

require "Database Functions.php";

if(isset($_POST["user_id"]) and !empty($_POST["user_id"]))
{
    // Attempt to delete the user then log them out
    DeleteUser($_POST["user_id"]);
    include_once "logout.php";
}
?>