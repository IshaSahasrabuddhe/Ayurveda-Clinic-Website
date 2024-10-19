<?php
session_start();
include('db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hash_password);
    $stmt->fetch();

    if (password_verify($password, $hash_password)) {
        // Set session variables on successful login
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Redirect to the appointment page
        header("Location: voila.php");
    } else {
        echo "Invalid login credentials.";
    }

    $stmt->close();
}
?>
