<?php
session_start();
include('db.php'); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            background-image: url('sl8.png');
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1); /* Transparent white background */
            border: 1px solid white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 430px;
            width: 100%;
            color: white; /* Change text color to white */
        }

        h2 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 5px;
            color: white;
        }

        input[type="text"], input[type="datetime-local"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.7);
            color: #333;
        }

        button {
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        p {
            text-align: center;
            color: white;
        }

        a {
            color: #5cb85c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-6 d-none d-lg-block"></div> <!-- Empty space on the left (6 out of 12 columns) -->
            <div class="col-lg-6 col-md-8 col-sm-10 col-12 mx-auto my-auto">
                <div class="container">
                    <h2>Book Appointment</h2>
                    <form method="POST" action="appointment_handler.php">
                        <!-- Show logged-in user's name -->
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

                        <label for="appointment_date">Appointment Date and Time</label>
                        <input type="datetime-local" id="appointment_date" name="appointment_date" required>

                        <label for="reason">Reason</label>
                        <input type="text" id="reason" name="reason" required>

                        <button type="submit">Book Appointment</button>
                    </form>
                    <p><a href="logout.php">Logout</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
