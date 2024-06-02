<?php

require "db.php";
session_start();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Tech | Invoice</title>
    <link rel="icon" href="resources//logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mt-2" style="background-color: #f7f7ff;">


    <div class="container-fluid">
        <div class="row">
            <?php

require "header.php";

?>
            <div class="col-12">
                <?php if (isset($_SESSION["u"])) {

$email = $_SESSION["u"]["email"];

$oid = $_GET["id"];
?>

                <div class="row">

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 btn-toolbar justify-content-end">
                        <button class="btn btn-dark me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i>
                            Print</button>
                        <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as
                            PDF</button>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>





                </div>


                <div class="row" style="background-color:' ';" id="GFG">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6 text-end">
                                       <img src="resources/logo.png" style="height: 80px;">
                                    </div>
                                    <div class="col-6 text-center">
                                        <h2 class="text-success mt-1 fs-1">Gaming Tech</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="row">
                                    <div class="col-12 text-start">
                                       
                                    </div>
                                    <div class="col-12 fw-bold text-end">
                                        <span>No.38,Kananwila,Horana,Sri Lanka</span>
                                        <br />
                                        <span>+9412345678</span>
                                        <br />
                                        <span>www.gtdeals@gmail.com</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-2 border-success" />
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-6">
                                <h5>INVOICE TO :</h5>

                                <?php

                            $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "' ");
                            $addrdata = $addressrs->fetch_assoc();

                            ?>

                                <h3><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h3>
                                <span
                                    class="fw-bold"><?php echo $addrdata["line1"] . " " . $addrdata["line2"]; ?></span>
                                <br />
                                <span
                                    class="fw-bold text-success text-decoration-underline"><?php echo $email; ?></span>
                            </div>

                            <?php

                        $invrs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");


                        $invdata = $invrs->fetch_assoc();
                        ?>

                            <div class="col-6 text-end mt-2">
                                <h1 class="text-primary">INVOICE 0<?php echo $invdata["id"]; ?></h1>
                                <span class="fw-bold">Date and Time of Invoice : </span>
                                <span class="fw-bold"><?php echo $invdata["date"]; ?></span>
                            </div>


                        </div>
                    </div>



                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order Id & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                            $invrs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");

                            $subtotal = 0;

                            for ($x = 0; $x < $invrs->num_rows; $x++) {
                                $invd = $invrs->fetch_assoc();

                                $prdrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invd["product_id"] . "' ");
                                $pdata = $prdrs->fetch_assoc();

                                $subtotal += (int)$invd["total"];

                            ?>
                                <tr style="height: 70px;">
                                    <td class="bg-success fw-bold text-white fs-5"><?php echo $invd["id"]; ?></td>
                                    <td>
                                        <a href="#" class="fw-bold p-2"><?php echo $invd["order_id"]; ?></a>
                                        <br />
                                        <a href="#" class="fw-bold p-2"><?php echo $pdata["title"]; ?></a>
                                    </td>
                                    <td class="text-end pt-2" style="background-color: rgb(199, 199, 199);">Rs.
                                        <?php echo $pdata["price"]; ?> .00</td>
                                    <td class="text-end px-2"><?php echo $invd["qty"]; ?></td>
                                    <td class="text-end text-white bg-success p-2 fw-bold">Rs.
                                        <?php echo $invd["total"]; ?> .00</td>

                                </tr>
                                <?php
                            }


                            ?>


                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                    <td class="fs-5 text-end">Rs. <?php echo $subtotal; ?> .00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="2" class="border-0"><span class="fs-1">Thank You !</span>
                                    </td>
                                    <td colspan="2" class="fs-5 text-end border-primary">Discount Coupon</td>
                                    <td class="fs-5 text-end border-success">Rs. 00 .00</td>
                                </tr>
                                <tr>
                                    <!-- <td colspan="2" class="border-0"></td> -->
                                    <td colspan="2" class="fs-4 text-end text-success border-0">GRAND TOTAL</td>
                                    <td class="fs-5 text-end text-primary border-0">Rs. <?php echo $subtotal; ?> .00
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-12 ">
                        <div class="row mx-2">
                            <div class="col-12 py-3 my-3 border border-3 border-primary border-top-0 border-bottom-0 border-end-0 "
                                style="background-color: rgb(153, 199, 252);">
                                <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                <label class="form-label fs-6">Purchased item can return before 07 days od
                                    delivary.</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3 text-center">
                        <label class="form-label text-black-50">
                            Invoice was created on a computer and is valid without the Signature and Seal.
                        </label>
                    </div>




                </div>

                <div class="row">
                    <?php

                require "footer.php";

                ?>
                </div>
            

            </div>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
            }else{
               ?> <script>window.location="home.php"</script><?php
            }
            ?>
