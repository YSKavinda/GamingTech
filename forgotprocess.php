<?php
  use PHPMailer\PHPMailer\PHPMailer; 
 
  require 'Exception.php'; 
  require 'PHPMailer.php'; 
  require 'SMTP.php'; 
 require "db.php";
 if(isset($_GET["e"])){
     $e = $_GET["e"];
     if(empty($e)){
         echo "Please Enter your Email Address";
     }else{
         $rs = Database::search("SELECT*FROM `user` WHERE `email`='".$e."'");
         if($rs->num_rows==1){
             $code = uniqid();
             Database::iud("UPDATE `user`SET `verification_code`='".$code."' WHERE `email`='".$e."' ");

            //email code
           
             
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
            $mail->addAddress($e); 
            $mail->isHTML(true); 
            $mail->Subject = 'gTech Forget Password Verification Code'; 
            $bodyContent = '<h1 style="color:red;">Your Verification Code : '.$code.'</h1>'; 
            $mail->Body    = $bodyContent; 
            
            if(!$mail->send()) { 
                echo 'Verification Code Sending Failed'; 
            } else { 
                echo 'Success'; 
            }
            
         }else{
             echo "Email address not found";
         }
        }
 }else{
     echo "Please enter your email address";
 }
 
?>