<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "users"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get booked seats from the request
$data = json_decode(file_get_contents('php://input'), true);
$bookedSeats = $data['seats'];

// Prepare SQL statement to insert booked seats into the database
$stmt = $conn->prepare("INSERT INTO seat (seat_number) VALUES (?)");

// Bind parameters and execute the statement for each booked seat
$stmt->bind_param("s", $seatNumber);
foreach ($bookedSeats as $seatNumber) {
    $stmt->execute();
}

// Close statement and database connection
$stmt->close();
$conn->close();

// Return success status to client
http_response_code(200);
?>
