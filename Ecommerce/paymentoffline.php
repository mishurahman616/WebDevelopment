<?php include'inc/header.php'; ?>
<?php
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<?php
	if (isset($_GET['order']) && $_GET['order']=='order' ) {
		$customerId = Session::get("customerId");
		$insertOrder = $cart->dataInsertToOrderTbl(session_id() , $customerId);
		$deleteData = $cart->deleteCartBySessionId(session_id());

		header("Location:ordersuccess.php");
	}
?>

<style>
.division{width: 50%; float: left;}
.tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td{text-align: justify;}
.tbltwo{float:right;text-align:left;width:60%;border: 2px solid #ddd; margin-right: 15px; margin-top: 10px; padding-left: 10px;} 
.tbltwo tr td{text-align: justify; padding: 5px 10px;}


.button{width: 62%; min-height: 20px; padding: 50px;}	
.back{float: left;}
.back a {background: #29bfec;padding: 15px;font-size: 25px;color: #fff;border-radius: 5px;}
.back a:hover{background: #39989F; color: #fff; }
.next{float: right;}
.next a {background: #29bfec;padding: 15px;font-size: 25px;color: #fff;border-radius: 5px;}
.next a:hover{background: #39989F; color: #fff; }
</style>

<div class="main">
	<div class="content">
		<div class="section group">
			
			<div class="division">
				<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>
						<?php
							$getProduct = $cart->getCartProductBySessionId(session_id());

							if ($getProduct) {
								$i = 0;
								$sum = 0;
								$quantity = 0;
								while ($result = $getProduct->fetch_assoc()) {
								$i++;
						?>
							<tr>
								<td> <?php echo $i; ?> </td>
								<td> <?php echo $result['product_name'] ;?> </td>
								<td><img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($result['product_image']); ?>" alt="" /></td>
								<td> ৳<?php echo $result['product_price'] ;?> </td>
								<td> <?php echo $result['product_quantity'] ;?> </td>

								<td> 
								৳<?php 
									echo $total = $result['product_price'] * $result['product_quantity'];
									?> 
								</td>
							</tr>

							<?php
								$sum = $sum + $total;
								$quantity +=  $result['product_quantity'];
								
							?>

						 <?php }  ?>	
						</table>

					
						<table class="tbltwo">
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td>৳<?php echo $sum ;?></td>
							</tr>
							<tr>
								<td>Delivery Charge</td>
								<td>:</td>
								<td> ৳<?php echo $deliveryCharge= 60; ?> </td>
							</tr>
							<tr>
								<td>Total Bill</td>
								<td>:</td>
								<td>
								৳<?php
										echo $GrandTotal = $sum + $deliveryCharge;
									?>
								</td>
							</tr>
					   </table>
					   <?php } ?>
			</div>
			<div class="division">
				<?php
				$id = Session::get("customerId");
				$getData = $customer->getCustomerInfoById($id);

				if ($getData) {
					while ($result = $getData->fetch_assoc()) {
				
			?>
				<table class="tblone">
					<tr>
						<td colspan="3"><h2>Your Profile Information</h2></td>
						
					</tr>
					<tr>
						<td width="20%">Name</td>
						<td width="5%">:</td>
						<td> <?php echo $result['customer_name'] ;?> </td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>:</td>
						<td> <?php echo $result['customer_email'] ;?> </td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td> <?php echo $result['customer_mobile'] ;?> </td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<?php $customerAddress = $result['customer_address'] ?>
						<td> <?php echo $result['customer_address'] ;?> </td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td> <?php echo $result['customer_city'] ;?> </td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td> <a href="customerprofile.php">Edit Information</a> </td>
					</tr>
					
				</table>
			<?php } } ?>
			</div>

		</div>

		<div class="button">
			<div class="back">
				<a href="payment.php">Back</a>
			</div>
			<div class="next">
			<?php if($customerAddress != ''){ ?>
				<a href="?order=order">Confirm order</a>
				<?php }else{
					
				 ?>
				 Add Address to confirm order
				 <?php } ?>
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