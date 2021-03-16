<?php
// Script to add a user to the database.

require "Database Functions.php";

if(isset($_POST["username"], $_POST["password"]) and !empty($_POST["username"]) and !empty($_POST["password"]))
{
    // Try insert the user
    $result = InsertUser($_POST["username"], $_POST["password"]);

    // Update the metric value for if the user signed up from offer 1 or 2, assuming offer is set.
    if(isset($_POST["offer"]) and !empty($_POST["offer"]))
    {
        $offerType = substr(SanitizeString($_POST["offer"]), -1);
        $metric = "Offer {$offerType} Signups";
        UpdateMetric($metric);
    }

    // Output the result of trying to insert the user
    if ($result)
        echo "Successfully Added Account";
    else
        echo "Failed to create your account";
}
else
    echo "Fill in all fields"
?>