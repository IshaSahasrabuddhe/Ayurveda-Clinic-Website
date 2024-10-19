<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit;
}

include 'db.php';

// Mark appointment as completed
if (isset($_POST['mark_completed'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM appointments WHERE id=$id"; // Remove completed appointment
    $conn->query($sql);
}

// Fetch all appointments
$result = $conn->query("SELECT * FROM appointments");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Appointments</title>
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>

    <h1>Admin Page - Manage Appointments</h1>
    <a href="logout.php">Logout</a> <!-- Logout link -->

    <h2>Appointments List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Appointment Date</th>
            <th>Reason</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo date('Y-m-d H:i:s', strtotime($row['appointment_date'])); ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="mark_completed">Mark Completed</button>
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
