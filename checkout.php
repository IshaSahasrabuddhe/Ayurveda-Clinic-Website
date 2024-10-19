<?php 
session_start();
include 'db.php'; // Include your database connection file

// Initialize variables
$items = [];
$total_amount = isset($_SESSION['order_total']) ? $_SESSION['order_total'] : 0;

// If the cart is empty, redirect to the cart page or show a message
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty. Please add items to the cart.'); window.location.href = 'cart.php';</script>";
    exit;
}

// Prepare the SQL query to fetch product details
$product_ids = implode(',', array_keys($_SESSION['cart']));
$sql = "SELECT id, name, price, stock FROM products WHERE id IN ($product_ids)";
$result = $conn->query($sql);

// Fetch product details and prepare items array
while ($row = $result->fetch_assoc()) {
    $quantity = $_SESSION['cart'][$row['id']];
    
    // Check if there's enough stock
    if ($row['stock'] < $quantity) {
        echo "<script>alert('Sorry, there is not enough stock for " . htmlspecialchars($row['name']) . ".'); window.location.href = 'cart.php';</script>";
        exit;
    }
    
    // Include 'product_id' in the items array
    $items[] = [
        'product_id' => $row['id'],
        'name' => $row['name'],
        'price' => $row['price'],
        'quantity' => $quantity
    ];
}

// Calculate GST and final amount
$gst_rate = 0.18; // 18% GST
$total_amount = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $items));

$gst_amount = $total_amount * $gst_rate;
$final_amount = $total_amount + $gst_amount;

// Store amounts in session for payment processing
$_SESSION['order_total'] = $final_amount;
$_SESSION['items'] = $items;

// Update stock in the database
foreach ($items as $item) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    
    // Prepare SQL query to update stock
    $update_stock_sql = "UPDATE products SET stock = stock - $quantity WHERE id = $product_id";
    
    // Execute the query
    if (!$conn->query($update_stock_sql)) {
        echo "<script>alert('Error updating stock for product: " . htmlspecialchars($item['name']) . "');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px;">
    <a class="navbar-brand" href="#" style="color: rgb(35, 62, 35); font-size: 24px; font-weight: bold;">
        Sahane Ayurvedalaya
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background-color: rgb(163, 205, 183);">
        <span class="navbar-toggler-icon" style="color: white;">=</span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: flex-end;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="voila.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="voila.php#abt" style="color: rgb(7, 32, 7); padding: 14px 20px;">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book_appointment.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Book Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productcard.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="voila.php#con" style="color: rgb(7, 32, 7); padding: 14px 20px;">Contact Us</a>
            </li>

            <!-- Conditional login/signup or profile/logout -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(7, 32, 7); padding: 14px 20px;">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="your_orders.php">Your Orders</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div> 
</nav>

<div class="container mt-5">
    <h1>Checkout</h1>

    <h2>Order Summary</h2>
    <ul class="list-group mb-3">
        <?php foreach ($items as $item): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($item['name']) ?> - 
                <?= htmlspecialchars($item['quantity']) ?> x ₹<?= htmlspecialchars(number_format($item['price'], 2)) ?> 
                = ₹<?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p>Subtotal: ₹<?= number_format($total_amount, 2) ?></p>
    <p>GST (18%): ₹<?= number_format($gst_amount, 2) ?></p>
    <h3>Total Amount: ₹<?= number_format($final_amount, 2) ?></h3>

    <div class="alert alert-warning">
        <strong>Important:</strong> If you place an order using UPI, the order will not be visible in your orders until the admin confirms your UPI transfer. Once the admin confirms the UPI transfer, your order will be placed. For Cash on Delivery, the order will be visible in your orders.
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
        <label class="form-check-label" for="agreeTerms">I have read the above instructions and agree to it.</label>
    </div>

    <form method="post" action="process_payment.php" id="paymentForm">
        <input type="hidden" name="total_amount" value="<?= htmlspecialchars($final_amount) ?>">
        <input type="hidden" name="gst_amount" value="<?= htmlspecialchars($gst_amount) ?>">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
        <input type="hidden" name="items" value='<?= htmlspecialchars(json_encode($items)) ?>'>
        
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select" id="paymentMethodSelect" required disabled>
                <option value="">Select a payment method</option>
                <option value="upi">UPI</option>
                <option value="cod">Cash On Delivery</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" disabled id="submitBtn">Proceed to Payment</button>
    </form>
</div>

<script>
    document.getElementById('agreeTerms').addEventListener('change', function() {
        const paymentMethodSelect = document.getElementById('paymentMethodSelect');
        const submitBtn = document.getElementById('submitBtn');
        paymentMethodSelect.disabled = !this.checked; // Enable/disable payment method select
        submitBtn.disabled = !this.checked; // Enable/disable submit button
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
