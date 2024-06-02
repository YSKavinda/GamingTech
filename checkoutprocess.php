<?php
session_start();
require "db.php";

if (isset($_SESSION["u"]["email"])) {
  $bemail = $_SESSION["u"]["email"];
  $arayy;


  $cartrs = Database::search("SELECT*FROM `cart` WHERE `user_id`='" . $bemail . "'");
  $cn = $cartrs->num_rows;
  if ($cn > 0) {
    $cityrs = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='" . $bemail . "'");
    $cityn = $cityrs->num_rows;
    if ($cityn == 1) {
      $cr = $cityrs->fetch_assoc();
      $cityid = $cr["city_id"];



      $add = $cr["line1"] . "," . $cr["line2"];

      $cityid = $cr["city_id"];

      $districtrs = Database::search("SELECT*FROM `city` WHERE `id`='" . $cityid . "'");
      $dr = $districtrs->fetch_assoc();
      $cityName = $dr["name"];

      $orderId = uniqid();
      $buyerrs = Database::search("SELECT*FROM `user` WHERE `email` = '" . $bemail . "';");
      $bn = $buyerrs->num_rows;
      //checking for a buyyer in database
      if ($bn == 1) {
        $buyerdata = $buyerrs->fetch_assoc();

        if ($buyerdata["status"] == "1") {
          $amount = 0;
          $item = " ";
          $delivery = "0";

          $fname = $buyerdata["fname"];
          $lname = $buyerdata["lname"];
          $mobile = $buyerdata["mobile"];
          $cityName = "";




          for ($n = 0; $n < $cn; $n++) {

            $cartdata = $cartrs->fetch_assoc();
            $cqty = (int)$cartdata["qty"];
            $prodid = $cartdata["product_id"];

            $productrs = Database::search("SELECT*FROM `product` WHERE `id`='" . $prodid . "' ");
            $pn = $productrs->num_rows;
            if ($pn == 1) {
              $pddata = $productrs->fetch_assoc();
              $ptitle = $pddata["title"];
              $pppu = (int)$pddata["price"];




              $districtId = $dr["district_id"];

              if ($districtId == "2") {
                $delivery = $pddata["delivery_fee_colombo"];
              } else {
                $delivery = $pddata["delivery_fee_other"];
              }



              $item = $item . $ptitle . " ";


              $amount = (($pppu * $cqty) + $delivery) + $amount;
            }
          }
          // echo $item;
          // echo "<br/>";
          // echo $amount;

          $arayy["oid"] = $orderId;
          $arayy["item"] = $item;
          $arayy["amount"] = $amount;
          $arayy["fn"] = $fname;
          $arayy["ln"] = $lname;
          $arayy["e"] = $_SESSION["u"]["email"];
          $arayy["m"] = $mobile;
          $arayy["addrs"] = $add;
          $arayy["city"] = $cityName;

          echo json_encode($arayy);
        }else{
           "User is Banned";
        }
      }
    }else{
      echo "Please Update Your Profile";
    }
  }else{
    echo "No product found in Cart";
  }
}else{
   echo "Please Sign In";
}
