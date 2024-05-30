<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sstyles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper register-link">
        <form action="req/admin_register_process.php" method="post">
            <h1>Sign Up</h1>

            <?php
            // Display error message if any
            if (isset($_GET['error'])) {
                echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>";
            }

            // Display success message if registration was successful
            if (isset($_GET['success'])) {
                echo "<div class='success'>" . htmlspecialchars($_GET['success']) . "</div>";
            }
            ?>

            <div class="input-box">
                <label for="firstname"></label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter your Firstname" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="lastname"></label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter your Lastname" required>
                <i class='bx bxs-user'></i>
            </div>
            
            <div class="input-box">
                <label for="email"> </label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <!-- New input box for username -->
            <div class="input-box">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <input type="hidden" name="role" value="admin">

            <button type="submit" class="btn">Sign Up</button>
            <div class="register-link">
                <p>Already have an account? <a href="admin_login.php" target="_self">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
