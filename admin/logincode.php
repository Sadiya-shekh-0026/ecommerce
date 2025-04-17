<?php
session_start();

include('config/dbcon.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check if user exists
    $log_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if(mysqli_num_rows($log_query_run) > 0)
    {
        foreach($log_query_run as $row){
            // Password check added here 
            if($row['password'] === $password)
            {
                $user_id = $row['id'];
                $user_name = $row['name'];
                $user_email = $row['email'];
                $user_phone = $row['phone'];
                $role_as = $row['role_as'];

                $_SESSION['auth'] = "$role_as";
                $_SESSION['auth_user'] = [
                    'user_id'=>$user_id,
                    'user_name'=>$user_name,
                    'user_email'=>$user_email,
                    'user_phone'=>$user_phone,
                ];

                $_SESSION['status']= "Logged In Successfully";
                header('location: index.php');
                exit();
            }
            else
            {
                $_SESSION['status']= "Invalid Password";
                header('location: login.php');
                exit();
            }
        }
    }
    else
    {
        $_SESSION['status']= "Invalid Email";
        header('location: login.php');
        exit();
    }

}
else
{
    $_SESSION['status']= "Access Denied";
    header('Location: login.php');
    exit();
}?>
