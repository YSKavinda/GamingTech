<?php
session_start();
require "db.php";
if (isset($_GET["oid"])) {

    if (isset($_SESSION["u"]["email"])) {

        $usermail = $_SESSION["u"]["email"];

        $cartrs = Database::search("SELECT*FROM `cart` ");
        $cartn = $cartrs->num_rows;

        if ($cartn > 0) {

            for ($x = 0; $x < $cartn; $x++) {
                $orderId = $_GET["oid"];
                $cartdata = $cartrs->fetch_assoc();

                $datetime = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $datetime->setTimezone($tz);
                $date = $datetime->format("Y-m-d H:i:s");




                $productrs = Database::search("SELECT*FROM `product` WHERE `id`='" . $cartdata["product_id"] . "'; ");
                if ($productrs->num_rows > 0) {
                    $productdata = $productrs->fetch_assoc();

                    $delivery = 0;

                    $addrs = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='" . $cartdata["user_id"] . "'; ");
                    if ($addrs->num_rows > 0) {

                        $addata = $addrs->fetch_assoc();
                        $cityrs = Database::search("SELECT*FROM `city` WHERE `id`='" . $addata["city_id"] . "'");

                        $cityd = $cityrs->fetch_assoc();

                        $districtrs = Database::search(" SELECT*FROM `district` WHERE `id`='" . $cityd["district_id"] . "' ");
                        $districtdata = $districtrs->fetch_assoc();

                        if ($districtdata["id"] == 2) {
                            $delivery =  $productdata["delivery_fee_colombo"];
                        } else {
                            $delivery = $productdata["delivery_fee_other"];
                        }

                        $pid = $productdata["id"];
                        $pqty = (int)$productdata["qty"];
                        $proprc = (int)$productdata["price"];
                        $cqty = (int)$cartdata["qty"];
                        $total =($proprc * $cqty) + (int)$delivery;


                        Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`) VALUES('" . $orderId . "','" . $pid . "','" . $usermail . "','" . $date . "','".$total."','".$cqty."') ");
                        
                        $pqty = $pqty-$cqty;

                        Database::iud("UPDATE `product` SET `qty`='".$pqty."' WHERE `id`='".$pid."' ");

                    }
                }
            }
            Database::iud("DELETE FROM `cart` WHERE `user_id`='".$usermail."'");
            echo "success";
        }
    }
}
