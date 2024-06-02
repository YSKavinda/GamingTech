<?php
require "db.php";

session_start();
if(isset($_SESSION["u"])){

    if(isset($_POST["to"])){



        $msg=$_POST["msg"];
        $to = $_POST["to"];
        $from = $_SESSION["u"]["email"];
        
        if(!empty($msg && $to)){
              
            $status = 1;
            $date = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($tz);

            $d = $date->format("Y-m-d H:i:s");
            
           
            Database::iud("INSERT INTO `messages`(`to`,`from`,`content`,`status`,`date`) VALUES('".$to."','".$from."','".$msg."','1','".$d."') ");

            echo "success";



        }







    }else{
        echo "1";
    }

}else{
    echo "2";
} 









?>