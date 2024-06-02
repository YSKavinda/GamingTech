<?php
require "db.php";
session_start();
?>
<!DOCTYPE html>
<HTML>

<head>
    <meta charset="utd-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>gTech home</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body onload="<?php echo "loopmsgs();" ?>" class="main-background">
    <div class="container-fluid">
        <div class="row">
            <!--header-->
            <?php require "header.php" ?>
            <!--header-->
            <hr class="hrbreak1" />

            <div class="col-12 d-none d-lg-block">
                <div class="row">

                    <div class="col-8">


                        <div class="row">
                            <div id="carouselExampleCaptions" class="carousel slide col-12" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="slider/posterimg.jpg" class="d-block posterimg1">
                                        <div class="carousel-caption d-none d-md-block postercaption1">
                                            <h5 class="poster-title text-info">Gaming Tech is for You</h5>
                                            <p class="poster-text fw-bold text-light
                                    ">All the Gaming Equipment & Gear</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider/posterimg2.jpg" class="d-block posterimg1">
                                        <div class="carousel-caption d-none d-md-block postercaption2 mb-5">
                                            <h5 class="poster-title text-success">Quality Products!</h5>
                                            <p class="poster-text text-light">Best Products with Popular Brands</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="slider/posterimg3.jpg" class="d-block posterimg1">
                                        <div class="carousel-caption d-none d-md-block postercaption3">
                                            <h5 class="poster-title text-info">Be Free....!</h5>
                                            <p class="poster-text text-light ms-5">Let us Handle All things till
                                                delivery to doorstep...</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>



                    </div>
                    <div class="col-4">
                        <div class="row mb-1">
                            <div class="col-12 text-start fs-4 d-grid" style="height: 300px; background-color:rgb(216, 241, 165);" >
                                   <div class="row">
                                       <div class="col-10 offset-1 text-center">
                                       <i class="bi bi-shield-shaded" style="font-size: 144px;"></i>
                                       </div>
                                   </div>
                                   <div class="row">
                                   <div class="col-10 offset-1 text-center mb-4">
                                         <h3 class="fw-bold">Quality Assured Warranty for Every Product</h3>
                                       </div>
                                   </div>

                               

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 text-start fs-4 d-grid" style="height: 300px; background-color:rgb(216, 241, 165);" >
                                   <div class="row">
                                       <div class="col-10 offset-1 text-center">
                                       <i class="bi bi-truck" style="font-size: 144px;"></i>
                                       </div>
                                   </div>
                                   <div class="row">
                                   <div class="col-10 offset-1 text-center mb-5">
                                         <h2 class="fw-bold">Island Wide Delivery Service</h2>
                                       </div>
                                   </div>

                               

                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

        <hr class="hrbreak1">

        <!--search by -->
        <div class="row">
            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="col-12 col-lg-1 offset-lg-1 mt-3 mt-lg-1 logoimg" style="background-position: center;">
                    </div>
                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <select class="col-12 col-md-4 btn btn-outline-success fs-6" id="basic_search_select">
                                <option value="0">Select Category</option>
                                <?php
                                $rs = Database::search("SELECT*FROM `category`;");
                                $n = $rs->num_rows;
                                for ($i = 0; $i < $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }
                                ?>
                                <!-- <li><a class="dropdown-item" href="#">Cell Phones & Accessories</a></li>
                                <li><a class="dropdown-item" href="#">Computers & Tablets</a></li>
                                <li><a class="dropdown-item" href="#">Cameras</a></li>
                                <li><a class="dropdown-item" href="#">Camera Drones</a></li>
                                <li><a class="dropdown-item" href="#">Video Game Consoles</a></li> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-8 offset-2 offset-lg-2 col-lg-6 d-grid"><button class="btn btn-info mt-3 searchbtn fs-5 fw-bold text-white" onclick="basicsearch();">Search</button>
                            </div>
                            <div class="col-8 offset-2 col-md-2 mt-4 ms-4 mt-lg-4 gap-lg-2"><a class="adserch link-success" href="advancedsearch.php">Advanced</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--searchbar-->
        <hr class="hrbreak1">



        <!--Product View-->


        <!-- searchresultview -->
        <div class="row">
            <div class="col-12 mb-2 mt-5 d-none" id="srviewbox">
                <div class="row mb-4 pt-2 pb-2" style="box-shadow: 0px 1px 5px 1px grey;">
                    <div class="col-12 offset-lg-1 col-lg-10">
                        <div class="row" id="searchbox">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- searchresultview -->

        <div class="row">
            <div class="col-12" id="pviewbox">
                <div class="row">


                    <?php
                    $rs = Database::search("SELECT*FROM `category`; ");
                    $n = $rs->num_rows;

                    for ($x = 0; $x < $n; $x++) {
                        $c = $rs->fetch_assoc();
                    ?>
                        <div class="col-12 ms-3">
                            <a href="#" class="text-success link2"><?php echo $c["name"]; ?></a> &nbsp; &nbsp;
                            <a id="sall<?php echo $c['id']; ?>" onclick="seeall(<?php echo $c['id']; ?>);" class="link-dark link3 text-secondary d-inline-block" style="cursor: pointer;">See all
                                &rightarrow;</a>
                            <a id="call<?php echo $c['id']; ?>" onclick="collapse(<?php echo $c['id']; ?>);" class="link-dark link3 text-secondary d-none" style="cursor: pointer;">Collapse &leftarrow;</a>

                        </div>
                        <?php
                        $resultset = Database::search("SELECT*FROM `product` WHERE `category_id` = '" . $c["id"] . "' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 5");
                        $nr = $resultset->num_rows;
                        ?>
                        <div class="col-12" id="itembox<?php echo $c['id']; ?>">
                            <div class="row mb-4 pt-2 pb-2" style="box-shadow: 0px 1px 5px 1px grey;">
                                <div class="col-12 offset-lg-1 col-lg-10">
                                    <div class="row" id="pdetails">
                                        <?php
                                        for ($y = 0; $y < $nr; $y++) {
                                            $prod = $resultset->fetch_assoc();
                                        ?>
                                            <div class="card bg-white col-12 ms-lg-1 col-lg-2 offset-lg-0 mt-1 mb-1 img-thumbnail cardwidth">
                                                <?php
                                                $pimage = Database::search("SELECT*FROM `image` WHERE `product_id`='" . $prod["id"] . "'");
                                                $imgrow = $pimage->fetch_assoc();
                                                ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img class="card-img-top cardToping" src="resources/products/<?php echo $imgrow["code"]; ?>" alt="<?php echo $imgrow["code"]; ?>">
                                                    </div>

                                                </div>

                                                <div class="card-body mt-1">
                                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-danger ms-1">Latest</span></h5>
                                                    <span class="card-text text-primary"><?php echo $prod["price"]; ?></span>
                                                    <br />
                                                    <?php
                                                    if ((int)$prod["qty"] > 0) { ?>
                                                        <span class="card-text text-warning"><?php echo "In Stock"; ?></span>
                                                        <input class="form-control" type="number" value="1" id="qty">
                                                        <br />
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod['id']); ?>" class="btn btn-success col-8 fs-6">Buy Now</a>
                                                        <a href="#" class="btn btn-danger col-3 fs-6" onclick="addToWatchList(<?php echo $prod['id']; ?>);"><i class="bi bi-heart-fill"></i></a>
                                                        <a class="btn btn-warning col-12 mt-2 fs-6" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart <i class="bi bi-cart-plus-fill fs-4"></i></a>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger"><?php echo "Out of Stock"; ?></span>
                                                        <input class="form-control" type="number" value="1" disabled>
                                                        <br />
                                                        <a href="#" class="btn btn-success disabled">Buy Now</a>
                                                        <a class="btn btn-danger disabled">Add to cart<i class="bi bi-cart-plus-fill fs-4"></i></a>
                                                        <a href="#" class="btn btn-secondary gx-5 gy-2"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
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





        <!--Product View-->
        <!--footer-->
        <div class="row">
        <?php require "footer.php"; ?>
        </div>
        
        <!--footer-->

        <div class="row fixed-bottom mb-5">
            <div class="col-11">

            </div>
            <div class="col-1">
                <i class="bi bi-chat-dots p-1 rounded fs-2 text-primary" style="cursor: pointer;" onclick="<?php if (isset($_SESSION['u'])) {
                                                                                                            ?>viewmsgmodal('<?php echo $_SESSION['u']['email']; ?>');
                        <?php } ?>"></i>
            </div>

        </div>
        <?php
        if (isset($_SESSION["u"])) {
            require "customeradmmincontact.php";
        }
        ?>
    </div>
</body>
<script src="sweetalert.min.js"></script>
<script src="script.js"></script>
<script src="bootstrap.bundle.js"></script>

</HTML>