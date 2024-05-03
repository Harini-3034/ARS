<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if flight_id is set in the GET request
if (isset($_GET['flight_id'])) {
    $flight_id = $_GET['flight_id'];

    // Prepare SQL statement to delete reservation
    $sql = "DELETE FROM reservation WHERE flight_id = '$flight_id'";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Ticket for flight " . $flight_id . " has been canceled successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Flight ID not provided.";
}

// Close connection
$conn->close();
?>
