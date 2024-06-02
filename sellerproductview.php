<?php
session_start();
require "db.php";
if (isset($_SESSION["u"])) {
    $pageno;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eShop Sellers Product View</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="icon" href="resources/logo.png" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: rgb(216, 241, 165);">
        <?php $user = $_SESSION["u"]; ?>
        <div class="container-fluid">
            <div class="row">
                <!--head-->
                <div class="col-12 main-background">
                    <div class="row my-2">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-4 mt-1 mb-1">
                                    <?php
                                    $profileimg = Database::search("SELECT*FROM `profile_img` WHERE `user_email`='" . $user["email"] . "'");
                                    $pn = $profileimg->num_rows;

                                    if ($pn == 1) {
                                        $pr = $profileimg->fetch_assoc();
                                    ?>
                                        <img class="rounded-circle" src="<?php echo $pr["code"]; ?>" height="78px" width="72px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img class="rounded-circle" src="resources/demoProfileImg.jpg" height="78px" width="72px" />
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <span class="fw-bold text-info"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $user["email"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-8 mt-4 offset-md-1">
                                    <h1 class="text-success fw-bold fs-1 text-center">My Stall</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="row">
                                <div class="col-12 mt-4 mt-lg-3">
                                    <a href="home.php" class="text-decoration-none text-success fs-5"><span class="d-none d-md-inline-block">to Home</span>  <i class="bi bi-house-door-fill text-white"></i></a>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
                <!--head-->
                <div class="col-12">
                    <div class="row">
                        <!--sorting-->
                        <div class="col-12 text-white">
                            <div id="filcanvas" class="filcanvas main-background">
                                <div class="row">
                                <div class="col-12 text-end"><button class="btn fw-bold fs-3 text-white" onclick="closefcanvas();">X</button></div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 rounded main-background">
                                                <div class="row px-3">
                                                    <div class="col-12 mt-3 fs-5" id="filters">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="form-label text-white fw-bold fs-3">Filters</label>
                                                            </div>
                                                            <div class="col-11">
                                                                <div class="row">
                                                                    <div class="col-10">
                                                                        <input type="text" placeholder="Search..." class="form-control" id="s">
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <label class="form-label text-white fs-4"><i class="bi bi-search"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-5">
                                                                <label class="form-label text-white">Acitve Time</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <hr width="80%" class="bg-secondary" />
                                                            </div>
                                                            <div class="col-12" style="font-size: 16px;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="radiobtn" id="n">
                                                                    <label class="form-check-label text-white" for="n">
                                                                        Newer To Oldest
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="radiobtn" id="o">
                                                                    <label class="form-check-label text-white" for="o">
                                                                        Oldest To Newer
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-5">
                                                                <label class="form-label text-white">By Quantity</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <hr width="80%" class="bg-secondary" />
                                                            </div>
                                                            <div class="col-12" style="font-size: 16px;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="radiobtn" id="l">
                                                                    <label class="form-check-label text-white" for="l">
                                                                        Low To High
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="radiobtn" id="h">
                                                                    <label class="form-check-label text-white" for="h">
                                                                        High To Low
                                                                    </label>
                                                                </div>
                                                                <div class="col-12 mt-5">
                                                                    <label class="form-label text-white">By Condition</label>
                                                                </div>
                                                                <div class="col-12">
                                                                    <hr width="80%" class="bg-secondary" />
                                                                </div>
                                                                <div class="col-12" style="font-size: 16px;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="radiobtn" id="b">
                                                                        <label class="form-check-label text-white" for="b">
                                                                            Brand New
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="radiobtn" id="u">
                                                                        <label class="form-check-label text-white" for="u">
                                                                            Used
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="offset-1 offset-lg-4 col-10 col-lg-4 d-grid my-3">
                                                                    <button class="btn btn-success mb-3" onclick="addfilters();">Search</button>
                                                                    <button class="btn btn-primary" onclick="clearfilters();">Clear Filters</button>
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
                        </div>

                        <div class="col-12 main-background"> <i class="bi bi-filter-square text-white fs-3" style="cursor: pointer;" onclick="openfcanvas();"><span class="text-warning fs-3">&nbsp;Filters</span></i></div>

                        <!--sorting-->
                        <!--product-->
                        <div class="col-12 offset-md-1 col-md-10 mt-3 mb-3 main-background rounded" id="box">
                            <div class="row">
                                <div class="col-12 offset-md-1 text-center">
                                    <div class="row mt-3">
                                        <?php
                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $products = Database::search("SELECT*FROM `product` WHERE `user_email`='" . $user["email"] . "';");
                                        $d = $products->num_rows;
                                        $row = $products->fetch_assoc();

                                        $results_per_page = 6;

                                        $number_of_pages = ceil($d / $results_per_page);
                                        $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                        $selectedrs = Database::search("SELECT*FROM `product` WHERE `user_email`='" . $user["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");
                                        $srn = $selectedrs->num_rows;
                                        $srow;
                                        //for($i = 0; $i<$srn; $i++){
                                        while ($srow = $selectedrs->fetch_assoc()) {
                                        ?><div class="card bg-transparent mb-3 col-12 col-lg-5 mx-md-2" style="box-shadow: 0px 0px 10px 2px black;">
                                                <div class="row g-0">
                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $srow["id"] . "'");
                                                    $pir = $pimgrs->fetch_assoc();
                                                    ?>
                                                    <div class="col-md-8 offset-md-2 mt-4 mb-4">
                                                        <img src="resources/products//<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-md-10 offset-md-1">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold text-info"><?php echo $srow["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-warning my-2"><?php echo $srow["price"]; ?>.00/=</span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $srow["qty"]; ?>
                                                                items left</span>
                                                            <div class="form-check form-switch my-1">
                                                                <input class="form-check-input" type="checkbox" onchange="changeStatus(<?php echo $srow['id']; ?>);" id="check" <?php if ($srow["status_id"] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                                <label class="form-check-label fw-bold text-info" id="checklabel<?php echo $srow["id"]; ?>">
                                                                    <?php if ($srow["status_id"] == 1) {
                                                                        echo "Make Your Product Deactive";
                                                                    } else {
                                                                        echo "Make Your Product Active";
                                                                    }
                                                                    ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6 d-grid mb-1 mb-md-0"><a href="#" class="btn btn-success fw-bold" style="font-size: 14px;" onclick="sendid(<?php echo $srow['id']; ?>);">Update
                                                                            Product</a>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6 d-grid mt-1 mt-md-0"><a href="#" class="btn btn-danger fw-bold" onclick="deleteModel(<?php echo $srow['id']; ?>);">Delete
                                                                            Product</a>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="deleteModel<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bolder text-danger" id="exampleModalLabel">Warning....!</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are You Sure to Delete This Product
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" onclick="deleteProduct(<?php echo $srow['id']; ?>);">Delete</button>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
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
                            <div class="row mt-4">
                                <div class="col-12 col-lg-4 offset-lg-4 d-grid">
                                    <a href="addproduct.php" class="btn btn-success fs-4 fw-bold">Add Products <b>+</b></a>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">

                                <!--pagination-->
                                <div class="col-12 text-center mb-3">
                                    <div class="pagination">
                                        <a class="text-white" href="<?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);
                                                                    } ?>">&laquo;</a>
                                        <?php
                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?><a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a><?php
                                                                                                                                } else {
                                                                                                                                    ?>
                                                <a class="text-white" href="<?php echo "?page=" . ($page) ?>" class="ms-1"><?php echo $page; ?></a>
                                        <?php
                                                                                                                                }
                                                                                                                            }
                                        ?>
                                        <a class="text-white" href="<?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
                                                                    } ?>">&raquo;</a>
                                    </div>
                                </div>
                                <!--pagination-->


                            </div>
                        </div>
                        <!--product-->
                    </div>
                </div>

            </div>
            <div class="row">
                <?php require "footer.php" ?>
            </div>
        </div>

        <script src="sweetalert.min.js"></script>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("You Have to Sign In Or Sign Up First");
        window.location = "index.php";
    </script>
<?php
}
?>