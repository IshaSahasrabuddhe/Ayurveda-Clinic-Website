<?php
session_start();

// Ensure that the total is available in the session or calculate it here
$total = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Payment Options</h1>
        <h3>Total Amount: $<?php echo number_format($total, 2); ?></h3>

        <!-- Payment Options (MCQs) -->
        <form method="post" action="process_payment.php">
            <h4>Select Payment Method:</h4>
            <div class="form-group">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="upi" name="payment_method" value="UPI" required>
                    <label class="form-check-label" for="upi">UPI (Google Pay, PhonePe)</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="net_banking" name="payment_method" value="Net Banking">
                    <label class="form-check-label" for="net_banking">Net Banking</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="credit_card" name="payment_method" value="Credit Card">
                    <label class="form-check-label" for="credit_card">Credit Card</label>
                </div>
            </div>

            <!-- UPI Payment Links -->
            <div id="upi-options" class="mt-3" style="display:none;">
                <h5>Scan to Pay with UPI:</h5>
                <a href="upi://pay?pa=yourupiaddress@upi&pn=YourName&mc=YourMerchantCode&tid=YourTransactionId&am=<?php echo number_format($total, 2); ?>&item_name=YourItemName&signature=YourSignature" class="btn btn-primary">Google Pay</a>
                <a href="upi://pay?pa=yourupiaddress@upi&pn=YourName&mc=YourMerchantCode&tid=YourTransactionId&am=<?php echo number_format($total, 2); ?>&item_name=YourItemName&signature=YourSignature" class="btn btn-secondary">PhonePe</a>
            </div>

            <!-- Net Banking Payment Form -->
            <div id="net-banking-form" class="mt-3" style="display:none;">
                <h5>Net Banking Details:</h5>
                <div class="mb-3">
                    <label for="bank" class="form-label">Select Your Bank</label>
                    <select class="form-select" id="bank" name="bank" required>
                        <option value="" disabled selected>Select your bank</option>
                        <option value="bank1">Bank 1</option>
                        <option value="bank2">Bank 2</option>
                        <option value="bank3">Bank 3</option>
                        <!-- Add more banks as needed -->
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Pay via Net Banking</button>
            </div>

            <!-- Credit Card Payment Form -->
            <div id="credit-card-form" class="mt-3" style="display:none;">
                <h5>Credit Card Details:</h5>
                <div class="mb-3">
                    <label for="card_number" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                </div>
                <div class="mb-3">
                    <label for="expiry_date" class="form-label">Expiry Date (MM/YY)</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                </div>
                <div class="mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                </div>
                <button type="submit" class="btn btn-success">Pay via Credit Card</button>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
        </form>
    </div>

    <script>
        // Show/hide payment forms based on selected method
        const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
        paymentOptions.forEach(option => {
            option.addEventListener('change', function() {
                document.getElementById('upi-options').style.display = this.value === 'UPI' ? 'block' : 'none';
                document.getElementById('net-banking-form').style.display = this.value === 'Net Banking' ? 'block' : 'none';
                document.getElementById('credit-card-form').style.display = this.value === 'Credit Card' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
