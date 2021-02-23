<?php
/**
 * Track what page the user is currently on by storing it in the session.
 * @param $page - The current page.
 */
function SetCurrentPage($page)
{
    $_SESSION["currentPage"] = $page;
}

/**
 * Retrieve what page the user is currently on.
 * @return mixed - Return the current page the users on.
 */
function GetCurrentPage()
{
    return $_SESSION["currentPage"];
}
?>