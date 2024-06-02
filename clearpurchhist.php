<?php 
session_start();
require "db.php";
if(isset($_SESSION["u"])){

  $uemail = $_SESSION["u"]["email"];

   $invoicers =  Database::search("SELECT*FROM `invoice` WHERE `user_email`='".$uemail."' ");
   $in = $invoicers->num_rows;
   if($in=!0){

  
        
        Database::iud("DELETE FROM `invoice` WHERE `user_email` = '".$uemail."' ");

        echo "Records Cleared";
        


   }else{

    echo "No Records Found";

   }
   
   

}





?>