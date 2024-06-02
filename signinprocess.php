<?php
session_start(); 
   require "db.php";
   $email= $_POST["email"];
   $password = $_POST["password"];
   $r = $_POST["remember"];

$rs=Database::search("SELECT*FROM `user` WHERE `email`='".$email."' AND `password`='".$password."'");
$n=$rs->num_rows;
   if($n==1){
       echo "success";
       $d = $rs->fetch_assoc();
       $_SESSION["u"] = $d;
       
       if ($r == "true") {
        setcookie("e", $email);
        setcookie("p", $password);
    }else{
        setcookie("e","",-1);
        setcookie("p","",-1);
    }
   }else{
       echo "Invalid details";
   }
?>