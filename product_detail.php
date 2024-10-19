<?php
session_start();
require 'db.php'; // Ensure you include your db connection file

// Get the product ID from the URL
$product_id = $_GET['id'] ?? null;

// Check if a review was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_text'], $_POST['rating'], $_POST['product_id'])) {
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'] ?? null; // Assuming you have user ID in the session

    // Insert review into the database
    if ($user_id) {
        $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, review_text, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $product_id, $user_id, $review_text, $rating);
        $stmt->execute();
    }
}

// Fetch the product details
$stmt = $conn->prepare("SELECT id, name, short_description, long_description, price, weight, stock FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

$product = $result->fetch_assoc();

// Check if the product was found
if ($product === null) {
    echo "Product not found.";
    exit;
}

// Fetch product images
$stmt = $conn->prepare("SELECT image_url FROM product_images WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch reviews for the product
$stmt = $conn->prepare("SELECT r.review_text, r.created_at, u.username, r.rating 
                         FROM reviews r 
                         JOIN users u ON r.user_id = u.id 
                         WHERE r.product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            height: 400px; /* Adjust as necessary */
            object-fit: cover;
        }
        .quantity-display {
            display: none;
            font-size: 1.5rem;
            color: green;
            margin-top: 10px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .quantity-controls button {
            margin: 0 5px;
        }
        .review-rating {
            color: gold; /* Add some color for star ratings */
        }
    </style>
</head>
<body>
    <!-- Navbar Code Here (Unchanged) -->
    <nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px; position: fixed; z-index: 1000; width: 100%;">
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
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>

        <!-- Image Carousel -->
        
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($image['image_url']); ?>" class="d-block w-100" alt="Product Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Product Descriptions -->
        <p class="mt-3"><?php echo htmlspecialchars($product['short_description']); ?></p>
        <p><?php echo htmlspecialchars($product['long_description']); ?></p>
        <p><strong>Price:</strong> ₹ <?php echo htmlspecialchars($product['price']); ?></p>
        <p><strong>Weight:</strong> <?php echo htmlspecialchars($product['weight']); ?></p>
        
        <!-- Add to Cart / Stock Availability -->
        <?php if ($product['stock'] > 0): ?>
            <div id="cartControls" class="d-flex align-items-center mt-3">
                <div class="quantity-controls d-flex align-items-center me-3">
                    <button class="btn btn-secondary" id="decreaseQuantityBtn">-</button>
                    <span id="quantityDisplay" class="mx-2">1</span>
                    <button class="btn btn-secondary" id="increaseQuantityBtn">+</button>
                </div>
                <button class="btn btn-success me-2" id="addToCartBtn">Add to Cart</button>
                <a href= "cart.php"><button class="btn btn-primary">Buy Now</button></a>
            </div>
        <?php else: ?>
            <p class="text-danger">Sold Out</p>
        <?php endif; ?>

        <!-- Reviews Section -->
        <h3>Customer Reviews</h3>
        <div>
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="mb-2">
                        <strong><?php echo htmlspecialchars($review['username']); ?></strong>:
                        <p><?php echo htmlspecialchars($review['review_text']); ?></p>
                        <p class="review-rating">Rating: <?php echo str_repeat('⭐', $review['rating']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>

        <!-- Add a Review -->
        <h3>Add a Review</h3>
        <form action="" method="post"> <!-- Action points to the same page -->
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Name:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>" required readonly>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Review:</label>
                <textarea class="form-control" id="review" name="review_text" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

    <!-- JavaScript for Adding to Cart -->
    <script>
        let quantity = 1;

        document.getElementById('increaseQuantityBtn').addEventListener('click', function() {
            quantity++;
            document.getElementById('quantityDisplay').innerText = quantity;
        });

        document.getElementById('decreaseQuantityBtn').addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantityDisplay').innerText = quantity;
            }
        });

        document.getElementById('addToCartBtn').addEventListener('click', function() {
            // Send an AJAX request to add the item to the cart
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: <?php echo $product_id; ?>,
                    quantity: quantity
                }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
