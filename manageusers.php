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
        <title>gTech | Manage Users</title>
        <link rel="icon" href="resources//logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%, #9FACE6 100%); min-height: 100vh;">

        <div class="container-fluid">
            <div class="row">


                <div class="col-12 bg-light text-center rounded">
                    <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
                </div>

                <div class="col-12 bg-light rounded">
                    <div class="row ">
                        <div class="col-12 col-lg-6 offset-lg-3"></div>
                    </div>
                    <div class="row p-3">
                        <div class="col-9">
                            <input type="text" class="form-control" id="searchTxt" />
                        </div>
                        <div class="col-3 d-grid">
                            <button class="btn btn-primary" onclick="searchUser();">Search</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 bg-light">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="adminpanel.php">Admin Pannel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 my-3" id="userInfoCont">
                    <div class="row mb-1">
                        <div class="col-2 col-lg-1 bg-primary text-white text-end py-2">
                            <span class="fs-5 fw-bold">#</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Profile Image</span>
                        </div>
                        <div class="col-2 bg-primary d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold text-white">User Name</span>
                        </div>
                        <div class="col-6 col-lg-2 bg-light py-2">
                            <span class="fs-5 fw-bold">E-mail</span>
                        </div>

                        <div class="col-2 bg-primary d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold text-white">Mobile</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Registered Date</span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white py-2"></div>
                    </div>

                    <?php

                    $usersrs = Database::search("SELECT * FROM `user` ");
                    $usdn = $usersrs->num_rows;
                    $userdata = $usersrs->fetch_assoc();

                    $results_per_page = 10;
                    $no_of_pages = ceil($usdn / $results_per_page);

                    // echo $prdn." ".$no_of_pages;




                    if (!isset($_GET["page"]) || empty($_GET["page"])) {
                        $pageno = 1;
                    } else {
                        $pageno = $_GET["page"];
                    }

                    $offset = ($pageno - 1) * $results_per_page;

                    $page_first_result = $pageno * $results_per_page;

                    $selectedrs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $offset . " ");
                    $srn = $selectedrs->num_rows;

                    $c = 0;

                    while ($usrow = $selectedrs->fetch_assoc()) {
                        $c += 1;

                    ?>
                        <div class="row" onclick="">

                            <div class="col-2 col-lg-1 bg-primary text-white text-end py-2">
                                <span class="fs-5 "><?php echo $c; ?></span>
                            </div>

                            <div class="col-2 bg-light d-none d-lg-block py-2 text-center" onclick="viewmsgmodal('<?php echo $usrow['email']; ?>');reloadAdminSideMsgModal('<?php echo $usrow['email']; ?>');">
                                <?php

                                $profimrs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $usrow["email"] . "' ");

                                if ($profimrs->num_rows == 1) {
                                    $primgd = $profimrs->fetch_assoc();

                                ?>
                                    <img src="<?php echo $primgd["code"]; ?>" style="width: 60px;" class="rounded-circle" />
                                <?php

                                } else {

                                ?>
                                    <img src="resources//demoProfileImg.jpg" style="width: 60px;" class="rounded-circle" />
                                <?php

                                }


                                ?>

                            </div>
                            <div class="col-2 bg-primary d-none d-lg-block py-2">
                                <span class="fs-5 text-white"><?php echo $usrow["fname"] . " " . $usrow["lname"]; ?></span>
                            </div>
                            <div class="col-6 col-lg-2 bg-light py-2">
                                <span class="fs-5 "><?php echo $usrow["email"]; ?></span>
                            </div>

                            <div class="col-2 bg-primary d-none d-lg-block py-2">
                                <span class="fs-5 text-white"><?php echo $usrow["mobile"]; ?></span>
                            </div>
                            <div class="col-2 bg-light d-none d-lg-block py-2">
                                <span class="fs-5 ">
                                    <?php
                                    $rd = $usrow["register_date"];
                                    $splitrd = explode(" ", $rd);

                                    echo $splitrd[0];

                                    ?>
                                </span>
                            </div>
                            <div class="col-4 col-lg-1 bg-white py-2 d-grid">

                                <?php

                                $s = $usrow["status"];

                                if ($s == "1") {
                                ?>
                                    <button id="blockbtn<?php echo $usrow['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $usrow['email']; ?>');">Block</button>
                                <?php

                                } else {
                                ?>
                                    <button id="blockbtn<?php echo $usrow['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $usrow['email']; ?>');">Unblock</button>
                                <?php

                                }

                                ?>


                            </div>


                            <!-- adm msg view modal -->
                            <div class="col-12">
                                <!-- Modal -->
                                <div class="modal fade" id="msgModal<?php echo $usrow['email'];?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row bg-white  py-3">


                                                    <!-- msg viewing area -->
                                                    <div id="ADMmsg_view_box<?php echo $usrow['email'];?>" class="chatbox">

                                                        <?php
                                                        $mye = $_SESSION['a']['email'];

                                                        $chatrs = Database::search("SELECT * FROM `admin_chat` WHERE (`from`='" . $mye . "' AND `to`='" . $usrow['email'] . "') OR (`from`='" . $usrow['email'] . "' AND `to`='" . $mye . "')  ORDER BY `sent_date` ASC ");
                                                        $cn = $chatrs->num_rows;
                                                        // echo $cn;

                                                        if ($cn > 0) {

                                                            for ($x = 0; $x < $cn; $x++) {
                                                                $cdata = $chatrs->fetch_assoc();

                                                                if ($cdata["from"] == $mye) {
                                                        ?>
                                                                    <!-- api yawana msg -->
                                                                    <div class="col-12 d-flex justify-content-end">

                                                                        <!-- receiver's message -->
                                                                        <div class="media w-50 mb-3">
                                                                            <div class="media-bodty">
                                                                                <div class="bg-primary rounded py-2 px-2 mb-2">
                                                                                    <p class="text-white"><?php echo $cdata["content"]; ?></p>
                                                                                </div>
                                                                                <p class="small text-black-50"><?php echo $cdata["sent_date"]; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- receiver's message -->

                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <!-- ehen ena msg -->
                                                                    <div class="col-12">

                                                                        <!-- sender's message -->
                                                                        <div class="media mb-3 w-50">
                                                                            <?php

                                                                            $imrs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $cdata["from"] . "' ");
                                                                            if ($imrs->num_rows == 1) {
                                                                                $imd = $imrs->fetch_assoc();
                                                                            ?>
                                                                                <img src="resources//demoProfileImg.jpg" width="50px" class="rounded-circle" />
                                                                            <?php
                                                                            } else {

                                                                            ?>
                                                                                <img src="resources//demoProfileImg.jpg" width="50px" class="rounded-circle" />
                                                                            <?php

                                                                            }


                                                                            ?>

                                                                            <div class="media-body me-3 mt-1">
                                                                                <div class="bg-light rounded py-2 px-2 mb-2">
                                                                                    <p class="text-black-50"><?php echo $cdata["content"]; ?></p>
                                                                                </div>
                                                                                <p class="small text-black-50"><?php echo $cdata["sent_date"]; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- sender's message -->

                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="col-12 bg-light">
                                                                <div class="row py-2">
                                                                    <div class="col-12 text-center">
                                                                        <span class="text-muted">No messages to view !</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }

                                                        ?>


                                                    </div>


                                                    <!-- text field area -->
                                                    <div>

                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control rounded-0 border-0 py-3 bg-light" placeholder="Type a message..." area-describedby="Adsidesendbtn" id="Adsidemsgtxt<?php echo $usrow['email'];?>" />
                                                                    <!-- <div class="input-group"> -->
                                                                    <button id="Adsidesendbtn" class="btn btn-link fs-2" onclick="ADMSidesendMessage('<?php echo $usrow['email'];?>');">
                                                                        <i class="bi bi-cursor-fill"></i>

                                                                    </button>
                                                                    <!-- </div> -->
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>



                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- adm msg view modal -->





                        </div>
                    <?php

                    }




                    ?>





                    <!-- <div class="row">
                        <div class="col-2 col-lg-1 bg-primary text-white text-end py-2">
                            <span class="fs-5 fw-bold">1</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2 text-center">
                            <img src="resources//demoProfileImg.png" style="width: 60px;" />
                        </div>
                        <div class="col-2 bg-primary d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">Sahan Perera</span>
                        </div>
                        <div class="col-6 col-lg-2 bg-light py-2">
                            <span class="fs-5 fw-bold">sahan@gmail.com</span>
                        </div>

                        <div class="col-2 bg-primary d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">07144448899</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block py-2">
                            <span class="fs-5 fw-bold">2010-10-01</span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white py-2 d-grid">
                            <button class="btn btn-danger">Block</button>
                        </div>



                    </div> -->

                </div>

                <!-- pagination -->

                <div class="col-12 mt-4">
                    <div class="row ">
                        <div class="col-12 d-flex justify-content-center">

                            <div class="pagination mb-2">
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






                <?php require "footer.php"; ?>

            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>



<?php

}

?>