<?php
require "db.php";
if (isset($_GET["cid"])) {


        
        $cid = $_GET["cid"];


        $cityrsform = Database::search("SELECT*FROM `city` WHERE `id`='" . $cid . "'");
        if ($cityrsform->num_rows == 1) {
            $citydataform = $cityrsform->fetch_assoc();
            $districtrsform = Database::search("SELECT*FROM `district` WHERE `id`='" . $citydataform["district_id"] . "'");
            $districtdataform  = $districtrsform->fetch_assoc();
            $provincersform = Database::search("SELECT*FROM `province` WHERE `id` = '" . $districtdataform["province_id"] . "' ");
            $provincedataform = $provincersform->fetch_assoc();


?>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Province</label>
                    <select id="province" class="form-select disabled">
                        <option value="0">Select Province</option>
                        <option value="<?php echo $provincedataform["id"] ?>"><?php echo $provincedataform["name"]; ?></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">District</label>
                    <select id="District" class="form-select">
                        <option value="0">Select District</option>
                        <option value="<?php echo $districtdataform["id"] ?>"><?php echo $districtdataform["name"]; ?></option>

                    </select>
                </div>
            </div>




<?php




        }else{
            echo "3";
        }
}else{
    echo "1";
}


?>