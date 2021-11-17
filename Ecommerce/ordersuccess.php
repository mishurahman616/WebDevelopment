<?php include'inc/header.php'; ?>
<?php

if('http://bestdeal.com/paymentoffline.php'!=$_SERVER['HTTP_REFERER']){
	header("Location:login.php");
};
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<style>

.payment{width: 550px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 50px;}	
.payment h2 {border-bottom: 1px solid #302F34;margin-bottom: 50px;}
.payment p{font-size: 18px; line-height: 23px; text-align: left;}

</style>

<div class="main">
	<div class="content">
		<div class="section group">

			<div class="payment"> 
				<h2> Order Successfully Placed</h2>
				<?php
					$customerId = Session::get("customerId");
					$amount = $cart->paymentAmount($customerId);
		
					if ($amount) {
						$sum = 0;
						while ($result = $amount->fetch_assoc()) {
							$price = $result['product_price'];
							$sum = $sum + $price;
						}
					
				?>
				<p style="color: red" >Total Payable Amount : ৳
					<?php
						$deliveryCharge = 60;
						echo $total = $sum + $deliveryCharge;
					}
					?>
				 </p>
				<p>Thanks For Purchase. Receive Your Order Successfully.</p>
				<p>We Will Contact You As Soon As Prossible With Delivery Details. </p>
				<p>Here Your Order Details ... <a href="orderdetails.php">Click For Order Details</a> </p>

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