<?php
session_start();
include '../db_connection.php'; // Ensure this path is correct

// Ensure the user_id is available
if (!isset($_SESSION['user_id'])) {
    header("Location: carts.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$session_id = session_id();

try {
    // Begin transaction
    $conn->begin_transaction();

    // Fetch cart items for the user
    $cart_query = $conn->prepare("SELECT * FROM carts WHERE user_id = ? AND session_id = ?");
    $cart_query->bind_param("is", $user_id, $session_id);
    $cart_query->execute();
    $result = $cart_query->get_result();
    $cart_items = $result->fetch_all(MYSQLI_ASSOC);

    if (count($cart_items) > 0) {
        foreach ($cart_items as $item) {
            // Generate a tracking number for each order
            $tracking_number = generateTrackingNumber();
            $order_date = date('Y-m-d H:i:s');
            $status = 'pending';

            $stmt = $conn->prepare("INSERT INTO orders (user_id, session_id, product_id, product_name, price, quantity, subtotal, order_date, status, tracking_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isisdiisss", $user_id, $session_id, $item['product_id'], $item['product_name'], $item['price'], $item['quantity'], $item['subtotal'], $order_date, $status, $tracking_number);

            if (!$stmt->execute()) {
                // Print error info
                print_r($stmt->error);
                throw new Exception("Failed to insert order item.");
            }
        }

        // Commit transaction
        $conn->commit();

        // Clear the cart after successful order
        $clear_cart = $conn->prepare("DELETE FROM carts WHERE user_id = ? AND session_id = ?");
        $clear_cart->bind_param("is", $user_id, $session_id);
        $clear_cart->execute();

        header("Location: carts.php?success=1");
        exit;
    } else {
        throw new Exception("No items in cart.");
    }
} catch (Exception $e) {
    // Rollback transaction on error
    if ($conn->errno) {
        $conn->rollback();
    }
    echo "Failed to complete the order: " . $e->getMessage();
}
?>