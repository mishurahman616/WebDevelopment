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
                    <h3></h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">

                <?php	
                if($catAll){
                    $grid4=0;
                    while($category = $catAll->fetch_assoc()){
                    $grid4++;
                ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <h1><?php echo $category['cat_name']; ?> </h1>
                        <div class="button"><span><a href="categoryview.php?action=showproduct&catid=<?php echo $category['cat_id'] ?>" class="details">View Products</a></span></div>
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
    </div>

<?php
     include "inc/footer.php";
?>