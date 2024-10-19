<?php
session_start();
include('db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert new user into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Get the ID of the newly created user
        $user_id = $conn->insert_id;

        // Set session variables for the new user
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Redirect to the appointment page
        header("Location: voila.php");
    } else {
        echo "Error signing up.";
    }

    $stmt->close();
}
?>
