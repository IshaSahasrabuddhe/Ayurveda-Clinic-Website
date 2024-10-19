<?php
$host = 'localhost';
$db = 'ayurveda_db'; // Your database name
$user = 'root'; // Default XAMPP MySQL username
$pass = ''; // Default XAMPP MySQL password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
