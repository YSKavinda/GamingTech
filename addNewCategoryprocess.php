<?php

session_start();

require "db.php";

if(isset($_SESSION["a"])){

    $cat=trim($_GET["c"]);

    if(empty($cat)){

        echo "Enter name of your new Category !";

    }else{
        $catrs=Database::search("SELECT * FROM `category` WHERE `name` LIKE '".$cat."' ");
        $n=$catrs->num_rows;

        if($n>0){
            echo "This category is already existing !";
        }else{
            Database::iud("INSERT INTO `category`(`name`) VALUES('".$cat."') ");
            echo "success";
        }

    }

    


}

?>