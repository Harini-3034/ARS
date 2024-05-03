<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "users";

// Establishing connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extracting form data
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Perform SQL query to check if user exists
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            // Password matches, redirect to dashboard or another page
            header("Location: homepage.html"); // Change 'homepage.php' to your actual dashboard page
            exit();
        } else {
            // Invalid password, display error message
            echo "Invalid password";
        }
    } else {
        // Invalid username, display error message
        echo "Invalid username";
    }
}

// Closing the database connection
$conn->close();
?>
