<?php
session_start();
require 'db.php'; // Ensure this file connects to your database

// Get the product ID and review data
$product_id = $_POST['product_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null; // Assuming you have user ID stored in session
$review_text = $_POST['review_text'] ?? null;
$rating = $_POST['rating'] ?? 0;

// Check if product ID is valid
if ($product_id && $user_id && $review_text) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, review_text, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $product_id, $user_id, $review_text, $rating);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the product detail page
        header("Location: product_detail.php?id=" . urlencode($product_id));
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

$conn->close();
?>
