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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            // Start session
            session_start();
            $_SESSION['username'] = $username; // Store username in session

            // Redirect to index.html with a welcome message
            header("Location: index.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Invalid username or password.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<script>
        // Function to handle login state and button updates
        function handleLogin(username) {
            const loginButton = document.getElementById('loginButton'); // Get the login button

            // Check if the user is logged in
            if (username) {
                // User is logged in, update the login button to show the username
                loginButton.innerText = username; // Set button text to the username
                loginButton.onclick = null; // Disable click event to prevent further actions
            } else {
                // User is not logged in, show a pop-up
                alert("Please log in to proceed.");
                window.location.href = 'index.php'; // Redirect to the login form
            }
        }

        // Call the handleLogin function to check the login state
        handleLogin("<?php echo $username; ?>"); // Pass the PHP username to JavaScript
    </script>