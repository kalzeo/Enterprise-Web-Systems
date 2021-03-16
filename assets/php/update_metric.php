<?php
// Script to handle updating or resetting an AB test metric

require "Database Functions.php";
if(isset($_POST["method"], $_POST["metric_type"]))
{
    $metric = SanitizeString($_POST["metric_type"]);

    switch($_POST["method"])
    {
        case "update": UpdateMetric($metric); break;
        case "reset": ResetMetric($metric); break;
        default: break;
    }
}
?>
