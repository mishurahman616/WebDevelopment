<?php
    include "inc/header.php";
?>
<?php 

if(isset($_POST["submit"])){
    $search = $_POST['search'];
    $searchResult=$pd->searchProduct($search);
}else{
 header("location: index.php");   
}





?>
</div>
     <div class="clear"></div>
</div>

    <div class="main">
        <div class="content">

            <div class="content_bottom">
                <div class="heading">
                    <h3>Search Products</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">

                <?php	
        if($searchResult){
            $grid4=0;
            while($result = $searchResult->fetch_assoc()){
            $grid4++;
        ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?productid=<?php echo $result['product_id'] ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result['product_image1']);?>" alt="Image not Found" width="212px" height="212px" /></a>
                    <h2><?php echo $result['product_name']; ?> </h2>
                    <p><?php echo $fm->textShorten($result['product_desc'], 50); ?></p>
                    <p>Color: <?php echo $result['product_color']; ?></p>
                    <p><span class="price">৳<?php echo $result['product_price']; ?></span></p>
                    <div class="button"><span><a href="details.php?productid=<?php echo $result['product_id'] ?>" class="details">Details</a></span></div>
                </div>
        <?php
                
           
            if($grid4==4){
                $grid4=0;
                ?>
                </div>
                <div class="content_bottom">
                <div class="heading">
                    <h3></h3>
                </div>
                <div class="clear"></div>
            </div>
                <div class="section group">
                <?php
                }
            }
        }else{
            echo "<h1> No product Match with '{$search}'</h1>";
        }
        ?>


            </div>
        </div>
    </div>
    </div>

<?php
     include "inc/footer.php";
?>