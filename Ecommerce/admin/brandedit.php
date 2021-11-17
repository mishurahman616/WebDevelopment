<?php
include("../classes/Brand.php");

$action=filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$brandId=filter_input(INPUT_GET, 'brandid', FILTER_SANITIZE_NUMBER_INT);



$bd = new Brand();
$brandUpdateMsg = false;
$brandName='';

if('brandedit'==$action){
	$brandName = $bd->getBrandNameById($brandId);
    
	
}
if(($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['submit'])){
	$brandId = $_POST['brandId'];
	$brandName = $_POST['brandName'];
	$brandUpdateMsg = $bd->brandUpdate($brandId, $brandName);
	
}
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
            
                <h2>Update Brand</h2>
                
               <div class="block copyblock"> 
               <h3><strong><?php echo $brandUpdateMsg; ?></strong></h3>
                 <form action= "" method="post">
                    <table class="form">
					<tr>
                            <td>
                                <input type="hidden" name="brandId" class="medium" value="<?php echo $brandId; ?>"> 
                            </td>
                            </tr>					
                        <tr>
                            <td>
                                <input type="text" placeholder="Brand Name..." name = "brandName" class="medium" value="<?php echo $brandName; ?>" require />
                            </td>
                        </tr>
                       	<tr> 
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