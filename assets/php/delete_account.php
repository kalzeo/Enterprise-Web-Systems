<?php
/**
 * Script to delete a user from the database.
 */
require "Database Functions.php";

if(isset($_POST["user_id"]) and !empty($_POST["user_id"]))
{
    DeleteUser($_POST["user_id"]);
    include_once "logout.php";
}
?>