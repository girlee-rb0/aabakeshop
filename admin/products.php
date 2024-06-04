<?php
include '../db_connection.php'; // Ensure this path is correct
include 'admin_auth.php';

checkAdminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="../assets/img/cake_logo.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../css/styles.css">

    <title>AA BAKESHOP</title>

    <style>
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }

        /* Image styles */
        td img {
            width: 100px; /* Adjust as necessary */
            height: auto;
        }

        /* Heading styles */
        h1 {
            text-align: center;
            margin-top: 50px; /* Adjust this value to lower the heading */
            margin-bottom: 20px;
        }

        /* Form styles */
        .add_product_form {
            margin-top: 20px;
            text-align: center;
        }

        /* Enable scrolling for the table container */
        .table-container {
            max-height: 500px; /* Adjust as necessary */
            overflow-y: auto;
        }

        .delete-link {
            color: red; /* Change color to red */
            font-weight: bold; /* Make the link bold */
            text-decoration: none; /* Remove underline */
        }
        .delete-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav_logo">
                <img src="../assets/img/cake_logo.png" alt="logo image">
                AABAKESHOP
            </a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="index.php" class="nav_link">Home</a>
                    </li>
                    <li class="nav_item">
                        <a href="products.php" class="nav_link active-link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="order.php" class="nav_link">Orders</a>
                    </li>
                    <li class="nav_item">
                        <a href="sales.php" class="nav_link">Sales</a>
                    </li>

                    <li class="nav_item">
                        <a href="transaction.php" class="nav_link ">Transaction</a>
                    </li>

                    <li class="nav_item">
                        <a href="inventory.php" class="nav_link ">Inventory</a>
                    </li>
                </ul>

                <!-- close button -->
                <div class="nav_close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>

                <img src="assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                <img src="assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">
            </div>
                            
            <a href="admin_logout.php" class="nav_link">Logout</a>
        </nav>

        <div class="container">
            <h1>List of Products</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database connection file
                        include_once '../db_connection.php';
                        
                        // SQL query to fetch products
                        $sql = "SELECT * FROM products";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img src='".$row["product_image"]."' alt='".$row["product_name"]."'></td>";
                                echo "<td>".$row["product_name"]."</td>";
                                echo "<td>".$row["Description"]."</td>";
                                echo "<td>".$row["price"]."</td>";
                                echo "<td><a href='delete_product.php?id=".$row["product_id"]."' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a></td>"; // Delete link
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No products found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="add_product_form">
            <h3>Add New Product</h3>
            <form action="insert_products.php" method="post" enctype="multipart/form-data">
                <label for="product_image">Product Image:</label>
                <input type="file" name="product_image" id="product_image" required><br>

                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" required><br>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea><br>

                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required><br>

                <button type="submit" name="submit">Add Product</button>
            </form>
        </div>
    </header>

    <script src="assets/js/main.js"></script>
    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="../assets/js/ScrollReveal.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/main.js"></script>
    <script>
    function toggleCart() {
        var cart = document.getElementById("cart");
        cart.classList.toggle("active");
    }
    </script>
</body>
</html>
