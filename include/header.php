<?php
    /**
     * Function to echo out a reusable header to different pages of the web system to include different
     * functionalities i.e CSS, JS, etc.
     *
     * The page title is set to whatever page the user is currently on.
     */
    function CreateHeader()
    {
        echo '
            <noscript>Enable JavaScript</noscript>
            <meta charset="UTF-8">
            <title>'.GetCurrentPage().'</title>
            <meta name="author" content="Kyle McPherson">
            <meta name="description" content="Enterprise Web System Coursework">
            <meta name="keywords" content="events,coursework">
            <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">

            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
            
            <!-- Google Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
            
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
            
            <!-- jQuery 3.5.1 & jQuery Migrate 3.3.2 -->
            <script src="assets/vendor/jquery/jquery-3.5.1.min.js" type="text/javascript"></script>
            <!--<script src="assets/vendor/jquery/jquery-migrate-3.3.2.min.js" type="text/javascript"></script>-->

            <!-- MDB 4.19 & Bootstrap 4.5 -->
            <link type="text/css" rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
            <link type="text/css" rel="stylesheet" href="assets/vendor/bootstrap/css/mdb.min.css" />
            <script src="assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="assets/vendor/bootstrap/js/mdb.min.js" type="text/javascript"></script>
            <script src="assets/vendor/bootstrap/js/popper.js" type="text/javascript"></script>
            
            <!-- Default Stylesheet -->
            <link type="text/css" rel="stylesheet" href="assets/css/styles.css" />
            ';
    }
?>