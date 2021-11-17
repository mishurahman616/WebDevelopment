<?php
    include "inc/header.php";
 ?>

</div>
     <div class="clear"></div>
</div>

    <div class="main">
        <div class="content" style="width: 80%; margin: 0 auto;">



        <div class="content_bottom">
                        <div class="heading">
                            <h3>Offer Products</h3>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="section group">

                        <?php	
                        $offerProducts= $pd->getOfferProduct();
                        if(!$offerProducts){
                    ?>
                    <?php
                }
                else{
                    $grid4=0;
                    while($offerProduct = $offerProducts->fetch_assoc()){
                    $grid4++;
                ?>
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($offerProduct['product_image1']);?>" alt="Image not Found" width="212px" height="212px" /></a>
                            <h2><?php echo $offerProduct['product_name']; ?> </h2>
                            <p><?php echo $fm->textShorten($offerProduct['product_desc'], 60); ?></p>
                            <p>Color: <?php echo $offerProduct['product_color']; ?></p>
                            <p><span class="price">৳<?php echo $offerProduct['product_price']; ?></span></p>
                            <div class="button"><span><a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>" class="details">Details</a></span></div>
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

        ?>









        </div>
    </div>
    </div>

<?php
     include "inc/footer.php";
?>