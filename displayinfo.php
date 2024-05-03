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

// Retrieve user input
$origin = $_GET['origin'];
$destination = $_GET['destination'];
$seat_class = $_GET['seat_class'];

// SQL query to retrieve flights based on user input
$sql = "SELECT * FROM flight WHERE origin='$origin' AND destination='$destination' AND seat_class='$seat_class' ";
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
  // Display flight information
  echo '<div class="flight-container">';
  while($row = $result->fetch_assoc()) {
    echo "Origin: " . $row["origin"]. "<br>";
    echo "Destination: " . $row["destination"]. "<br>";
    echo "Flight ID: " . $row["flight_id"]. "<br>";
    echo "Take-off Time: " . $row["takeoff_time"]. "<br>";
    echo "Price: $" . $row["price"]. "<br>";
    echo "Seat Class: " . $row["seat_class"]. "<br>";

    // Store retrieved data in a new database table
    $flightId = $row["flight_id"];
    $takeoffTime = $row["takeoff_time"];
    $price = $row["price"];

    // Insert data into the new table (replace 'reservation' with your table name)
    $insertSql = "INSERT INTO reservation (origin, destination, flight_id, takeoff_time, price, seat_class) VALUES ('$origin', '$destination', '$flightId', '$takeoffTime', '$price', '$seat_class')";
    if ($conn->query($insertSql) === TRUE) {
      echo "<br>";
    } else {
      echo "Error storing flight information: " . $conn->error . "<br>";
    }

    // Display the "Select Seats" button
    echo '<a href="seat_selection.html" class="btn">Select Seats</a>'. "<br><br><br>"; 
  }
  echo '</div>';
} else {
  echo "No flights found for the selected origin and destination";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flight Information</title>
  <style>
    .flight-container {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      align-items: center;
    }

    .btn {
      display: inline-block;
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
</body>
</html>
