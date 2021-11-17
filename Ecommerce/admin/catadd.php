<?php
include("../classes/Category.php");
$ct = new Category();
$catAddMsg = false;
$catName='';
$catDescription='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $catName = $_POST['catName'];
    $catDescription = $_POST['catDescription'];
}

$catAddMsg = $ct->catInsert($catName, $catDescription);
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
            
                <h2>Add New Category</h2>
                
               <div class="block copyblock"> 
               <h3><strong><?php echo $catAddMsg; ?></strong></h3>
                 <form action= "catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Category Name..." name = "catName" class="medium" require />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" placeholder="Category Description..." name = "catDescription" class="medium" />
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