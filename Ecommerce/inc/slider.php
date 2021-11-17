<div class="header_bottom">
        <div class="header_bottom_left">




            <div class="section group">
            <?php	
                if($offerProducts){
                    $grid2=0;
                    while($offerProduct = $offerProducts->fetch_assoc()){
                    $grid2++;
            ?>
                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($offerProduct['product_image1']);?>" alt="Image not Found" width="212px" height="212px" /></a>

                    </div>
                    <div class="text list_2_of_1">
                        <h2><?php echo $offerProduct['product_name'] ?></h2>
                        <p><?php echo $fm->textShorten($offerProduct['product_desc'], 50); ?></p>
                        <div class="button"><span><a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>">Add to cart</a></span></div>
                    </div>
                </div>
                <?php 
                        if($grid2 >=2) break;
                    }
                }
                ?>
            </div>

            <div class="section group">
            <?php	
                if($offerProducts){
                    $grid2=0;
                    while($offerProduct = $offerProducts->fetch_assoc()){
                    $grid2++;
                    if($grid2 <3) continue;
            ?>
                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($offerProduct['product_image1']);?>" alt="Image not Found" width="212px" height="212px" /></a>

                    </div>
                    <div class="text list_2_of_1">
                        <h2><?php echo $offerProduct['product_name'] ?></h2>
                        <p><?php echo $fm->textShorten($offerProduct['product_desc'], 50); ?></p>
                        <div class="button"><span><a href="details.php?productid=<?php echo $offerProduct['product_id'] ?>">Add to cart</a></span></div>
                    </div>
                </div>
                <?php 
                        if($grid2 >=4) break;
                    }
                }
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_bottom_right_images">
            <!-- FlexSlider -->

            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li><img src="images/1.jpg" alt="" /></li>
                        <li><img src="images/2.jpg" alt="" /></li>
                        <li><img src="images/3.jpg" alt="" /></li>
                        <li><img src="images/4.jpg" alt="" /></li>
                    </ul>
                </div>
            </section>
            <!-- FlexSlider -->