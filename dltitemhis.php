<?php 
session_start();
require "db.php";

if($_SESSION["u"]["email"]){

}
if(isset($_GET["iid"])){

    $id =$_GET["iid"];
    
    $invoicers = Database::search("SELECT*FROM `invoice` WHERE `id`='".$id."' ");
    if($invoicers->num_rows==1){
       
        Database::iud("DELETE FROM `invoice` WHERE `id` = '".$id."'; ");
        echo "dlted";

    }else{
        echo "no item found";
    }


}






?>