

<?php require "db.php";

if (isset($_GET["br"])) {

    $br = $_GET["br"];

    $selectbnm = Database::search("SELECT*FROM `model_has_brand` WHERE `brand_id` = '" . $br . "'");
    $selnumrows = $selectbnm->num_rows;
    if ($selnumrows == 0) {
?>


        <option value="0">No Models Available Right Now</option>


        <?php
    } else {
       ?>
    <option value="0">Select Model</option><?php


        for ($i = 0; $i < $selnumrows; $i++) {

            $selectdata = $selectbnm->fetch_assoc();
            $modelrs = Database::search("SELECT*FROM `model` WHERE `id`='" . $selectdata["model_id"] . "' ;");
            $modeln = $modelrs->num_rows;
            for ($x = 0; $x < $modeln; $x++) {
                $modeld = $modelrs->fetch_assoc();
        ?>
                <option value="<?php echo $modeld["id"] ?>"><?php echo $modeld["name"]; ?></option>
<?php

            }
        }
    }
}
?>