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

// Get form data
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$flight_id = $_POST['flight_id'];
$takeoff_time = $_POST['takeoff_time'];
$price = $_POST['price'];
$seat_class = $_POST['seat_class'];

// SQL query to insert data into the database
$sql = "INSERT INTO flight (origin, destination, flight_id, takeoff_time, price, seat_class)
        VALUES ('$origin', '$destination', '$flight_id', '$takeoff_time', '$price', '$seat_class')";

if ($conn->query($sql) === TRUE) {
  echo "Flight information stored successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
