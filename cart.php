<?php
 session_start();
 require "db.php";
?>
<!DOCTYPE html>

<HTML>

<head>
    <meta charset="utd-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>gTech |Cart</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-background">
    <div class="container-fluid">
        <div class="row">
            <?php require "header.php" ?>
            <?php





if(isset($_SESSION["u"])){
    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = 0;

?>
            <div class="col-12" style="background-color: #E3E4E5;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 border border-1 border-secondary rounded mb-3">
                <div class="row">
                    <div class="col-6 text-start text-warning fs-1">
                    <i class="bi bi-cart3"></i>
                    </div>
                    <div class="col-6 text-end">
                        <label class="form-label text-white fs-1 fw-bolder">Cart</label>
                    </div>
                    <div class="col-12">
                        <hr class="hrbreak1" />
                    </div>
                    <?php

 $cartrs = Database::search("SELECT*FROM `cart` WHERE `user_id` = '".$umail."';");
 $cn = $cartrs->num_rows;

if($cn == 0){

?>
                    <!-- empty cart -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptycart">

                            </div>
                            <div class="col-12 text-center">
                                <label class="form-label text-white-50 fs-1 fw-bolder">You Have No items in your Cart</label>
                            </div>
                            <div class="col-12 col-lg-4 offset-0 offset-lg-4 d-grid mb-4 mt-4">
                                <a href="home.php" class="btn btn-success fs-3">Go To Store</a>
                            </div>
                        </div>
                    </div>


                    <!-- empty cart -->
                    <?php

}else{

?>
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <?php

for($i=0; $i<$cn;$i++){
       $cr = $cartrs->fetch_assoc();
 

       $productrs = Database::search("SELECT*FROM `product` WHERE `id`='".$cr["product_id"]."'");
       $pr = $productrs->fetch_assoc();

       
       $imagers = Database::search("SELECT*FROM `image` WHERE `product_id`='".$cr["product_id"]."'");
       $imagedata=$imagers->fetch_assoc();

       $total = $total + ($pr["price"]*$cr["qty"]);


       $addressrs = Database::search("SELECT*FROM `user_has_address` WHERE `user_email`='".$umail."' ");
       $ar  = $addressrs->fetch_assoc();
       $cityid = $ar["city_id"];
       $cityrs = Database::search("SELECT*FROM `city` WHERE `id`='".$cityid."'");
       $dr = $cityrs->fetch_assoc();
       $districtid = $dr["district_id"];
       $delCharge = "0";

       if($districtid=="2"){
        $delCharge = $pr["delivery_fee_colombo"];
        $shipping = $shipping + $pr["delivery_fee_colombo"];
    
       }else{
        $delCharge = $pr["delivery_fee_other"];

        $shipping = $shipping + $pr["delivery_fee_other"];
       }

       $sellerrs = Database::search("SELECT*FROM `user` WHERE `email`='".$pr["user_email"]."'");
       $ur = $sellerrs->fetch_assoc();
      
?>

<div class="card mb-3 col-12">
                                <div class="row g-0">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                <span
                                                    class="fw-bold text-black fs-5"><?php echo $_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"]; ?></span>
                                            </div>
                                            <hr class="hrbreak1 mt-3" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <img src="resources/products//<?php echo $imagedata["code"];?> "tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"] ?>" data-bs-content="<?php echo $pr["description"]; ?>"
                                            class="img-fluid rounded-start d-inline-block">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                            <?php
                                                 $colorrs = Database::search("SELECT `name` FROM `color` WHERE `id`='".$pr["color_id"]."'");
                                                 $colorcode = $colorrs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold text-black-50">Colour :<?php $colorcode["name"]; ?></span>&nbsp; |
                                            <?php $conditionrs = Database::search("SELECT `name` FROM `condition` WHERE `id`='".$pr["condition_id"]."' ");
                                                    $cor = $conditionrs->fetch_assoc(); ?>
                                            &nbsp;<span class="fw-bold text-black-50">Condition :<?php echo $cor["name"] ?></span>
                                            <br />
                                            <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                            <span class="fw-bolder text-black fs-5">Rs.<?php echo $pr["price"]; ?>.00</span>
                                            <br />
                                            <span class="fw-bold text-black-50 fs-5">Qty :</span>&nbsp;
                                            <input type="text" onkeyup="changeqty(<?php echo $cr['id']; ?>);"
                                                class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cartqtytxt"
                                                value="<?php echo $cr['qty'];?>" id="cqty<?php echo $cr["id"]; ?>"/>
                                            <br />
                                            <br />
                                            <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                            <span class="fw-bolder text-black fs-5">Rs.<?php echo $delCharge; ?>.00</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="card-body d-grid">
                                            <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                            <a class="btn btn-outline-danger mb-2" onclick="deletefromCart(<?php echo $cr['id']; ?>);">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <hr class="secondary" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="fw-bold text-black-50 fs-5">Requested Total &nbsp; <i
                                                        class="bi bi-info-circle"></i></span>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <span class="fw-bold text-black-50 fs-5">Rs.<?php echo ($pr["price"]*$cr["qty"])+$delCharge;?>.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="modal-dialog modal-dialog-centered fade" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Modal body text goes here.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->




                            <?php
 }
 ?>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12"><label class="form-label text-white fs-3 fw-bold">Summary</label></div>
                            <div class="col-12">
                                <hr class="hrbreak1" />
                            </div>
                            <div class="col-6">
                                <span class="fs-6 fw-bold text-white">Items (<?php echo $cn ;?>)</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold text-white">Rs. <?php echo $total; ?>.00</span>
                            </div>
                            <div class="col-6 mt-2">
                                <span class="fs-6 fw-bold text-white">Shipping</span>
                            </div>
                            <div class="col-6 text-end mt-2">
                                <span class="fs-6 fw-bold text-white">Rs.<?php echo $shipping; ?>.00</span>
                            </div>
                            <div class="col-12 mt-3">
                                <hr class="secondary" />
                            </div>
                            <div class="col-6 mt-2 text-white">Total</div>
                            <div class="col-6 mt-2 text-end text-white">Rs.<?php echo $total+$shipping; ?>.00</div>
                            <hr class="hrbreak1 mt-2" />

                            <div class="col-12 d-grid"><button class="btn btn-primary fw-bolder fs-4" type="submit" id="payhere-payment" onclick="checkoutall();">Checkout</button>
                            </div>
                        </div>
                    </div>

                    <?php
}

?>


                </div>
            </div>
            <?php require "footer.php" ?>
        </div>

    </div>



    <?php
}else{
    ?> <script>
    window.location = "home.php";
    alert("You have to Sign In");
    </script> <?php
}
?>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script src="sweetalert.min.js"></script> 
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
      
    <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
</body>

</HTML>