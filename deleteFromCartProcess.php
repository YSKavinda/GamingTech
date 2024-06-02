<?php 
session_start();

require "db.php";

if(isset($_SESSION["u"])){
    $email = $_SESSION["u"]["email"];
    $cid=$_GET["id"];

    $cartrs = Database::search("SELECT*FROM `cart` WHERE `id`='".$cid."'");
    $cf = $cartrs->fetch_assoc();
    $pid = $cf["id"];
    $recentrs = Database::search("SELECT*FROM `recent` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
    $cn = $recentrs->num_rows;
    if($cn==1){
      Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."';");
      echo "success";
    }else{
      Database::iud("INSERT INTO `recent` WHERE `id` = '".$cid."' ");
      Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."';");
      echo "success";
    }


}




?>