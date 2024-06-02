<?php
require "db.php";
$c = 0;
if (isset($_GET["stext"])) {
    $text = $_GET["stext"];
    $searchrs = Database::search("SELECT*FROM `user` WHERE `email` LIKE '%" . $text . "%';");
    $nsr = $searchrs->num_rows;

    for ($x = 0; $x < $nsr; $x++) {
        $row = $searchrs->fetch_assoc();
?>
        <?php $c = $c + 1; ?>
        <?php

        $imgrs = Database::search("SELECT*FROM `profile_img` WHERE `user_email`='" . $row["email"] . "'; ");
        $imn = $imgrs->num_rows;

        ?>
        <div class="col-12">
            <div class="row">
                <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                    <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                </div>
                <?php
                if ($imn == "1") {
                    $imd = $imgrs->fetch_assoc();
                ?>
                    <div class="col-2 col-lg-2 bg-light d-none d-lg-block text-center">
                        <img src="<?php echo $imd["code"]; ?>" style="height: 70px;" class="rounded-circle">
                    </div>
                <?php

                } else {
                ?>
                    <div class="col-2 col-lg-2 bg-light d-none d-lg-block text-center">
                        <img src="resources//demoProfileImg.jpg" style="height: 70px;" class="rounded-circle">
                    </div>
                <?php
                }

                ?>

                <div class="col-6 col-lg-2 bg-primary pt-2 pb-2">
                    <span class="fs-5 fw-bold text-white"><?php echo $row["email"]; ?></span>
                </div>
                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                    <span class="fs-5 fw-bold"><?php echo $row["fname"] . " " . $row["lname"]; ?></span>
                </div>
                <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                    <span class="fs-5 fw-bold text-white"><?php echo $row["mobile"] ?></span>
                </div>
                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                    <span class="fs-5 fw-bold"><?php echo $row["register_date"]; ?></span>
                </div>
                <div class="col-4 col-lg-1 bg-light pt-2 pb-2 d-grid">
                    <button class="btn btn-danger">Block</button>
                </div>
            </div>
        </div>
<?php
    }
}


?>