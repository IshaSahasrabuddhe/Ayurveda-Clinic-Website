<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Product List</h1>

<?php
// Sample product data (replace this with your database query)
$products = [
    [
        "id" => "1",
        "name" => "Product 1",
        "price" => "100"
    ],
    [
        "id" => "2",
        "name" => "Product 2",
        "price" => "150"
    ]
];

foreach ($products as $product) {
    echo "<div>";
    echo "<h2>{$product['name']}</h2>";
    echo "<p>Price: \${$product['price']}</p>";
    echo "<button class='add-to-cart' data-product-id='{$product['id']}'>Add to Cart</button>";
    echo "</div>";
}
?>

<span id="cart-count">0</span>
<div id="cart-message" style="display:none;">Item added to cart!</div>

<script>
$(document).ready(function() {
    $('.add-to-cart').on('click', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'add_to_cart.php',
            data: { product_id: productId },
            success: function(response) {
                $('#cart-count').text(response);
                showCartMessage();
            }
        });
    });

    function showCartMessage() {
        var message = $('#cart-message');
        message.fadeIn().delay(3000).fadeOut();
    }
});
</script>

</body>
</html>
