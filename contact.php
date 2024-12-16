<?php
// Database configuration
$host = 'localhost'; // or your database host
$dbname = 'cars_detail';
$username = 'root'; // your database username
$password = ''; // your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$complaintId = null;
$messageStatus = '';

// Handle form submission for new complaint
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['edit_id'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO complaints (name, contact, message) VALUES ('$name', '$contact', '$message')";
    if ($conn->query($sql) === TRUE) {
        $complaintId = $conn->insert_id; // Get the ID of the newly created complaint
        $messageStatus = "Your message has been saved successfully!";
    } else {
        $messageStatus = "Error: " . $conn->error;
    }
}

// Handle form submission for editing a complaint
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
    $id = $conn->real_escape_string($_POST['edit_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $message = $conn->real_escape_string($_POST['message']);

    // Update data in the database
    $sql = "UPDATE complaints SET name='$name', contact='$contact', message='$message' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $messageStatus = "Your complaint has been updated successfully!";
    } else {
        $messageStatus = "Error: " . $conn->error;
    }
}

// Handle deletion of a complaint
if (isset($_GET['delete_id'])) {
    $id = $conn->real_escape_string($_GET['delete_id']);
    $sql = "DELETE FROM complaints WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $messageStatus = "Complaint has been deleted successfully!";
    } else {
        $messageStatus = "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Cars Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./images/car10.jpg');
            background-size: cover;
            background-position: center;
            color: #ffffff;
        }

        .container {
            background-color: rgba(21, 23, 23, 0.5);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Contact Us</h1>

        <?php if ($messageStatus): ?>
            <div class='alert alert-success'><?php echo $messageStatus; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                    required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Email or Phone</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Email or Phone Number"
                    required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message here"
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>

        <?php if ($complaintId): ?>
            <div class="mt-4">
                <a href="user_complaints.php?id=<?php echo $complaintId; ?>" class="btn btn-success text-light"
                    target="_blank">View Your Complaint</a>
                <a href="php\All_complaints.php" class="btn btn-success" target="_blank">View All Complaints</a>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <h5>Contact Information</h5>
            <p>Phone: <a href="tel:03485329512" class="text-decoration-none text-white">03485329512</a></p>
            <p>Address: The Mall, Opposite Koishtan Enclave, Wah</p>
            <p>WhatsApp Group: <a href="https://chat.whatsapp.com/your-whatsapp-group-link"
                    class="text-decoration-none text-white">Join our WhatsApp Group</a></p>
        </div>

        <div class="mt-4">
            <h5>Follow Us</h5>
            <a href="https://facebook.com/yourpage" class="text-white me-3">Facebook</a>
            <a href="https://twitter.com/yourprofile" class="text-white me-3">Twitter</a>
            <a href="https://instagram.com/yourprofile" class="text-white">Instagram</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>