<?php
session_start();
require "db.php";
// $img;
// if (isset($_FILES["i"])) {
//     $img = $_FILES["i"];
// } else {
//     $profileimg = Database::search("SELECT*FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
//     $pn = $profileimg->num_rows;
//     if ($pn == 1) {
//         $p = $profileimg->fetch_assoc();
//         $img = $p["code"];
//     } else {
//         $img = "resources//demoProfileOmg.jpg";
//     }
// }
if (isset($_SESSION["u"])) {
    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line01 = $_POST["a1"];
    $line02 = $_POST["a2"];
    $city = $_POST["c"];



    if (empty($fname)) {
        echo "Enter First Name";
    } elseif (empty($lname)) {
        echo "Enter Last Name";
    } elseif (empty($mobile)) {
        echo "Enter Mobile Number";
    } elseif (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Enter Valid Mobile Number";
    } elseif (empty($line01)) {
        echo "Fill In Address Line 01";
    } elseif (empty($line02)) {
        echo "Fill In Address Line 02";
    } elseif (empty($city)) {
        echo "Fill In Your City";
    } else {

        // echo $mobile;
        // echo $fname;
        // echo $lname;

        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',
        `lname`='" . $lname . "',
        `mobile`='" . $mobile . "'
        WHERE `email`='" . $_SESSION["u"]["email"] . "'");
        $upsessionrs =  Database::search("SELECT*FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "' ");
        $updata = $upsessionrs->fetch_assoc();
        $_SESSION["u"] = $updata;

        //  echo "User Table Updated";

        $addressrs = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
        $nr = $addressrs->num_rows;


        if ($nr == 1) {

            //update
            // echo $city;

            $ucity = Database::search("SELECT * FROM `city` WHERE `id`='" . $city . "'");
            $unr = $ucity->fetch_assoc();
            Database::iud("UPDATE `user_has_address` SET
    `line1`='" . $line01 . "',
    `line2`='" . $line02 . "',
    `city_id`='" . $unr["id"] . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
            // echo "Address Update";

            //update image

            // if (isset($_FILES["i"])) {
            //     $allowed_image_extension = array("image/jpg", "image/png", "image/svg", "image/jpeg");
            //     $fileex = $img["type"];
            //echo $file_extension;
            // if (!in_array($fileex, $allowed_image_extension)) {
            //     echo "Please Select a Valid Image";
            // } else {
            //     $newimgextention;
            //     if ($fileex == "image/jpeg") {
            //         $newimgextention = ".jpeg";
            //     } else if ($fileex == "image/jpg") {
            //         $newimgextention = ".jpg";
            //     } else if ($fileex = "image/png") {
            //         $newimgextention = ".png";
            //     } else if ($fileex == "image/svg") {
            //         $newimgextention = ".svg";
            //     }
            //     $file_Name = "profile_img//" . uniqid() . $newimgextention;
            //     move_uploaded_file($img["tmp_name"], $file_Name);
            //     Database::iud("UPDATE `profile_img` SET `code`='" . $file_Name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
            //   echo "Image Updated Successfully";
            //     }
            // }
            //insert part eka hadanna////////////////////////////////////////////////////////
        } else {
            //add new
            $ucity = Database::search("SELECT * FROM `city` WHERE `id`='" . $city . "'");
            $unr = $ucity->fetch_assoc();
            echo $unr["id"];
            Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city_id`)VALUES('" . $_SESSION["u"]["email"] . "','" . $line01 . "','" . $line02 . "','" . $unr["id"] . "')");
            // echo "New Address Added";

        }
        //Insert Image
        if (isset($_FILES["i"])) {
            $img = $_FILES["i"];
            $allowed_image_extension = array("image/jpg", "image/png", "image/svg", "image/jpeg");
            $fileex = $img["type"];
            //echo $file_extension;
            if (!in_array($fileex, $allowed_image_extension)) {
                echo "Please Select a Valid Image";
            } else {
                $newimgextention;
                if ($fileex == "image/jpeg") {
                    $newimgextention = ".jpeg";
                } else if ($fileex == "image/jpg") {
                    $newimgextention = ".jpg";
                } else if ($fileex = "image/png") {
                    $newimgextention = ".png";
                } else if ($fileex == "image/svg") {
                    $newimgextention = ".svg";
                }
                $file_Name = "profile_img//" . uniqid() . $newimgextention;
                move_uploaded_file($img["tmp_name"], $file_Name);
                $iuprs=Database::search("SELECT*FROM `profile_img` WHERE `user_email`='".$_SESSION["u"]["email"]."' ");
               $iupnr = $iuprs->num_rows;
               if($iupnr==0){
                Database::iud("INSERT INTO `profile_img`(`user_email`,`code`)VALUES('" . $_SESSION["u"]["email"] . "','" . $file_Name . "')");
                echo "img inserted";
               }else{
                Database::iud("UPDATE `profile_img` SET `code`='" . $file_Name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                echo "img Updated";
               }
               
            }
        } 
    }
}
