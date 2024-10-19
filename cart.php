<?php
session_start();
include 'db.php'; // Include the database connection file

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Initialize total
$total = 0;

// Handle quantity update and remove item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_quantity') {
        // Loop through all quantities submitted
        foreach ($_POST['quantity'] as $id => $quantity) {
            $quantity = (int)$quantity;
            if ($quantity > 0) {
                $_SESSION['cart'][$id] = $quantity; // Update quantity if valid
            } else {
                unset($_SESSION['cart'][$id]); // Remove item if quantity is 0
            }
        }

        // Save updated cart to database
        saveCartToDatabase($conn, $_SESSION['cart']);
    } elseif ($_POST['action'] === 'remove' && isset($_POST['id'])) {
        $item_id = $_POST['id'];
        unset($_SESSION['cart'][$item_id]); // Remove item

        // Save updated cart to database
        saveCartToDatabase($conn, $_SESSION['cart']);
    }
}

// Function to save the cart to the database
function saveCartToDatabase($conn, $cart) {
    // Assuming you have a user_id (you might want to get it from the session or authentication)
    $user_id = 1; // Example user ID, replace with actual user ID

    // Clear previous cart entries for the user
    $conn->query("DELETE FROM cart WHERE user_id = $user_id");

    // Insert each item in the cart into the database
    foreach ($cart as $product_id => $quantity) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .quantity-col {
        width: 10%; /* Adjust the width as needed */
    }
    .quantity-input {
        width: 60px; /* Reduce the width of the input box */
        text-align: center; /* Align text in the center */
    }
</style>

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
        <h1>Your Cart</h1>
        <form method="post" id="cartForm">
        <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th class="quantity-col">Quantity</th> <!-- Apply the class here -->
            <th>Price</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($_SESSION['cart'] as $item_id => $quantity): 
            // Fetch product details from the database
            $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
            $stmt->bind_param("i", $item_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product):
                $price = (float)$product['price'];
                $total_price = $price * $quantity;
                $total += $total_price;
        ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td class="quantity-col">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQuantity('<?php echo htmlspecialchars($item_id); ?>', -1)">-</button>
                        <input type="number" name="quantity[<?php echo htmlspecialchars($item_id); ?>]" value="<?php echo htmlspecialchars($quantity); ?>" min="0" class="form-control quantity-input mx-2" required>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQuantity('<?php echo htmlspecialchars($item_id); ?>', 1)">+</button>
                    </div>
                </td>
                <td>₹<?php echo htmlspecialchars(number_format($price, 2)); ?></td>
                <td>₹<?php echo htmlspecialchars(number_format($total_price, 2)); ?></td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeFromCart('<?php echo htmlspecialchars($item_id); ?>')">Remove</button>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="5">Product not found.</td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

            <button type="submit" name="action" value="update_quantity" class="btn btn-primary">Update Quantities</button>
        </form>
        <h3>Total: ₹<?php echo htmlspecialchars(number_format($total, 2)); ?></h3>

        <!-- Save order total in session before checkout -->
        <?php $_SESSION['order_total'] = $total; ?>

        <!-- Buy Now and Continue Shopping Buttons -->
        <div class="mt-3">
            <a href="address.php" class="btn btn-success">Buy Now</a>
            <a href="productcard.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </div>

    <script>
        function updateQuantity(productId, change) {
            const quantityInput = document.querySelector(`input[name="quantity[${productId}]"]`);
            let currentQuantity = parseInt(quantityInput.value) || 0;
            currentQuantity += change;
            if (currentQuantity < 0) currentQuantity = 0; // Prevent negative quantity
            quantityInput.value = currentQuantity; // Update input value
        }

        function removeFromCart(productId) {
            // Remove the item from the cart using AJAX
            const formData = new FormData();
            formData.append('action', 'remove');
            formData.append('id', productId);

            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Reload the cart to reflect changes
                } else {
                    console.error('Failed to remove item');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
