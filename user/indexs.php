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
                        <img src="../assets/img/cake_logo.png" alt="logo image">
                        AABakeshop
                    </a>

                    <p class="footer_description">
                        AA Bakeshop is not just an <br> 
                        ordinary bakeshop. <br>
                        Every cake we make <br>
                        is made with love.
                    </p>
                </div>
                <div class="footer_content">
                    <div>
                        <h3 class="footer_title">Main Menu</h3>

                        <ul class="footer_links">
                            <li>
                                <a href="#about" class="footer_link">About</a>
                            </li>
                            <li>
                                <a href="#Products" class="footer_link">Menus</a>
                            </li>
                            <li>
                                <a href="#" class="footer_link">Offer</a>
                            </li>
                            <li>
                                <a href="#" class="footer_link">Events</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="footer_title">Information</h3>

                        <ul class="footer_links">
                            <li>
                                <a href="#" class="footer_link">Contact Us</a>
                            </li>
                            <li>
                                <a href="#" class="footer_link">Customers Feedback</a>
                            </li>

                        </ul>
                    </div>
                    <div>
                        <h3 class="footer_title">Address</h3>

                        <ul class="footer_links">
                            <li class="footer_information">
                                123 Street  <br>
                                Polangui, Albay
                            </li>
                            <li class="footer_information">
                                8AM - 4PM
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="footer_title">Social Media</h3>

                        <ul class="footer_social">
                            <a href="https://www.facebook.com/" target="_blank" class="footer_social-link">
                                <i class="ri-facebook-circle-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" class="footer_social-link">
                                <i class="ri-instagram-fill"></i>
                            </a>
                            <a href="https://twitter.com/" target="_blank" class="footer_social-link">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        </ul>
                    </div>
                </div>
                <img src="../assets/img/leaf-3.png" alt="footer image" class="footer_leaf-small">
                <img src="../assets/img/leaf-branch-4.png" alt="footer image" class="footer_leaf">
            </div>
            <div class="footer_info container">
                <div class="footer_card">
                    <img src="../assets/img/footer-card-1.png" alt="footer image">
                    <img src="../assets/img/footer-card-2.png" alt="footer image">
                    <img src="../assets/img/footer-card-3.png" alt="footer image">
                    <img src="../assets/img/footer-card-4.png" alt="footer image">
                </div>

                <span class="footer_copy">
                    &#169; AA BAKESHOP. 2024
                </span>
            </div>
        </footer>

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