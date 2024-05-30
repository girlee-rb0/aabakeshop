<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aabakeshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateTrackingNumber() {
    return strtoupper(bin2hex(random_bytes(8))); // Generates a 16-character tracking number
}
?>