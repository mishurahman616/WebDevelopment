
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';
include("../classes/Category.php");
include("../classes/Brand.php");
include("../classes/Product.php");

$ct = new Category();
$catAll = $ct->getAllCat();

$ct = new Brand();
$brandAll = $ct->getAllBrand();


$ct = new Category();
$catAddMsg = false;
$catName='';
$catDescription='';
$productAddMessage = '';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'], $_FILES['productImage'])){
    $pd= new Product();
    $productAddMessage= $pd->productInsert($_POST, $_FILES);
}


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <h1 style= "text-align:center"><?php echo $productAddMessage ?></h1>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
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
			
                     <option value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
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

					
                        <option value="<?php echo $result['brand_id'] ; ?>"><?php echo $result['brand_name'] ; ?></option>

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
                        <textarea name="productDescription" spellcheck="true" style="margin: 0px; width: 550px; height: 50px;" class="medium"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product Image</label>
                    </td>
                    <td>
                        <input type="file" name="productImage" class="medium" />
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Product Price</label>
                    </td>
                    <td>
                        <input type="text" name="productPrice" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
           
  		
				<tr>
                    <td>
                        <label>Product Color</label>
                    </td>
                    <td>
                         <input type="text" name="productColor" placeholder="Enter color..." class="medium" />   
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


