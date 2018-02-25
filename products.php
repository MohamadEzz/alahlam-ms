<?php

    session_start();
    $pageTitle = 'Products';
    include 'init.php'; 

?>

<!-- Start product Section  -->
<section class="broduct">
    <div class="container">
        <div class="row">
            <div class="broduct-container text-center">
                <div class="col-md-5 col-xs-12 text-center">
                    <img class="img-circle the-broduct text-center" src="../layout/imgs/sergery/6.jpg" alt="<?php echo $item['ItemName']; ?>"/>
                </div>
                <div class="col-md-7 col-xs-12">
                    <h1><?php echo $item['ItemName']; ?></h1>
                    <p class="lead"><?php echo $item['ItemDesc']; ?></p><?php echo $item['ItemType']; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End product Section  -->



<?php 
    include $tpl . 'ourproviders.php';
    include $tpl . 'footer.php'; ?>