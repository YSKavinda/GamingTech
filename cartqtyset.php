<?php

require "db.php";
session_start();

if(isset($_SESSION["u"])){



if(isset($_GET["cqty"])){
    if(!empty($_GET["cqty"] && $_GET["cid"])){

        $cqty = $_GET["cqty"];
        $cid =$_GET["cid"];


        if(!is_numeric($cqty) || $cqty=="e"){

            echo "1";
          
        }else{
            $cartrs = Database::search("SELECT*FROM `cart` WHERE `id` = '".$cid."' ");
            if($cartrs->num_rows==1){
                $cartdata = $cartrs->fetch_assoc();
                    $pid = $cartdata["product_id"];
                $productrs = Database::search("SELECT*FROM `product` WHERE `id`='".$pid."' ");
                if($productrs->num_rows==1){
                $productdata = $productrs->fetch_assoc();
                $pqty = $productdata["qty"];
    
                if($cqty<=$pqty && $cqty>0){
                    
                    Database::iud("UPDATE `cart` SET `qty`='".$cqty."' WHERE `id` = '".$cid."' ");
                    echo "success";

                }else{
                    echo "1";
                }
                   
                }
    
    
            }
        }
                                  
        

        



    }else{
        echo "1";
    }
}else{
    echo "1";
}

  

}


?>