<?php
/**
 * Script to fetch the A/B test metrics from the database.
 *
 * An array is outputted by the server to the client-side so that the information can be included within different
 * graphs.
 *
 * The array is structured like so: array["metric"=>"example", ["id"=>1, "value"=>"example"]]
 */
require "Database Functions.php";

$result = SelectFromTable("heroku_7e12094ae71a8cd.metrics", "*", "1=1");
if(NumRows($result) != 0)
{
    $metrics = [];

    while($row = mysqli_fetch_object($result))
    {
        $row = SanitizeRowObject($row);
        $metric = ["metric" => $row->metric_type, ["id" => $row->metric_id, "value" => $row->metric_value]];
        array_push($metrics, $metric);
    }

    echo json_encode($metrics);
}
?>