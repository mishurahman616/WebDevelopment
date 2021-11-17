<?php
include("../classes/Brand.php");
$ct = new Brand();
$brandAddMsg = false;
$brandName='';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $brandName = $_POST['brandName'];
}

$brandAddMsg = $ct->brandInsert($brandName);
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
            
                <h2>Add New Brand</h2>
                
               <div class="block copyblock"> 
               <h3><strong><?php echo $brandAddMsg; ?></strong></h3>
                 <form action= "brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Brand Name..." name = "brandName" class="medium" require />
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