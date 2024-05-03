<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Seat Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .bus-layout {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .row {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            background-color: white;
        }
        .reserved {
            background-color: blue;
        }
        .selected {
            background-color: red;
        }
        .total {
            text-align: center;
            margin-top: 20px;
        }
        .next-page {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $selectedSeats = $_POST['selected_seats'];
    $totalAmount = $_POST['total_amount'];

    // Update available seats in the database
    $seatsCount = count($selectedSeats);
    $sqlUpdate = "UPDATE seats SET available_seats = available_seats - $seatsCount";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Available seats updated successfully. ";
    } else {
        echo "Error updating available seats: " . $conn->error;
    }

    // Insert booking details into the database
    $selectedSeatsStr = implode(',', $selectedSeats);
    $sqlInsert = "INSERT INTO bookings (selected_seats, total_amount) VALUES ('$selectedSeatsStr', $totalAmount)";
    if ($conn->query($sqlInsert) === TRUE) {
        echo "Booking details inserted successfully. ";
    } else {
        echo "Error inserting booking details: " . $conn->error;
    }

    // Redirect to the payment page
    header("Location: confirmation.html");
    exit();
}

$conn->close();
?>

</head>
<body>
    <div class="bus-layout">
        <div class="row">
            <?php
            // Assuming PHP is used to generate the seat layout
            for ($i = 1; $i <= 25; $i++) {
                echo "<div class='seat' id='seat-$i' onclick='toggleSeat($i)'></div>";
            }
            ?>
        </div>
        <div class="row">
            <?php
            for ($i = 26; $i <= 50; $i++) {
                echo "<div class='seat' id='seat-$i' onclick='toggleSeat($i)'></div>";
            }
            ?>
        </div>
        <div class="total">
            <p>Seats Selected: <span id="selected-seats">0</span></p>
            <p>Total Amount: <span id="total-amount">0</span></p>
            <button onclick="generateTickets()">OK</button>
        </div>
        <div class="next-page">
            <a href="confirmation.html">Next</a>
        </div>
    </div>

    <script>
        var selectedSeats = [];
        var seatAmount = 50; // Amount per seat

        function toggleSeat(seatNumber) {
            var seat = document.getElementById('seat-' + seatNumber);
            if (!selectedSeats.includes(seatNumber)) {
                seat.classList.toggle('selected');
                selectedSeats.push(seatNumber);
            } else {
                seat.classList.toggle('selected');
                selectedSeats.splice(selectedSeats.indexOf(seatNumber), 1);
            }
            updateTotal();
        }

        function updateTotal() {
            var selectedSeatsCount = selectedSeats.length;
            document.getElementById('selected-seats').textContent = selectedSeatsCount;
            var totalAmount = selectedSeatsCount * seatAmount;
            document.getElementById('total-amount').textContent = totalAmount;
        }

        function generateTickets() {
            // Implement ticket generation logic here using selectedSeats array
            alert("Tickets generated successfully!");
            // Redirect or do further processing as needed
        }
    </script>
</body>
</html>