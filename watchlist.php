<?php
 session_start();
 require "db.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utd-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>gTech |Wishlist</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-background">
    <div class="container-fluid">
        <div class="col-12">
            <div class="row gy-2">
                <?php require "header.php"; ?>
                <?php

 if(isset($_SESSION["u"])){
     $umail = $_SESSION["u"]["email"];
?>
                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder text-info">Wishlist&nbsp;<i class="bi bi-emoji-heart-eyes" style="color: hotpink;"></i></label>
                        </div>
                        <div
                            class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end-0 border-primary bg-dark rounded">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="#">Recently Viewed</a>
                            </nav>
                        </div>
                        <?php

                        $watchlistrs = Database::search("SELECT*FROM `watchlist` WHERE `user_email`='".$_SESSION["u"]["email"]."' ");
                        $wn=$watchlistrs->num_rows;

                        if($wn==0){
?>
                        <!-- without item -->
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-12 emptyview">

                                </div>
                                <div class="col-12 text-center"> <label class="form-label fs-1 mb-3 fw-bolder text-white-50">You Have
                                        No Items In Your Watchlist</label></div>
                            </div>
                        </div>
                        <!-- without item -->

                        
                                <?php

                        }else{
                            ?>
                            <div class="col-12 col-lg-9">
                            <div class="row g-2"><?php
                            for($i=0;$i<$wn;$i++){
                                $watchlistdata=$watchlistrs->fetch_assoc();
                                $wid = $watchlistdata["product_id"];

                                $productrs = Database::search("SELECT*FROM `product` WHERE `id`='".$wid."'");
                                $pn =$productrs->num_rows;
                                if($pn==1){
                                    $pr = $productrs->fetch_assoc();
                                    $prodid = $pr["id"];
                             
                                ?>


                                <div class="card mb-3 col-12">
                                    <div class="row g-0">
                                        <div class="col-md-4">

                                            <?php
                                              $imagers = Database::search("SELECT*FROM `image` WHERE `product_id`='".$prodid."'");
                                              $in = $imagers->num_rows;
                                              $arr;
                                              for($x=0;$x<$in;$x++){
                                                  $ir = $imagers->fetch_assoc();
                                                  $arr[$x] = $ir["code"];
                                              }
                                            ?>
                                            <img src="resources/products/<?php echo $arr[0]; ?>"
                                                class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                <span class="fw-bold text-black-50">Colour : Pacific Blue</span>&nbsp; |
                                                &nbsp;<span class="fw-bold text-black-50">Condition : Brand New</span>
                                                <br />
                                                <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                <span class="fw-bolder text-black fs-5">Rs.100000.00</span>
                                                <br />
                                                <span class="fw-bold text-black-50 fs-5">Seller :</span>
                                                <br />
                                                <span class="fw-bolder text-black fs-5">Yasiru Kavinda</span>
                                                <br />
                                                <span class="fw-bolder text-black fs-5">Yasiru@gmail.com</span>


                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="card-body d-grid ">
                                                <a href="<?php echo "singleproductview.php?id=" . ($pr['id']); ?>" class="btn btn-info mb-2">Buy Now</a>
                                                <a href="#" class="btn btn-warning text-black-50 mb-2" onclick="addToCartfromwishlist(<?php echo $pr['id']; ?>);">Add To Cart</a>
                                                <a href="#" class="btn btn-outline-danger mb-2" onclick="deletefromwatchlist(<?php echo $watchlistdata['id']; ?>);">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php
       }
                            }

 
                        }

?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
 }else{
?><script>
                window.location = "index.php"
                </script><?php
 }
?>
                
            </div>
            <Div class="row">
            <?php require "footer.php"; ?>
            </Div>
        </div>


    </div>
<script src="sweetalert.min.js"></script>
<script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>