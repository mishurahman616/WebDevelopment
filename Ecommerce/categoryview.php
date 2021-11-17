<?php
    include "inc/header.php";
 ?>

</div>
     <div class="clear"></div>
</div>

    <div class="main">
        <div class="content" style="width: 80%; margin: 0 auto;">

            <?php
                if(isset($_GET['action'], $_GET['catid'])){
                    if($_GET['action']=="showproduct"){
                        ?>


        <div class="content_bottom">
                        <div class="heading">
                            <h3></h3>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="section group">

                        <?php	
                    $catViewProduct= $pd->getProductByCategory($_GET['catid']);
                if(!$catViewProduct){
                    ?>
                    <?php
                }
                else{
                    $grid4=0;
                    while($catView = $catViewProduct->fetch_assoc()){
                    $grid4++;
                ?>
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="details.php?productid=<?php echo $catView['product_id'] ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($catView['product_image1']);?>" alt="Image not Found" width="212px" height="212px" /></a>
                            <h2><?php echo $catView['product_name']; ?> </h2>
                            <p><?php echo $fm->textShorten($catView['product_desc'], 60); ?></p>
                            <p>Color: <?php echo $catView['product_color']; ?></p>
                            <p><span class="price">৳<?php echo $catView['product_price']; ?></span></p>
                            <div class="button"><span><a href="details.php?productid=<?php echo $catView['product_id'] ?>" class="details">Details</a></span></div>
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
                }

                }else{
                    header("Location: index.php");
                }
            }else{
                header("Location: index.php");
            }
        ?>









        </div>
    </div>
    </div>

<?php
     include "inc/footer.php";
?>