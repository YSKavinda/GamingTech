<?php
require "db.php";
if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $product = Database::search("SELECT*FROM `product` WHERE `id` = '" . $pid . "'");
    $pn = $product->num_rows;

    if ($pn == 1) {
        $cartrs = Database::search("SELECT*FROM `cart` WHERE `product_id`='" . $pid . "' ");
        $watchlistrs = Database::search("SELECT*FROM `watchlist` WHERE `product_id`= '" . $pid . "'");
        $invoicers = Database::search("SELECT*FROM `invoice` WHERE `product_id`='" . $pid . "'");
        $recentrs = Database::search("SELECT*FROM `recent` WHERE `product_id`='".$pid."' ");
        if ($cartrs->num_rows > 0) {
             echo "1";
        } else if ($watchlistrs->num_rows > 0) {
             echo "2";
        } else if ($invoicers->num_rows > 0) {
             echo "3";
        } else if($recentrs->num_rows>0){
            echo "4";
        }
        else{

            $proImagers = Database::search("SELECT*FROM `image` WHERE `product_id`='" . $pid . "' ");
            if ($proImagers->num_rows == 1) {
                $prIdata = $proImagers->fetch_assoc();
                Database::iud("DELETE FROM `image` WHERE `code` = '".$prIdata["code"]."'; ");
            }

            Database::iud("DELETE FROM `product` WHERE `id`='".$pid."'");
            echo "Product Deleted";
        }
    } else {
        echo "Product Doesn't Exist";
    }
}
