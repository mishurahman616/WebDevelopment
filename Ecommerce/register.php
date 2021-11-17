<?php include "inc/header.php"; 
Session::customerCheckLogin();

$customerRegMsg="";
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
     $customerRegMsg= $rg->customerRegistration($_POST);
}

?>
        <div class="main">

        <div class="container" style="padding-bottom:25px">
	<section id="content">
		<form action="register.php" method="post">
			<h1>Customer Registration</h1>
			<h2 style="color:blue"><?php echo $customerRegMsg; ?></h2>
			<div style="float:right"><a href="login.php">Already have account? Login Here!</a></div>

        <div>
				<input type="text" placeholder="Name" required="" name="customerName"/>
			</div>
            <div>
				<input type="tel" pattern="([0][1])[3-9][0-9]{2}[0-9]{6}" placeholder="01********* (Mobile)" required="" name="customerMobile"/>
			</div>
            <div>
				<input type="text" placeholder="City" required="" name="customerCity"/>
			</div>
           	<div>
				<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required="" name="customerPass"/>
			</div>
			<div>
				<input type="submit" value="Register" name="submit" />
			</div>
		</form>
  
	</section>
</div>

          
        </div>
    </div>
    <?php include "inc/footer.php"; ?>