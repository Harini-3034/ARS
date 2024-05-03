<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Details</title>
  <link rel="stylesheet" href="adsignup.css">
</head>
<body>
  <h1>Login Details</h1>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <?php
// Establish database connection
$host = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "users"; // Replace with your database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from the users table
$sql = "SELECT name, password FROM login";
$result = $conn->query($sql);

// Output data in table format
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["name"] . "</td>
            <td>" . $row["password"] . "</td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='2'>No data found</td></tr>";
}
$conn->close();
?>

    </tbody>
  </table>
</body>
</html>
