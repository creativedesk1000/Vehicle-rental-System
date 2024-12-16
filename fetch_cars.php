<?php
function fetchCars($servername, $username, $password, $dbname, $page, $limit) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Calculate the offset
        $offset = ($page - 1) * $limit;

        // Fetch cars with LIMIT and OFFSET
        $stmt = $conn->prepare("SELECT * FROM cars LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    } finally {
        $conn = null; // Close the connection
    }
}

// Function to count total cars for pagination
function countCars($servername, $username, $password, $dbname) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM cars");
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0;
    } finally {
        $conn = null; // Close the connection
    }
}
?>