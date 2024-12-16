<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the car details for the given ID
    if (isset($_GET['id'])) {
        $car_id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $car_id);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            echo "Car not found!";
            exit;
        }
    }

    // Handle form submission for editing the vehicle
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $car_name = $_POST['car_name'];
        $price = $_POST['price'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $availability = $_POST['availability'];
        $image_path = $car['image_path']; // Keep existing image path

        // Handle image upload if a new image is provided
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'images/';
            $image_path = $upload_dir . basename($_FILES['image_path']['name']);
            move_uploaded_file($_FILES['image_path']['tmp_name'], $image_path);
        }

        // Update the car details in the database
        $stmt = $conn->prepare("UPDATE cars SET car_name = ?, price = ?, location = ?, category = ?, availability = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$car_name, $price, $location, $category, $availability, $image_path, $car_id]);

        // Redirect to view cars page after successful update
        header("Location: view_cars.php");
        exit;
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        select,
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .category-select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .current-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Edit Vehicle</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="car_name">Car Name:</label>
        <input type="text" id="car_name" name="car_name" value="<?php echo htmlspecialchars($car['car_name']); ?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($car['price']); ?>" step="0.01" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($car['location']); ?>" required>

        <label for="category">Category:</label>
        <select id="category" name="category" class="category-select" required>
            <option value="SUV" <?php if ($car['category'] == 'SUV') echo 'selected'; ?>>SUV</option>
            <option value="Sedan" <?php if ($car['category'] == 'Sedan') echo 'selected'; ?>>Sedan</option>
            <option value="Convertible" <?php if ($car['category'] == 'Convertible') echo 'selected'; ?>>Convertible</option>
            <option value="Hatchback" <?php if ($car['category'] == 'Hatchback') echo 'selected'; ?>>Hatchback</option>
            <option value="Coupe" <?php if ($car['category'] == 'Coupe') echo 'selected'; ?>>Coupe</option>
            <!-- Add more categories as needed -->
        </select>

        <label for="availability">Availability:</label>
        <input type="text" id="availability" name="availability" value="<?php echo htmlspecialchars($car['availability']); ?>" required>

        <label for="image_path">Current Image:</label>
        <?php if (!empty($car['image_path'])): ?>
            <img src="<?php echo htmlspecialchars($car['image_path']); ?>" alt="Current Image" class="current-image">
        <?php else: ?>
            <p>No image available.</p>
        <?php endif; ?>

        <label for="image_path">Upload New Image (optional):</label>
        <input type="file" id="image_path" name="image_path" accept="image/*">

        <input type="submit" value="Update Vehicle">
    </form>
</div>

</body>
</html>