<?php
// Authentication and Database connection
include('includes/authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper -->
<div class="content-wrapper">

<section class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php')?> <!-- Message display -->
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Gift Products - ADD
                            <a href="product.php" class="btn btn-danger float-right">BACK</a> <!-- Back Button -->
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()"> <!-- Product Save Form Start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Category</label>
                                    <?php
                                        // Fetching Categories from Database
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            ?>
                                            <select name="category_id" class="form-control">
                                                <?php foreach($query_run as $item){ ?>
                                                    <option value="<?=$item['id'] ?>"><?=$item['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                        }
                                    ?>
                                </div>

                                <!-- Product Name -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Name</label><br>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product Name" >
                                        <small class="text-danger" id="name_error"></small>
                                    </div>
                                </div>

                                <!-- Small Description -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Small Description</label>
                                        <textarea name="small_description" class="form-control" rows="3" placeholder="Enter Small Description"></textarea>
                                    </div>
                                </div>

                                <!-- Long Description -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea name="long_description" class="form-control" rows="3" placeholder="Enter Long Description"></textarea>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
                                        <small class="text-danger" id="price_error"></small>
                                    </div>
                                </div>

                                <!-- Offer Price -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="text" name="offerprice" id="offerprice" class="form-control" placeholder="Enter Offer Price">
                                        <small class="text-danger" id="offerprice_error"></small>
                                    </div>
                                </div>

                                <!-- Tax -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" name="tax" class="form-control" placeholder="Enter Tax">
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Quantity">
                                        <small class="text-danger" id="quantity_error"></small>
                                    </div>
                                </div>

                                <!-- Status Checkbox -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status (checked = Show | Hide)</label> <br>
                                        <input type="checkbox" name="status"> Show / Hide
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Images</label><br>
                                        <input type="file" name="images[]" multiple>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Save</label> <br>
                                        <button type="submit" name="product_save" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>

                            </div> <!-- Row End -->
                        </form> <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>     
</div>

<!-- Frontend JavaScript Validation -->
<script>
function validateForm() {
    let name = document.getElementById('name').value.trim();
    let price = document.getElementById('price').value.trim();
    let offerprice = document.getElementById('offerprice').value.trim();
    let quantity = document.getElementById('quantity').value.trim();

    let valid = true;

    // Clear previous error messages
    document.getElementById('name_error').innerText = "";
    document.getElementById('price_error').innerText = "";
    document.getElementById('offerprice_error').innerText = "";
    document.getElementById('quantity_error').innerText = "";

    // Name validation
    if (name === "") {
        document.getElementById('name_error').innerText = "Product name is required.";
        valid = false;
    }

    // Price validation
    if (price === "" || isNaN(price) || Number(price) <= 0) {
        document.getElementById('price_error').innerText = "Enter a valid positive price.";
        valid = false;
    }

    // Offer Price validation
    if (offerprice !== "" && (isNaN(offerprice) || Number(offerprice) < 0)) {
        document.getElementById('offerprice_error').innerText = "Enter a valid offer price.";
        valid = false;
    }

    // Quantity validation
    if (quantity === "" || isNaN(quantity) || Number(quantity) < 0) {
        document.getElementById('quantity_error').innerText = "Enter a valid quantity.";
        valid = false;
    }

    return valid; // agar false return hoga to form submit nahi hoga
}
</script>

<!-- Including Scripts and Footer -->

<!-- Including Scripts and Footer -->
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>