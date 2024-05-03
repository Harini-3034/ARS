<?php
// Establishing connection to the database
$conn = new mysqli('localhost','root','','users');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

// Inserting data into the database
$sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

if ($conn->query($sql) === TRUE) {
    echo "Feedback submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo '<a href="homepage.html">Back</a>';
// Closing the database connection
$conn->close();
?>
