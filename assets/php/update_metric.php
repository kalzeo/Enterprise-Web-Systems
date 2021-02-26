<?php
require "Database Functions.php";
if(isset($_POST["type"]))
{
    $type = SanitizeString($_POST["type"]);
    UpdateMetric($type);
}
?>
