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
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form {
            display: inline-block;
        }

        .search-form input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 250px;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        .notification {
    display: none; /* Hidden by default */
    background-color: #4caf50; /* Green background */
    color: white; /* White text */
    text-align: center; /* Centered text */
    padding: 10px; /* Some padding */
    position: fixed; /* Fixed position */
    top: 10px; /* Position at the top */
    width: 100%; /* Full width */
    z-index: 1000; /* Sit on top */
}

.notification.show {
    display: block; /* Show the notification */
}
    </style>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav_logo">
                <img src="../assets/img/cake_logo.png" alt="logo image">
                AA BAKESHOP
            </a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="#home" class="nav_link active-link">Home</a>
                    </li>
                    <li class="nav_item">
                        <a href="#about" class="nav_link">About us</a>
                    </li>
                    <li class="nav_item">
                        <a href="#products" class="nav_link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="#newsletter" class="nav_link">Subscribe</a>
                    </li>

                    <li class="nav_item">
                    <a href="orders.php" class="nav_link">My Orders</a>
                </li>

                </ul>

                <!-- close button -->
                <div class="nav_close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>

                <img src="../assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                <img src="../assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">
            </div>

             
            <li class="nav_item">
                <a href="logout.php" class="nav_link">Logout</a>
            </li>

            <a href="carts.php" class="cart_button" onclick="toggleCart()">
                <i class="ri-shopping-cart-2-line"></i>
            </a>
                           

            <a href="#" class="account_button" onclick="toggleAccount()">
                <i class="ri-account-circle-line"></i>
            </a>

        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home_container container grid">
                <img src="../assets/img/home-img.png" alt="chocolate cake" class="home_img">

                <div class="home_data">
                    <h1 class="home_title">
                        Enjoy Delicious

                        <div>
                            <img src="../assets/img/small-cake-img.png" alt="home image">
                            Sweet Cakes!
                        </div>
                    </h1>

                    <p class="home_description">
                        Indulge in premium and elegant cakes, perfect for any occasion, guaranteed to satisfy and delight your senses.
                    </p>

                    <a href="#products" class="button">
                        Order Now <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>

            <img src="../assets/img/leaf-branch-2.png" alt="home image" class="home_leaf-1">
            <img src="../assets/img/leaf-branch-4.png" alt="home image" class="home_leaf-2">
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <div class="about_container container grid">
                <div class="about_data">
                    <span class="section_subtitle">About Us</span>
                    <h2 class="section_title about_title">
                        <div>
                            We Provide
                            <img src="../assets/img/small-cake-img-1.png" alt="about image">
                        </div>
                        High-quality Cake
                    </h2>

                    <p class="about_description">
                        Come try our delicious cakes! They're made with 
                        top-notch ingredients for a heavenly taste. 
                        Satisfy your cravings at our store today!
                    </p>
                </div>
                <img src="../assets/img/cupcakes-1.png" alt="about image" class="about_img">
            </div>
            <img src="../assets/img/leaf-3.png" alt="about image" class="about_img-1">
                <img src="../assets/img/leaf-3.png" alt="about image" class="about_img-2">  
            <img src="../assets/img/leaf-branch-1.png" alt="about image" class="about_leaf">
        </section>


            <!--==================== PRODUCTS ====================-->
            <section class="popular section" id="products">
                <span class="section_subtitle">The Best Cake</span>
                <h2 class="section_title">Products</h2>

                <div class="search-container">
                    <form action="" method="GET" class="search-form">
                        <input type="text" name="search" placeholder="Search for products..." value="<?php echo htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                        <button type="submit" class="button">Search</button>
                    </form>
                </div>

                <div class="popular_container container grid">
                    <!-- Integrate PHP to generate product cards -->
                    <?php
                    include 'fetch_products.php'; // Fetch product data

                    foreach ($products as $product) {
                        ?>
                        <article class="popular_card">
                            <img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" class="popular_img">
                            <h3 class="popular_name"><?php echo $product['product_name']; ?></h3>
                            <span class="popular_description"><?php echo $product['description']; ?></span>
                            <span class="popular_price">₱<?php echo number_format($product['price'], 2); ?></span>

                            <!-- Link to add to cart -->
                            <button onclick="addToCart(<?php echo $product['product_id']; ?>)" class="popular_button">
                                <i class="ri-shopping-bag-line"></i>
                            </button>
                        </article>
                        <?php
                    }
                    ?>
                </div>
                <div id="notification" class="notification"></div>
            </section>

        <!--==================== NEWSLETTER ====================-->
        <section class="newsletter section" id="newsletter">
            <div class="newsletter_container container">
                <div class="newsletter_content grid">
                    <img src="../assets/img/newsletter-img.png" alt="newsletter image" class="newsletter_img">
                    <div class="newsletter_data">
                        <span class="section_subtitle">Newsletter</span>
                        <h2 class="section_title">
                            Subscribe For <br>
                            Offer Updates
                        </h2>
                        <form action="" class="newsletter_form">
                            <input type="email" placeholder="Enter email" class="newsletter_input">

                            <button class="button newsletter_button">
                                Subscribe <i class="ri-send-plane-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer_container container grid">
            <div>
                <a href="#" class="footer_logo">
                    <img src="../assets/img/cake_logo.png" alt="footer logo">
                    AA BAKESHOP
                </a>
                <p class="footer_description">
                    Indulge in premium and elegant cakes, perfect for any occasion, guaranteed to satisfy and delight your senses.
                </p>
            </div>

            <div class="footer_content">
                <div>
                    <h3 class="footer_title">
                        Main Menu
                    </h3>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Home</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">About us</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">Products</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">Subscribe</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer_title">
                        Information
                    </h3>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Event</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">Contact us</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">Privacy policy</a>
                        </li>
                        <li>
                            <a href="#" class="footer_link">Terms of services</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer_title">
                        Address
                    </h3>

                    <ul class="footer_links">
                        <li class="footer_information">
                            Davao City
                        </li>
                        <li class="footer_information">
                            4A Playa Azalea
                        </li>
                        <li class="footer_information">
                            davaocity@gmail.com
                        </li>
                        <li class="footer_information">
                            +12 3456 7890
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer_copy">
            <p class="footer_copy">
                &#169; 2022 AA BAKESHOP. All right reserved
            </p>
        </div>
    </footer>

    <!--==================== SCROLL TOP ====================-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!--=============== SCROLL REVEAL ===============-->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/main.js"></script>

    <!--=============== AJAX SCRIPT FOR ADDING TO CART ===============-->
    <script>
      function addToCart(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Show the custom notification
            var notification = document.getElementById("notification");
            notification.textContent = this.responseText;
            notification.classList.add("show");

            // Hide the notification after 3 seconds
            setTimeout(function() {
                notification.classList.remove("show");
            }, 3000);
        }
    };
    xhr.send("product_id=" + productId);
}
    </script>
</body>
</html>

<?php
// Close the database connection here
$stmt->close();
$conn->close();
?>
