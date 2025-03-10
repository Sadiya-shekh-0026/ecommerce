<?php
include('includes/authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

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
                            Gift Products
                            <a href="product-add.php" class="btn btn-primary float-right">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Dalete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM products";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) 
                                    {
                                        foreach($query_run as $prod_item)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $prod_item['id']; ?></td>
                                                <td><?= $prod_item['name']; ?></td>
                                                <td><?= $prod_item['price']; ?></td>
                                                <td>
                                                    <input type="checkbox" <?= $prod_item['status'] == '1' ? 'checked':'' ?> disabled/> 
                                                </td>
                                                    <td><?= $prod_item['created_at']; ?></td>
                                                <td>
                                                    <a href="product-edit.php?prod_id=<?=$prod_item['id'] ?>" class="btn btn-success">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="product_id" value="<?=$prod_item['id'] ?>">
                                                        <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
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
                                                <td colspan="7">No Record Found</td>
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
<?php include('includes/footer.php'); ?>