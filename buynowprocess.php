<?php
session_start();
require "db.php";

if(isset($_SESSION["u"])){
    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $orderId = uniqid();


    $productrs = Database::search("SELECT*FROM `product` WHERE `id` = '".$id."'");
    $pr = $productrs->fetch_assoc();

  
    $cityrs = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='".$umail."'");
    $cn = $cityrs->num_rows; 


    if($cn ==1){
        $cr = $cityrs->fetch_assoc();
        $cityid=$cr["city_id"];



        $add = $cr["line1"].",".$cr["line2"];

        $cityid=$cr["city_id"];

        $districtrs = Database::search("SELECT*FROM `city` WHERE `id`='".$cityid."'");
        $dr = $districtrs->fetch_assoc();
    
        $districtId = $dr["district_id"];
    
        $delivery = "0";
    
        if($districtId=="2"){
            $delivery = $pr["delivery_fee_colombo"];
        }else{
            $delivery = $pr["delivery_fee_other"];
        }
    
    
        $item = $pr["title"];
        $amount = ($pr["price"]*(int)$qty)+(int)$delivery;//one unoth nam $pr int walata parse karaganna
    
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $add;
        $cityid = $dr["name"];


        $array['id']=$orderId;
        $array['item']=$item;
        $array['amount']=$amount;
        $array['fname']=$fname;
        $array['lname']=$lname;
        $array['email']=$umail;
        $array['mobile']=$mobile;
        $array['address']=$address;
        $array['city']=$cityid;

       echo json_encode($array);


    
    }else{
         
         echo "2";

    }

  
}else{
 
    echo "1";

}

?>