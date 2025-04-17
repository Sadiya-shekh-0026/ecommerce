<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to Access Dashboard";
    header("Location: login.php"); // Fix: Corrected header format
    exit(0);
} else {
    if ($_SESSION['auth'] == "1") {
        // Admin hai toh yahan code likh sakti hain
    } else {
        $_SESSION['status'] = "You are not Authorised as ADMIN";
        header("Location: ../user/index.php"); // Fix: Corrected header format
        exit(0);
    }
}
?>

