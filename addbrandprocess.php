<?php
require "db.php";
if(isset($_GET["bd"])){

    $bd = $_GET["bd"];
    
  $bdrs = Database::search("SELECT*FROM `brand` WHERE `name`='".$bd."'; ");
     $bdnr = $bdrs->num_rows;
      if($bdnr==0){
          Database::iud("INSERT INTO `brand`(`name`) VALUES ('".$bd."'); ");
          echo "done";
      }else{
          echo "product exist";
      }


}

     
       



?>