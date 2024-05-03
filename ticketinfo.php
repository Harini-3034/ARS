<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Information</title>
    <style>
        /* CSS for ticket container */
        body {
            background-image: url('ticketinfo.avif');
            background-attachment: fixed;
            background-size: 100% 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .ticket-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* CSS for ticket details */
        .ticket-details {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .ticket-details strong {
            font-weight: bold;
        }
        .ticket-details hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #ccc;
        }
        .cancel-ticket-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .cancel-ticket-btn:hover {
            background-color: #c82333;
        }
        .navigate-home {
            text-align: center;
            margin-top: 20px;
        }
        .navigate-home a {
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <?php
        // Paste your PHP code here
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

        // Fetch data from reservation table
        $reservation_query = "SELECT origin, destination, flight_id, takeoff_time, seat_class FROM reservation"; 
        $reservation_result = $conn->query($reservation_query);

        if ($reservation_result->num_rows > 0) {
            // Fetch total seat from seat selection table
            $seat_query = "SELECT SUM(totalseat) as totalseat FROM seat_selection"; 
            $seat_result = $conn->query($seat_query);
            $seat_row = $seat_result->fetch_assoc();
            $total_seat = $seat_row["totalseat"];

            // Display information in ticket format
            while ($reservation_row = $reservation_result->fetch_assoc()) {
                echo "<div class='ticket-details'>";
                echo "<h1>Ticket Information</h1>";
                echo "<p><strong>Origin:</strong> " . $reservation_row["origin"] . "</p>";
                echo "<p><strong>Destination:</strong> " . $reservation_row["destination"] . "</p>";
                echo "<p><strong>Flight ID:</strong> " . $reservation_row["flight_id"] . "</p>";
                echo "<p><strong>Takeoff Time:</strong> " . $reservation_row["takeoff_time"] . "</p>";
                echo "<p><strong>Seat Class:</strong> " . $reservation_row["seat_class"] . "</p>";
                echo "<p><strong>Total Seat:</strong> " . $total_seat . "</p>";
                echo "<button class='cancel-ticket-btn' onclick='cancelTicket(\"" . $reservation_row["flight_id"] . "\")'>Cancel Your Ticket</button>";
                echo "</div>";
                echo "<hr>";
            }
        } else {
            echo "Your ticket has been canceled";
        }

        // Close connection
        $conn->close();
        ?>

        <div class="navigate-home">
            <a href="homepage.html">Back to Homepage</a>
        </div>

        <script>
            function cancelTicket(flightId) {
                if (confirm("Are you sure you want to cancel your ticket for flight " + flightId + "?")) {
                    // Send AJAX request to delete the reservation
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Reload the page to reflect the changes
                                location.reload();
                            } else {
                                alert('Error: ' + xhr.statusText);
                            }
                        }
                    };
                    xhr.open('GET', 'cancel_ticket.php?flight_id=' + flightId, true);
                    xhr.send();
                }
            }
        </script>
    </div>
</body>
</html>
