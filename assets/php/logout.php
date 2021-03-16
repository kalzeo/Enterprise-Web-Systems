<?php
// Kill the session and redirect back to the index
session_start();
session_destroy();
header("Location: ../../index.php");
?>