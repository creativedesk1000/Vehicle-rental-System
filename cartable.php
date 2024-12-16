<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL statement to create the cars table
    $sql = "CREATE TABLE IF NOT EXISTS cars (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        image_path VARCHAR(255),
        car_name VARCHAR(255),
        price DECIMAL(10, 2),
        price_per_day DECIMAL(10, 2),
        rental_period INT,           -- Rental period in days
        count_of_cars INT,          -- Number of units available
        colors VARCHAR(255),        -- Available colors (can be a comma-separated list)
        mileage_per_km DECIMAL(10, 2), -- Mileage per km
        availability VARCHAR(20)
    )";

    // Execute the SQL statement
    $conn->exec($sql);
    echo "Table 'cars' created successfully (or already exists).";
} catch(PDOException $e) {
    // Handle any errors
    echo "Error creating table: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>