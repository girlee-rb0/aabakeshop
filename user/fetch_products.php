<?php
// Database connection
include '../db_connection.php'; // Ensure this file connects to your database

// Fetch product data
$query = "SELECT product_id, product_name, description, price, product_image FROM products";
$result = $conn->query($query);

$products = [];

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $products[] = $product; // Add product to an array
    }
} else {
    echo "No products found.";
}

$conn->close(); // Close the database connection
?>
