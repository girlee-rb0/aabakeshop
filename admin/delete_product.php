<?php
include_once '../db_connection.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Redirect back to the products page with a success message
        header("Location: products.php?message=Product deleted successfully");
    } else {
        // Redirect back to the products page with an error message
        header("Location: products.php?error=Unable to delete product");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the products page if no id is provided
    header("Location: products.php");
    exit;
}
?>
