<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];
    $gst_amount = $_POST['gst_amount'];
    $items = json_decode($_POST['items'], true);
    $payment_method = $_POST['payment_method']; // Get the payment method from the form

    // Fetch the user's address
    $address_sql = "SELECT full_address FROM addresses WHERE user_id = ? ORDER BY id DESC LIMIT 1";
    $address_stmt = $conn->prepare($address_sql);
    $address_stmt->bind_param("i", $user_id);
    $address_stmt->execute();
    $address_result = $address_stmt->get_result();

    if ($address_result->num_rows > 0) {
        $address_row = $address_result->fetch_assoc();
        $full_address = $address_row['full_address'];
    } else {
        // Handle the case where no address is found
        echo "<script>alert('No address found. Please add your address.'); window.location.href = 'add_address.php';</script>";
        exit;
    }

    // Prepare the SQL statement for order insertion
    $stmt = $conn->prepare("INSERT INTO order_summary (user_id, product_id, quantity, subtotal, gst, total, payment_method, full_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $subtotal = $item['price'] * $quantity;
        $total = $subtotal + $gst_amount; // Assuming gst_amount applies to all products

        // Bind parameters (add payment method and full address)
        $stmt->bind_param("iiddddsd", $user_id, $product_id, $quantity, $subtotal, $gst_amount, $total, $payment_method, $full_address);

        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
            exit; // Stop further execution on error
        }
    }

    // Get the last inserted order_id
    $order_id = $conn->insert_id; // Store the last order_id

    // Close the statement
    $stmt->close();
    $address_stmt->close(); // Close the address statement

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect based on payment method
    if ($payment_method == 'COD') {
        // Redirect directly to order confirmation page for COD
        header("Location: order_confirmation.php?user_id=" . urlencode($user_id) . "&order_id=" . urlencode($order_id) . "&total_amount=" . urlencode($total_amount));
    } else {
        // For UPI, continue to the process.php page to handle payment
        header("Location: process.php?user_id=" . urlencode($user_id) . "&total_amount=" . urlencode($total_amount) . "&order_id=" . urlencode($order_id));
    }
    exit;
}

// Close the database connection
$conn->close();
?>
