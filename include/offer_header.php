<?php
$random = rand(1, 10);
$offerDetails = [];

// Switch the random value, values <=5 show the first header, anything >5 shows the second header
switch ($random)
{
    case $random <= 5:
        array_push($offerDetails, ["id" => "homepage_header_1", "offer" => "10%", "header_style" => "indigo lighten-2", "button_style" => "btn-outline-white"]);
        break;
    case $random > 5:
        array_push($offerDetails, ["id" => "homepage_header_2", "offer" => "£10", "header_style" => "grey darken-3", "button_style" => "btn-red"]);
        break;
}

// Output the header with the corresponding offer details and styles
echo "<!--Section: Homepage Header -->
      <section class='text-center white-text d-md-flex justify-content-between p-5 {$offerDetails[0]['header_style']} mb-1'>
          <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive {$offerDetails[0]['offer']} off your first order!</h3>
           <a href='signup.php'><button type='button' id='{$offerDetails[0]['id']}' class='btn {$offerDetails[0]['button_style']} waves-effect btn-md'>Sign up here</button></a>
      </section>
      <!--Section: Homepage Header-->";
?>