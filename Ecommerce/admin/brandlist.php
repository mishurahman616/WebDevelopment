

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include("../classes/Brand.php");
$bd = new Brand();

$deleteMsg = "";
if(isset($_GET['action'], $_GET['brandid'])){
	if($_GET['action']=="deletebrand"){
		$deleteMsg=$bd->deleteBrandById($_GET['brandid']);
	}
}

$brandAll = $bd->getAllBrand();
?>

        <div class="grid_10">
            <div class="box round first grid">
			<h1><?php echo $deleteMsg; ?></h1>
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td><strong>Serial No.</strong></td>
							<td><strong>Brand Name</strong></td>
							<td><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
				<?php	
					if($brandAll){
						$brandSerial=0;
						while($result = $brandAll->fetch_assoc()){
								$brandSerial++;
							?>

					
						<tr class="odd gradeX">
							<td><?php echo $brandSerial; ?></td>
							<td><?php echo $result['brand_name']; ?></td>
							<td><a href="brandedit.php?action=brandedit&brandid=<?php echo $result['brand_id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?action=deletebrand&brandid=<?php echo $result['brand_id']; ?>">Delete</a></td>
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

</script>
<?php include 'inc/footer.php';?>

