<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if (isset($_POST['uname']) && isset($_POST['pass'])) {
    include "../db_connection.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if (empty($uname) || empty($pass)) {
        $em  = "Username and password are required";
        header("Location: ../login.php?error=$em");
        exit;
    } else {
        // Check in the admin table
      
        // Check in the user table
        $sqlUser = "SELECT * FROM user WHERE username = ?";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param("s", $uname);
        $stmtUser->execute();

        $resultUser = $stmtUser->get_result();
        $rowCountUser = $resultUser->num_rows;

        if ($rowCountUser == 1) {
            $user = $resultUser->fetch_assoc();
            $username = $user['username'];
            $password = $user['password'];
            $role = $user['role'];  // Assuming 'role' is the column storing the user role

            if (password_verify($pass, $password)) {
                // Password is correct for user

                // Check the role and redirect accordingly
                if ($role == 'admin') {
                    $_SESSION['username'] = $username;
                    $_SESSION['admin_id'] = $user['user_id'];
                    header("Location: ../admin/index.php");
                } elseif ($role == 'user') {
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user['user_id'];
                    header("Location: ../user/index.php");
                }
                exit;
            } else {
                // Incorrect Password for user
                $em = "Username and password are incorrect";
                header("Location: ../login.php?error=$em");
                exit;
            }
        } else {
            // Incorrect Username for both admin and user
            $em = "Username and password are incorrect";
            header("Location: ../login.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>