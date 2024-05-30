<?php
session_start();
include "../db_connection.php";

if (isset($_POST['uname']) && isset($_POST['pass'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if (empty($uname) || empty($pass)) {
        $em = "Username and password are required";
        header("Location: ../login.php?error=$em");
        exit;
    }

    // Check in the user table for regular users
    $sql = "SELECT * FROM user WHERE username = ? AND role = 'user'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($pass, $user['password'])) {
            // Update last_login field
            $update_last_login = $conn->prepare("UPDATE user SET last_login = NOW() WHERE user_id = ?");
            $update_last_login->bind_param("i", $user['user_id']);
            $update_last_login->execute();
            
            // Set session variables
            $_SESSION['username'] = $uname;
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: ../user/indexs.php");
            exit;
        } else {
            $em = "Incorrect Password";
            header("Location: ../login.php?error=$em");
            exit;
        }
    } else {
        $em = "Incorrect Username";
        header("Location: ../login.php?error=$em");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}

mysqli_close($conn);
?>
