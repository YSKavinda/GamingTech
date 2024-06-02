<?php
   
    require "db.php";

    session_start();

    if($_SESSION["u"]){
        if(!$_FILES["img"]){
            echo "Set an Image";
        }else{

     
            $pid=$_POST["pid"];
            $title =  $_POST["upti"];
            $qty =  (int)$_POST["upq"];
            $cost =  $_POST["upcost"];
            $dwc = (int)$_POST["updwc"];
            $doc = (int)$_POST["updoc"];
            $desc = $_POST["updesc"];
            $img = $_FILES["img"];

           
    if(empty($title)){
        echo "Please enter product title !";
    }else if(strlen($title)>100){
        echo "Title is too long !";
    }else if(empty($qty)){
        echo "Please enter product quantity !";
    }else if((!is_numeric($qty)) || $qty=="e" || $qty<=0){
        echo "Invalid product quantity !";
    }else if(empty($dwc)){
        echo "Please enter delivary cost within Colombo !";
    }else if((!is_numeric($dwc)) || $dwc=="e" || $dwc<0){
        echo "Invalid value for delivary cost within Colombo !";
    }else if(empty($doc)){
        echo "Please enter delivary cost out of Colombo !";
    }else if((!is_numeric($doc)) || $doc=="e" || $doc<0){
        echo "Invalid value for delivary cost out of Colombo !";
    }else if(empty($desc)){
        echo "Please fill the product description !";
    }else{

                $prs = Database::search("SELECT*FROM `product` WHERE `id` = '".$pid."'");
                $pn = $prs->num_rows;
                if($pn==1){

                    Database::iud("UPDATE `product` SET `title`='".$title."',`price`='".$cost."',`qty`='".$qty."',`description`='".$desc."',`delivery_fee_colombo`='".$dwc."',`delivery_fee_other`='".$doc."' WHERE `id`='".$pid."' ;");
                   
                    $allowed_image_extension = array("image/jpg","image/png","image/svg","image/jpeg");
                $fileex = $img["type"];
                //echo $file_extension;
                if(!in_array($fileex,$allowed_image_extension)){
                    echo "Please Select a Valid Image";
                }else{
                    $newimgextention;
                      if($fileex == "image/jpeg"){
                          $newimgextention = ".jpeg";
                      }else if($fileex == "image/jpg"){
                          $newimgextention= ".jpg";
                      }else if($fileex ="image/png"){
                          $newimgextention = ".png";
                      }else if($fileex == "image/svg"){
                          $newimgextention = ".svg";
                      }
                      $file_Name = uniqid().$newimgextention;
                      $file_Path = "resources\\products\\".$file_Name;
                      
                    move_uploaded_file($img["tmp_name"],$file_Path);

                    $imgrs = Database::search("SELECT*FROM `image` WHERE `product_id`='".$pid."' ");
                    $imgn = $imgrs->num_rows;
                    if($imgn==0){
                        Database::iud("INSERT INTO `image` (`code`,`product_id`) VALUES ('".$file_Name."','".$pid."');");
                        echo "success";
                    }else{
                        Database::iud("UPDATE `image` SET `code`='".$file_Name."' WHERE `product_id`='".$pid."' ");
                        echo "success";
                    }

                    
                }





            }else{
                echo "no product found";
            }




             
            }



        }

         

       
    

    }


    


    


?>