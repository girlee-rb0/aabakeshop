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
        <link rel="stylesheet" href="css/styles.css">

        <title>AA BAKESHOP</title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav_logo">
                    <img src="assets/img/cake_logo.png" alt="logo image">
                    AA BAKESHOP
                </a>

                <div class="nav_menu" id="nav-menu">
                    <ul class="nav_list">
                        <li class="nav_item">
                            <a href="indexx.html" class="nav_link active-link">Home</a>
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
                    </ul>

                    <!-- close button -->
                    <div class="nav_close" id="nav-close">
                        <i class="ri-close-line"></i>
                    </div>

                    <img src="assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                    <img src="assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">
                </div>

                <a href="cart.php" class="cart_button" onclick="toggleCart()">
                    <i class="ri-shopping-cart-2-line"></i>
                </a>
                                
                <a href="#" class="account_button" onclick="toggleAccount()">
                    <i class="ri-account-circle-line"></i>
                </a>

                <div class="nav_buttons">
                    <!-- Theme change button -->
                    <i class="ri-moon-line change-theme" id="theme-button"></i>

                    <!-- Toggle button -->
                    <div class="nav_toggle" id="nav-toggle">
                        <i class="ri-apps-2-line"></i>
                    </div>
                </div>
            </nav>
        </header>

        <!--==================== MAIN ====================-->
        <main class="main">


            <!--==================== PRODUCTS ====================-->
            <section class="popular section" id="products">
                <span class="section_subtitle">The Best Cake</span>
                <h2 class="section_title">Products</h2>

                    <img src="assets/img/leaf-branch-4.png" alt="nav image" class="nav_img-1">
                    <img src="assets/img/leaf-branch-3.png" alt="nav image" class="nav_img-2">

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
            </section>

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

        function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + productId
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Display success message
        })
        .catch(error => {
            console.error('Error adding to cart:', error); // Handle errors
        });
    }
    </script>
    </body>
</html>