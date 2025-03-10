<?php
include('includes/authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php
    if(isset($_GET['prod_id']))
    {
        $prod_id = $_GET['prod_id'];
        $query = "SELECT * FROM products WHERE id='$prod_id' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $prodItem = mysqli_fetch_array($query_run);
            ?>
            
<section class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php')?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Products - Edit
                            <a href="product.php" class="btn btn-danger float-right">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST"enctype="multipart/form-data">

                            <input type="hidden" name="product_id" value="<?=$prodItem['id']?>">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Category</label>
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run)>0)
                                        {
                                            ?>
                                            <select name="category_id" required class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach($query_run as $item){ ?>
                                                    <option value="<?=$item['id'] ?>" <?= $prodItem['category_id'] == $item['id'] ? 'selected':'' ?>>
                                                        <?=$item['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                        }
                                    ?>
                                </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Name</label><br>
                                    <input type="text" name="name" class="from-control" value="<?=$prodItem['name']?>" required placeholder="Enyer Product Name" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Small Description</label>
                                    <textarea name="small_description" class="form-control" required rows="3" placeholder="Enyer Small Descriptione"><?=$prodItem['small_description']?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control" required rows="3" placeholder="Enyer Small Descriptione"><?=$prodItem['long_description']?></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="from-control" value="<?=$prodItem['price']?>" placeholder="Enyer Price">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" name="offerprice" class="from-control" value="<?=$prodItem['offerprice']?>" placeholder="Enyer Offer Price">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tax</label>
                                    <input type="text" name="tax" value="<?=$prodItem['tax']?>" required placeholder="Enyer tax">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" value="<?=$prodItem['quantity']?>" required placeholder="Enyer quantity">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status (checked = Show | Hide</label> <br>
                                    <input type="checkbox" name="status" <?=$prodItem['quantity'] == '1' ? 'checked':''?> > Show / Hide
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="image" class="from-control" >
                                    <input type="hidden" name="old_image" value="<?=$prodItem['image']?>">
                                </div>
                                <img src="uploads/product/<?=$prodItem['image']?>" width="50px" height="50px" alt="Image">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                   
                                    <button type="submit" name="product_update" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
<?php
}
else
{
    echo "No Such Product Found";
}
}
?>
    
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>