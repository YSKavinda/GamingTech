<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <div class="col-12 headimg">
        <div class="row mb-1 mt-2 mb-4">
            <div class="col-12 col-lg-12 align-self-start">
                <div class="row">
                    <?php
                    if (isset($_SESSION["u"])) {

                        $imgusrs = Database::search("SELECT*FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "';");
                        if ($imgusrs->num_rows == 1) {
                            $imgdata = $imgusrs->fetch_assoc();
                    ?>

                            <div class="col-3 col-md-2">
                                <img src="<?php echo $imgdata["code"]; ?>" class="homeppview rounded-pill">
                                <span class="fw-bold  d-block" style="color: rgb(216, 241, 165);"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                            </div>

                        <?php

                        } else {

                        ?>

                            <div class="col-3 col-md-2">
                                <img src="resources/signinicon.svg" class="homeppview rounded-pill">
                                <span class="fw-bold  d-block" style="color: rgb(216, 241, 165);"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                            </div>

                        <?php

                        }

                    } else {

                    ?>
                        <div class="col-5 col-md-2">
                            <img src="resources/signinicon.svg" class="homeppview rounded-pill" style="cursor: pointer;" onclick="gotoIndex();">
                            <span class="fw-bold d-block" style="color: rgb(216, 241, 165); cursor: pointer;" onclick="gotoIndex();">Login First</span>
                        </div>
                    <?php


                    } ?>

                    <div class="col-5 col-md-6 ms-lg-0">
                        <Div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-12 col-md-2 d-none d-lg-inline-block">
                                <img src="resources/logo.png" class="logohead rounded mt-2 text-center">
                            </div>
                            <div class="d-none d-md-inline-block col-md-8 text-md-start">
                                <h1 class="mt-4" style="font-size: 48px; color:yellowgreen;">Gaming Tech&reg; <span class="d-none d-md-block text-white text-center" style="font-size: 18px;">For
                                        Advanced Future</span></h1>
                            </div>

                        </Div>

                    </div>
                    <div class="col-4">


                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-6 col-lg-3 gy-3">
                                <span class="text-center label2 text-white" onclick="goToAddProduct();"><b>My Store</b></span>
                            </div>

                            <div class="col-6 col-lg-3 mt-1 ms-lg-0 carticon" onclick="gotocart();" style="cursor: pointer;">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6"></div>
                            <div class="col-6 dropdown d-grid">
                                <a class="btn fw-bold dropdown-toggle fs-4" href="#" role="button" id="dropdownbutton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: yellowgreen;">
                                    Go To
                                </a>

                                <ul class="dropdown-menu rounded w-100 ddcolor" aria-labelledby="dropdownbutton1">
                                    <li><a class="dropdown-item text-center ddcl" href="watchlist.php"><span class="text-white fw-bold ">Wishlist</span></a></li>
                                    <li><a class="dropdown-item text-center ddcl" href="purchasehistory.php"><span class="text-white fw-bold ">Purchase History</span></a></li>
                                    <li><a class="dropdown-item text-center ddcl" href="messages.php"><span class="text-white fw-bold ">Message</span></a></li>
                                    <li><a class="dropdown-item text-center ddcl" href="userprofile.php"><span class="text-white fw-bold ">My Profile</span></a></li>
                                    <li><a class="dropdown-item text-center ddcl" href="#"><span class="text-white fw-bold">My sellings</span></a></li>
                                </ul>

                            </div>
                        </div>



                    </div>
                </div>

                <span class="text-start text-white label1" onclick="signout();"><b>Sign Out </b></span>
            </div>

        </div>
    </div>
</body>

</html>