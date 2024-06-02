<?php 

require "db.php";


if(isset($_GET["id"])){

    ?>



<div class="row">


                <?php
             $resultset = Database::search("SELECT*FROM `product` WHERE `category_id` = '".$_GET["id"]."' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 5");
             $nr = $resultset->num_rows;
             ?>
            <div class="col-12">
                <div class="row mb-4 pt-2 pb-2" style="box-shadow: 0px 1px 5px 1px grey;">
                    <div class="col-12 offset-lg-1 col-lg-10" id="pdetails">
                        <div class="row">
                            <?php
                               for($y=0;$y<$nr;$y++){
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




                </div>





    <?php

}





?>