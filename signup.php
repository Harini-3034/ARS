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
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $passport = $_POST['passport'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    // SQL query to insert data into database
    $sql = "INSERT INTO users (name, dob, email, passport, mobile, gender, password) 
            VALUES ('$name', '$dob', '$email', '$passport', '$mobile', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: loginpage.html");
        //echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
