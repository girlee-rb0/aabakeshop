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
    <link rel="shortcut icon" href="../assets/img/cake_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Admin Sales Report</title>
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
        .total-sales {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        .filter-form {
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
                        <a href="sales.php" class="nav_link">Sales</a>
                    </li>
                    <li class="nav_item">
                        <a href="transaction.php" class="nav_link active-link">Transaction</a>
                    </li>
                    <li class="nav_item">
                        <a href="inventory.php" class="nav_link">Inventory</a>
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

    <main>
        <h1>Transaction Report</h1>
        <div class="filter-form">
            <!-- Add any filter form here if needed -->
        </div>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Payment Amount</th>
                    <th>Gcash Name</th>
                    <th>Gcash Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file

                // Fetch transaction data from the orders table
                $query = "SELECT user_id, order_date, payment_amount, gcash_name, gcash_number FROM orders";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['user_id']) . '</td>';
                        echo '<td>' . htmlspecialchars(number_format($row['payment_amount'], 2)) . '</td>';
                        echo '<td>' . htmlspecialchars($row['gcash_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['gcash_number']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No transactions found.</td></tr>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <!-- If needed, add the total sales calculation here -->
    </main>

    <script src="../assets/js/main.js"></script>
</body>
</html>
