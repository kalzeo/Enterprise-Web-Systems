<?php
$random = rand(1,10);
switch($random)
{
    case $random<=5:
        echo "<!--Section: Content-->
            <section class='text-center white-text d-md-flex justify-content-between p-5 indigo lighten-2 mb-1' id='homepage_header_1'>
                <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive 10% off your first order!</h3>
                <a href='signup.php'><button type='button' class='btn btn-outline-white waves-effect btn-md'>Sign up here</button></a>
            </section>
            <!--Section: Content-->";
        break;
    case $random>5:
        echo "<!--Section: Content-->
            <section class='text-center white-text d-md-flex justify-content-between p-5 grey darken-3 mb-1' id='homepage_header_2'>
                <h3 class='font-weight-bold mb-md-0 mb-4 mt-2 pt-1'>Sign up to receive £10 off your first order!</h3>
                <a href='signup.php'><button type='button' class='btn btn-red waves-effect btn-md'>Sign up here</button></a>
            </section>
            <!--Section: Content-->";
        break;
}
?>