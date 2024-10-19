<?php
session_start();
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if product ID and quantity are provided
    if (isset($data['product_id']) && isset($data['quantity'])) {
        $product_id = $data['product_id'];
        $quantity = $data['quantity'];

        // Initialize cart if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity; // Increase quantity
        } else {
            $_SESSION['cart'][$product_id] = $quantity; // Add new product
        }

        // Return success message
        echo json_encode(['message' => 'Product added to cart successfully!']);
    } else {
        // Return error message if data is incomplete
        echo json_encode(['message' => 'Invalid data provided.']);
    }
} else {
    // Return error message for invalid request method
    echo json_encode(['message' => 'Invalid request method.']);
}
?>
