<?php
session_start();
session_destroy(); // End session
header("Location: voila.php"); // Redirect to login page
exit();
?>
