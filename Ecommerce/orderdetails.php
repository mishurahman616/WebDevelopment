<?php include'inc/header.php'; ?>
<?php
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
<style>
.tblone td{text-align: left;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>Your Order Details </h2>

		 		<?php
					if (isset($_GET['deleteCstProduct'])) {
						$cmrId = $_GET['deleteCstProduct'];
						$time  = $_GET['time'];
						$price = $_GET['price'];

					$deleteProduct = $ocl->deleteProductPermanent($cmrId, $time, $price);
					}

					if (isset($deleteProduct)) {
						echo $deleteProduct;
					}
				?>   
				<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Total Price</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						<?php
							$customerId = Session::get("customerId");
							$getOrder = $cart->getOrderProducts($customerId);
							if ($getOrder) {
								$i = 0;
								while ($result = $getOrder->fetch_assoc()) {
								$i++;
						?>
							<tr>
								<td> <?php echo $i; ?> </td>
								<td> <?php echo $result['product_name'] ;?> </td>
								<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result['product_image']);?>" alt="Image not Found" width="212px" height="212px" /></td>
								<td> <?php echo $result['product_quantity'] ;?> </td>

								<td> 
								৳<?php 
									echo $total = $result['product_price']+60;
									?> 
								</td>
								<td> <?php echo $fm->formatDate($result['date']) ;?> </td>
								<td>
									<?php
										if ($result['status']=='0') {
											echo "Pending";
										}else{
											echo "Delivered Processing";
										}
									?>
								 </td>

								 <?php
								 	if ($result['status']=='1') { ?>
								 		<td>N/A</td>
								<?php	} else{?>
									
									<td>
										<a onclick="return confirm('Are Sure To Delete This Product ?')" href="?deleteCstProduct=<?php echo $result['customer_id']; ?> & price=<?php echo $result['product_price']; ?> & time=<?php echo $result['date']; ?> ">Cancel</a>
									</td>
								<?php	}?>
								
							</tr>

						 <?php } } ?>	
						</table>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>



   <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include'inc/footer.php'; ?>