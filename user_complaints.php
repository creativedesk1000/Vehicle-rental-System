<?php
$host = 'localhost'; 
$dbname = 'cars_detail';
$username = 'root'; 
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM complaints WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Complaint deleted successfully.'); window.location.href='All_complaints.php';</script>";
    } else {
        echo "<script>alert('Error deleting complaint: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Complaint Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($complaint['id']); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($complaint['name']); ?></td>
        </tr>
        <tr>
            <th>Contact</th>
            <td><?php echo htmlspecialchars($complaint['contact']); ?></td>
        </tr>
        <tr>
            <th>Message</th>
            <td><?php echo nl2br(htmlspecialchars($complaint['message'])); ?></td>
        </tr>
        <tr>
            <th>Date Submitted</th>
            <td><?php echo htmlspecialchars($complaint['created_at']); ?></td>
        </tr>
    </table>
    
    <a href="Edit_user_complain.php?id=<?php echo $complaint['id']; ?>" class="btn btn-warning">Edit Complaint</a>
    
    <form method="post" style="display:inline;">
        <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete Complaint</button>
    </form>

    <a href="contact.php" class="btn btn-primary">Back to Complaints</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>