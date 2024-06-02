<?php
require "db.php";

$serchtxt =$_GET["s"];
if(isset($serchtxt)){
    if(!empty($serchtxt)){
        
           $rs = Database::search("SELECT*FROM `invoice` WHERE `order_id` LIKE '%".$serchtxt."%' OR `product_id` IN (SELECT `id` FROM `product` WHERE `title` LIKE '%".$serchtxt."%') ;");
        $n = $rs->num_rows;
           for($x=0;$x<$n;$x++){
            $data = $rs->fetch_assoc();
            ?>

<div class="col-12">
<?php


if ($rs->num_rows > 0) {

    // echo $rs->num_rows;


?>
<div class="row">
<div class="col-3 col-lg-2 bg-primary text-white text-end py-2">
    <span class="fs-5 "><?php echo $data["order_id"];?></span>
</div>
<div class="col-3 col-lg-3 bg-light  py-2">
    <?php
                
                $prdrs=Database::search("SELECT * FROM `product` WHERE `id`='".$data["product_id"]."' ");
                $prd=$prdrs->fetch_assoc();
                
                ?>
    <span class="fs-5 "><?php echo $prd["title"];?></span>
</div>
<div class="col-2 col-lg-3 bg-primary text-white d-none d-lg-block py-2">
    <?php
                
                $usrs=Database::search("SELECT * FROM `user` WHERE `email`='".$data["user_email"]."' ");
                $usd=$usrs->fetch_assoc();
                
                ?>
    <span class="fs-5 "><?php echo $usd["fname"]." ".$usd["lname"];?></span>
</div>
<div class="col-4 col-lg-2 bg-light py-2">
    <span class="fs-5 ">Rs. <?php echo $data["total"];?> .00</span>
</div>

<div class="col-2 bg-primary text-white py-2">
    <span class="fs-5 d-none d-lg-block"><?php echo $data["qty"];?></span>
    <span class="fs-5 d-lg-none"><?php echo $data["qty"];?></span>
</div>
</div>
<?php

} else {
    echo "No records found !";
}


?>


</div>


          <?php
        

          }


    }else{
        echo "1";
    }
}else{
  echo "2";
}

?>