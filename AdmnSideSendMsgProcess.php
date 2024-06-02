<?php

session_start();

require "db.php";

if(isset($_SESSION["a"])){

    $me=$_SESSION["a"]["email"];

    $to=$_POST["to"];

    $msg=trim($_POST["msg"]);

    if(!empty($msg)){

        $status="1";

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");



        Database::iud("INSERT INTO `admin_chat`(`from`,`to`,`content`,`sent_date`) 
        VALUES('".$me."','".$to."','".$msg."','".$date."') ");
        
        echo "success";


    }



}


?>