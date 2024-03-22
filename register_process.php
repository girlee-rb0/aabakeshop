<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../db_connection.php";  // Adjust the path based on your actual directory structure

    // Retrieve user input from the registration form
    $username = htmlspecialchars($_POST['username']);  // Use htmlspecialchars to prevent XSS attacks
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password for security
    $role = htmlspecialchars($_POST['role']);

    // Check if the username or email already exists in the database
    $checkExistingUser = "SELECT username, email FROM user WHERE username = ? OR email = ?";
    $stmtCheck = $conn->prepare($checkExistingUser);
    $stmtCheck->bind_param("ss", $username, $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    // ... (existing code)

    if ($resultCheck->num_rows > 0) {
    // Username or email already exists
    $error_message = "Username or email already exists. Please choose a different one.";
    header("Location: ../register.html?error=$error_message");
    exit;
    }

// ... (rest of your code)


    // Prepare and execute the SQL query to insert data into the database
    $insertUser = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertUser);
    $stmtInsert->bind_param("ssss", $username, $email, $password, $role);
    
    if ($stmtInsert->execute()) {
        // Registration successful
        header("Location: ../login.php");
        exit;
    } else {
        // Registration failed
        $error_message = "Registration failed. Please try again.";
        header("Location: ../register.php?error=$error_message");
        exit;
    }

    $stmtCheck->close();
    $stmtInsert->close();
    $conn->close();
} else {
    // Redirect to the registration form if the request method is not POST
    header("Location: ../register.html?error=$error_message");
    exit;
}
?>