<?php
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['role_as'] != 0) {
    $_SESSION['status'] = "Please login as a user to access this page";
    header("Location: ../admin/login.php"); 
    exit();
}

// Page starts here
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/slider.php');
include('includes/banner.php');
include('includes/blog.php');
include('includes/cart.php');
include('includes/product.php');
?>


<?php
include('includes/footer.php');
include('includes/script.php');
?>
<a href="../admin/logout.php">Logout</a>
