<?php

require "db.php";

if(isset($_POST["e"])){
    $email = $_POST["e"];

    $userrs = Database::search("SELECT*FROM `user` WHERE `email` = '".$email."'");
    $num = $userrs->num_rows;

    if($num=="1"){
        $row = $userrs->fetch_assoc();
        $statid=$row["status"];
       if($statid=="1"){
          Database::iud("UPDATE `user` SET `status`='2' WHERE `email`='".$email."'; ");
          echo "1";
       }else{
          Database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$email."'; ");
          echo "2";
       }
    }else{
      echo "User not Found";
    }
}


?>