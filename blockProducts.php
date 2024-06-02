<?php

session_start();

require "db.php";

if(isset($_SESSION["a"])){


    $pid=$_GET["pid"];
    // echo $pid;  
    
    if(!empty($pid)){


        $prs=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
        if($prs->num_rows==1){
            $pdata=$prs->fetch_assoc();
            $sid=$pdata["status_id"];
            
            if($sid=="1"){
                Database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='".$pid."' ");
                echo "blocked";
            }else{
                Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='".$pid."' ");
                echo "unblocked";
            }

        }else{
            echo "No product found !";
        }


    }
    

}




?>