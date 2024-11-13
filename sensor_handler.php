<?php
// Database configuration
$servername = "localhost";
$username = "Project2024";
$password = "Abdullah3434";
$database = "patient";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request from hardware sensors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve sensor data from POST parameters
    $temperature = $_POST["temperature"];
    $heart_rate = $_POST["heart_rate"];
    // Add more sensor data as needed

    // Prepare and execute SQL statement to insert sensor data into database
    $sql = "INSERT INTO sensor_data (temperature, heart_rate) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dd", $temperature, $heart_rate); // Assuming temperature and heart rate are double values
    $stmt->execute();
    $stmt->close();
}

// Handle GET request to fetch sensor data
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve sensor data from database
    $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 1"; // Assuming 'timestamp' column indicates the time of sensor readings
    $result = $conn->query($sql);

    // Check if there is any data
    if ($result->num_rows > 0) {
        // Output data as JSON
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "No data available";
    }
}

// Close database connection
$conn->close();
?>
