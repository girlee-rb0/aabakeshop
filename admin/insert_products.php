<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    include '../db_connection.php';

    // Get form data
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO products (product_image, product_name, description, price) VALUES ('$target_file', '$product_name', '$description', '$price')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/products.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
