<?php
session_start();
require "db.php";

if(isset($_SESSION["u"])){

    $p = $_GET["pid"];
    $qtytxt =$_GET["qty"];
    $umail = $_SESSION["u"]["email"];
//  echo $qtytxt.$umail.$p;
    if($qtytxt == 0){
        echo "Please Add A Quantity";
    }else{
        $cartrs = Database::search("SELECT*FROM `cart` WHERE `user_id`='".$umail."' AND `product_id`='".$p."'");
        $cn = $cartrs->num_rows;

        if($cn==1){
            echo "This Product is already exist in the cart";
        }else{
            $productrs = Database::search("SELECT `qty` FROM `product` WHERE `id`='".$p."';");
            $pr = $productrs->fetch_assoc();

            if($pr["qty"]>=$qtytxt){
                Database::iud("INSERT INTO `cart` (`user_id`,`product_id`,`qty`) VALUES('".$umail."','".$p."','".$qtytxt."')");
                echo "Success";
            }else{
                echo "Maxixmum Quantity Limit Reached ' '".$pr['qty'].".";
            }
        }
    }

}else{
    echo "Add To Cart requires Sign In";
}


?>