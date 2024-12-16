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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['fullName'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $rental_days = $_POST['rentalDays'];
    $car_name = $_POST['carName'];
    $price_per_day = $_POST['pricePerDay']; // Get the price per day
    $agree_policy = isset($_POST['agreePolicy']) ? 1 : 0; // Checkbox value

    // Handle file upload
    $license_photo = "images/" . basename($_FILES["licensePhoto"]["name"]); // Destination path
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($license_photo, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["licensePhoto"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB for example)
    if ($_FILES["licensePhoto"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["licensePhoto"]["tmp_name"], $license_photo)) {
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO rental_request (full_name, phone, address, rental_days, car_name, license_photo, price_per_day, agree_policy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssissii", $full_name, $phone, $address, $rental_days, $car_name, $license_photo, $price_per_day, $agree_policy);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "New rental request created successfully."; // Set session variable
                header("Location: index.php"); // Redirect to index.php
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close connection
$conn->close();