<?php include "inc/header.php"; 
if(Session::get('customerLogin') != true){
	header("location: index.php");
}
$customerInfo = $customer->getCustomerInfoById(Session::get("customerId"));





$customerUpdateMsg="";
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
     $customerUpdateMsg= $customer->customerInfoUpdate($_POST, $_FILES);
	 
}

?>


        <div class="main">

        <div class="container" style="padding-bottom:25px">
	<section id="content" style="width:80%">
<?php if($customerInfo){
	$singleCustomerInfo = $customerInfo->fetch_assoc()
?>
		<form action="customerprofile.php" method="post">
			<h1>Customer Information</h1>
			<h2 style="color:blue"><?php echo $customerUpdateMsg; ?></h2>
			<div>
				<input type="hidden" name="customerId" value="<?php echo Session::get("customerId"); ?>" class="medium" />
			</div>
        	<div>
				<label style="width:35%; color:black" for="customerName">Name: </label>
				<input style="width:70%; color:black" type="text"  value = "<?php echo $singleCustomerInfo['customer_name']; ?> " required="" name="customerName"/>
			</div>
            <div>
				<label style="width:30%; color:black" for="customerMobile">Mobile: </label>
				<input style="width:70%; color:black" type="tel" pattern="([0][1])[3-9][0-9]{2}[0-9]{6}" value="<?php echo $singleCustomerInfo['customer_mobile']; ?>"  required="" name="customerMobile"/>
			</div>
			<div>
				<label style="width:30%; color:black" for="customerEmail">Email: </label>
				<input style="width:70%; color:black" type="email" value="<?php echo $singleCustomerInfo['customer_email']; ?>" name="customerEmail"/>
			</div>
			<div>
				<label style="width:30%; color:black" for="customerAddress">Address: </label>
				<input style="width:70%; color:black" type="text" value="<?php echo $singleCustomerInfo['customer_address']; ?>" name="customerAddress"/>
			</div>
            <div>
				<label style="width:30%; color:black" for="customerCity">City: </label>
				<input style="width:70%; color:black" type="text" value="<?php echo $singleCustomerInfo['customer_city']; ?>" required="" name="customerCity"/>
			</div>

			<div>
				<?php
					if($singleCustomerInfo['customer_image']){
				?>
						<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($singleCustomerInfo['customer_image']);?>" height="100px" width="100px" alt="You have no previous Image"/> <br>
				<?php
					}
				?>
			<label style="width:30%; color:black" for="customerImage">Image: </label>
			<input style="width:70%; color:black" type="file" name="customerImage" />
			</div>

			<div>
				<input type="submit" value="Update" name="submit" />
			</div>
		</form>
  

<?php
}
?>

	</section>
</div>

          
        </div>
    </div>
    <?php include "inc/footer.php"; ?>