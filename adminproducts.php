<?php
session_start();
include 'db.php'; // Include your database connection file

// Fetch data from order_summary and addresses tables
$sql = "SELECT os.*, 
               GROUP_CONCAT(a.address_line1, ', ', a.city, ', ', a.state, ', ', a.zip, ', ', a.country SEPARATOR ' | ') AS full_address
        FROM order_summary os
        LEFT JOIN addresses a ON os.user_id = a.user_id
        GROUP BY os.order_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for the lightbox */
        .lightbox {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.8); 
            justify-content: center; 
            align-items: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px;">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="adminproducts.php">Products</a></li>
                <!-- Add more navigation items as needed -->
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Order Summary</h1>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>GST</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Payment Status</th>
                    <th>Transaction ID</th>
                    <th>Is Confirmed</th>
                    <th>UPI Screenshot</th>
                    <th>Full Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Decode UPI screenshot
                        $upiScreenshot = !empty($row['upi_screenshot']) ? 'data:image/jpeg;base64,' . base64_encode($row['upi_screenshot']) : null;

                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['product_id']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['subtotal']}</td>
                                <td>{$row['gst']}</td>
                                <td>{$row['total']}</td>
                                <td>{$row['order_date']}</td>
                                <td>{$row['payment_status']}</td>
                                <td>{$row['transaction_id']}</td>
                                <td>
                                    <form method='post' action='update_confirmation.php'>
                                        <input type='hidden' name='order_id' value='{$row['order_id']}'>
                                        <select name='is_confirmed' class='form-select' onchange='this.form.submit()'>
                                            <option value='0' " . ($row['is_confirmed'] == 0 ? "selected" : "") . ">No</option>
                                            <option value='1' " . ($row['is_confirmed'] == 1 ? "selected" : "") . ">Yes</option>
                                        </select>
                                    </form>
                                </td>
                                <td>" . ($upiScreenshot ? "<img src='{$upiScreenshot}' alt='UPI Screenshot' style='width: 100px; height: auto; cursor: pointer;' onclick='openLightbox(\"{$upiScreenshot}\")'>" : "No Screenshot") . "</td>
                                <td>{$row['full_address']}</td>
                                <td>
                                    <a href='edit_order.php?order_id={$row['order_id']}' class='btn btn-warning'>Edit</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='14' class='text-center'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Lightbox for enlarged image -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <img id="lightboxImage" src="" alt="Enlarged Image">
    </div>

    <script>
        // Open lightbox with the selected image
        function openLightbox(imageSrc) {
            document.getElementById('lightboxImage').src = imageSrc;
            document.getElementById('lightbox').style.display = 'flex';
        }

        // Close lightbox
        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
