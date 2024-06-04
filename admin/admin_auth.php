<?php
session_start();

function checkAdminLogin() {
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        header("Location: ../admin_login.php");
        exit;
    }
}
?>
