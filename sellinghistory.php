<?php

require "db.php";

session_start();

if (isset($_SESSION["a"])) {




    $from=$_GET["f"];
     $to=$_GET["t"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gTech | Selling History</title>
    <link rel="icon" href="resources//logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body
    class="main-background">

    <div class="container-fluid">
        <div class="row">


            <div class="col-12 bg-transparent text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Products Selling History</label>
            </div>

            <!-- <div class="col-12 bg-light rounded">
                    <div class="row ">
                        <div class="col-12 col-lg-6 offset-lg-3"></div>
                    </div>
                    <div class="row p-3">
                        <div class="col-9">
                            <input type="text" class="form-control" id="searchtxt" />
                        </div>
                        <div class="col-3 d-grid">
                            <button class="btn btn-primary" onclick="sellingProductSearch();">Search</button>
                        </div>
                    </div>
                </div> -->
            <div class="col-12 bg-transparent">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-white text-decoration-none"><a href="adminpanel.php">Admin Pannel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Selling History</li>
                    </ol>
                </nav>
            </div>


            <div class="col-12 col-lg-10 offset-lg-1">
                <Div class="row mt-4 mb-4">
                    <div class="col-8">
                        <input type="text" class="form-control" id="Searchcode" />
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" onclick="searchinsellingHistory();">Search</button>
                    </div>
                </Div>


            </div>



            <div class="col-12 my-3">
                <div class="row mb-1">
                    <div class="col-3 col-lg-2 bg-primary text-white text-end py-2">
                        <span class="fs-5 fw-bold">Order ID</span>
                    </div>
                    <div class="col-3 col-lg-3 bg-light  py-2">
                        <span class="fs-5 fw-bold">Product</span>
                    </div>
                    <div class="col-2 col-lg-3 bg-primary text-white d-none d-lg-block py-2">
                        <span class="fs-5 fw-bold">Buyer</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-light py-2">
                        <span class="fs-5 fw-bold">Price</span>
                    </div>

                    <div class="col-2 bg-primary text-white py-2">
                        <span class="fs-5 fw-bold d-none d-lg-block">Quantity</span>
                        <span class="fs-5 fw-bold d-lg-none">Qty</span>
                    </div>
 
</div>
<div class="row" id="bodypart">

</div>


<div class="row" id="bdn">

<div class="col-12">
<?php

$q = "SELECT * FROM `invoice` ";

if (!empty($from) && empty($to)) {
    $q = " SELECT * FROM `invoice` WHERE `date` > '" . $from . "' ";
} else if (empty($from) && !empty($to)) {
    $q = " SELECT * FROM `invoice` WHERE `date` < '" . $to . "' ";
} else if (!empty($from) && !empty($to)) {
    $q = " SELECT * FROM `invoice` WHERE `date` BETWEEN '" . $from . "' AND '" . $to . "' ";
}



$rs = Database::search($q);
if ($rs->num_rows > 0) {

    // echo $rs->num_rows;

    for ($x = 0; $x < $rs->num_rows; $x++) {
        $data = $rs->fetch_assoc();
        // echo $data["order_id"];

?>
<div class="row">
<div class="col-3 col-lg-2 bg-primary text-white text-end py-2">
    <span class="fs-5 "><?php echo $data["order_id"];?></span>
</div>
<div class="col-3 col-lg-3 bg-light  py-2">
    <?php
                
                $prdrs=Database::search("SELECT * FROM `product` WHERE `id`='".$data["product_id"]."' ");
                $prd=$prdrs->fetch_assoc();
                
                ?>
    <span class="fs-5 "><?php echo $prd["title"];?></span>
</div>
<div class="col-2 col-lg-3 bg-primary text-white d-none d-lg-block py-2">
    <?php
                
                $usrs=Database::search("SELECT * FROM `user` WHERE `email`='".$data["user_email"]."' ");
                $usd=$usrs->fetch_assoc();
                
                ?>
    <span class="fs-5 "><?php echo $usd["fname"]." ".$usd["lname"];?></span>
</div>
<div class="col-4 col-lg-2 bg-light py-2">
    <span class="fs-5 ">Rs. <?php echo $data["total"];?> .00</span>
</div>

<div class="col-2 bg-primary text-white py-2">
    <span class="fs-5 d-none d-lg-block"><?php echo $data["qty"];?></span>
    <span class="fs-5 d-lg-none"><?php echo $data["qty"];?></span>
</div>
</div>
<?php

    }
} else {
    echo "No records found !";
}


?>


</div>

</div>
              




            </div>







        </div>
        <div class="row" style="margin-top: 200px;"><?php require "footer.php"; ?></div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>




<?php
    }


?>