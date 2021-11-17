<?php include "inc/header.php"; 
Session::customerCheckLogin();
?>
<?php
	$cl = new CustomerLogin();
	$loginChk = false;
	$clMobile='';
	$clPass='';
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$clMobile = $_POST['customerMobile'];
		$clPass = hash("sha512", $_POST['customerPass']);
		$loginChk = $cl->customerLogin($clMobile, $clPass);
	}
	
	
?>
        <div class="main">

        <div class="container" style="padding-bottom:25px">
	<section id="content">
		<form action="login.php" method="post">

			<h1>Customer Login</h1>
			<h2 style="color:blue"><?php echo $loginChk; ?></h2>
			<div style="float:right"><a href="register.php">No Account? Register Here!</a></div>

            <div>
				<input type="tel" pattern="[0][1][3-9][0-9]{2}[0-9]{6}" placeholder="Mobile No" required="" name="customerMobile"/>
			</div>
			<div>
				<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" placeholder="Password" required="" name="customerPass"/>
			</div>
			<div>
				<input type="submit" name="submit" value="Login" />
			</div>
		</form>
	</section>
</div>

          
        </div>
    </div>
    <?php include "inc/footer.php"; ?>