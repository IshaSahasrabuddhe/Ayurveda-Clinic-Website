<?php
session_start();
include 'db.php'; // Include your database connection file

// Retrieve data from URL parameters
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : '';
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

// Fetch payment method from the database (assuming order_summary table has a payment_method column)
$stmt = $conn->prepare("SELECT payment_method FROM order_summary WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->bind_result($payment_method);
$stmt->fetch();
$stmt->close();

// Only proceed if the payment method is UPI
if ($payment_method != 'UPI') {
    // Redirect to an error page or order confirmation for COD
    header("Location: order_confirmation.php?user_id=" . urlencode($user_id) . "&order_id=" . urlencode($order_id) . "&total_amount=" . urlencode($total_amount));
    exit;
}

// Generate QR code (you can use a library like PHP QR Code for this)
// Example: $qr_code_url = generateQRCode($total_amount); // Define your QR code generation logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px; ">
        <!-- Navbar code remains unchanged -->
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
        <h1>Payment Processing (UPI)</h1>

        <div class="mb-4">
            <h3>Total Amount: ₹<?= htmlspecialchars($total_amount) ?></h3>
            <img src="<?= $qr_code_url ?>" alt="QR Code" class="img-fluid">
        </div>

        <form method="post" action="finalize_payment.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="transaction_id" class="form-label">Transaction ID</label>
                <input type="text" name="transaction_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="upi_screenshot" class="form-label">UPI Transfer Screenshot (Optional)</label>
                <input type="file" name="upi_screenshot" class="form-control" accept="image/*">
            </div>

            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
            <input type="hidden" name="total_amount" value="<?= htmlspecialchars($total_amount) ?>">
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order_id) ?>"> <!-- Add order_id here -->

            <button type="submit" class="btn btn-primary">Submit Transaction ID</button>
        </form>
    </div>

<!-- Include Bootstrap JS and its dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>




