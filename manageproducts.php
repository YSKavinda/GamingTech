<?php

session_start();

require "db.php";

if (isset($_SESSION["a"])) {

    $pageno = 1;
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>gTech | Manage Products</title>
        <link rel="icon" href="resources//logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="main-background">

        <div class="container-fluid">
            <div class="row">


                <div class="col-12 main-background text-center rounded">
                    <label class="form-label fs-2 fw-bold text-info">Manage All Products</label>
                </div>

                <div class="col-12 bg-dark">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-white"><a href="adminpanel.php">Admin Pannel</a></li>
                            <li class="breadcrumb-item text-white text-decoration-none active" aria-current="page">Manage Products</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 my-3">
                    <div class="row mb-1">
                        <div class="col-2 col-lg-1 bg-success text-white text-end py-2">
                            <span class="fs-5 fw-bold">#</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Product Image</span>
                        </div>
                        <div class="col-6 col-lg-2 bg-success py-2">
                            <span class="fs-5 fw-bold">Title</span>
                        </div>
                        <div class="col-2 col-lg-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Price</span>
                        </div>

                        <div class="col-2 bg-success d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Quantity</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Added Date</span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white py-2"></div>
                    </div>

                    <?php

                    $prs = Database::search("SELECT * FROM `product` ");
                    $pn = $prs->num_rows;


                    $results_per_page = 6;
                    $no_of_pages = ceil($pn / $results_per_page);

                    if (!isset($_GET["page"]) || empty($_GET["page"])) {
                        $pageno = 1;
                    } else {
                        $pageno = $_GET["page"];
                    }

                    $offset = ($pageno - 1) * $results_per_page;

                    $page_first_result = $pageno * $results_per_page;

                    $prdrs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $offset . " ");

                    for ($x = 0; $x < $prdrs->num_rows; $x++) {
                        $pdata = $prdrs->fetch_assoc();
                        $pimgrs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pdata["id"] . "' ");
                        $pimgdata = $pimgrs->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-success text-white text-end py-2">
                                <span class="fs-5 fw-bold"><?php echo $x + 1; ?></span>
                            </div>
                            <div class="col-2 bg-light d-none d-lg-block py-2 text-center" onclick="singleviewMod(<?php echo $pdata['id']; ?>);">
                                <img src="resources/products/<?php echo $pimgdata["code"]; ?>" style="width: 70px;" />
                            </div>
                            <div class="col-6 col-lg-2 bg-success py-2">
                                <span class="fs-5 fw-bold"><?php echo $pdata["title"]; ?></span>
                            </div>
                            <div class="col-2 col-lg-2 bg-light d-none d-lg-block py-2">
                                <span class="fs-5 fw-bold">Rs. <?php echo $pdata["price"]; ?> .00</span>
                            </div>

                            <div class="col-2 bg-success d-none d-lg-block py-2">
                                <span class="fs-5 fw-bold"><?php echo $pdata["qty"]; ?></span>
                            </div>
                            <div class="col-2 bg-light d-none d-lg-block py-2">
                                <span class="fs-5 fw-bold">
                                    <?php
                                    $adddate = $pdata["datetime_added"];
                                    $spltdt = explode(" ", $adddate);
                                    echo $spltdt[0];
                                    ?>
                                </span>
                            </div>
                            <div class="col-4 col-lg-1 bg-white py-2 d-grid">
                                <?php

                                $s = $pdata["status_id"];

                                if ($s == "1") {
                                ?>
                                    <button id="blockbtn<?php echo $pdata['id']; ?>" class="btn btn-danger" onclick="blockProductsAl(<?php echo $pdata['id']; ?>);">Block</button>
                                <?php

                                } else {
                                ?>
                                    <button id="blockbtn<?php echo $pdata['id']; ?>" class="btn btn-success" onclick="blockProductsAl(<?php echo $pdata['id']; ?>);">Unblock</button>
                                <?php

                                }

                                ?>
                            </div>


                            <!-- single view modal -->
                            <div class="col-12">
                                <!-- Modal single product view-->
                                <div class="modal fade" id="singleproductvw<?php echo $pdata["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="background-color: cyan;">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="exampleModalLabel"><?php echo $pdata["title"]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="resources/products/<?php echo $pimgdata["code"]; ?>" style="height: 200px; margin:0 auto;" class="d-block" />
                                                <hr />

                                                <div>
                                                    <span class="fs-5 fw-bold">Price : </span>
                                                    <span class="fs-5">Rs. <?php echo $pdata["price"]; ?> .00</span><br />
                                                    <span class="fs-5 fw-bold">Quantity : </span>
                                                    <span class="fs-5"><?php echo $pdata["qty"]; ?> Items Left</span><br />
                                                    <span class="fs-5 fw-bold">Seller : </span>
                                                    <?php
                                                    
                                                    $sellrs=Database::search("SELECT * FROM `user` WHERE `email`='".$pdata["user_email"]."' ");
                                                    $selldata=$sellrs->fetch_assoc();

                                                    ?>
                                                    <span class="fs-5"><?php echo $selldata["fname"]." ".$selldata["lname"];?></span><br />
                                                    <span class="fs-5 fw-bold">Description : </span>
                                                    <p class="fs-5"><?php echo $pdata["description"]; ?></p>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single view modal -->



                        </div>





                    <?php

                    }


                    ?>



                </div>

                <!-- pagination -->

                <div class="col-12 mt-4">
                    <div class="row ">
                        <div class="col-12 d-flex justify-content-center">

                            <div class="pagination text-white">
                                <a href="<?php if ($pageno <= 1) {
                                                echo "#";
                                            } else {
                                                echo "?page=" . ($pageno - 1);
                                            } ?>">&laquo;</a>

                                <?php

                                for ($p = 1; $p <= $no_of_pages; $p++) {
                                    if ($p == $pageno) {
                                ?>
                                        <a class="active" href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                                    <?php

                                    } else {
                                    ?>
                                        <a href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                                <?php

                                    }
                                }

                                ?>
                                <a href="<?php if ($pageno >= $no_of_pages) {
                                                echo "#";
                                            } else {
                                                echo "?page=" . ($pageno + 1);
                                            } ?>">&raquo;</a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- pagination -->


                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12">
                    <h3 class="text-primary">Manage Categories</h3>
                </div>

                <hr>

                <div class="col-12 mb-3">
                    <div class="row g-1">
                        <?php

                        $catrs = Database::search("SELECT * FROM `category`");
                        $n = $catrs->num_rows;

                        for ($i = 0; $i < $n; $i++) {
                            $cdata = $catrs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3">
                                <div class="row g-1 px-1">
                                    <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                        <label class="form-label fs-4 fw-bold py-3"><?php echo $cdata["name"]; ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>


                        <div class="col-12 col-lg-3">
                            <div class="row g-1 px-1">
                                <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                    <div class="row">
                                        <div class="col-3 mt-3 addnewimg"></div>
                                        <div class="col-9" onclick="addNewCategory();">
                                            <label class="form-label fs-4 fw-bold py-3 text-black-50">+Add New Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <!-- Modal -->
                            <div class="modal fade" id="addCatMod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Category</label>
                                            <input type="text" class="form-control" id="cattxt" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveCategory();">Save Category</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white">Add Brands</h2>
                            <div class="row">
                                <div class="col-4">
                                <input class="form-control" type="text" id="bd" placeholder="type your Brand Name">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-success" onclick="addbrand();">Add New Brand</button>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>

                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white">Add Model</h2>
                            <div class="row">
                                <div class="col-4">
                                    
                                  <select class="form-select" id="brsel">
                                      <option value="0">Select Model</option>
                                      <?php 
                                        $dbbrandsr = Database::search("SELECT*FROM `brand`");
                                          $dbn = $dbbrandsr->num_rows;
                                          for($x=0;$x<$dbn;$x++){
                                          $dbbdata =  $dbbrandsr->fetch_assoc();
                                             ?>

                                         <option value="<?php echo $dbbdata["id"] ?>"><?php echo $dbbdata["name"]; ?></option>
                                              <?php
                                          }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-4">
                                <input class="form-control" type="text" id="mod1" placeholder="type your Model Name">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-success" onclick="addmodel();">Add New Model</button>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>

                </div>




                <?php require "footer.php"; ?>

            </div>
        </div>

        <script src="sweetalert.min.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>


<?php
} else {
?>
    <script>
        alert("Login first !");
        window.location = "adminsignin.php";
    </script>
<?php
}

?>