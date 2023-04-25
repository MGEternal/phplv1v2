<?php
// Database configuration
$host = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = "12345678"; // replace with your database password
$dbname = "closet"; // replace with your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
echo "Connected successfully to the database: " . $dbname;

// ... Other code and queries can be added here ...

// Close the database connection

?>