<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the connection is established
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Assuming user ID is stored in session after login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$query = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Initialize address variables
$address_line1 = '';
$address_line2 = '';
$city = '';
$state = '';
$zip = '';
$country = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and store address details
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];

    // Store the address in the database
    $insert_query = "INSERT INTO addresses (user_id, address_line1, address_line2, city, state, zip, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("issssss", $user_id, $address_line1, $address_line2, $city, $state, $zip, $country);
    
    if ($insert_stmt->execute()) {
        // Redirect to payment page if insertion is successful
        header('Location: checkout.php');
        exit();
    } else {
        echo "Error: " . $insert_stmt->error;
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
              <?php echo htmlspecialchars($user['username']); ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="your_orders.php">Your Orders</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </ul>
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
    <h5>Confirm your details:</h5>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="address_line1" class="form-label">Address Line 1</label>
            <input type="text" class="form-control" id="address_line1" name="address_line1" required>
        </div>
        <div class="mb-3">
            <label for="address_line2" class="form-label">Address Line 2</label>
            <input type="text" class="form-control" id="address_line2" name="address_line2">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" name="state" required>
        </div>
        <div class="mb-3">
            <label for="zip" class="form-label">Zip Code</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <button type="submit" class="btn btn-primary">Confirm Address</button>
    </form>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
