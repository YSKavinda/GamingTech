<?php
 session_start();
?>
<?php

require "db.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utd-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <title>Gaming Tech| Transaction History</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-background">


    <div class="container-fluid">

        <div class="row">


            <?php require "header.php"; ?>
            <?php
                if(isset($_SESSION["u"])){
                    $mail = $_SESSION["u"]["email"];

                    $invoicers = Database::search("SELECT*FROM `invoice` WHERE `user_email`='".$mail."'; ");
                    $in = $invoicers->num_rows;

               
            ?>
            <div class="col-2">
                            <div class="row">
                                <div class="col-12 mt-4 mt-lg-3">
                                    <a href="home.php" class="text-decoration-none text-success fs-5"><span class="d-none d-md-inline-block">&lt; to Home</span>  <i class="bi bi-house-door-fill text-white"></i></a>
                                </div>
                            </div>
                        </div>
            <div class="col-10 text-center mb-3">
                <span class="fs-1 fw-bold text-primary">Transaction History</span>
            </div>
            
            <?php
             if($in==0){

                ?>         
                
                <div class="col-12 text-center bg-dark mb-5" style="height: 450px; padding-top:180px;">
                <span class="fs-1 mt-5 fw-bold text-white-50" style="">You Have No Transaction Records to Show yet....</span></div>
                
                <?php

             }else{
                 ?>

               

            <!-- item history  -->
            <div class="col-12 d-none d-lg-block">
                <div class="row">
                    <div class="col-2 fw-bold text-white text-end bg-success">#</div>
                    <div class="col-3 bg-light">Order Details</div>
                    <div class="col-1 text-end fw-bold text-white bg-success">Quantity</div>
                    <div class="col-1 text-end fw-bold bg-light">Amount</div>
                    <div class="col-2 text-end fw-bold text-white bg-success">Time of Transaction</div>
                    <div class="col-2 text-end fw-bold bg-transparent"></div>
                    <div class="col-12">
                        <hr />
                    </div>
                    
                </div>
            </div>
            <?php
                 for($i=0;$i<$in;$i++){
                     $ir = $invoicers->fetch_assoc();
                     ?>
                         <div class="col-12">
                        <div class="row mb-5 bg-secondary">
                            <div class="col-12 col-lg-2">
                                <label class="form-label text-white fw-bold py-5 px-3" style="font-size: 17px;"><?php echo $ir["order_id"]; ?></label>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <div class="card mx-3" style="max-width: 100%;">
                                        <div class="row g-0">
                                            <div class="col-md-4 mt-4">
                                                <?php
                                                $pid = $ir["product_id"];
                                                $array;
                           $imagers = Database::search("SELECT*FROM `image` WHERE `product_id` = '".$pid."' ");
                           $n = $imagers->num_rows;
                           for($x=0;$x<$n;$x++){
                               $f = $imagers->fetch_assoc();
                               $array[$x]=$f["code"];
                           }
                                                ?>
                                                <img src="resources/products/<?php echo $array[0]; ?>" class="img-fluid rounded-start">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body text-center text-lg-end">
                                                    <?php
                                                        $productrs = Database::search("SELECT*FROM `product` WHERE `id` = '".$pid."' ");
                                                        $pr = $productrs->fetch_assoc();

                                                    ?>
                                                    <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                    <?php 
                                                    $sm = $pr["user_email"];
                                                         $sellerrs = Database::search("SELECT*FROM `user` WHERE `email`='".$sm."' ");
                                                         $sr = $sellerrs->fetch_assoc();
                                                    ?>
                                                    <p class="card-text"><b>Seller :</b><?php echo $sr["fname"]." ".$sr["lname"]; ?></p>
                                                    <p class="card-text"><b>Price :Rs.<?php echo $pr["price"]; ?>.00</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-1 text-center text-lg-end">
                                <label class="form-label text-white fs-4 pt-5">
                                  <?php echo $ir["qty"]; ?>
                                </label>
                            </div>
                            <div class="col-12 col-lg-1 text-center text-lg-end">
                                <label class="form-label fs-6 px-3 py-5 text-white fw-bold">
                                Rs.<?php echo $ir["total"]; ?>.00
                                </label>
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                <label class="form-label text-white fs-4 pt-5"><?php echo $ir["date"]; ?></label>
                            </div>
                            <div class="col-12 col-lg-2">
                                <div class="row">
                                    <div class="col-8 offset-1 d-grid">
                                        <button class="btn btn-success rounded mt-5 fs-5" onclick="addfeedback(<?php echo $pid; ?>);"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                    </div>
                                    <div class="col-2 offset-s-1 d-grid">
                                        <button class="btn btn-danger mt-5 fs-5" onclick="dlthis(<?php echo $ir['id']; ?>);"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


<!-- Modal -->
<div class="modal fade" id="feedbackModal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <textarea cols="30" rows="10" class="form-control fs-5" id="feedtxt"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveFeedbck(<?php echo $pid; ?>);">Save Feedback</button>
      </div>
    </div>
  </div>
</div>
<!--modal-->
            
                    <div class="col-12">
                        <hr />
                    </div>
                    <?php
                 }
            ?>
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block">
                            </div>
                                <div class="col-12 col-lg-2 d-grid">
                                    <button class="btn btn-danger fs-4" onclick="clearallrec();"><i class="bi bi-info-circle-fill"></i> Clear All Records</button>
                                </div>
                        </div>
                    </div>
                    <?php
             }
             ?>
            <?php require "footer.php"; ?>
            <?php
                }
          ?>
        </div>
      

    </div>

<script src="sweetalert.min.js"></script>
<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>
</body>

</html>