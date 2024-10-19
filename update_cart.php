<?php
session_start();

$productId = $_POST['id'];
$quantity = $_POST['quantity'];

// Update product quantity in the cart session
if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] = $quantity;
}

echo json_encode(['status' => 'success']);
?>
