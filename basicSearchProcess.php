<?php
 session_start();
require "db.php";
$searchSelect = $_GET["s"];
$searchTxt = $_GET["t"];


$aray;

if(!empty($searchTxt) && $searchSelect==0){
  $textSearch = Database::search("SELECT*FROM `product` WHERE `title` LIKE '%".$searchTxt."%'");
  $n = $textSearch->num_rows;
  if($n>=1){
      for($i=0;$i<$n;$i++){
          $prod = $textSearch->fetch_assoc();
          $img = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prod["id"]."'");
          $n1 = $img->num_rows;

          if($n1>=1){
             $row1 = $img->fetch_assoc();
             $prod["img"] = $row1["code"];

             ?>
              <!-- result -->
                            
                            <div class="card col-6 offset-3 ms-lg-1 col-lg-2 offset-lg-0 mt-1 mb-1 img-thumbnail" style="width: 17rem;">
                             

                                <img class="card-img-top cardToping" style="width: 100%;" src="resources/products/<?php echo $prod["img"]; ?>"
                                    alt="<?php echo $row1["code"];?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info ms-1">New</span></h5>
                                    <span class="card-text text-primary"><?php echo $prod["price"];?></span>
                                    <br />
                                    <?php
                                     if((int)$prod["qty"] > 0){?>
                                        <span class="card-text text-warning"><?php echo "In Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" id="qty">
                                    <br />
                                    <a href="<?php echo "singleproductview.php?id=".($prod['id']);?>" class="btn btn-success col-8 fs-6">Buy Now</a>
                                    <a href="#" class="btn btn-secondary col-3 fs-6" onclick="addToWatchList(<?php echo $prod['id']; ?>);"><i class="bi bi-heart-fill"></i></a>
                                    <a class="btn btn-danger col-12 mt-2 fs-6" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                   
                                        <?php
                                     }else{
                                         ?>
                                        <span class="card-text text-danger"><?php echo "Out of Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" disabled>
                                    <br />
                                    <a href="#" class="btn btn-success disabled">Buy Now</a>
                                    <a class="btn btn-danger disabled">Add to cart</a>
                                    <a href="#" class="btn btn-secondary gx-5 gy-2"><i class="bi bi-heart-fill"></i></a>
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                               }
                            ?>
                       
  <!-- result -->
             <?php

         
      }
  }else{
    ?><h3 class="text-center text-white">No Search Results...</h3><?php
}
}else if($searchSelect!=0 && empty($searchTxt)){
  $textSearch = Database::search("SELECT*FROM `product` WHERE `category_id` LIKE '%".$searchSelect."%'");
  $n = $textSearch->num_rows;
  echo $n;
  if($n>=1){
      for($i=0;$i<$n;$i++){
          $prod = $textSearch->fetch_assoc();
          $img = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prod["id"]."'");
          $n1 = $img->num_rows;

          if($n1>=1){
             $row1 = $img->fetch_assoc();
             $prod["img"] = $row1["code"];



             ?>

 <!-- result -->

                            
                            <div class="card col-6 offset-3 ms-lg-1 col-lg-2 offset-lg-0 mt-1 mb-1 img-thumbnail" style="width: 17rem;">
                              <?php
                                 $pimage = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prod["id"]."'");
                                 $imgrow = $pimage->fetch_assoc();
                              ?>

                                <img class="card-img-top cardToping" src="resources/products/<?php echo $prod["img"]; ?>"
                                    alt="<?php echo $row1["code"];?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info ms-1">New</span></h5>
                                    <span class="card-text text-primary"><?php echo $prod["price"];?></span>
                                    <br />
                                    <?php
                                     if((int)$prod["qty"] > 0){?>
                                        <span class="card-text text-warning"><?php echo "In Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" id="qty">
                                    <br />
                                    <a href="<?php echo "singleproductview.php?id=".($prod['id']);?>" class="btn btn-success col-8 fs-6">Buy Now</a>
                                    <a href="#" class="btn btn-secondary col-3 fs-6" onclick="addToWatchList(<?php echo $prod['id']; ?>);"><i class="bi bi-heart-fill"></i></a>
                                    <a class="btn btn-danger col-12 mt-2 fs-6" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                   
                                        <?php
                                     }else{
                                         ?>
                                        <span class="card-text text-danger"><?php echo "Out of Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" disabled>
                                    <br />
                                    <a href="#" class="btn btn-success disabled">Buy Now</a>
                                    <a class="btn btn-danger disabled">Add to cart</a>
                                    <a href="#" class="btn btn-secondary gx-5 gy-2"><i class="bi bi-heart-fill"></i></a>
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            
              

  <!-- result -->


<?php


          }



      }
  }else{
    ?><h3 class="text-center text-white">No Search Results...</h3><?php
}

}else if(!empty($searchTxt) && $searchSelect != 0){
  $textSearch = Database::search("SELECT*FROM `product` WHERE `title` LIKE '%".$searchTxt."%' AND `category_id` LIKE '%".$searchSelect."%'");
  $n = $textSearch->num_rows;
  echo $n;
  if($n>=1){
      for($i=0;$i<$n;$i++){
          $prod = $textSearch->fetch_assoc();
          $img = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prod["id"]."'");
          $n1 = $img->num_rows;

          if($n1>=1){
             $row1 = $img->fetch_assoc();
             $prod["img"] = $row1["code"];


             ?>


 <!-- result -->

                           
                            <div class="card col-6 offset-3 ms-lg-1 col-lg-2 offset-lg-0 mt-1 mb-1 img-thumbnail" style="width: 17rem;">
                                <img class="card-img-top cardToping" src="resources/products/<?php echo $prod["img"]; ?>"
                                    alt="<?php echo $row1["code"];?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info ms-1">New</span></h5>
                                    <span class="card-text text-primary"><?php echo $prod["price"];?></span>
                                    <br />
                                    <?php
                                     if((int)$prod["qty"] > 0){?>
                                        <span class="card-text text-warning"><?php echo "In Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" id="qty">
                                    <br />
                                    <a href="<?php echo "singleproductview.php?id=".($prod['id']);?>" class="btn btn-success col-8 fs-6">Buy Now</a>
                                    <a href="#" class="btn btn-secondary col-3 fs-6" onclick="addToWatchList(<?php echo $prod['id']; ?>);"><i class="bi bi-heart-fill"></i></a>
                                    <a class="btn btn-danger col-12 mt-2 fs-6" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                   
                                        <?php
                                     }else{
                                         ?>
                                        <span class="card-text text-danger"><?php echo "Out of Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" disabled>
                                    <br />
                                    <a href="#" class="btn btn-success disabled">Buy Now</a>
                                    <a class="btn btn-danger disabled">Add to cart</a>
                                    <a href="#" class="btn btn-secondary gx-5 gy-2"><i class="bi bi-heart-fill"></i></a>
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                               }
                            ?>
            

  <!-- result -->


             <?php


         
      }
  }else{
      ?><h3 class="text-center text-white">No Search Results...</h3><?php
  }
}else{
    $textSearch = Database::search("SELECT*FROM `product`");
  $n = $textSearch->num_rows;
  if($n>=1){
      for($i=0;$i<$n;$i++){
          $prod = $textSearch->fetch_assoc();
          $img = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prod["id"]."'");
          $n1 = $img->num_rows;

          if($n1>=1){
             $row1 = $img->fetch_assoc();
             $prod["img"] = $row1["code"];


             ?>


 <!-- result -->

                           
                            <div class="card col-6 offset-3 ms-lg-1 col-lg-2 offset-lg-0 mt-1 mb-1 img-thumbnail" style="width: 17rem;">
                                <img class="card-img-top cardToping" src="resources/products/<?php echo $prod["img"]; ?>"
                                    alt="<?php echo $row1["code"];?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info ms-1">New</span></h5>
                                    <span class="card-text text-primary"><?php echo $prod["price"];?></span>
                                    <br />
                                    <?php
                                     if((int)$prod["qty"] > 0){?>
                                        <span class="card-text text-warning"><?php echo "In Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" id="qty">
                                    <br />
                                    <a href="<?php echo "singleproductview.php?id=".($prod['id']);?>" class="btn btn-success col-8 fs-6">Buy Now</a>
                                    <a href="#" class="btn btn-secondary col-3 fs-6" onclick="addToWatchList(<?php echo $prod['id']; ?>);"><i class="bi bi-heart-fill"></i></a>
                                    <a class="btn btn-danger col-12 mt-2 fs-6" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                   
                                        <?php
                                     }else{
                                         ?>
                                        <span class="card-text text-danger"><?php echo "Out of Stock"; ?></span>
                                        <input class="form-control" type="number" value="1" disabled>
                                    <br />
                                    <a href="#" class="btn btn-success disabled">Buy Now</a>
                                    <a class="btn btn-danger disabled">Add to cart</a>
                                    <a href="#" class="btn btn-secondary gx-5 gy-2"><i class="bi bi-heart-fill"></i></a>
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                               }
                            ?>
            

  <!-- result -->


             <?php


         
      }
  }else{
    ?><h3 class="text-center text-white">No Search Results</h3><?php
}   











}
?>