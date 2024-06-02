<?php 
     require "db.php";

     if(isset($_GET["id"])){

         $array;
$id = $_GET["id"];

    if(empty($id)){
        echo "Please Enter the Product id";
    }else{
        $prs = Database::search("SELECT*FROM `product` WHERE `id`='".$id."';");
        $n = $prs->num_rows;

        if($n==1){
             $r = $prs->fetch_assoc();
             $array["id"]=$r["id"];
             
             $crs = Database::search("SELECT*FROM `category` WHERE `id`='".$r["category_id"]."'");
             if($crs->num_rows==1){
                 $cr = $crs->fetch_assoc();
                 $array["category"]=$r["name"];
             }
             $brs = Database::search("SELECT*FROM `model_has_brand` WHERE `id`='".$r["model_has_brand_id"]."'");
             if($brs->num_rows==1){
                 $bmr =$brs->fetch_assoc();
                 
             }
        }

    }
}


?> 