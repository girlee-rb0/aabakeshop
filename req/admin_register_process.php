<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection
    include "../db_connection.php";  

    // Collect user input from the registration form with validation
    $firstname = htmlspecialchars($_POST['firstname'] ?? ''); 
    $lastname = htmlspecialchars($_POST['lastname'] ?? ''); 
    $username = htmlspecialchars($_POST['username'] ?? ''); 
    $email = htmlspecialchars($_POST['email'] ?? ''); 
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT); // Hash the password for security
    $role = htmlspecialchars($_POST['role'] ?? 'admin');  // Default role to 'user'

    // Error handling for empty fields
    $errors = [];  // Initialize an array to hold error messages
    if (empty($firstname) || empty($lastname)) {
        $errors[] = "Firstname and lastname are required.";
    }
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (!empty($errors)) {
        // Return error messages for missing fields
        $error_message = implode("<br>", $errors);
        header("Location: ../admin_register.php?error=" . urlencode($error_message));
        exit;
    }

    // Check for existing username or email in the database
    $checkExistingUser = "SELECT username, email FROM admin WHERE username = ? OR email = ?";
    $stmtCheck = $conn->prepare($checkExistingUser);
    $stmtCheck->bind_param("ss", $username, $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    // Initialize error messages for existing username and email
    if ($resultCheck->num_rows > 0) {
        while ($existingUser = $resultCheck->fetch_assoc()) {
            if ($existingUser['username'] == $username && $existingUser['email'] == $email) {
                $errors[] = " The username and email  already exist.";
            } else {
                if ($existingUser['username'] == $username) {
                    $errors[] = "Username  already exists.";
                }
                if ($existingUser['email'] == $email) {
                    $errors[] = "Email  is already used.";
                }
            }
        }
    }

    if (!empty($errors)) {
        // Return error messages for existing username and/or email
        $error_message = implode("<br>", $errors);
        header("Location: ../admin_register.php?error=" . urlencode($error_message));
        exit;
    }

    // Insert the new user into the database
    $insertUser = "INSERT INTO admin (firstname, lastname, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertUser);
    $stmtInsert->bind_param("ssssss", $firstname, $lastname, $username, $email, $password, $role);

    if ($stmtInsert->execute()) {
        // If registration is successful, redirect to the login page with a success message
        $error_message = "Register successful.";
        header("Location: ../admin_register.php?success=" . urlencode($error_message));
        exit;
    } else {
        // If insertion fails, return an error message
        $error_message = "Registration failed. Please try again later.";
        header("Location: ../admin_register.php?error=" . urlencode($error_message));
        exit;
    }

    $stmtCheck->close();  // Close the statement for checking existing data
    $stmtInsert->close();  // Close the insertion statement
    $conn->close();  // Close the database connection
} else {
    // Handle non-POST requests by redirecting to the registration form with an error message
    header("Location: ../admin_register.php?error=" . urlencode("Invalid request method."));
    exit;
}
?>
