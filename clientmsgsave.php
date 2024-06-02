<?php
require "db.php";
session_start();

if ($_SESSION["u"]) {

    if (isset($_GET["cm"]) && !empty($_GET["cm"])) {
        $cm = $_GET["cm"];



        $date = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($tz);

        $d = $date->format("Y-m-d H:i:s");

        $adrs = Database::search("SELECT * FROM `admin`");
        $adn = $adrs->num_rows;
        if($adn==1){
             $addata =$adrs->fetch_assoc();
          Database::iud("INSERT INTO `admin_chat`(`from`,`to`,`content`,`sent_date`)VALUES('" . $_SESSION["u"]["email"] . "','".$addata['email']."','" . $cm . "','" . $d . "')");
            echo "success";
        }

      
    }
}
