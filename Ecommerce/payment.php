<?php include'inc/header.php'; ?>
<?php
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<style>

.payment{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 50px;}	
.payment h2 {border-bottom: 1px solid #302F34;margin-bottom: 50px;}
.payment a {border: 1px solid #3998D6;background: #39989F;color: #fff;font-size: 20px;text-decoration: none;padding: 10px 25px;border-radius: 5px;font-weight: bold;}
.payment a:hover{background: #29bfec;}
.back { display: block;margin-top: 120px; float: left;}
.back a { border: 1px solid; background: #29bfec; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 18px;}
.back a:hover{background: #39989F; color: #fff; }
</style>

<div class="main">
	<div class="content">
		<div class="section group">

			<div class="payment">
				<h2>Choose Payment Method</h2>
				<a href="paymentoffline.php">Cash on delivery</a>
				<a href="payentonline.php">Online Payment</a>

				<div class="back">
				<a href="cart.php">Back</a>
			</div>
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