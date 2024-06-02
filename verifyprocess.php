<?php

session_start();
require "db.php";


if(isset($_POST["v"])){
    $verify_code=$_POST["v"];

    $adminrs = Database::search("SELECT*FROM `admin` WHERE `verification`='".$verify_code."'; ");
    $an = $adminrs->num_rows;

     if($an == 1){
         $ar = $adminrs->fetch_assoc();
         $_SESSION["a"] = $ar;

         echo "success";
     }else{
         echo "Invalid Code,try again!!!";
     }

}else{

echo "Enter your Verification code";

}





?>