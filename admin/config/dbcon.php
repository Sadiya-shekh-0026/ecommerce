
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpadminpanel";

// Connection
$con = mysqli_connect("$host", "$username", "$password", "$database");

// Check Connection
if (!$con) {
    header("Location: ./errors/db.php");
    exit();
    //die(mysqli_connect_errno($con));
}// else{
//     echo "Database Connection successfully.";
//  }
?>
