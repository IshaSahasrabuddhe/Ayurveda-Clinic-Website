<?php
session_start();

// Destroy the session to log the user out
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session

// Redirect to the login page after logout
header("Location: adminlogin.php");
exit;
?>