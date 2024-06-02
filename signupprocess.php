<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if(empty($fname)){
  echo "Please Enter Your First Name";
}elseif(strlen($fname)>50){
echo "First Name must be Less Than 50 Characters";
}elseif(empty($lname)){
echo "Please Enter Your last Name";
}elseif(strlen($lname)>50){
echo "Last Name must be Less Than 50 Characters";
}elseif(empty($email)){
echo "Please Enter your Email";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
echo "Invalid Email address!";
}elseif(strlen($email)>100){
echo "Email must be less than 100 characters";
}elseif(empty($password)){
echo "Please Enter your password";
}elseif(strlen($password)<5||strlen($password)>20){
echo "Password length must between 5 to 20";
}elseif(empty($mobile)){
echo "Please Enter Your Mobile";
}elseif(strlen($mobile)!=10){
echo "Please Enter 10 digit mobile number";
}elseif(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
 echo "Invalid Mobile number";
}else{
    require "db.php";
    $r = Database::search("SELECT*FROM `user` WHERE `email`='".$email."'");
    if($r->num_rows>0){
       echo "Email Address Already Exist";
    }else{
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
  Database::iud("INSERT INTO `user`(`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender_id`) VALUES('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','".$gender."')");
   echo "Success";
}
}
?>