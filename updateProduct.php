<?php
session_start();
require "db.php";



if (isset($_SESSION["p"])) {
    $product = $_SESSION["p"];

?>




    <!DOCTYPE html>
    <html>

    <head>
        <title>gTech|Update Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" href="resources/logo.png" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: 	#6899ce">
        <div class="container-fluid">
            <div class="row main-background">

            <div class="col-10 pt-3">
                        <h3 class="h2 text-center text-info mb-5">Update Product</h3>
                    </div>
                    <div class="col-2">
                            <div class="row">
                                <div class="col-12 mt-4 mt-lg-3">
                                    <a href="home.php" class="text-decoration-none text-success fs-5"><span class="d-none d-md-inline-block">to Home</span>  <i class="bi bi-house-door-fill text-white"></i></a>
                                </div>
                            </div>
                        </div>


            </div>
            <div class="row mt-3 mb-3">
                <div id="updateproductbox" class="">
                    
                    <div class="col-12">
                        <div class="row my-3">
                            <div class="offset-0 offset-lg-1 col-12 col-lg-6 mb-2">

                            </div>
                            <div class="col-12 col-lg-4 d-grid mt-2 mt-lg-0 mb-2">

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label text-white fw-bold">Select Product Category</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="ca" disabled>

                                            <?php
                                            $category = Database::search("SELECT*FROM `category` WHERE `id`='" . $product["category_id"] . "'; ");
                                            $cd = $category->fetch_assoc();
                                            ?>

                                            <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>

                                            <?php
                                            $categoryother = Database::search("SELECT*FROM `category` WHERE `id`!='" . $product["category_id"] . "'; ");
                                            $cdn = $categoryother->num_rows;
                                            for ($i = 0; $i < $cdn; $i++) {
                                                $cdo = $categoryother->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $cdo["id"]; ?>"><?php echo $cdo["name"]; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label text-white fw-bold">Select Product Brand</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="br" disabled>
                                            <?php
                                            $modelHasbrand = Database::search("SELECT*FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "'; ");
                                            $mHb = $modelHasbrand->fetch_assoc();
                                            $brand = Database::search("SELECT*FROM `brand` WHERE `id`='" . $mHb["brand_id"] . "' ");
                                            $brandlist = $brand->fetch_assoc();
                                            ?>

                                            <option value="<?php echo $brandlist["id"]; ?>">
                                                <?php echo $brandlist["name"]; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label text-white fw-bold">Select Product Model</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="mo" disabled>
                                            <?php
                                            $model = Database::search("SELECT*FROM `model` WHERE `id`='" . $mHb["model_id"] . "' ");
                                            $modellist = $model->fetch_assoc();
                                            ?>

                                            <option value="<?php echo $modellist["id"]; ?>">
                                                <?php echo $modellist["name"]; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hrbreak1 my-3">
                    <!--title-->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1 text-white">Add a Title to a Product</label>
                            </div>
                            <div class="offset-lg-2 col-12 col-lg-8">
                                <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <!--title-->
                    <hr class="hrbreak1 my-3">
                    <!--condition/color/quantity-->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1 text-white">Select Product Condition</label>
                                    </div>
                                    <div class="offset-lg-1 col-12 col-lg-4 ms-5 form-check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Bn" disabled <?php
                                                                                                            if ($product["condition_id"] == 1) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?>>
                                            <label class="form-check-label text-white" for="Bn">
                                                Brand New
                                            </label>
                                        </div>
                                    </div>
                                    <div class="offset-lg-1 col-12 col-lg-4 ms-5 form-check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Usd" disabled <?php
                                                                                                            if ($product["condition_id"] == 2) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?>>
                                            <label class="form-check-label text-white" for="Usd">
                                                Used
                                            </label>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1 text-white">Select Product Colour</label>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-10 offset-1">
                                                <select class="form-select" disabled>
                                                    <option value="<?php echo $product["color_id"]; ?>">
                                                        <?php
                                                        $clrrs = Database::search("SELECT*FROM `color` WHERE `id` = '" . $product["color_id"] . "' ");

                                                        $clrdata = $clrrs->fetch_assoc();
                                                        echo $clrdata["name"];
                                                        ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1 text-white">Add Product Quantity</label>
                                        <input class="form-control" type="number" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                    </div>
                                </div>
                            </div>
                            <!--condition/color/quantity-->
                            <hr class="hrbreak1 my-3">
                            <!--cost,Payment-method-->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1 ms-2 text-white">Cost per Item</label>
                                            </div>
                                            <div class="col-10 offset-1">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" id="upcost" aria-label="Amount (to the nearest dollar)" value="<?php echo $product["price"]; ?>">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Delivery Cost</label>
                                    </div>
                                    <div class="col-12 offset-lg-1 col-lg-3">
                                        <label>Delivery Cost within colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="dwc" value="<?php echo $product["delivery_fee_colombo"]; ?>">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1"></label>
                                    </div>
                                    <div class="col-12 offset-lg-1 col-lg-3">
                                        <label>Delivery Cost Out of colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc" value="<?php echo $product["delivery_fee_other"]; ?>">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    
                                </div>
                            </div>
                           
                            
                            <!--cost,Payment-method-->
                            <hr class="hrbreak1 my-3">
                            <!--Description-->
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Product Descriprion</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" id="desc" cols="20" rows="10" style="background-color: ghostwhite;">
                      <?php echo $product["description"]; ?>
                </textarea>
                                    </div>
                                </div>
                            </div>
                            <!--Description-->
                            <!--Product Img-->
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Product Image</label>
                                    </div>
                                    <?php
                                    $primgrs = Database::search("SELECT*FROM `image` WHERE `product_id`='" . $product["id"] . "'");
                                    $primgdata = $primgrs->fetch_assoc();
                                    ?>
                                    <img class="col-10 offset-1 col-lg-6 offset-lg-3 img-thumbnail ms-2" style="height: 220px;" src="resources/products/<?php echo $primgdata["code"]; ?>" id="prev" />
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-12 d-grid">
                                                        <input type="file" class="d-none" accept="img/*" id="upimguploader" />
                                                        <label class="btn btn-primary col-8 offset-2 col-lg-8 offset-lg-2 mt-1" for="upimguploader" onclick="changeupdateImage(<?php echo $product['id']; ?>);">Upload</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Product Img-->
                            <hr class="hrbreak1 my-3">
                            <!-- notice
                            <div class="col-12">
                                <label class="form-label lbl1">Notice...</label>
                                <label class="form-label">We are taking 5% of the product price from every product as
                                    Service
                                    Charge</label>
                            </div> -->
                            <!--notice-->
                            <!--Save btn-->
                            <div class="col-12 mb-5">
                                <div class="row">
                                    <div class="col-12 offset-0 col-lg-4 offset-lg-2 d-grid">
                                        <button class="btn btn-success" style="height: 50px;" onclick="updateprocess(<?php echo $product['id']; ?>);">Update Product</button>
                                    </div>
                                    <div class="col-12 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-dark" style="height: 50px;" onclick="changeproductview();">Add
                                            Product</button>
                                    </div>
                                </div>
                            </div>
                            <!--Save btn-->
                        </div>
                    </div>
                </div>
                <?php require "footer.php"; ?>
                <script src="sweetalert.min.js"></script>
                <script src="script.js"></script>
    </body>

    </html>

<?php

}


?>