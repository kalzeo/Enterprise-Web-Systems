<?php
    require_once "Database Functions.php";
    require_once "Page Functions.php";

    //require_once "User.php";
    $conn = DatabaseConnection();

    /**
     * Check if a user is logged in on the current session.
     * @return bool - True if logged in else False.
     */
    function LoggedIn()
    {
        return isset($_SESSION["user"]);
    }

    /**
     * Gets the user class thats stored in the session.
     * @return mixed - Returns an unserialized User class.
     */
    function GetUser()
    {
        return unserialize($_SESSION["user"]);
    }
?>