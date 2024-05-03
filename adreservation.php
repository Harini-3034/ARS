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

// SQL query to retrieve data from reservation table
$reservation_sql = "SELECT * FROM reservation";
$reservation_result = $conn->query($reservation_sql);

// SQL query to retrieve data from seat_selection table
$seat_selection_sql = "SELECT * FROM seat_selection";
$seat_selection_result = $conn->query($seat_selection_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight and Seat Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Flight and Seat Information</h2>
    <h3>Reservation Details</h3>
    <table>
        <tr>
            <th>Origin</th>
            <th>Destination</th>
            <th>Flight ID</th>
            <th>Take-off Time</th>
            <th>Price</th>
            <th>Seat Class</th>
        </tr>
        <?php
        if ($reservation_result->num_rows > 0) {
            while($row = $reservation_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["origin"]."</td>";
                echo "<td>".$row["destination"]."</td>";
                echo "<td>".$row["flight_id"]."</td>";
                echo "<td>".$row["takeoff_time"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td>".$row["seat_class"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No reservation data available</td></tr>";
        }
        ?>
    </table>

    <h3>Seat Selection Details</h3>
    <table>
        <tr>
            <th>Total Seats</th>
            <th>Male</th>
            <th>Female</th>
            <th>Child</th>
        </tr>
        <?php
        if ($seat_selection_result->num_rows > 0) {
            while($row = $seat_selection_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["totalseat"]."</td>";
                echo "<td>".$row["male"]."</td>";
                echo "<td>".$row["female"]."</td>";
                echo "<td>".$row["child"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No seat selection data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
