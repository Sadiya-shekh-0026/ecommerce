<?php

include('includes/authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>


<!-- Content Wrap per. Contains page content -->
<div class="content-wrapper">
    <!--User Modal -->
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="">Email Id</label>
                            <span class="email_error text-danger ml-2"></span>
                            <input type="email" name="email" class="form-control email_id" placeholder="Email">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <button type="submit" name="addUser" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!--Delete User Modal -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" class="delete_user_id ">
                            <p>
                                Are you sure. you want to delete this data ?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Yes, Delete.!</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--Delete User Modal -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid"> 
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registered Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
            if (isset($_SESSION['status'])) 
            {
                echo "<h4>".$_SESSION['status']."</h4>";
                unset($_SESSION['status']);
            }
        ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registered Users</h3>
                        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddUserModal">Add User</a>
                    </div>
                    <!-- /.card-header -->
                   <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $query = "SELECT * FROM users";
                        $query_run = mysqli_query($con, $query);
                        unset($_SESSION['status']);
     
                        if (mysqli_num_rows($query_run) > 0) 
                        {
                           foreach($query_run as $row)
                           {
                           
                           ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td>
                                    <?php 
                                    if($row['role_as'] == "0")
                                    {
                                        echo "User";
                                    }
                                    elseif($row['role_as'] == "1")
                                    {
                                        echo "Admin";
                                    }
                                    else
                                    {
                                        echo "Invalid User";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="registered-edit.php?user_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                    <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</a>
                                </td>
                            </tr>                           

                            <?php
                           }
                        }
                        else
                        {
                        ?>
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                            
                        </tbody>
                    </table>
                   </div>
                   <!-- /.card-header -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</div>

<?php include('includes/script.php'); ?>

<script>

    $(document).ready(function () {

        $('.email_id').keyup(function (e) {
            var email = $('.email_id').val();
            //console.log(email);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: {
                    'check_Emailbtn':1,
                    'email':email,
                },
                success: function (response) {
                  //  console.log(response);
                   $('.email_error').text(response);
                }

            });
        });

    });

</script>

<script>
  $(document).ready(function () {
    $('.deletebtn').click(function(e){
      e.preventDefault();

      var user_id = $(this).val();
      //consol.log(user_id);
      $('.delete_user_id').val(user_id);
      $('#DeleteModal').modal('show');
    })
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action='code.php']");
    
    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Input fields
        const name = form.querySelector("input[name='name']");
        const phone = form.querySelector("input[name='phone']");
        const email = form.querySelector("input[name='email']");
        const password = form.querySelector("input[name='password']");
        const confirmpassword = form.querySelector("input[name='confirmpassword']");

        // Clear previous error messages
        form.querySelectorAll(".text-danger").forEach(el => el.remove());

        // Name validation (alphabets only)
        if (!/^[A-Za-z\s]+$/.test(name.value.trim())) {
            showError(name, "Please enter a valid name (alphabets only).");
            isValid = false;
        }

        // Phone validation (10 digits)
        if (!/^\d{10}$/.test(phone.value.trim())) {
            showError(phone, "Please enter a valid 10-digit phone number.");
            isValid = false;
        }
        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value.trim())) {
            showError(email, "Please enter a valid email address.");
            isValid = false;
        }

        // Password validation
        if (password.value.length < 8) {
            showError(password, "Password must be at least 8 characters long.");
            isValid = false;
        }

        // Confirm password match
        if (password.value !== confirmpassword.value) {
            showError(confirmpassword, "Passwords do not match.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Stop form submission
        }
    });

    function showError(inputElement, message) {
        const error = document.createElement("small");
        error.classList.add("text-danger");
        error.innerText = message;
        inputElement.parentElement.appendChild(error);
    }
});
</script>

<?php include('includes/footer.php'); ?>