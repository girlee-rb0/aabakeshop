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
    <title>Admin Dashboard - AA BAKESHOP</title>
    <style>
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 50px;
        }
        .widget {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            flex: 1 1 300px;
            max-width: 300px;
        }
        .widget h2 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }
        .widget p {
            font-size: 24px;
            font-weight: bold;
        }
        .widget .list {
            list-style-type: none;
            padding: 0;
        }
        .widget .list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .widget .list li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav_logo">
                <img src="../assets/img/cake_logo.png" alt="logo image">
                AABAKESHOP
            </a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="index.php" class="nav_link active-link">Home</a>
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
                        <a href="transaction.php" class="nav_link">Transaction</a>
                    </li>

                    <li class="nav_item">
                        <a href="inventory.php" class="nav_link">Inventory</a>
                    </li>
                </ul>
                <div class="nav_close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
                <img src="assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                <img src="assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">
            </div>
            <a href="admin_logout.php" class="nav_link">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard-container">
            <!-- Sales Summary Widget -->
            <div class="widget">
                <h2>Sales Summary</h2>
                <?php
                include_once '../db_connection.php';
                // Fetch total sales, orders, and revenue for today, week, month, and year
                $today_sales = $conn->query("SELECT SUM(subtotal) as total_sales FROM orders WHERE DATE(order_date) = CURDATE()")->fetch_assoc()['total_sales'];
                $week_sales = $conn->query("SELECT SUM(subtotal) as total_sales FROM orders WHERE WEEK(order_date) = WEEK(CURDATE())")->fetch_assoc()['total_sales'];
                $month_sales = $conn->query("SELECT SUM(subtotal) as total_sales FROM orders WHERE MONTH(order_date) = MONTH(CURDATE())")->fetch_assoc()['total_sales'];
                $year_sales = $conn->query("SELECT SUM(subtotal) as total_sales FROM orders WHERE YEAR(order_date) = YEAR(CURDATE())")->fetch_assoc()['total_sales'];
                ?>
                <p>Today: <?php echo $today_sales ?: 0; ?></p>
                <p>This Week: <?php echo $today_sales ?: 0; ?></p>
                <p>This Month: <?php echo $month_sales ?: 0; ?></p>
                <p>This Year: <?php echo $year_sales ?: 0; ?></p>
            </div>
            
            <!-- Recent Orders Widget -->
            <div class="widget">
                <h2>Recent Orders</h2>
                <ul class="list">
                    <?php
                    $recent_orders = $conn->query("SELECT order_id, user_id, order_date, subtotal FROM orders ORDER BY order_date DESC LIMIT 5");
                    if ($recent_orders->num_rows > 0) {
                        while ($order = $recent_orders->fetch_assoc()) {
                            echo "<li>Order ID: {$order['order_id']}, User ID: {$order['user_id']}, Date: {$order['order_date']}, Total: {$order['subtotal']}</li>";
                        }
                    } else {
                        echo "<li>No recent orders</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Top Selling Products Widget -->
            <div class="widget">
                <h2>Top Selling Products</h2>
                <ul class="list">
                    <?php
                    $top_products = $conn->query("SELECT p.product_name, SUM(o.quantity) as total_quantity FROM orders o JOIN products p ON o.product_id = p.product_id GROUP BY o.product_id ORDER BY total_quantity DESC LIMIT 5");
                    if ($top_products->num_rows > 0) {
                        while ($product = $top_products->fetch_assoc()) {
                            echo "<li>{$product['product_name']} - Sold: {$product['total_quantity']}</li>";
                        }
                    } else {
                        echo "<li>No top selling products</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Order Status Summary Widget -->
            <div class="widget">
                <h2>Order Status Summary</h2>
                <?php
                $statuses = $conn->query("SELECT status, COUNT(*) as count FROM orders GROUP BY status");
                while ($status = $statuses->fetch_assoc()) {
                    echo "<p>{$status['status']}: {$status['count']}</p>";
                }
                ?>
            </div>

            <!-- Inventory Alerts Widget -->
            <div class="widget">
                <h2>Inventory Alerts</h2>
                <ul class="list">
                    <?php
                    $low_stock_products = $conn->query("SELECT product_name, stock FROM products WHERE stock <= 10");
                    if ($low_stock_products->num_rows > 0) {
                        while ($product = $low_stock_products->fetch_assoc()) {
                            echo "<li>{$product['product_name']} - Stock: {$product['stock']}</li>";
                        }
                    } else {
                        echo "<li>No low stock products</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- User Activity Widget -->
            <div class="widget">
                <h2>Recent User Activity</h2>
                <ul class="list">
                    <?php
                    $recent_users = $conn->query("SELECT user_id, username, last_login FROM user ORDER BY last_login DESC LIMIT 5");
                    if ($recent_users->num_rows > 0) {
                        while ($user = $recent_users->fetch_assoc()) {
                            echo "<li>User: {$user['username']}, Last Login: {$user['last_login']}</li>";
                        }
                    } else {
                        echo "<li>No recent user activity</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="../assets/js/ScrollReveal.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/main.js"></script>
</body>
</html>
