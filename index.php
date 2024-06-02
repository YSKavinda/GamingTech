<!DOCTYPE html>
<html>

<head>
    <title>
        eShop
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="resources/logo.png">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-background">
    <div class="container-fluid vh-100 d-flex" style="background-color: light-blue;">
        <div class="row align-content-center">
            <!--header-->
            <div class="col-12 justify-content-center">
                <div class="row">
                    <div class="col-12 background" style="height: 200px;">

                    </div>
                </div>
                <div class="row">

                    <div class="col-4 text-end mb-5">
                        <img class="logo" src="resources/logo.png">
                    </div>
                    <div class="col-8 mb-5 text-start">
                        <p class="title1 mt-4" style="color: rgb(79, 228, 49);">iTzz Gaming Tech.. Welcome!!!</p>
                    </div>


                </div>
            </div>
            <!--header-->
            <!--content-->
            <div class="col-12">

                <div class="row">


                    <div class="col-12 col-lg-6 offset-lg-3 d-none" id="signupbox">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title2">Fill following details to Create New Account</p>
                                <p class="text-danger" id="msg"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-white">First Name</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="text"
                                    id="fname">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-white">Last Name</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="text"
                                    id="lname">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Email</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="text"
                                    id="email">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Password</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="password"
                                    id="password">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-white">Mobile</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="text"
                                    id="mobile">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-white">Gender</label>
                                <select class="form-select bg-secondary text-info fw-bold border-info" id="gender">
                                    <?php
                                    require "db.php";
                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;
                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $r->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-info fw-bold" onclick="signUp();">Sign Up</button>

                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-warning fw-bold" onclick="changeView();">Already have an Account?
                                    Sign
                                    In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 offset-lg-3" id="signinbox">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title2">Sign In To Your Account</p>
                                <p class="text-danger" id="msg2"></p>
                            </div>
                            <div class="col-12">
                                <?php
                                $e = "";
                                $p = "";
                                if (isset($_COOKIE["e"])) {
                                    $e = $_COOKIE["e"];
                                }
                                if (isset($_COOKIE["p"])) {
                                    $p = $_COOKIE["p"];
                                }

                                ?>
                                <label class="form-label text-white">Email</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="text"
                                    value="<?php echo $e ?>" id="email2">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Password</label>
                                <input class="form-control bg-secondary text-info fw-bold border-info" type="password"
                                    value="<?php echo $p ?>" id="password2">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label text-white">Keep My Details</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <a href="#" class="link-primary text-info" onclick="forgotpassword();">Forgot
                                    Password</a>
                            </div>

                            <div class="col-6 d-grid">
                                <button class="btn btn-primary" onclick="signin();">Sign In</button>

                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to User? Create new account
                                    Here</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-2 offset-5 text-center mt-5 d-none" id="loadingspin">

                    <span class="sr-only fs-3"></span>
                    <div class="spinner-border text-success" role="status">

                    </div>
                
                       
                    </div>
                </div>
            </div>
            <!--content-->
            <!--footer-->
            <div class="col-12 text-center text-secondary mt-5">
                <p>&copy 2021 GamingTech.lk All Rights Reserved</p>
            </div>
            <!--footer-->
            <!--modal-->
            <div class="modal fade" id="forgetpasswordmodal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">GamingTech|Forgot Password</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4 text-center">
                                   <img src="resources/logo.png" class="logohead">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="password" id="np">
                                        <button class="btn btn-primary" onclick="showPassword1();"
                                            id="npb">Show</button>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="password" id="rnp">
                                        <button class="btn btn-primary" onclick="showPassword2();"
                                            id="rnpb">Show</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input class="form-control" type="text" id="vc">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--modal-->
        </div>
    </div>
    <script src="sweetalert.min.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>