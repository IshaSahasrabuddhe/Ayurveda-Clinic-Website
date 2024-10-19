<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in to view your orders.'); window.location.href = 'login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch order details for the logged-in user
$stmt = $conn->prepare("
    SELECT os.product_id, p.name AS product_name, os.quantity, os.subtotal, os.gst, os.total, os.transaction_id, os.payment_method
    FROM order_summary os
    LEFT JOIN products p ON os.product_id = p.id
    WHERE os.user_id = ? AND (os.is_confirmed = 1 OR os.payment_method = 'COD')
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any orders
if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Your Orders</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            table {
                width: calc(100% - 200px); /* Adjust for 100px padding on each side */
                border-collapse: collapse;
                margin: 20px auto; /* Center the table */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 100px; /* Add padding around the table */
            }
            th, td {
                padding: 15px;
                text-align: left;
                border: 1px solid #ddd;
                height: 10px; /* Fixed height for table cells */
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            @media (max-width: 600px) {
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                thead tr {
                    display: none;
                }
                tr {
                    margin-bottom: 10px;
                }
                td {
                    text-align: right;
                    padding-left: 50%;
                    position: relative;
                }
                td::before {
                    content: attr(data-label);
                    position: absolute;
                    left: 10px;
                    width: 45%;
                    padding-left: 10px;
                    text-align: left;
                    font-weight: bold;
                }
            }
        </style>
    </head>
    <body>
        <h1>Your Orders</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>GST</th>
                <th>Total</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
            </tr>";

    // Output data of each order
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td data-label='Product Name'>" . htmlspecialchars($row['product_name']) . "</td>
                <td data-label='Quantity'>" . htmlspecialchars($row['quantity']) . "</td>
                <td data-label='Subtotal'>" . number_format($row['subtotal'], 2) . "</td>
                <td data-label='GST'>" . number_format($row['gst'], 2) . "</td>
                <td data-label='Total'>" . number_format($row['total'], 2) . "</td>
                <td data-label='Transaction ID'>" . htmlspecialchars($row['transaction_id']) . "</td>
                <td data-label='Payment Method'>" . htmlspecialchars($row['payment_method']) . "</td>
              </tr>";
    }
    echo "</table>
    </body>
    </html>";
} else {
    echo "<h2>No orders found.</h2>";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
