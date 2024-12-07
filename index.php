<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expiring Contracts</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Contracts Expiring Today</h1>
        <table id="contracts-table">
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection details
                $date_today = date('Y-m-d');

                // Database connection details
                $servername = "localhost";
                $username = "root";  // Your MySQL username
                $password = "";  // Your MySQL password
                $dbname = "test1";  // Your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch contracts expiring today
                $sql = "SELECT * FROM contracts WHERE DATE(end_date) = '$date_today' AND status = 'active'";

                // Debugging: Print the query
                echo "Query: $sql <br>";

                $result = $conn->query($sql);

                // Initialize the contracts array
                $contracts = [];

                // Check if the query returned any results
                if ($result->num_rows > 0) {
                    // Populate the $contracts array with the data
                    while ($row = $result->fetch_assoc()) {
                        $contracts[] = $row;
                    }
                }

                // Close the database connection
                $conn->close();

                // If contracts array is empty, display a message
                if (empty($contracts)) {
                    echo "<tr><td colspan='4'>No contracts expiring today.</td></tr>";
                } else {
                    // Loop through the contracts and display them in the table
                    foreach ($contracts as $contract) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($contract['property_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($contract['client_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($contract['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($contract['end_date']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>

</html>