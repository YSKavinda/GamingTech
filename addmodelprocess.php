<?php 
   session_start();
   require "db.php";

   if(isset($_GET["m"]) && isset($_GET["brsel"])){
         $model = $_GET["m"];
         $brand = $_GET["brsel"];
       if($brand!=0){
           if(empty($model)){
               echo "Insert a Model";
           }else{

            $brs = Database::search("SELECT*FROM `brand` WHERE `id` = '".$brand."'");
            if($brs->num_rows==1){
                $brdata = $brs->fetch_assoc();
                
              $mrs = Database::search("SELECT*FROM `model` WHERE `name`='".$model."' ");
              if($mrs->num_rows==0){

                 Database::iud("INSERT INTO `model`(`name`) VALUES ('".$model."'); ");
                 $mid = Database::$connection->insert_id;
                 if($mid!=0){
                     Database::iud("INSERT INTO `model_has_brand`(`brand_id`,`model_id`) VALUES('".$brand."','".$mid."'); ");
                     echo "success";
                 }else{
                     echo "model not set";
                 }

                

              }else{
                  echo "model exist";
              }
                

            }else{
                echo "error";
            }

           }
         
       



       }else{
           echo "Select Brand";
       }
         
   }



?>