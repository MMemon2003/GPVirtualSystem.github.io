<?php
// Database connection parameters
$servername = "MY SQL80";
$username = "Project2024";
$password = "Abdullah3434";
$dbname = "gpvirtualsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from HTML form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to retrieve user data from database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Authentication successful, redirect to next HTML page
    header("Location: next_page.html");
    exit();
} else {
    // Authentication failed, display error message
    echo "Invalid username or password";
}

// Close database connection
$conn->close();
?>
