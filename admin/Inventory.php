<?php
include '../db_connection.php'; // Ensure this path is correct
include 'admin_auth.php';

checkAdminLogin();

$sql = "SELECT ingredient_id, ingredient_name, usages, stock FROM ingredients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/cake_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Ingredient Stock</title>
    <style>
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
        h1 {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
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
                        <a href="products.php" class="nav_link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="order.php" class="nav_link">Orders</a>
                    </li>
                    <li class="nav_item">
                        <a href="sales.php" class="nav_link ">Sales</a>
                    </li>
                    <li class="nav_item">
                        <a href="transaction.php" class="nav_link ">Transaction</a>
                    </li>
                    <li class="nav_item">
                        <a href="inventory.php" class="nav_link active-link">Inventory</a>
                    </li>
                </ul>
                <div class="nav_close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
                <img src="../assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                <img src="../assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">
            </div>
            <a href="admin_logout.php" class="nav_link">Logout</a>
        </nav>
    </header>

    <h1>Ingredient Stock</h1>
    <table>
        <thead>
            <tr>
                <th>Ingredient ID</th>
                <th>Ingredient Name</th>
                <th>Ingredients Usage</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ingredient_id"] . "</td><td>" . $row["ingredient_name"] . "</td><td>" . $row["usages"] . "</td><td>" . $row["stock"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No ingredients found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <script src="../assets/js/main.js"></script>
</body>
</html>
