<?php
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
 * @return false|mixed - Returns an unserialized User class if a user is logged in otherwise false.
 */
function GetUser()
{
    return LoggedIn() ? unserialize($_SESSION["user"]) : false;
}
?>