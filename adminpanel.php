<?php
session_start();
require "db.php";

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Gaming Tech|Admin Panel</title>
        <link rel="icon" href="resources/logo.png">
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="main-background">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2 bg-transparent" style="box-shadow: 0px 0px 10px 2px black;">
                    <div class="row">
                        <div class="align-items-start  col-12 text-center">
                            <div class="row g-1">
                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"];  ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column ">
                                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link" href="manageusers.php">Manage Users</a>
                                        <a class="nav-link" href="manageproducts.php">Manage Products</a>
                                    </nav>

                                </div>
                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />
                                    <h4 class="text-white">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-3 d-grid mb-5">
                                    <label class="form-label text-white">From Date</label>
                                    <input type="date" class="form-control mb-1" id="fromdate" />
                                    <label class="form-label text-white">To Date</label>
                                    <input type="date" class="form-control" id="todate" />
                                    <a id="historylink" class="btn btn-primary mt-3" onclick="dailysellings();">View Sellings</a>
                                    <!-- <hr class="border border-1 border-white" />
                                <a href="sellinghi" class="text-white fs-4 fw-bold" style="cursor:pointer;" onclick="dailysellings();">Daily Sellings</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 mt-4 mb-2 text-white">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>


                        <div class="col-6 col-lg-4 px-2 py-1">
                            <?php
                            $today = date("Y-m-d");
                            $thismonth = date("m");
                            $thisyear = date("Y");
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            $d = 0;
                            $e = 0;
                            $f = 0;


                            $invoicers = Database::search("SELECT*FROM `invoice`");
                            $in = $invoicers->num_rows;



                            for ($x = 0; $x < $in; $x++) {
                                
                                $ir = $invoicers->fetch_assoc();
                                $d = $ir["date"];

                                $splitdate = explode(" ", $d);
                                $pdate = $splitdate[0];

                                $f = $f + (int)$ir["qty"];

                                if ($pdate == $today) {
                                    $a = $a + (int)$ir["total"];
                                    $c = $c + (int)$ir["qty"];
                                }
                                $splitmonth = explode("-", $pdate);
                                $year = $splitmonth[0];

                                $pmonth = $splitmonth[1];

                                if($year == $thisyear){
                                    if ($pmonth == $thismonth) {
                                        $b = $b + (int)$ir["total"];
                                        $e = $e + (int)$ir["qty"];
                                    }
                                }


                                
                            }


                            ?>
                            <div class="row g-1">
                                <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Daily Earning</span>
                                    <br />

                                    <span class="fs-5">Rs.<?php echo $a; ?>.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-2 py-1">
                            <div class="row g-1">
                                <div class="col-12 bg-white text-black text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Monthly Earnings</span>
                                    <br />
                                    <span class="fs-5">Rs. <?php echo $b; ?>.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 px-2 py-1">
                            <div class="row g-1">
                                <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Today Sellings</span>
                                    <br />
                                    <span class="fs-5"><?php echo $c ?> Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 px-2 py-1">
                            <div class="row g-1">
                                <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Monthly Sellings</span>
                                    <br />
                                    <span class="fs-5"><?php echo $e; ?> Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 px-2 py-1">
                            <div class="row g-1">
                                <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Total Selling</span>
                                    <br />
                                    <span class="fs-5"><?php echo $f; ?> Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 px-2 py-1">
                            <div class="row g-1">
                                <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <?php
                                    $userrs = Database::search("SELECT*FROM `user`");
                                    $un = $userrs->num_rows;

                                    ?>
                                    <span class="fs-4 fw-bold">Total Engagements</span>
                                    <br />
                                    <span class="fs-5 text-white"><?php echo $un; ?> Members</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-lg-2 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white text">
                                        Total Active Time
                                    </label>
                                </div>
                                <?php

                                $startdate = new DateTime("2021-10-01 00:00:00");
                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $endDate->diff($startdate);

                                ?>
                                <div class="col-lg-10 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-success">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " . $difference->format('%d') . " days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Mins " . $difference->format('%s') . " Secs ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                        $freq = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' 
  GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");
                        $freqnum = $freq->num_rows;
                        $fpid = "";
                        if ($freqnum > 0) {
                        ?>
                            <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                                <div class="row g-1">
                                    <?php





                                    for ($z = 0; $z < $freqnum; $z++) {
                                        $freqrow = $freq->fetch_assoc();
                                        $fpid = $freqrow["product_id"];
                                    }
                                    $popularrs = Database::search("SELECT*FROM `product` WHERE `id`='" . $fpid . "'");
                                    $prow = $popularrs->fetch_assoc();

                                    ?>
                                    <?php


                                    ?>

                                    <div class="col-12 text-center ">
                                        <label class="form-label fs-3 fw-bolder mt-1">Mostly Sold Item</label>
                                    </div>
                                    <div class="col-12">
                                        <?php

                                        $pimgrs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $fpid . "' ");
                                        $pimgdata = $pimgrs->fetch_assoc();

                                        ?>
                                        <img src="resources/products//<?php echo $pimgdata["code"]; ?>" class="img-fluid rounded-top">
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo $prow["title"]; ?></span>
                                        <br />
                                        <span class="fs-6"><?php echo $prow["qty"]; ?> Items</span>
                                        <br />
                                        <span class="fs-6">Rs.<?php echo $prow["price"]; ?>.00</span>
                                    </div>

                                    <div class="col-12">
                                        <div class="firstplace">

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                                <?php

                                $sellrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $prow["user_email"] . "' ");
                                $sedata = $sellrs->fetch_assoc();

                                $simgrs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $sedata["email"] . "' ");


                                ?>
                                <div class="row g-1 mt-1">
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-3 fw-bolder">Mostly Popular Seller</label>
                                </br>
                                        <?php

                                        if ($simgrs->num_rows == 0) {
                                        ?>
                                            <img src="resources//demoProfileImg.png" class="rounded-circle" height="250px" />
                                        <?php
                                        } else {
                                            $simdata = $simgrs->fetch_assoc();
                                        ?>
                                            <img src="<?php echo $simdata["code"]; ?>" class="rounded-circle" height="250px" />
                                        <?php
                                        }

                                        ?>
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo $sedata["fname"] . " " . $sedata["lname"]; ?></span>
                                        <br />
                                        <span class="fs-6"><?php echo $sedata["email"]; ?></span>
                                        <br />
                                        <span class="fs-6"><?php echo $sedata["mobile"]; ?></span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstplace">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                                <div class="row g-1">


                                    <div class="col-12 text-center ">
                                        <label class="form-label fs-3 fw-bolder mt-1">Mostly Sold Item</label>
                                    </div>
                                    <div class="col-12 text-center">

                                        <img src="resources/binoculars-fill.svg" style="height: 150px;" class="img-fluid rounded-top">
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-3 fw-bold">No Product Found</span>
                                    </div>

                                    <div class="col-12">
                                        <div class="firstplace">

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">

                                <div class="row g-1 mt-1">
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-3 fw-bolder">Mostly Popular Seller</label>
                                        <br/>

                                        <img src="resources//person-x-fill.svg" style="height: 150px;" class="rounded-circle" height="250px" />
                                        <hr />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-3 fw-bold">No Seller Found</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstplace">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php

                        }

                        ?>

                    </div>
                </div>
            </div>
            <div class="row"> <?php require "footer.php"; ?></div>
            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
    </body>

    </html>


<?php
} else {
?>
    <script>
        window.location = "adminsignin.php"
    </script>
<?php
}


?>