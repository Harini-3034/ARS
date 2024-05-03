<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            background-image: url('bg.avif'); /* Change 'your_background_image.jpg' to the path of your background image */
            background-attachment: fixed;
            background-size: cover; /* Cover the entire viewport */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Make the body take up the full viewport height */
        }
        .forgot-password-container {
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center the content inside the container */
        }
        .forgot-password-container h2 {
            margin-top: 0;
        }
        .password-message {
            margin-top: 20px; /* Add some space between the heading and the password message */
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Your Password has been retrieved</h2>
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
            $mobile = $_POST['mobile'];

            // Perform SQL query to retrieve password
            $sql = "SELECT password FROM users WHERE name = '$name' AND mobile = '$mobile'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // User exists, retrieve the password
                $row = $result->fetch_assoc();
                $password = $row["password"];
                echo "<div class='password-message'>Your password is: " . $password . "</div>"; // Display the password to the user
            } else {
                // No user found with the provided name and mobile number
                echo "<div class='password-message'>No user found with the provided name and mobile number</div>";
            }
        }

        // Closing the database connection
        $conn->close();
        ?>
        <p style="text-align: center;"> <a href="loginpage.html">GO to Login page</a></p>
            
    </div>
</body>
</html>
