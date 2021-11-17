<?php 
$filepath =realpath(dirname(__FILE__));
include_once $filepath.'/../../lib/Session.php'; 
include_once $filepath.'/../../helpers/Format.php'; 
Session::checkSession();

$fm = new Format();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestDeal Admin Pannel</title>
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/table/demo_page.css" media="screen" />
   

</head>
<body>
<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Our Ecommerce Site</h1>
					<p>www.bestdeal.com</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/user.png" width="15px" height="15px" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <?php
                            if(isset($_GET['action']) && $_GET['action']=='logout'){
                                Session::destroy();
                            }
                        ?>
                        <ul class="inline-ul floatleft">
                            <li><?php echo Session::get("adminFname")." ".Session::get("adminLname"); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="dashboard.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="uderconstruction.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
                <li class="ic-charts"><a href=""><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
    