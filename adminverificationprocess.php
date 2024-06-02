<?php
require "db.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){

$email = $_POST["e"];

if(empty($email)){
    echo "Please enter your Email address";
}else{
     $adminrs = Database::search("SELECT*FROM `admin` WHERE `email`='".$email."'");
     $an = $adminrs->num_rows;

     if($an == 1){
         $code = uniqid();
         Database::iud("UPDATE `admin` SET `verification` = '".$code."' WHERE `email`='".$email."' ");


         //EMAIL SEND
         $mail = new PHPMailer; 
         $mail->IsSMTP();
         $mail->Host = 'smtp.gmail.com'; 
         $mail->SMTPAuth = true; 
         $mail->Username = 'ysmegasuriya@gmail.com'; 
         $mail->Password = 'horana2001';
         $mail->SMTPSecure = 'ssl';
         $mail->Port = 465;
         $mail->setFrom('ysmegasuriya@gmail.com', 'Yasiru'); 
         $mail->addReplyTo('ysmegasuriya@gmail.com', 'Yasiru'); 
         $mail->addAddress($email); 
         $mail->isHTML(true); 
         $mail->Subject = 'eShop Forget Password Verification Code'; 
         $bodyContent = '<h1 style="color:red;">Your Verification Code : '.$code.'</h1>'; 
         $mail->Body    = $bodyContent; 
         
         if(!$mail->send()) { 
             echo 'Verification Code Sending Failed'; 
         } else { 
             echo 'Success'; 
         }

         //

     }else{
       echo "You are not a Valid User";
     }
}

}








?>