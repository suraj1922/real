<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "test1"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date_today = date('Y-m-d');

// SQL query to fetch contracts expiring today
$sql = "SELECT * FROM contracts WHERE end_date = '$date_today' AND status = 'active'";
$result = $conn->query($sql);

$contracts = [];
if ($result->num_rows > 0) {
    // Output each contract
    while ($row = $result->fetch_assoc()) {
        $contracts[] = $row;
    }
}

$conn->close();
?>
