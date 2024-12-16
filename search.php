<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $car_name = trim($_POST['car_name']);
        $category = trim($_POST['category']);
        $location = trim($_POST['location']);

        $sql = "SELECT * FROM cars WHERE availability = 'Available'";

        $conditions = []; // Store conditions and parameters separately
        $parameters = [];

        if (!empty($car_name)) {
            $conditions[] = "car_name LIKE :car_name";
            $parameters[':car_name'] = '%' . $car_name . '%';
        }
        if (!empty($category)) {  // Use independent if statements
            $conditions[] = "category = :category";
            $parameters[':category'] = $category;
        }
        if (!empty($location)) {  // Use independent if statements
            $conditions[] = "location = :location";
            $parameters[':location'] = $location;
        }

        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions); // Combine conditions with AND
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters); // Execute with all parameters at once
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($cars) {
            echo "<h2>Available Cars:</h2>";
            echo '<button onclick="window.location.href=\'index.php\'" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Back to Index</button>';            echo "<div class='car-list'>";
            foreach ($cars as $car) {
                echo "<div class='car-item'>";
                // Check if image_path exists and isn't empty
                if (isset($car['image_path']) && !empty($car['image_path'])) {
                    echo "<img src='" . htmlspecialchars($car['image_path']) . "' alt='" . htmlspecialchars($car['car_name']) . "' class='car-image'>";
                } else {
                    echo "<p>No Image Available</p>"; // Placeholder if no image
                }
                echo "<h3>" . htmlspecialchars($car['car_name']) . "</h3>";

                // Check if daily_price exists before displaying
                if (isset($car['daily_price'])) {
                    echo "<p>Daily Price: $" . htmlspecialchars($car['daily_price']) . "</p>";
                }
                
                echo "<p>Location: " . htmlspecialchars($car['location']) . "</p>";
                echo "<p>Category: " . htmlspecialchars($car['category']) . "</p>";
                echo "<p>Availability: " . htmlspecialchars($car['availability']) . "</p>";
                echo "<a href='booking.php?car_id=" . htmlspecialchars($car['id']) . "' class='book-button'>Book</a>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<h2>No available cars found.</h2>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<style>
    .car-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-around;
    }
    .car-item {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 250px;
        text-align: center;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }
    .car-image {
        width: 100%; /* Responsive image */
        height: auto; /* Maintain aspect ratio */
        border-radius: 5px;
    }
    h3 {
        margin: 10px 0;
    }
    .book-button {
        background-color: #007bff; /* Primary color */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }
    .book-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }
</style>