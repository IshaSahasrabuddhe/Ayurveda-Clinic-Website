<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit;
}

include 'db.php';

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $images = $_POST['images'];
    $rating = $_POST['rating'];
    $reviews_count = $_POST['reviews_count'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, short_description, long_description, price, weight, images, rating, reviews_count, stock)
            VALUES ('$name', '$short_description', '$long_description', '$price', '$weight', '$images', '$rating', '$reviews_count', '$stock')";
    $conn->query($sql);
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $images = $_POST['images'];
    $rating = $_POST['rating'];
    $reviews_count = $_POST['reviews_count'];
    $stock = $_POST['stock'];

    $sql = "UPDATE products SET 
            name='$name', short_description='$short_description', long_description='$long_description', price='$price', 
            weight='$weight', images='$images', rating='$rating', reviews_count='$reviews_count', stock='$stock' 
            WHERE id=$id";
    $conn->query($sql);
}

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Products</title>
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        /* Navigation bar styles */
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

    <nav>
        <a href="admin.php">Products</a>
        <a href="adminproducts.php">Order Summary</a>
        <a href="adminappointments.php">Manage Appointments</a>
        <a href="adminlogout.php">Logout</a> <!-- Redirect to login/logout -->
    </nav>

    <h1>Admin Page - Manage Products</h1>

    <h2>Add Product</h2>
    <form action="" method="POST">
        <label for="name">Product Name:</label><br>
        <input type="text" name="name" required><br>
        <label for="short_description">Short Description:</label><br>
        <textarea name="short_description" required></textarea><br>
        <label for="long_description">Long Description:</label><br>
        <textarea name="long_description"></textarea><br>
        <label for="price">Price:</label><br>
        <input type="number" name="price" step="0.01" required><br>
        <label for="weight">Weight:</label><br>
        <input type="text" name="weight"><br>
        <label for="images">Image URL:</label><br>
        <input type="text" name="images"><br>
        <label for="rating">Rating:</label><br>
        <input type="number" name="rating" step="0.1"><br>
        <label for="reviews_count">Reviews Count:</label><br>
        <input type="number" name="reviews_count"><br>
        <label for="stock">Stock:</label><br>
        <input type="number" name="stock"><br><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Products List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Short Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['short_description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
                        <input type="text" name="short_description" value="<?php echo $row['short_description']; ?>" required><br>
                        <input type="text" name="long_description" value="<?php echo $row['long_description']; ?>"><br>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01" required><br>
                        <input type="text" name="weight" value="<?php echo $row['weight']; ?>"><br>
                        <input type="text" name="images" value="<?php echo $row['images']; ?>"><br>
                        <input type="number" name="rating" value="<?php echo $row['rating']; ?>" step="0.1"><br>
                        <input type="number" name="reviews_count" value="<?php echo $row['reviews_count']; ?>"><br>
                        <input type="number" name="stock" value="<?php echo $row['stock']; ?>"><br>
                        <button type="submit" name="edit_product">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
