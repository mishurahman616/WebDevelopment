<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
include("../classes/Brand.php");
include("../classes/Category.php");
include("../classes/Product.php");
$ct = new Category();
$bd = new Brand();
$pd = new Product();

$deleteMsg = "";
if(isset($_GET['action'], $_GET['productid'])){
	if($_GET['action']=="deleteproduct"){
		$deleteMsg=$pd->deleteProductById($_GET['productid']);
	}
}


$productAll = $pd->getAllProduct();
?>
<div class="grid_10">
    <div class="box round first grid">
	<h1><?php echo $deleteMsg; ?></h1>
        <h2>Product List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
				<td><strong>Serial</strong></td>
					<td><strong>Product Name</strong></td>
					<td><strong>Description</strong></td>
					<td><strong>Category</strong></td>
					<td><strong>Brand</strong></td>
					<td><strong>Image</strong></td>
					<td><strong>Color</strong></td>
					<td><strong>Price</strong></td>
					<td><strong>Action</strong></td>
				</tr>
			</thead>
			<tbody>

				<?php	
						if($productAll){
							$productSerial=0;
							while($result = $productAll->fetch_assoc()){
								$productSerial++;
								?>

						<tr class="odd gradeX">
							<td><?php echo $productSerial;?></td>
							<td><?php echo $result['product_name']; ?></td>
							<td><?php echo $fm->textShorten($result['product_desc'], 30); ?></td>
							<td><?php echo $result['cat_name']; ?></td>
							<td><?php echo $result['brand_name']; ?></td>
							<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result['product_image1']);?>" height="20px" width="20px" /> </td>
							<td><?php echo $result['product_color']; ?></td>
							<td><?php echo $result['product_price']; ?></td>
							<td><a href="productedit.php?action=productedit&productid=<?php echo $result['product_id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?action=deleteproduct&productid=<?php echo $result['product_id']; ?>">Delete</a></td>

						</tr>


							<?php
							}
						}
						?>

				
		
			</tbody>
		</table>

       </div>
    </div>
</div>


<?php include 'inc/footer.php';?>
