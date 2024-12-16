<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$host = 'localhost'; 
$dbname = 'cars_detail';
$username = 'root'; 
$password = ''; 

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$messageStatus = '';
$complaint = null;

// Fetch complaint details for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM complaints WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $complaint = $result->fetch_assoc();
    } else {
        die("Complaint not found.");
    }
    $stmt->close();
} else {
    die("No complaint ID provided.");
}

// Handle form submission for updating a complaint
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($contact) || empty($message)) {
        $messageStatus = "All fields are required.";
    } elseif (!filter_var($contact, FILTER_VALIDATE_EMAIL) && !preg_match('/^[0-9]{10}$/', $contact)) {
        $messageStatus = "Contact must be a valid email or a 10-digit phone number.";
    } else {
        // Update data in the database
        $stmt = $conn->prepare("UPDATE complaints SET name=?, contact=?, message=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $contact, $message, $id);

        if ($stmt->execute()) {
            // Redirect to contact.php after successful update
            header("Location: contact.php");
            exit();
        } else {
            $messageStatus = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle deletion if delete_id is provided in the query string
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM complaints WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        // Redirect to contact.php after deletion
        header("Location: contact.php");
        exit();
    } else {
        echo "Error deleting complaint: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Complaint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Complaint</h2>

    <?php if ($messageStatus): ?>
        <div class='alert alert-warning'><?php echo $messageStatus; ?></div>
    <?php endif; ?>

    <?php if ($complaint): ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $complaint['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($complaint['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Email or Phone</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($complaint['contact']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required><?php echo htmlspecialchars($complaint['message']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Complaint</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">No complaint data available for editing.</div>
    <?php endif; ?>
    
    <!-- Back button to redirect to contact.php -->
    <a href="contact.php" class="btn btn-secondary mt-3">Back to Contacts</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>