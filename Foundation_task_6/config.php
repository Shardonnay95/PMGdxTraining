<?php

// Database credentials
$servername = "localhost";
$username = "root"; // Default username for local MySQL installations
$password = ""; // Default password for local MySQL installations (empty)
$dbname = "mysql_people";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully <br> <br>";
?>
