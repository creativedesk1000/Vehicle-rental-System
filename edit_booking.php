<?php
session_start();
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

// Fetch the record to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM rental_request WHERE id = $id");
    $row = $result->fetch_assoc();
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['fullName'];
    $phone = $_POST['phone'];
    $address = trim($_POST['address']); // Trim whitespace
    $rental_days = $_POST['rentalDays'];
    $car_name = $_POST['carName'];
    $price_per_day = $_POST['pricePerDay'];
    $agree_policy = isset($_POST['agreePolicy']) ? 1 : 0;

    // Debugging output
    echo "Full Name: $full_name<br>";
    echo "Phone: $phone<br>";
    echo "Address: $address<br>";
    echo "Rental Days: $rental_days<br>";
    echo "Car Name: $car_name<br>";
    echo "Price Per Day: $price_per_day<br>";
    echo "Agree Policy: $agree_policy<br>";

    // Update the record
    $stmt = $conn->prepare("UPDATE rental_request SET full_name=?, phone=?, address=?, rental_days=?, car_name=?, price_per_day=?, agree_policy=? WHERE id=?");
    $stmt->bind_param("ssissiii", $full_name, $phone, $address, $rental_days, $car_name, $price_per_day, $agree_policy, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Rental request updated successfully.";
        header("Location: view_rental_requests.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental Request</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Rental Request</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
        </div>
        <div class="form-group">
            <label for="rentalDays">Rental Days:</label>
            <input type="number" class="form-control" id="rentalDays" name="rentalDays" value="<?php echo htmlspecialchars($row['rental_days']); ?>" required>
        </div>
        <div class="form-group">
            <label for="carName">Car Name:</label>
            <input type="text" class="form-control" id="carName" name="carName" value="<?php echo htmlspecialchars($row['car_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="pricePerDay">Price Per Day:</label>
            <input type="number" class="form-control" id="pricePerDay" name="pricePerDay" value="<?php echo htmlspecialchars($row['price_per_day']); ?>" required>
        </div>
        <div class="form-group">
            <label for="agreePolicy">Agree to Policy:</label>
            <input type="checkbox" id="agreePolicy" name="agreePolicy" <?php echo ($row['agree_policy'] ? 'checked' : ''); ?>>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>