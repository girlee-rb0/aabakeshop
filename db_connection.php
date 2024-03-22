<?php

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "aabakeshop";

$conn = new mysqli($sName, $uName, $pass, $db_name);

if ($conn->connect_errno) {
    echo $conn->connect_error;
} else {
    echo "Connection successfully";
}

    