<?php
session_start();
require "db.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: 	#6899ce"><?php
                                            if (isset($_SESSION["u"])) {
                                            ?><div class="container-fluid">
            <div class="row bg-dark">
                <div class="col-10 mb-2">
                    <h3 class="h2 text-center text-info mb-5 mt-3">Add Your Product to Your Store</h3>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-12 mt-4 mt-lg-3">
                            <a href="home.php" class="text-decoration-none text-success fs-5"><span class="d-none d-md-inline-block">to Home</span> <i class="bi bi-house-door-fill text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">

                    <div class="row mb-2">

                        <!-- <div id="addproductbox"> -->


                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Select Product Category</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" id="ca">
                                                <option value="0">Select Category</option>
                                                <?php
                                                $catrs = Database::search("SELECT*FROM `category`;");
                                                $catn = $catrs->num_rows;
                                                for ($i = 0; $i < $catn; $i++) {
                                                    $catd = $catrs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $catd["id"] ?>"><?php echo $catd["name"]; ?>
                                                    </option>
                                                <?php

                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Select Product Brand</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" id="br" onchange="selectmodel();">
                                                <option value="0">Select Brand</option>
                                                <?php
                                                $brandrs = Database::search("SELECT*FROM `brand`;");
                                                $brandn = $brandrs->num_rows;
                                                for ($i = 0; $i < $brandn; $i++) {
                                                    $brandd = $brandrs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brandd["id"] ?>"><?php echo $brandd["name"]; ?>
                                                    </option>
                                                <?php

                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Select Product Model</label>
                                        </div>
                                        <div class="col-12" id="smodelbox">
                                            <select class="form-select" id="mo">
                                                <option value="0">Select Model</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-12 mb-4">
                                            <label class="form-label ms-2 fw-bold">Cost per Item</label>
                                        </div>
                                        <div class="col-10 offset-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" id="cost" aria-label="Amount (to the nearest dollar)">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--title-->
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <label class="form-label lbl1">Add a Title to the Product</label>
                                </div>
                                <div class="offset-md-2 col-12 col-md-8">
                                    <input class="form-control" type="text" id="ti" />
                                </div>
                            </div>


                            <!--condition/color/quantity-->
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="row mt-3 ">
                                        <div class="col-12 text-center">
                                            <label class="form-label lbl1">Select Product Condition</label>
                                            <hr />
                                        </div>
                                        <div class="offset-md-3 col-12 col-md-3 ms-5 form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="Bn" name="cond">
                                                <label class="form-check-label" for="Bn">
                                                    Brand New
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-md-3 col-12 col-md-3 ms-5 form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="Usd" name="cond" checked>
                                                <label class="form-check-label" for="Usd">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-8 offset-2 mt-3 text-center">
                                            <label class="form-label lbl1">Select Product Colour</label>
                                            <select class="form-select" id="clr">
                                                <option value="0">Select Color</option>
                                                <?php
                                                $clrrs = Database::search("SELECT*FROM `color`;");
                                                $clrn  =  $clrrs->num_rows;
                                                for ($h = 0; $h < $clrn; $h++) {
                                                    $clrdata = $clrrs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $clrdata["id"]; ?>">
                                                        <?php echo $clrdata["name"]; ?></option>

                                                <?php

                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <hr class="my-3" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-10 offset-md-1 mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input class="form-control" type="number" value="0" min="0" id="q" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--condition/color/quantity-->




                        </div>
                        <!--title-->
                        <!--cost,Payment-method-->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6">

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Approved Payment Methods</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-2 pm1"></div>
                                                <div class="col-2 pm2"></div>
                                                <div class="col-2 pm3"></div>
                                                <div class="col-2 pm4"></div>
                                                <div class="col-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Delivery Cost</label>
                                </div>
                                <div class="col-12 offset-md-1 col-md-3">
                                    <label>Delivery Cost within colombo</label>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="dwc">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1"></label>
                                </div>
                                <div class="col-12 offset-md-1 col-md-3">
                                    <label>Delivery Cost Out of colombo</label>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--cost,Payment-method-->
                        <!--Description-->
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Product Descriprion</label>
                                </div>
                                <div class="col-12 col-md-12 d-grid">
                                    <textarea class="form-control" id="desc" cols="30" rows="10" style="background-color: ghostwhite;">

                </textarea>
                                </div>
                            </div>
                        </div>
                        <!--Description-->

                        <!--Product Img-->
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Image</label>
                                </div>
                                <img class="col-12 col-md-12 img-thumbnail ms-2" style="height: 250px;" src="resources/addproductimg.svg" id="prev" />
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-12 ms-2 mt-2">
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <input type="file" class="d-none" accept="img/*" id="imguploader" />
                                                    <label class="btn btn-primary col-12 mt-1" for="imguploader" onclick="changeImage();">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Product Img-->
                        <hr class="hrbreak1 my-3">
                        <!--notice-->
                        <!-- <div class="col-12">
                            <label class="form-label lbl1">Notice...</label>
                            <label class="form-label">We are taking 5% of the product price from every product as Service
                                Charge</label>
                        </div> -->
                        <!--notice-->
                        <!--Save btn-->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 offset-0 col-md-4 offset-md-4 d-grid">
                                    <button class="btn btn-success" style="height: 50px;" onclick="addproduct();">Add
                                        Product</button>
                                </div>

                            </div>
                        </div>

                        <!-- Save btn</div> -->
                        <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


                        <!--footer-->

                        <!--footer-->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <?php require "footer.php"; ?>
            </div>
        </div><?php
                                            } else {
                ?>
                <script src="sweetalert.min.js"></script>
        <script>
            window.location = "index.php";
        </script>
        <script src="script.js"></script>
    <?php
                                            } ?>



<script src="sweetalert.min.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>