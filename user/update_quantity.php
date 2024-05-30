<?php
session_start();
include '../db_connection.php'; // Ensure this path is correct

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];
$cart_id = intval($_POST['cart_id']);
$new_quantity = intval($_POST['quantity']);

$update_query = $conn->prepare("UPDATE carts SET quantity = ? WHERE cart_id = ? AND user_id = ?");
$update_query->bind_param("iii", $new_quantity, $cart_id, $user_id);

if ($update_query->execute()) {
    echo "Quantity updated successfully.";
} else {
    echo "Failed to update quantity.";
}

$update_query->close();
$conn->close();
?>
