<?php
require "db.php";
session_start();
if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $productrs = Database::search("SELECT*FROM `product` WHERE `id` = '" . $pid . "'");
    $pn = $productrs->num_rows;
    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>Single Product View</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
                    require "header.php";
                    if ($_SESSION["u"]) {

                    ?>

            <div class="col-12 mt-0 singleproduct main-background">
                <div class="row">
                    <div class="col-12 mb-3">
                        <nav>
                            <ol class="d-flex flex-wrap mb-0 list-unstyled main-background ">
                                <li class="breadcrumb-item"><a class="text-warning text-decoration-none text-bold"
                                        href="home.php">Home</a></li>
                                <li class="breadcrumb-item text-warning"><a href="#"
                                        class="text-warning text-decoration-none">Single
                                        View</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-12 bg-dark rounded" style="padding: 11px;">
                        <div class="row">
                            <?php
                                                $imagesrs = Database::search("SELECT*FROM `image` WHERE `product_id`='" . $pid . "'");
                                                $in = $imagesrs->num_rows;
                                                $img1;
                                                if (!empty($in)) {
                                                  
                                                        $d = $imagesrs->fetch_assoc();

                                                      
                                                            $img1 = $d["code"];
                                                     
                                                ?>

                            <?php
                                                  
                                                } else {
                                                   

                                                }

                                                ?>

                            <div class="col-lg-6 order-2 order-lg-1 d-none d-lg-block">
                                <div class="d-flex flex-column align-items-center border border-2 border-success p-3">
                                    <img src="resources/products//<?php echo $img1 ?>" id="mainimg" width="100%" />
                                </div>
                            </div>
                            <div class="col-lg-6 order-3">
                                <div class="row">
                                    <div class="col-12 pe-0">
                                        <div class="row">
                                            <div class="col-12"><label
                                                    class="form-label text-info fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                            </div>
                                            <div class="col-12">
                                                <?php 
                                                             $colorrs = Database::search("SELECT*FROM `color` WHERE `id` = '".$pd["color_id"]."' ");
                                                               $clrd = $colorrs->fetch_assoc();
                                                            ?>
                                                <label class="text-warning"><?php echo $clrd["name"]; ?></label>
                                            </div>
                                            <div class="d-inline-block col-12">
                                                <label
                                                    class="fw-bold mt-1 fs-4 text-white"><?php echo $pd["price"] . ".00"; ?></label>
                                                <label
                                                    class="fw-bold mt-1 me-3 fs-5 text-danger"><del><?php $val = $pd["price"];
                                                                                                                    $newval = $val + ($val / 100) * 25;
                                                                                                                    echo $newval . ".00"; ?></del></label>
                                            </div>
                                            <div class="col-12">
                                                <hr class="hrbreak1" width="95%" />
                                            </div>
                                            <div class="col-12">
                                                <label class="text-white fs-5"><b>Warranty : </b>06 Months
                                                    Warranty</label><br />
                                                <label class="text-white fs-5"><b>Return Policy : </b>01 Month Return
                                                    Policy</label><br />
                                                <label class="text-white fs-5"><b>In Stock :
                                                    </b><?php echo $pd["qty"] ?> items
                                                    left</label>
                                            </div>
                                            <hr class="hrbreak1" />
                                            <div class="col-12">
                                                <label class="text-dark fs-3"><b>Seller Details</b></label><br />
                                                <?php
                                                            $userrs = Database::search("SELECT*FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                                            $userd = $userrs->fetch_assoc();
                                                            ?>
                                                <label class="text-success fs-6">Seller's
                                                    Name:<b><?php echo "  " . $userd["fname"] . " " . $userd["lname"]; ?></b></label><br />
                                                <label class="text-primary fs-6">Seller's
                                                    Email:<b><?php echo "  " . $userd["email"]; ?></b></label><br />
                                                <label class="text-primary fs-6">Seller's
                                                    Contact:<b><?php echo "  " . $userd["mobile"]; ?></b></label>
                                                <div class="row">
                                                    <div class="col-6"></div>
                                                    <div class="col-6">
                                                        <a class="btn text-info d-block mb-2"
                                                            href="messages.php?to=<?php echo $userd["email"]; ?>"><i
                                                                class="bi bi-chat-right-dots-fill">&nbsp;</i>Contact
                                                            Seller</a>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- <div class="col-12">
                                                <div class="row" style="margin-top:15px">
                                                    <div class="col-md-6" style="margin-top:15px;">
                                                        <lable class="fs-6 mt-1">Colour Options :</lable><br /><button
                                                            class="btn btn-primary">Black</button>
                                                        <button class="btn btn-primary">Blue</button>
                                                        <button class="btn btn-primary">Gold</button>
                                                    </div>

                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <hr class="hrbreak1" style="width: 95%;" />
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                        <div class="row">
                                                            <div
                                                                class="border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative bg-dark">
                                                                <span class="mt-2 text-white-50">QTY :</span>
                                                                <input id="qtyinput" type="number" pattern="[0-9]*"
                                                                    value="1"
                                                                    class="text-white bg-dark d-block border-0 fs-6 fw-bold text-center pe-2 mt-2"
                                                                    style="outline: none;" />
                                                                <div class="qty-buttons position-absolute">
                                                                    <div
                                                                        class="d-flex flex-column align-items-center border boerder-1 border-secondary qty-inc">
                                                                        <i class="fas fa-chevron-up text-success"
                                                                            onclick="qtyinc(<?php echo $pd['qty']; ?>);"></i>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex flex-column align-items-center border boerder-1 border-secondary qty-dec">
                                                                        <i class="fas fa-chevron-down text-success"
                                                                            onclick="qtydec();"></i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-4 col-lg-4 d-grid"><button
                                                                    class="btn btn-primary"
                                                                    onclick="addToCart('<?php echo $_GET['id']; ?>')"
                                                                    ;>Add To Cart</button></div>
                                                            <div class="col-4 col-lg-4 d-grid"><button
                                                                    class="btn btn-success" type="submit"
                                                                    id="payhere-payment"
                                                                    onclick="paynow(<?php echo $pid; ?>);">Buy
                                                                    Now</button></div>
                                                            <div class="col-4 col-lg-4 d-grid"><i
                                                                    class="fa fa-heart black mt-2 fs-4"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 bg-transparent">
                        <div class="row d-block me-0 mt-4 mb-3 border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-12">
                                <span class="fs-3 fw-bold text-warning">Related Items</span>
                                <hr class="hrbreak1">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 main-background">

                        <div class="row">
                            <div class="col-md-10 offset-md-1">

                                <div class="row p-2">
                                    <?php
                                                $brandsid = Database::search("SELECT `product`.`id`,`product`.`title`,`product`.`price`,`model_has_brand`.`model_id`,`model_has_brand`.`brand_id` FROM product LEFT JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`id` LIMIT 4");
                                                $bds = $brandsid->num_rows;
                                                for ($g = 0; $g < $bds; $g++) {
                                                    $bdf = $brandsid->fetch_assoc();
                                                    $riimage= Database::search("SELECT*FROM `image` WHERE `product_id` = '".$bdf["id"]."' ");
                                                        $red = $riimage->fetch_assoc();
                                                  
                                                ?>
                                    <div class="card me-1 bg-secondary" style="width: 18rem;">
                                        <img src="resources//products/<?php echo $red["code"]; ?>" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $bdf["title"]; ?></h5>
                                            <p class="card-text"><?php echo $bdf["price"]; ?></p>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-5 d-grid"><a href="#" class="btn btn-primary"
                                                            onclick="addToCartfromwishlist(<?php echo $bdf['id']; ?>);">Add
                                                            to
                                                            Cart</a></div>
                                                    <div class="col-5 d-grid"> <a
                                                            href="<?php echo "singleproductview.php?id=" . ($bdf['id']); ?>"
                                                            class="btn btn-success">Buy
                                                            Now</a>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="#"
                                                            onclick="addToWatchList(<?php echo $bdf['id']; ?>);"><i
                                                                class="fa fa-heart black fs-2 mt-2 text-danger"></i></a>
                                                    </div>
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
                    </div>
                    <div class="col-12 bg-secondary">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Product Details</span>
                            </div>
                        </div>

                    </div>
                    <div class="col-12" style="background-color: #8DB600;">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fw-bold fs-5">Brand</label>
                                    </div>
                                    <div class="col-10">
                                        <?php
                                                    $modelhasbrandrs = Database::search("SELECT*FROM `model_has_brand` WHERE `id`='" . $pd["model_has_brand_id"] . "'");
                                                    $rsmhb = $modelhasbrandrs->fetch_assoc();
                                                    $brandnamers = Database::search("SELECT*FROM `brand` WHERE `id`='" . $rsmhb["brand_id"] . "' ");
                                                    $brandname = $brandnamers->fetch_assoc();
                                                    $modelnamers =  Database::search("SELECT*FROM `model` WHERE `id`='" . $rsmhb["model_id"] . "' ");
                                                    $modelname = $modelnamers->fetch_assoc();
                                                    ?>
                                        <label class="form-label fw-bold fs-5"><?php echo $brandname["name"]; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fw-bold fs-5">Model</label>
                                    </div>
                                    <div class="col-10">
                                        <label class="form-label fw-bold fs-5"><?php echo $modelname["name"]; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label fw-bold fs-5">Description</label>
                                    </div>
                                    <div class="col-10">
                                        <textarea class="form-control" cols="60" rows="10"
                                            readonly><?php echo $pd["description"]; ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 " style="background-color: #6699CC;">
                        <div class="row d-block me-0 mt-4 mb-3 border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-12">
                                <span class="fs-3 fw-bold">FeedBacks...</span>
                                <hr class="hrbreak1" />
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <?php
                                                $feedbackrs = Database::search("SELECT*FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                                $feed = $feedbackrs->num_rows;
                                                if ($feed == 0) {
                                                ?>
                                    <div class="col-12"><label class="form-label fs-3 text-center">There are No
                                            feedbacks on this product</label></div>
                                    <?php
                                                } else {
                                                    for ($a = 0; $a < $feed; $a++) {
                                                        $feedrow = $feedbackrs->fetch_assoc();
                                                        $userrs = Database::search("SELECT*FROM `user` WHERE `email`='" . $feedrow["user_email"] . "' ");
                                                    ?>

                                    <div
                                        class="col-12 col-lg-6 offset-lg-2 border border-1 border-danger mt-2 rounded bg-white">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold text-primary">Yasiru Sandun</span>
                                            </div>
                                            <div class="col-12">
                                                <span class="fs-6 text-dark"><?php echo $feedrow["feed"]; ?></span>
                                            </div>
                                            <div class="col-12 text-end">
                                                <span style="font-size: 12px;"
                                                    class="text-dark"><?php echo $feedrow["date"]; ?></span>
                                            </div>
                                        </div>
                                    </div>




                                    <?php
                                                    }
                                                }
                                                ?>



                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
                    } else {
                    ?>
            <script>
            window.location = "index.php";
            alert("Please Sign In First");
            </script>
            <?php
                    }
                    ?>
            <?php
                    require "footer.php";
                    ?>
        </div>

    </div>
    <script src="sweetalert.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>

<?php
    }
}

?>