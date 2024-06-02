<?php
require "db.php";

$s = $_POST["k"];
$c = $_POST["c"];
$b = $_POST["b"];
$m = $_POST["m"];
$co = $_POST["co"];
$col = $_POST["clr"];
$pf = $_POST["pf"];
$pt = $_POST["pt"];
$states = "0";
$pageno = 1;


if (isset($_POST["page"])) {

    $pageno = $_POST["page"];
}

// echo   $_POST["page"];
$quvry = "SELECT * FROM product WHERE `status_id`='1' ";
if (!empty($s)) {
    $quvry = $quvry . " AND `title` LIKE '%" . $s . "%' ";
}
if ($c!=0) {
    $quvry = $quvry . " AND `category_id`='" . $c . "' ";
}
if ($b > 0) {
    $quvry = $quvry . " AND `model_has_brand_id` IN (SELECT `id` FROM  `model_has_brand` WHERE `brand_id` = '" . $b . "') ";
}
if ($m > 0) {
    $quvry = $quvry . " AND `model_has_brand_id` IN (SELECT `id` FROM  `model_has_brand` WHERE `model_id` = '" . $m . "') ";
}
if ($co!=0) {
    $quvry = $quvry . " AND `condition_id`='" . $co . "' ";
}
if ($col!=0) {
    $quvry =  $quvry . " AND `color_id` = '" . $col . "' ";
}
if (!empty($pf)) {
    $quvry =  $quvry . " AND `price`>='" . $pf . "' ";
}
if (!empty($pt)) {
    $quvry = $quvry . " AND `price`<='" . $pt . "' ";
}

?>
<div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center bg-transparent" id="filter">
    <div class="row">
        <?php


        $prds = Database::search($quvry);


        $d = $prds->num_rows;
        $results_per_page = 6;
        $number_of_pages = ceil($d / $results_per_page);
        $page_first_result = ((int)$pageno - 1) * $results_per_page;
        $prrs = Database::search($quvry . " LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");
        for ($x = 0; $x < $prrs->num_rows; $x++) {
            $pdata = $prrs->fetch_assoc();
            $imgrs = Database::search("SELECT*FROM `image` WHERE `product_id` = '" . $pdata["id"] . "' ");
            $imgnr = $imgrs->num_rows;
            if ($imgnr == "1") {
                $imagedata = $imgrs->fetch_assoc();
        ?>
                <div class="card col-6 mt-3">
                    <div class="row g-0">
                        <div class="col-md-4 mt-4">
                            <img src="resources/products//<?php echo $imagedata["code"]; ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $pdata["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold">Rs.<?php echo $pdata["price"]; ?>.00</span>
                                <br />
                                <span class="card-text text-success fw-bold"><?php echo $pdata["qty"]; ?> Items Left</span>
                                <div class="row">
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="row">
                                            <div class="col-6 d-grid">
                                                <a href="<?php echo "singleproductview.php?id=" . ($pdata['id']); ?>" class="btn btn-success">Buy Now</a>

                                            </div>
                                            <div class="col-6 d-grid">
                                                <a href="#" class="btn btn-primary" onclick="addToWatchList(<?php echo $pdata['id']; ?>);">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        <?php

            }
        }

        ?>
    </div>
</div>
<div class="col-12">
    <div class="row">
        <!--pagination-->
        <div class="col-12 text-center mb-3 mt-3">
            <div class="pagination">
                <?php
                if ($pageno > 1) {
                ?><a href="#" class="text-white" onclick="advancedSearch(<?php echo $pageno - 1; ?>);">&laquo;</a><?php
                                                                                                }

                                                                                                    ?>

                <?php
                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if ($page == $pageno) {
                ?><a href="#" onclick="advancedSearch(<?php echo $page; ?>);" class="ms-1 active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a href="#" class="text-white" onclick="advancedSearch(<?php echo $page; ?>);" class="ms-1"><?php echo $page; ?></a>
                <?php
                    }
                }
                ?>
                <?php
                if ($pageno < $number_of_pages) {
                ?><a href="#" class="text-white" onclick="advancedSearch(<?php echo $pageno + 1; ?>);">&raquo;</a><?php
                                                                                                }

                                                                                                    ?>
            </div>
        </div>
        <!--pagination-->
    </div>
</div>