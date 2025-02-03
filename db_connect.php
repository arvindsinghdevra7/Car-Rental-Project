<?php
$servername = "localhost";
$username = "root";  // apna database username
$password = "";      // apna database password
$dbname = "lovely_cars";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 