<?php
// Assuming your database credentials
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $totalseat = $_POST['totalseat'];
    $male = $_POST['male'];
    $female = $_POST['female'];
    $child = $_POST['child'];

    // Sanitize input data
    $totalseat = mysqli_real_escape_string($conn, $totalseat);
    $male = mysqli_real_escape_string($conn, $male);
    $female = mysqli_real_escape_string($conn, $female);
    $child = mysqli_real_escape_string($conn, $child);

    // SQL query to insert data into the database
    $sql = "INSERT INTO seat_selection (totalseat, male, female, child)
            VALUES ('$totalseat', '$male', '$female', '$child')";

    if ($conn->query($sql) === TRUE) {
        // Close connection
        $conn->close();
        // Redirect to ticket generation page
        header("Location: payment.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
