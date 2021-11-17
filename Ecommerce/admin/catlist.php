

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include("../classes/Category.php");
$ct = new Category();

$deleteMsg = "";
if(isset($_GET['action'], $_GET['catid'])){
	if($_GET['action']=="deletecat"){
		$deleteMsg=$ct->deleteCatById($_GET['catid']);
	}
}
$catAll = $ct->getAllCat();
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
							<td><strong>Category Name</strong></td>
							<td><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
				<?php	
					if($catAll){
						$catSerial=0;
						while($result = $catAll->fetch_assoc()){
							$catSerial++;
				?>
			
						<tr class="odd gradeX">
							<td><?php echo $catSerial; ?></td>
							<td><?php echo $result['cat_name']; ?></td>
							<td><a href="catedit.php?action=catedit&catid=<?php echo $result['cat_id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?action=deletecat&catid=<?php echo $result['cat_id']; ?>">Delete</a></td>

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

