<?php
/**
 * Script to randomly display one of the two offer headers for the homepage.
 *
 * The offer details are stored in an array that has an ID, offer, header style, and button style and are displayed
 * accordingly depending on what value is randomly outputted.
 */
$random = rand(1, 10);
$offerDetails = [];

// Values <=5 shows the first header, anything >5 shows the second header
if($random <= 5)
    array_push($offerDetails, ["id" => "offer_1", "offer" => "10%", "header_style" => "indigo lighten-2", "button_style" => "btn-outline-white"]);
else
    array_push($offerDetails, ["id" => "offer_2", "offer" => "£10", "header_style" => "grey darken-3", "button_style" => "btn-red"]);

$id = $offerDetails[0]['id'];
$headerStyle = $offerDetails[0]['header_style'];
$buttonStyle = $offerDetails[0]['button_style'];
$offer = $offerDetails[0]['offer'];

// Output the header with the corresponding offer details and styles
echo "<!--Section: Homepage Header -->
      <section class='text-center white-text d-md-flex justify-content-between p-5 {$headerStyle} mb-1'>
          <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive {$offer} off your first order!</h3>
           <a href='signup.php?offer={$id}'><button type='button' id='{$id}' class='btn {$buttonStyle} waves-effect btn-md'>Sign up here</button></a>
      </section>
      <!--Section: Homepage Header-->";
?>