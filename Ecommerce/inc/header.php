<?php include_once 'lib/Session.php'; 
Session::init();
include_once "lib/Database.php";
include_once "helpers/Format.php";

spl_autoload_register(function($class){
    include_once "classes/".$class."."."php";
});

$db = new Database();
$fm = new Format();
$cart = new Cart();
$ct = new Category();
$bd = new Brand();
$pd = new Product();
$rg = new CustomerRegistration();
$cl = new CustomerLogin();
$customer = new Customer();
$productAll = $pd->getAllProduct();
$catAll = $ct->getAllCat();
$brandAll=$bd->getAllBrand();
$offerProducts= $pd->getOfferProduct();
?>

<?php
    if(isset($_GET['action']) && $_GET['action']=='logout'){
        $cart->deleteCartBySessionId(session_id());
        Session::destroy();
    }
?>
<!DOCTYPE HTML>
<head>
    <title>BestDeal</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" height="120px" width="120px"/></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action = 'searchitem.php' method="POST">
                        <input type="text" name="search" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" name = "submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="cart.php" title="View my shopping cart" rel="nofollow">
                            <?php
                            if(Session::get("Total")>0){
                                ?>
                                <span class="cart_title">Cart: ৳<?php echo Session::get("Total")." | Qty:".Session::get("Quantity"); ?></span>
                                <?php

                            }else{ 
                                ?>
                                    <span class="no_product">Cart: (empty)</span>
                                <?php
                            }
                            ?> 
                        </a>
                    </div>
                </div>
                <?php if(Session::get("customerLogin")==true){
                 ?>
                 <div id="loggedin">
                    <ul style="float:right">
                        <li><a href="customerProfile.php"><?php echo Session::get("customerName"); ?></li>
                        <li><a href="?action=logout">Logout</a></li>
                    </ul>
                 </div>
                        
                   <?php
                     }else{
                    ?>
                    <div class="login"><a href="login.php">Login</a></div>
                    <?php
                    
                }
                 ?>
                
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Home</a></li>
                <li><a href="offer.php">Offer</a></li>
                <li><a href="categorylist.php">Category</a></li>
                <li><a href="brandlist.php">Brands</a></li>
                <li><a href="cart.php">Cart</a></li>
                <?php if(Session::get("customerLogin")==true){
                 ?>
                <li><a href="customerprofile.php">Account</a> </li>
                <li><a href="orderdetails.php">Order</a> </li>
                <?php } ?>
                <div class="clear"></div>
            </ul>
        </div>