
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';
include("../classes/Category.php");
include("../classes/Brand.php");
include("../classes/Product.php");

$action=filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$productId=filter_input(INPUT_GET, 'productid', FILTER_SANITIZE_NUMBER_INT);


$ct = new Category();
$catAll = $ct->getAllCat();

$ct = new Brand();
$brandAll = $ct->getAllBrand();
$pd= new Product();

if('productedit'==$action){
    $oneProduct = $pd->getproductById($productId);
    $productName=$oneProduct['product_name'];
	$productDescription=$oneProduct['product_desc'];
    $productCategory=$oneProduct['cat_id'];
	$productBrand = $oneProduct['brand_id'];
	$productColor=$oneProduct['product_color'];
	$productPrice=$oneProduct['product_price'];
	$productImage=$oneProduct['product_image1'];
}

$ct = new Category();
$catAddMsg = false;
$catName='';
$catDescription='';
$productUpdateMsg = '';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $productUpdateMsg= $pd->productUpdate($_POST, $_FILES);
}


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <h1 style= "text-align:center"><?php echo $productUpdateMsg ?></h1>
            <table class="form">
               
			<tr>
                    <td>
                        
                    </td>
                    <td>
                        <input type="hidden" name="productId" value="<?php echo $productId; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $productName; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="productCategory">
                            <option>Select Category</option>
                            <?php	
					if($catAll){
						while($result = $catAll->fetch_assoc()){
					?>
			
                     <option <?php
					 	if($productCategory==$result['cat_id']){
							 ?> 
							 selected='selected'
							 <?php
						 }
					 ?>value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
						<?php
						}
					}
					?>

                    </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="productBrand">
                            <option>Select Brand</option>

                            <?php	
					if($brandAll){

						while($result = $brandAll->fetch_assoc()){
							
							?>

					
                        <option <?php
					 	if($productBrand==$result['brand_id']){
							 ?> 
							 selected='selected'
							 <?php
						 }
					 ?> value="<?php echo $result['brand_id'] ; ?>"><?php echo $result['brand_name'] ; ?></option>

						<?php
						}
					}
					?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Product Description</label>
                    </td>
                    <td>
                        <textarea name="productDescription" spellcheck="true" style="margin: 0px; width: 550px; height: 50px;" class="medium"><?php echo $productDescription;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product Image</label>
                    </td>
                    <td>
					<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($productImage);?>" height="50px" width="50px" /> <br>
                        <input type="file" name="productImage" class="medium" />
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Product Price</label>
                    </td>
                    <td>
                        <input type="text" name="productPrice" value="<?php echo $productPrice;?>" class="medium" />
                    </td>
                </tr>
           
  		
				<tr>
                    <td>
                        <label>Product Color</label>
                    </td>
                    <td>
                         <input type="text" name="productColor" value="<?php echo $productColor;?>" class="medium" />   
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>


