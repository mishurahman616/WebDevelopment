<?php
	include("../classes/Adminlogin.php");
	$al = new Adminlogin();
	$loginChk = false;
	$adminEmail='';
	$adminPass='';
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$adminEmail = $_POST['adminEmail'];
		$adminPass = md5($_POST['adminPass']);
		$loginChk = $al->adminLogin($adminEmail, $adminPass);
	}
	
	
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:orange; font-size=16px;">
			<?php
				echo $loginChk;
			?>
		</span>
			<div>
				<input type="email" placeholder="Email" required="" name="adminEmail"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form>
		<div class="button">
			<a href="#">Techcrew</a>
		</div>
	</section>
</div>
</body>
</html>