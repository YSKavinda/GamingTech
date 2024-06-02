<?php 
     require "db.php";
     $e = $_POST["e"];
     $np = $_POST["np"];
     $rnp = $_POST["rnp"];
     $vc = $_POST["vc"];

     if(empty($e)){
         echo "Missing Email Address";
     }else if(empty($np)){
         echo "Please enter your new password";
     }else if(strlen($np)<5||strlen($np)>20){
         echo "Password length must be 5 to 20";
     }else if(empty($rnp)){
         echo "Please Re-type your Password";
     }else if($np != $rnp){
         echo "Password and Re-type password does not match";
     }else if(empty($vc)){
         echo "Please enter your verification code";
     }else{
         $rs = Database::search("SELECT*FROM `user` WHERE `email`='".$e."' AND `verification_code` = '".$vc."'");
       $n = $rs->num_rows;
         if($n==1){
             Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email` = '".$e."'");
             echo "Success";
         }else{
             echo "Password Reset Fail";
         }
     }
?>