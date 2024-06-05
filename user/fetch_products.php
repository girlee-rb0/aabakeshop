<?php
// Database connection
include '../db_connection.php'; // Ensure this file connects to your database

// Initialize the query
$query = "SELECT product_id, product_name, description, price, product_image, properties FROM products";

// Check if there is a search term
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
    $query .= " WHERE product_name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%' OR properties LIKE '%$searchTerm%'";
}

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
