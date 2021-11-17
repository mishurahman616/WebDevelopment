<?php
include("../classes/Category.php");

$action=filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$catId=filter_input(INPUT_GET, 'catid', FILTER_SANITIZE_NUMBER_INT);



$ct = new Category();
$catUpdateMsg = false;
$catName='';
$catDescription='';
if('catedit'==$action){
    $result = $ct->getCategoryById($catId);
    $catName=$result['cat_name'];
    $catDescription=$result['cat_description'];
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $catId = $_POST['catId'];
    $catName = $_POST['catName'];
    $catDescription = $_POST['catDescription'];
    $catUpdateMsg = $ct->catUpdate($catId, $catName, $catDescription);
}

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
            
                <h2>Update Category</h2>
                
               <div class="block copyblock"> 
               <h3><strong><?php echo $catUpdateMsg; ?></strong></h3>
                 <form action= "" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="hidden" name="catId" class="medium" value="<?php echo $catId; ?>"> 
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <input type="text" placeholder="Category Name..." name = "catName" class="medium" value="<?php echo $catName; ?>" require />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text-area" placeholder="Category Description..." name = "catDescription" class="medium" value="<?php echo $catDescription; ?>" />
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