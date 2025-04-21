<?php

include('includes/authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Modal -->
<div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gift Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="categoryForm" action="code.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" name="name" class="form-control" >
                    <small class="text-danger" id="nameError"></small>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                    <small class="text-danger" id="descError"></small>
                </div>
                <div class="form-group">
                    <label for="">Trending</label>
                    <input type="checkbox" name="trending"> Trending
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <input type="checkbox" name="status"> Status             
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="category_save" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
  </div>
</div>


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php')?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Gift Category
                                <a href="#" data-toggle="modal" data-target="#CategoryModal" class="btn btn-primary float-right">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Trending</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Dalete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) 
                                        {
                                            foreach($query_run as $cateitem)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $cateitem['id']; ?></td>
                                                    <td><?= $cateitem['name']; ?></td>
                                                    <td>
                                                        <input type="checkbox" <?= $cateitem['trending'] == '1' ? 'checked':'' ?> disabled/> 
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" <?= $cateitem['status'] == '1' ? 'checked':'' ?> disabled/> 
                                                    </td>
                                                        <td><?= $cateitem['created_at']; ?></td>
                                                    <td>
                                                    <a href="category-edit.php?id=<?= $cateitem['id']; ?>" class="btn btn-success">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="code.php" method="POST">
                                                            <input type="hidden" name="cate_delete_id" value="<?= $cateitem['id']; ?>">
                                                            <button type="submit" name="cate_delete_btn" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>                           
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="6">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>     
        
</div>


<?php include('includes/script.php'); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action='code.php']");
    const nameInput = form.querySelector("input[name='name']");
    const descInput = form.querySelector("textarea[name='description']");

    form.addEventListener("submit", function (event) {
        let isValid = true;
        let nameValue = nameInput.value.trim();
        let descValue = descInput.value.trim();

        // Category Name: only letters and space
        const nameRegex = /^[A-Za-z\s]+$/;
        // Description: allow letters, numbers, space, and basic punctuation
        const descRegex = /^[A-Za-z0-9\s.,!()\-]+$/;

        if (nameValue === "") {
            alert("Category Name is required.");
            isValid = false;
        } else if (!nameRegex.test(nameValue)) {
            alert("Category Name should contain only alphabets.");
            isValid = false;
        }

        if (descValue === "") {
            alert("Description is required.");
            isValid = false;
        } else if (!descRegex.test(descValue)) {
            alert("Description can only contain alphabets, numbers, and basic punctuation.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>



<?php include('includes/footer.php'); ?>