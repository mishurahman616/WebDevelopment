<?php include "inc/header.php"; ?>

<?php


if(isset($_POST['update'], $_POST['cartId'])){
    
    $cartId = $_POST['cartId'];
    $quantity = $_POST['productQuantity'];
	$cart->updateCartQuantity($cartId, $quantity);
	
}




  if(isset($_GET['action'], $_GET['cartid'])){
   if($_GET['action']=="deletecart"){
       $cartId = $_GET['cartid'];
        $cart->deleteCartByCartId($cartId);
   }
}
    ?>



<?php 
if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=load' />";
}

$cartProducts = $cart->getCartProductBySessionId(session_id());

?>
        <div class="main">
            <div class="content">
                <div class="cartoption">
                    <div class="cartpage">
                        <h2>Your Cart</h2>
                        <table class="tblone">
                        <?php 
                        if($cartProducts){
                           ?>
                            <tr>
                                <th width="5%">Serial</th>
                                <th width="20%">Product Name</th>
                                <th width="10%">Image</th>
                                <th width="10%">Unit Price</th>
                                <th width="20%">Quantity</th>
                                <th width="10%">Color</th>
                                <th width="15%">Total Price</th>
                                <th width="10%">Action</th>
                            </tr>
                            <?php 
                                $cartProductCount =0;
                                $total = 0;
                                $totalQuantity=0;
                            while($cartProduct = $cartProducts->fetch_assoc()){
                                $cartProductCount++;

                             ?>
                                <tr>
                                    <td><?php echo $cartProductCount; ?></td>
                                    <td><?php echo $cartProduct['product_name']; ?></td>
                                    <td><img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($cartProduct['product_image']); ?>" alt="" /></td>
                                    <td><?php echo $cartProduct['product_price']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="cartId" value="<?php echo $cartProduct['cart_id']; ?>">
                                            <input type="number" min="1" name="productQuantity" value="<?php $totalQuantity+=$cartProduct['product_quantity']; echo $cartProduct['product_quantity']; ?>" />
                                            <input type="submit" name="update" value="Update" />
                                        </form>
                                    </td>
                                    <td><?php echo $cartProduct['product_color']; ?></td>
                                    <td>TK <?php $productprice =$cartProduct['product_price'] * $cartProduct['product_quantity']; 
                                                    $total+=$productprice;
                                                    echo $productprice;
                                                ?></td>
                                    <td><a href="?action=deletecart&cartid=<?php echo $cartProduct['cart_id'] ?>">delete</a></td>
                                    <?php
                                Session::set("Total", $total);
                                Session::set("Quantity", $totalQuantity);

                            ?>
                                </tr>
                            <?php
                            }
                        ?>
                        </table>
                        <table style="float:right;text-align:left;" width="40%">
                            <tr>
                                <th>Sub Total : </th>
                                <td><?php echo $total;?></td>
                            </tr>
                      
                        </table>
                    </div>
                    <div class="shopping">
                        <div class="shopleft">
                            <a href="index.php"> <img src="images/shop.png" alt="Continue Shopping" /></a>
                        </div>
                        <div class="shopright">
                            <a href="payment.php"> <img src="images/check.png" alt="Chekout" /></a>
                        </div>
                    </div>
                    <?php 
                            }else{
                                
                                Session::set("Total", 0);
                                Session::set("Quantity", 0);
                            
                                ?>
                                <h1 style="text-align:center; margin-bottom:130px;"> <strong>Your cart is empty</strong> </h1>
                                
                                <?php
                            }

                        ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <?php include "inc/footer.php"; ?>