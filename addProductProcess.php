<?php
require "db.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = (int)$_POST["co"];
$colour = (int)$_POST["col"];
$qty = (int)$_POST["qty"];
$price= (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];
$imageFile = $_FILES["img"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail = "yskavinda@gmail.com";

if($category=="0"){
    echo "Please Select a Category";
}else if($brand=="0"){
    echo "Please Select Brand";
}else if($model=="0"){
    echo "Please Select a Model";
}else if(empty($title)){
    echo "Please Add a Title";
}else if(strlen($title)>=100){
    echo "Title Must Contain 100 or Lower Characters";
}else if($qty=="0"||$qty == "e"){
    echo "Please Enter a Valid Quantity";
}else if(!is_int($qty)){
    echo "Please Add a Valid Quantity";
}else if(empty($qty)){
  echo "Enter a Quantity";
}else if($qty<0){
    echo "Please Add a Valid Quantity";
}else if(empty($price)){
    echo "Please Enter the price of your product";
}else if(!is_int($price)){
    echo "Please Enter Valid price";
}else if(empty($dwc)){
    echo "Please Enter Delivery Cost Within Colombo District";
}else if(!is_int($dwc)){
    echo "Please Insert Valid Delivery Cost Within Colombo";
}else if(empty($doc)){
    echo "Please Enter Delivery Cost Out of Colombo District";
}else if(!is_int($doc)){
    echo "Please Insert Valid Delivery Cost Out of Colombo";
}
else if(empty($description)){
    echo "Please add a Description";
}else{
    $modelhasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'; ");
    
    if($modelhasBrand->num_rows == 0){
        echo "The Product Doesn't Exist";
    }else{
        $f= $modelhasBrand->fetch_assoc();
        $modelhasBrand = $f["id"];

        Database::iud("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`color_id`,`price`,`qty`,`description`,`title`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) VALUES('".$category."','".$modelhasBrand."','".$colour."','".$price."','".$qty."','".$description."','".$title."','".$condition."','".$state."','".$useremail."','".$date."','".$dwc."','".$doc."');");
        echo "Product Added Successfully";

        $last_id = Database::$connection->insert_id;
        echo $last_id;

    
        // $file_extention = pathinfo($imageFile,PATHINFO_EXTENSION);
        //     if(!file_exists($imageFile)){
        //         echo "Please Select an Image";
        //     }else if(!in_array($file_extention,$allowed_image_extension)){
        //         echo "Please Select a valid Image";
        //     }else{
        //         echo $imageFile;
        //     }
        $file_extention = $imageFile["type"];
        if(isset($_FILES["img"])){
            $allowed_image_extension = array("image/jpg","image/png","image/svg","image/jpeg");
            $fileex = $imageFile["type"];
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
                  echo $file_Path;
                  
                move_uploaded_file($imageFile["tmp_name"],$file_Path);
                Database::iud("INSERT INTO image(`code`,`product_id`) VALUES('".$file_Name."','".$last_id."');");
               echo "success";
            }
        }else{
            echo "Please Select An Image";
        }
    } 
}
//   echo gettype($state);
//   echo gettype($model);
//   echo gettype($category);
//  echo "<br/>";
//   echo gettype($brand);
//  echo "<br/>";
//  echo gettype($model);
// echo "<br/>";
// echo $title;
//  echo "<br/>";
//   echo gettype($condition);
//  echo "<br/>";
//   echo gettype($colour);
// echo "<br/>";
// echo $qty;
// echo "<br/>";
// echo $price;
// echo "<br/>";
// echo $dwc;
// echo "<br/>";
// echo $doc;
// echo "<br/>";
// echo $description;
// echo "<br/>";
// echo $imageFile;
// echo "<br/>";


?>