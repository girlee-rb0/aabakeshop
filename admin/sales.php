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
                AABAKESHOP - Admin
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
                        <a href="sales.php" class="nav_link active-link">Sales</a>
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

    <div class="container">
        <h1>Sales Report</h1>

        <!-- Filter Form -->
        <div class="filter-form">
            <form method="GET" action="sales.php">
                <label for="filter_date">Filter by Date:</label>
                <input type="date" id="filter_date" name="filter_date">
                <button type="submit">Filter</button>
                <button type="button" onclick="window.location.href='sales.php'">Clear Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include_once '../db_connection.php';

                // SQL query to fetch sales data
                $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
                $sql = "SELECT o.order_date, p.product_name, o.quantity, o.price, (o.quantity * o.price) as subtotal
                        FROM orders o
                        JOIN products p ON o.product_id = p.product_id";

                if ($filter_date) {
                    $sql .= " WHERE DATE(o.order_date) = '$filter_date'";
                }

                $result = $conn->query($sql);
                $total_sales = 0;

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["order_date"]."</td>";
                        echo "<td>".$row["product_name"]."</td>";
                        echo "<td>".$row["quantity"]."</td>";
                        echo "<td>".$row["price"]."</td>";
                        echo "<td>".$row["subtotal"]."</td>";
                        echo "</tr>";
                        $total_sales += $row["subtotal"];
                    }
                } else {
                    echo "<tr><td colspan='5'>No sales data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="total-sales">
            Total Sales: <?php echo $total_sales; ?>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>
