<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $car_id = $_GET['id'];

        // Delete the car from the database
        $stmt = $conn->prepare("DELETE FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $car_id);
        $stmt->execute();

        // Redirect to view cars page after successful deletion
        header("Location: view_cars.php");
        exit;
    } else {
        echo "No vehicle ID provided.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Close the connection
?>