<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is correct
    if ($_POST["username"] === "admin") {
        // Check if password is correct
        if ($_POST["password"] === "password") {
            // Redirect to next page if credentials are correct
            header("Location: adhome.html");
            exit();
        } else {
            // Display error message for invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // Display error message for invalid username
        echo "Invalid username. Please try again.";
    }
}
?>
