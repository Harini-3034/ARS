<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('payment.jpg'); /* Change 'payment.jpg' to the path of your background image */
            background-attachment: fixed;
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background image */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        .container {
            width: 300px;
            margin: 100px auto;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px; /* Add space below the heading */
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc; /* Add a border to the text inputs */
            border-radius: 5px; /* Add some border radius */
        }

        button {
            padding: 14px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px; /* Add border radius to the button */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add smooth transition on hover */
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <div>
            <?php
            // Paste your PHP script here
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "users";

            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch price from reservation table
            $reservation_query = "SELECT price FROM reservation "; // Assuming reservation id is 1
            $reservation_result = $conn->query($reservation_query);

            if ($reservation_result->num_rows > 0) {
                $reservation_row = $reservation_result->fetch_assoc();
                $price = $reservation_row["price"];
            } else {
                echo "No reservation found.";
                $conn->close();
                exit();
            }

            // Fetch total seat from seat selection table
            $seat_query = "SELECT SUM(totalseat) as totalseat FROM seat_selection"; // Assuming seat selection table has a column named total_seat
            $seat_result = $conn->query($seat_query);

            if ($seat_result->num_rows > 0) {
                $seat_row = $seat_result->fetch_assoc();
                $total_seat = $seat_row["totalseat"];
            } else {
                echo "No seat selected.";
                $conn->close();
                exit();
            }

            // Calculate total amount
            $total_amount = $price * $total_seat;

            // Print total amount
            echo "<div>Total amount: $" . $total_amount . "</div>";

            // Close connection
            $conn->close();
            ?>
        </div>
        <div>
            <br>
            <form id="paymentForm">
                <input type="text" name="cardHolderName" placeholder="Card Holder Name" required ><br>
                <input type="text" name="accountNumber" placeholder="Account Number" required ><br>
                <input type="text" name="cardValidity" placeholder="MM/YY" required ><br>
                <input type="text" name="cvv" placeholder="CVV Number" required ><br>
                <!-- Navigation link -->
                <br>
                <button type="button" onclick="validateForm()">Confirm</button>
                <br>
            </form>
        </div>
    </div>
    <script>
    function validateForm() {
        var cardHolderName = document.getElementsByName("cardHolderName")[0].value;
        var accountNumber = document.getElementsByName("accountNumber")[0].value;
        var cardValidity = document.getElementsByName("cardValidity")[0].value;
        var cvv = document.getElementsByName("cvv")[0].value;

        // Regular expressions for validation
        var nameRegex = /^[a-zA-Z\s]+$/;
        var accountNumberRegex = /^\d{12}$/;
        var cvvRegex = /^\d{3}$/;

        if (!nameRegex.test(cardHolderName)) {
            alert("Please enter a valid card holder name.");
            return;
        }

        if (!accountNumberRegex.test(accountNumber)) {
            alert("Please enter a 12-digit account number.");
            return;
        }

        if (!cvvRegex.test(cvv)) {
            alert("Please enter a 3-digit CVV number.");
            return;
        }

        // If all validations pass, submit the form
        document.getElementById("paymentForm").submit();
        // Navigate to the next page
        window.location.href = "ticketinfo.php";
    }
    </script>
</body>
</html>
