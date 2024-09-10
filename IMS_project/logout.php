<?php
session_start(); // Start or resume the session

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: index.php");
exit(); // Stop further execution
?>
