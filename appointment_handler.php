<?php
session_start();
include('db.php'); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $user_id = $_SESSION['user_id']; // Logged-in user's ID
    $appointment_date = $_POST['appointment_date'];
    $reason = $_POST['reason'];

    // Prepare SQL statement to insert appointment
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, appointment_date, reason) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $appointment_date, $reason);

    // Execute the query
    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
        // Optionally, you can redirect the user to a different page
        // header("Location: confirmation_page.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="voila.php" class="btn btn-secondary btn-block">Go to Home</a>  
</body>
</html>


