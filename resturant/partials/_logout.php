<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["resturantloggedin"]);
unset($_SESSION["resturantname"]);
unset($_SESSION["resturantId"]);

// session_unset();
// session_destroy();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
