<?php
session_start();
include '../db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_id'])) {
    if ($conn) {
        // Assuming you have a cart table with a column named 'cart_id' and 'session_id'
        $sql = "DELETE FROM carts WHERE session_id = ?";
        $stmt = $conn->prepare($sql);
        $session_id = session_id();
        $stmt->bind_param("s", $session_id);

        if ($stmt->execute()) {
            // If the items are successfully deleted from the database, remove them from the session-based cart as well
            unset($_SESSION['cart']); // Clear the cart session variable

            // Redirect to carts.php
            header("Location: carts.php");
            exit();
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete items from the database']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to connect to the database']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
