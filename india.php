<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <!-- Add your CSS file if needed -->
</head>
<body>
    <h1>Seat Selection</h1>
    <?php
    // Retrieve flight ID from the query parameters
    $flight_id = $_GET['flight_id'];
    ?>
    <p>You are selecting a seat for Flight ID: <?php echo $flight_id; ?></p>
    <!-- Implement your seat selection interface here -->
</body>
</html>
