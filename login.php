<?php
session_start();
include('db.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Bind the result variables
        $stmt->bind_result($user_id, $fetched_username, $hashed_password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user information in the session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $fetched_username; // Store the username in the session

            // Redirect to the dashboard or another page
            header("Location: voila.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username not found.";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    height: 100vh;
    background-image: url(sl7.png);
    background-size: cover;
    background-attachment: fixed;
}

.container {
    background-color: rgba(255, 255, 255, 0);
    border: 1px solid white;
    border-radius: 30px;
    padding: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 430px;
    width: 100%;
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

input[type="text"],
input[type="password"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 100%;
    font-size: 14px;
    background-color: rgba(255, 255, 255, 0.5);
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
                    <h2>Login</h2>
                    <form method="POST" action="login.php">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>

                        <button type="submit">Login</button>
                    </form>
                    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
