<?php
//session_start();
include('includes/authentication.php');
include('config/dbcon.php');



if(isset($_POST['delete_product']))
{
    $product_id = $_POST['product_id'];
    $query = "DELETE FROM products WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Deleted Successfully";
        header('Location: product.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Product Not Deleted";
        header('Location: product.php');
        exit(0);
    }
}


if(isset($_POST['product_update']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'] ?? '0.00'; // Default offer price
    $tax = $_POST['tax'] ?? '0';// Default tax
    $quantity = $_POST['quantity'];
    $status = isset($_POST['status']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    // Image Handling
    if($image != '')
    {
        $allowed_extension = array('png','jpg','jpeg');
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);  
        $update_filename = time().'.'.$file_extension;

        if(!in_array($file_extension, $allowed_extension))
        {
            $_SESSION['status'] = "You are allowed with only jpg, png, jpeg Image";
            header("Location: product-add.php");
            exit(0);
        }

    }
    else
    {
        $update_filename = $old_image;
    }


    // Update Query
    $query = "UPDATE products SET  
                category_id='$category_id',
                name='$name',
                small_description='$small_description',
                long_description='$long_description',
                price='$price',
                offerprice='$offerprice',
                tax='$tax',
                quantity='$quantity',
                image='$update_filename',
                status='$status'
              WHERE id='$product_id'";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        if($image != '')
        {
            // **Nayi image move karo**
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/product/'.$update_filename);

            // **Purani image delete karo agar new image upload hui ho**
            if(file_exists('uploads/product/'.$old_image))
            {
                unlink("uploads/product/".$old_image);
            }
        }
        $_SESSION['status'] = "Product Updated Successfully";
        header('Location: product-edit.php?prod_id='.$product_id);
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Product Not Updated";
        header('Location: product-edit.php?prod_id='.$product_id);
        exit(0);
    }
}

if(isset($_POST['product_save']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'] ?? '0.00';// Default value
    $tax = $_POST['tax'] ?? '0';// Default value
    $quantity = $_POST['quantity'];
    $status = $_POST['status'] == true ? '1': '0';
    $image = $_FILES['image']['name'];

    $allowed_extension = array('png','jpg','jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$file_extension;

    if(!in_array($file_extension, $allowed_extension))
    {
        $_SESSION['status'] = "You are allowed with only jpg, png, jpeg Image";
        header("Location: product-add.php");
        exit(0);
    }
    else
    {
        $query = "INSERT INTO products (category_id,name,small_description,long_description,price,offerprice,tax,quantity,image,status) 
        VALUES ('$category_id','$name','$small_description','$long_description','$price','$offerprice','$tax','$quantity','$filename','$status')";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/product/'.$filename);
            $_SESSION['status'] = "Product Added Successfully";
            header("Location: product-add.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong";
            header("Location: product-add.php");
            exit(0);
        }


    }

}


if(isset($_POST['category_save']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = $_POST['trending'] == true ? '1': '0';
    $status = $_POST['status'] == true ? '1': '0';

    $category_query = "INSERT INTO categories (name,description,trending,status) VALUES ('$name','$description','$trending','$status')";
    $cate_query_run = mysqli_query($con, $category_query);
    if($cate_query_run)
    {
        $_SESSION['status'] = "category Inserted Successfully";
        header("Location: category.php");
        exit();
    }
    else
    {
        $_SESSION['status'] = "category Inserted Failed";
        header("Location: category.php");
        exit();
    }

}



if(isset($_POST['category_update']))
{
    $cate_id = $_POST['cate_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = $_POST['trending'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE categories SET name='$name', description='$description', trending='$trending', status='$status' WHERE id='$cate_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Category Updated Successfully";
        header("Location: category.php");
        exit();
    }
    else
    {
        $_SESSION['status'] = "Category Update Failed";
        header("Location: category.php");
        exit();
    }
}


if(isset($_POST['cate_delete_btn']))
{
    $cate_id =$_POST['cate_delete_id'];
    $query ="DELETE FROM categories WHERE id='$cate_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Category Deleted Successfully";
        header("Location: category.php");
        exit();
    }
    else
    {
        $_SESSION['status'] = "Category Deleteing Failed";
        header("Location: category.php");
        exit();
    }
}

  

if(isset($_POST['check_Emailbtn']))
{
    $email = $_POST['email'];
    $checkemail = "SELECT email FROM users WHERE email='$email' ";
    $checkemail_run = mysqli_query($con, $checkemail);

    if(mysqli_num_rows($checkemail_run) > 0)
    {
        echo "Email Already Exists!";
    }
    else
    {
        echo "";
    }
}


if(isset($_POST['addUser']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password == $confirmpassword)
    {
        $checkemail = "SELECT email FROM users WHERE email='$email' ";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0)
        {
            //taken- already exists
            $_SESSION['status'] = "Email id is already taken";
            header("Location: registered.php");
            exit;
        }
        else
        {
            //available - record not found
            $user_query = "INSERT INTO users (name,phone,email,password) VALUES ('$name','$phone','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['status'] = "User Added Successfully";
                header("Location: registered.php");
                exit();
    
                $_SESSION['status'] = "User Registered Failed";
                header("Location: registered.php");
                exit();
            }
        }

    }
    else
    {
        $_SESSION['status'] = "Password and Confirm Password does not match";
        header("Location: registered.php");
        exit(); 
    }
    
}



if(isset($_POST['updateUser']))
{
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];

    $query = "UPDATE users SET name='$name', phone='$phone',email='$email',password='$password',role_as='$role_as' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Updateing Successfully";
        header("Location: registered.php");
        exit();

        $_SESSION['status'] = "User Updateing Failed";
        header("Location: registered.php");
        exit();
    }
}

if(isset($_POST['DeleteUserbtn']))
{
    $userid = $_POST['delete_id'];

    $query ="DELETE FROM users WHERE id='$userid' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Deleting Successfully";
        header("Location: registered.php");
        exit();

        $_SESSION['status'] = "User Deleting Failed";
        header("Location: registered.php");
        exit();
    }
}


if (isset($_POST['registerbtn'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $errors = [];

    // Name validation (alphabets only)
    if (!preg_match("/^[A-Za-z ]+$/", $name)) {
        $errors[] = "Please enter a valid name (alphabets only).";
    }

    // Phone validation (10 digits)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    // Password match
    if ($password !== $cpassword) {
        $errors[] = "Passwords do not match.";
    }

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Email already exists.";
    }

    if (count($errors) > 0) {
        // Agar error hai to alert show karo
        foreach ($errors as $error) {
            echo "<script>alert('$error'); window.location.href='registered.php';</script>";
        }
    } else {
        // Sab valid hai to insert karo
        $query = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            echo "<script>alert('User registered successfully.'); window.location.href='registered.php';</script>";
        } else {
            echo "<script>alert('Something went wrong.'); window.location.href='registered.php';</script>";
        }
    }
}


include('config/dbcon.php');

if(isset($_POST['category_save']))
{
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $trending = isset($_POST['trending']) ? '1':'0';
    $status = isset($_POST['status']) ? '1':'0';

    // Regex patterns
    $name_pattern = "/^[A-Za-z\s]+$/";
    $desc_pattern = "/^[A-Za-z0-9\s.,!()\-]+$/";

    // Backend Validation
    if(empty($name) || empty($description)) {
        $_SESSION['message'] = "All fields are required.";
        header("Location: category.php");
        exit(0);
    }
    elseif(!preg_match($name_pattern, $name)) {
        $_SESSION['message'] = "Category Name should contain only alphabets.";
        header("Location: category.php");
        exit(0);
    }
    elseif(!preg_match($desc_pattern, $description)) {
        $_SESSION['message'] = "Description can contain only letters, numbers and some symbols (, . ! ( ) -)";
        header("Location: category.php");
        exit(0);
    }
    else {
        // Inserting into DB
        $query = "INSERT INTO categories (name, description, trending, status) 
                  VALUES ('$name', '$description', '$trending', '$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Category added successfully";
        }
        else
        {
            $_SESSION['message'] = "Something went wrong!";
        }
        header("Location: category.php");
        exit(0);
    }
}


?>






        