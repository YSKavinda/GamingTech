<!DOCTYPE html>
<html>

<head>
    <title>eShop|User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="resources/logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="headimg">
    <?php session_start();
    require "db.php";
    if (isset($_SESSION["u"])) {
    ?>


        <div class="container-fluid bg-dark text-white rounded mt-5 mb-2">
            <div class="row">

                <Div class="col-12 col-lg-4 offset-lg-4">
                    <h2 class="text-center">Seller Dashboard</h2>
                </Div>
            </div>
            <div class="row">

                <Div class="col-2 col-lg-3 d-grid">
                    <a class="btn text-center text-warning border-bottom-1" href="home.php">&lt; Back To Home <h3 class="d-inline-block">&#8962;</h3></a>
                </Div>
            </div>
            <div class="row">
                <div class="col-md-3 border-end border-secondary rounded">
                    <div class="d-flex flex-column align-items-center">
                        <?php
                        $profileimg = Database::search("SELECT*FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                        $pn = $profileimg->num_rows;
                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                        ?>
                            <img class="rounded-circle mt-5" id="proimg" src="<?php echo $p["code"]; ?>" height="150px" />
                        <?php
                        } else {
                        ?><img class="rounded-circle mt-5" src="resources//demoProfileImg.jpg" height="150px" id="proimg" />
                        <?php
                        }
                        ?>

                        <span class="font-weight-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                        <span class="text-info"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input class="d-none" type="file" id="profileimg" accept="image/*" />
                        <label for="profileimg" class="btn btn-success text-white fw-bolder mt-2 mb-5" style="background-color:  #7dc734;" for="profileimg" onclick="changeProfileImage();">Update
                            Profile Image</label>
                    </div>

                </div>
                <div class="col-md-5 border-end border-secondary">
                    <div class="p-3 py-5">
                        <Div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right text-success fw-bold">User Stats</h4>
                        </Div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"]; ?>" id="fn" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"]; ?>" id="ln" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Mobile" id="mobile" value="<?php echo $_SESSION["u"]["mobile"]; ?>">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" placeholder="Enter emaid id" value="<?php echo $_SESSION["u"]["email"]; ?>" disabled>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input type="text" class="form-control" placeholder="registered date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>">
                            </div>
                            <?php
                            $usermail = $_SESSION["u"]["email"];
                            $address = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='" . $usermail . "'");
                            $n = $address->num_rows;
                            if ($n == 1) {
                                $d = $address->fetch_assoc();
                            ?>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 01" value="<?php echo $d["line1"]; ?>" id="line01">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 02" value="<?php echo $d["line2"]; ?>" id="line02">
                                </div>
                        </div>
                        <?php


                                $cityid = $d["city_id"];
                                $ucity = Database::search("SELECT*FROM `city` WHERE `id`='" . $cityid . "'");
                                $c = $ucity->fetch_assoc();

                                $districtid = $c["district_id"];
                                $udist = Database::search("SELECT*FROM `district` WHERE `id`='" . $districtid . "'");
                                $k = $udist->fetch_assoc();

                                $provinceid = $k["province_id"];
                                $uprovince = Database::search("SELECT*FROM `province` WHERE `id`='" . $provinceid . "'");
                                $l =  $uprovince->fetch_assoc();

                        ?>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Province</label>
                                <select id="province" class="form-select">
                                    <option value="<?php echo $l["id"]; ?>"><?php echo $l["name"]; ?></option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">District</label>
                                <select id="District" class="form-select">
                                    <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>


                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <?php
                                $cityid = $d["city_id"];
                                $ucity = Database::search("SELECT*FROM `city` WHERE `id`= '" . $cityid . "'");
                                $c = $ucity->fetch_assoc();
                                ?>
                                <select class="form-select" id="city" value="<?php echo $c["name"]; ?>">
                                    <option value="<?php echo $c["id"]; ?>"><?php echo $c["name"]; ?></option>
                                    <?php
                                    $listcityrs = Database::search("SELECT*FROM `city` WHERE `id`!='" . $c["id"] . "' ");
                                    $listcn = $listcityrs->num_rows;

                                    for ($z = 0; $z < $listcn; $z++) {
                                        $citylist = $listcityrs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $citylist["id"]; ?>"><?php echo $citylist["name"]; ?></option>
                                    <?php



                                    }


                                    ?>
                                </select>
                            </div>

                        <?php
                            } else {
                        ?>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address Line 01</label>
                                <input type="text" class="form-control" placeholder="Enter address line 01" value="" id="line01">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address Line 02</label>
                                <input type="text" class="form-control" placeholder="Enter address line 02" value="" id="line02">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-8">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city" value="<?php echo $c["name"]; ?>" onchange="setdist();">
                                    <?php
                                    $listcityrs = Database::search("SELECT*FROM `city`");
                                    $listcn = $listcityrs->num_rows;

                                    for ($z = 0; $z < $listcn; $z++) {
                                        $citylist = $listcityrs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $citylist["id"]; ?>"><?php echo $citylist["name"]; ?></option>
                                    <?php



                                    }


                                    ?>
                                </select>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12" id="reigonbox">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Province</label>
                                            <select id="province" class="form-select disabled">
                                                <option value="0">Select Province</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">District</label>
                                            <select id="District" class="form-select">
                                                <option value="0">Select District</option>


                                            </select>
                                        </div>
                                    </div>

                                </div>



                            </div>


                        <?php
                            }
                        ?>


                        </div>
                        <div class="row">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <?php

                                $searchinvoice = Database::search("SELECT*FROM `invoice` WHERE `product_id` IN (SELECT `id` FROM `product` WHERE `user_email`='" . $_SESSION["u"]["email"] . "')");
                                $pn = $searchinvoice->num_rows;




                                ?>
                                <h3>Selling Stats</h3>
                            </div>
                        </div>
                        <div class="row mt-3 fs-5">
                            <div class="col-6"><span>Total Sales</span>
                            </div>
                            <div class="col-6 text-warning"><span><?php if ($pn > 0) {
                                                                        $itemno = 0;
                                                                        for ($zd = 0; $zd < $pn; $zd++) {
                                                                            $sd = $searchinvoice->fetch_assoc();
                                                                            $itemno = $sd["qty"] + $itemno;
                                                                        }
                                                                        echo $itemno . " Items";
                                                                    } else {
                                                                        echo "No Sold Items Yet";
                                                                    } ?></span>
                            </div>

                        </div>
                        <?php

                        $searchinvoicers = Database::search("SELECT*FROM `invoice` WHERE `product_id` IN (SELECT `id` FROM `product` WHERE `user_email`='" . $_SESSION["u"]["email"] . "')");
                        $pnn = $searchinvoicers->num_rows;




                        ?>
                        <div class="row mt-3 fs-5">
                            <div class="col-6"><span>Total Income</span>
                            </div>
                            <div class="col-6 text-warning"><span>
                                    <?php
                                    if ($pnn > 0) {

                                        $totalincome = 0;
                                        for ($x = 0; $x < $pnn; $x++) {

                                            $indata = $searchinvoicers->fetch_assoc();

                                            $totalincome = $indata["total"] + $totalincome;
                                        }
                                        echo $totalincome . ".00";
                                    } else {
                                        echo "Rs. 00/=";
                                    }

                                    ?>
                                </span>
                            </div>

                        </div>
                        <div class="row text-white mt-3 fs-5">
                            <div class="col-6"><span>Most Selling Item</span></div>
                            <?php $countrs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `sellcou` FROM `invoice` WHERE `product_id` IN(SELECT `id` FROM `product` WHERE `user_email`='" . $_SESSION["u"]["email"] . "') GROUP BY `product_id` ORDER BY `sellcou` DESC LIMIT 1");
                            $cnrs = $countrs->num_rows;
                            if ($cnrs == 1) {
                                //ena product eka 1k nm
                                $countdata = $countrs->fetch_assoc();
                                $pid1 = $countdata["product_id"];
                                $findproduct = Database::search("SELECT*FROM `product` WHERE `id` = '" . $pid1 . "' ");
                                $fnr = $findproduct->num_rows;
                                if ($fnr == 1) {
                                    //ona product eka awoth
                                    $fpdata = $findproduct->fetch_assoc();

                            ?>
                                    <div class="col-6 text-warning "><span><?php echo $fpdata["title"] ?></span></div>
                                <?php

                                } else {


                                ?>
                                    <div class="col-6 text-warning"><span>No product to View</span></div>
                                <?php

                                }
                            } else {

                                ?>
                                <div class="col-6 text-warning"><span>No product to View</span></div>
                            <?php

                            }


                            ?>




                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php

                require "footer.php";
                ?>
            </div>
        </div>
    <?php } else { ?>
        <script>
            window.location = "index.php";
        </script>
        <script src="script.js"></script>

    <?php
    }
    ?>
    <script src="sweetalert.min.js"></script>
    <script src="script.js"></script>
    <script src="jquery.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>