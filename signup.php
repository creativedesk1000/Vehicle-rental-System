<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'cars_detail'; // Database name
$dbusername = 'root'; // Database username
$dbpassword = ''; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        phone VARCHAR(15) NOT NULL,
        address VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, phone, address, password) VALUES (?,  ?, ?, ?)");
        $stmt->execute([$username, $phone, $address, $password]);

        echo "User registered successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>