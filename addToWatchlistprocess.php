<?php
session_start();

require "db.php";

if(isset($_SESSION["u"])){
    $uemail = $_SESSION["u"]["email"];
    $id = $_GET["pid"];

    $watchlistrs = Database::search("SELECT*FROM `watchlist` WHERE `product_id`='".$id."' AND `user_email`='".$uemail."';");
    $n = $watchlistrs->num_rows;

    if($n==1){
        echo "You have Recently added this product to the watchlist";
    }else{
        Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES('".$id."','".$uemail."')");
        echo "success";
    }

   
}
?>