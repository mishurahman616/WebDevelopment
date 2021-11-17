<?php include "inc/header.php"; ?>
<?php
$productId='';
if(isset($_GET['productid'])){
    $productId = filter_input(INPUT_GET, 'productid', FILTER_SANITIZE_NUMBER_INT);
	$productId = $fm->validation($productId);
    if($productId !=""){
        $detailsProduct = $pd->getProductById($productId);
    }
	
    if(!$detailsProduct){
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
$dupplicateCheck="";
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'], $_POST['productQuantity'])){
    $productQuantity = $_POST['productQuantity'];
    
   if($productQuantity){
  
      $dupplicateCheck =$cart->insertCart($detailsProduct, $productQuantity, session_id());
      
   }
}






?>

        <div class="main">
            <div class="content">
                <div class="section group">
                    <div class="cont-desc span_1_of_2">
                        <div class="grid images_3_of_2">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($detailsProduct['product_image1']);?>" alt="Image not Found"/>
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?php echo $detailsProduct['product_name']; ?></h2>
                            <div class="price">
                                <p>Price: <span>৳<?php echo $detailsProduct['product_price']; ?></span></p>
                                <p>Category: <span><?php echo $detailsProduct['cat_name']; ?></span></p>
                                <p>Brand:<span><?php echo $detailsProduct['brand_name']; ?></span></p>
                            </div>
                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number"  min="1" class="buyfield" name="productQuantity" value="1" />
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                                </form>
                                <span style="color:red;"><?php echo $dupplicateCheck; ?></span>
                            </div>
                        </div>
                        <div class="product-desc">
                            <h2>Product Details</h2>
                            <p><?php echo $detailsProduct['product_desc']; ?></p>
                        </div>

                    </div>
                    <div class="rightsidebar span_3_of_1">
                        <h2>CATEGORIES</h2>
                        <ul>
                            <?php	
                            if($catAll){
                                while($category = $catAll->fetch_assoc()){
                            ?>
                            <li><a href="categoryview.php?action=showproduct&catid=<?php echo $category['cat_id'] ?>" ><?php echo $category['cat_name']; ?></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <?php include "inc/footer.php"; ?>