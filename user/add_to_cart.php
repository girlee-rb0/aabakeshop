<?php
session_start();
include '../db_connection.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);
$session_id = session_id();

// Fetch product details
$query = "SELECT product_name, price FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($product_name, $price);
    $stmt->fetch();

    // Check if the product is already in the cart
    $cart_query = "SELECT quantity FROM carts WHERE user_id = ? AND session_id = ? AND product_id = ?";
    $stmt = $conn->prepare($cart_query);
    $stmt->bind_param("isi", $user_id, $session_id, $product_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($quantity);
        $stmt->fetch();
        $quantity += 1;

        $update_query = "UPDATE carts SET quantity = ?, price = ? WHERE user_id = ? AND session_id = ? AND product_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("idisi", $quantity, $price, $user_id, $session_id, $product_id);
    } else {
        $insert_query = "INSERT INTO carts (user_id, session_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("isisd", $user_id, $session_id, $product_id, $product_name, $price);
    }

    if ($stmt->execute()) {
        echo "Product added to cart!";
    } else {
        echo "Failed to add product to cart!";
    }
} else {
    echo "Product not found!";
}

$stmt->close();
$conn->close();
?>
