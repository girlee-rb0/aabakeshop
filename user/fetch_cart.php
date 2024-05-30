<?php
// fetch_cart.php
session_start();
include '../db_connection.php'; // Ensure you have a database connection file

// Initialize the cart items array
$cart_items = [];

// Get the current session ID
$session_id = session_id();

// Query to fetch cart items and related product details
$query = "SELECT p.product_image, p.product_name, c.quantity, p.price, c.quantity * p.price AS subtotal
          FROM carts c
          JOIN products p ON c.product_id = p.product_id
          WHERE c.session_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

// Populate the cart_items array
if ($result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        $cart_items[] = $item;
    }
} else {
    // Debugging: No items found
    error_log("No cart items found for session: " . $session_id);
}

// Close resources
$stmt->close();
$conn->close();
?>
