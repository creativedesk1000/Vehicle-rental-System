<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all cars from the database
    $stmt = $conn->prepare("SELECT * FROM cars");
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($cars) {
        echo "<h2>All Cars:</h2>";
        echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .edit-btn {
                    background-color: #007bff;
                    color: white;
                    padding: 5px 10px;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .edit-btn:hover {
                    background-color: #0056b3;
                }
                .delete-btn {
                    background-color: #dc3545;
                    color: white;
                    padding: 5px 10px;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .delete-btn:hover {
                    background-color: #c82333;
                }
              </style>";
        
        echo "<table>";
        echo "<tr>
                <th>Image</th>
                <th>Car Name</th>
                <th>Price</th>
                <th>Location</th>
                <th>Category</th>
                <th>Availability</th>
                <th>Actions</th>
              </tr>";

        foreach ($cars as $car) {
            echo "<tr>";
            echo "<td><img src='" . htmlspecialchars($car['image_path']) . "' alt='" . htmlspecialchars($car['car_name']) . "' style='width:100px;'></td>";
            echo "<td>" . htmlspecialchars($car['car_name']) . "</td>";
            echo "<td>$" . htmlspecialchars($car['price']) . "</td>";
            echo "<td>" . htmlspecialchars($car['location']) . "</td>";
            echo "<td>" . htmlspecialchars($car['category']) . "</td>";
            echo "<td>" . htmlspecialchars($car['availability']) . "</td>";
            echo "<td>
                    <a href='edit_vehicle.php?id=" . htmlspecialchars($car['id']) . "' class='edit-btn'>Edit</a> | 
                    <a href='delete_vehicle.php?id=" . htmlspecialchars($car['id']) . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this vehicle?\");'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>No cars found.</h2>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>