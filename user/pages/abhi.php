










Warning: Undefined array key "role_as" in C:\xampp\htdocs\admin-alte-setup\web\user\index.php on line 3


<?php
									$select_cart = mysqli_query($con, "SELECT * FROM cart");
									$grand_total = 0;

									if(mysqli_num_rows($select_cart) > 0){
										while($fetch_cart = mysqli_fetch_assoc($select_cart)){


									?>
									

									<!-- <tr>
										<td><img src="../../../admin/uploads/products/<?php echo $fetch_cart['image']; ?>" height="50" width="60"></td>
										<td><?php echo $fetch_cart['name']; ?></td>
										<td>$<?php echo number_format($fetch_cart['price']); ?>/-</td>
										<td>
											<form action="" method="post">
											    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
												<input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                                <input type="submit" value="update" name="update_update_btn">
											</form>
										</td>
										<tb>$<?php echo $sub_total =number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</tb>
										<tb><a href="shoping-cart.php?remove <?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i>remove</a></tb>
									</tr>
										<?php
										$grand_total += $sun_total;
										};
									};
									?>
									<tr class="table-bottom">
										<td><a href="product.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
										<td colspan="3">grand total</td>
										<td>$<?php echo $grand_total; ?>/-</td>
										<td><a href="shoping-cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i>delete all</a></td>
									</tr> -->













                                    		<!-- <table class="table-shopping-cart">
								<thead class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2">Name</th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-5">Action</th>
								</thead>

								
									
								<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr class="table_row">
  <td class="column-1">
    <div class="cart-img-product b-rad-4 o-f-hidden">
	<img src="../../admin/uploads/<?php echo $row['image']; ?>" alt="IMG-PRODUCT">



    </div>
  </td>
  <td class="column-2"><?php echo $row['name']; ?></td>
  <td class="column-3">₹<?php echo $row['price']; ?></td>
  <td class="column-4">
    <div class="flex-w bo5 of-hidden w-size17">
      <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
      </button>
      <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="1">
      <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
      </button>
    </div>
  </td>
  <td class="column-5">₹<?php echo $row['price']; ?></td>
</tr>
<?php } ?>
</table> -->