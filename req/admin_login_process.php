<?php
session_start();
include "../db_connection.php";

if (isset($_POST['uname']) && isset($_POST['pass'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if (empty($uname) || empty($pass)) {
        $em = "Username and password are required";
        header("Location: ../admin_login.php?error=$em");
        exit;
    }

    // Check in the admin table for admin users
    $sql = "SELECT * FROM admin WHERE username = ? AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($pass, $admin['password'])) {
            $_SESSION['username'] = $uname;
            $_SESSION['admin_id'] = $admin['user_id'];
            header("Location: ../admin/index.php");
            exit;
        } else {
            $em = "Incorrect Password";
            header("Location: ../admin_login.php?error=$em");
            exit;
        }
    } else {
        $em = "Incorrect Username";
        header("Location: ../admin_login.php?error=$em");
        exit;
    }
} else {
    header("Location: ../admin_login.php");
    exit;
}

mysqli_close($conn);
?>
