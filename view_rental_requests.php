<?php
session_start(); // Start the session
$servername = "localhost";  // Change if your server is different
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "cars_detail";    // The name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM rental_request WHERE id = $delete_id");
    $_SESSION['success_message'] = "Rental request deleted successfully.";
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit();
}

// Fetch data from the rental_request table
$sql = "SELECT * FROM rental_request";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <h2>Rental Requests</h2>
    <button class="btn btn-primary" onclick="printPage()">Print</button>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
        unset($_SESSION['success_message']);
    }
    ?>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Rental Days</th>
                <th>Car Name</th>
                <th>Price Per Day</th>
                <th>License Photo</th>
                <th>Agreement</th>
                <th>Actions</th> <!-- New Actions Column -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["full_name"]) . "</td>
                        <td>" . htmlspecialchars($row["phone"]) . "</td>
                        <td>" . htmlspecialchars($row["address"]) . "</td>
                        <td>" . htmlspecialchars($row["rental_days"]) . "</td>
                        <td>" . htmlspecialchars($row["car_name"]) . "</td>
                        <td>$" . number_format($row["price_per_day"], 2) . "</td>
                        <td><img src='" . htmlspecialchars($row["license_photo"]) . "' alt='License Photo' width='100'></td>
                        <td>" . ($row["agree_policy"] ? "Yes" : "No") . "</td>
                        <td>
                            <a href='edit_booking.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='" . $_SERVER['PHP_SELF'] . "?delete_id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this request?\");'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No rental requests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>