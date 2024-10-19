<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];
    $order_id = $_POST['order_id']; // Make sure this is passed from the form

    // Initialize variable for image data
    $upi_screenshot = null;

    // Handle the file upload for the UPI screenshot
    if (isset($_FILES['upi_screenshot']) && $_FILES['upi_screenshot']['error'] == UPLOAD_ERR_OK) {
        // Read the image file content
        $imageData = file_get_contents($_FILES['upi_screenshot']['tmp_name']);
        $upi_screenshot = $imageData; // Store the image data
    }

    // Prepare the SQL statement for updating the transaction ID and optional image
    $stmt = $conn->prepare("UPDATE order_summary SET transaction_id = ?, upi_screenshot = ? WHERE order_id = ? AND user_id = ?");
    $stmt->bind_param("bssi", $transaction_id, $upi_screenshot, $order_id, $user_id); // Using "b" for BLOB

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to thank_you.php upon successful transaction
        header("Location: thank_you.php?user_id=" . urlencode($user_id));
        exit; // Ensure no further processing occurs
    } else {
        echo "Error updating transaction ID: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
