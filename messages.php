<?php
session_start();
require "db.php";
$to = "";
if ($_SESSION["u"]) {
    $me = $_SESSION["u"]["email"];
    if (isset($_GET["to"])) {
        if (!empty($_GET["to"])) {
            $to = $_GET["to"];
        }
    } else {

        $dbchk = Database::search("SELECT*FROM `messages` WHERE `to`='" . $me . "' ORDER BY `date` DESC LIMIT 1");
        $dbnum = $dbchk->num_rows;
        if ($dbnum == 0) {
            echo "No Message To View";
        } else {
          $dbdata = $dbchk->fetch_assoc();
          $to = $dbdata["from"];

        }

    }
    ?>
<!DOCTYPE html>
<html>

<head>

    <head>
        <meta charset="utd-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" href="resources/logo.svg">
        <title>GTech| Messages</title>
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>
</head>

<body onload="msgrefresher('<?php echo $to; ?>');"
class="main-background">

    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <?php require "header.php" ?>

                <div class="col-12">
                    <HR />
                </div>
                <div class="col-12 py-5 px-4">
                    <div class="row rounded overflow-hidden shadow">
                        <!-- recent msgs -->
                        <?php
                                    $dbrcnt = Database::search("SELECT*FROM `messages` WHERE `to`='" . $me . "' ORDER BY `date` DESC LIMIT 1");
        $dbnr = $dbrcnt->num_rows;
        if ($dbnr == 0) {
            echo "No Message To View";
        } else {
          $rcdata = $dbrcnt->fetch_assoc();
          $to = $rcdata["from"];
          ?>

                        <div class="col-12 col-md-5 px-0">
                            <div class="bg-light">
                                <div class="bg-success px-4 py-2 text-white">
                                    <h5 class="mb-0 py-1  fw-bolder">Recent</h5>
                                </div>
                                <div class="messagebox" id="rcntbox">
                                    <div class="list-group rounded">
                                        <a href="#" class="list-group-item list-group-item-action text-dark rounded-0">
                                            <div class="media">
                                                <img src="resources/demoProfileImg.jpg" height="60px"
                                                    class="rounded-circle" />
                                                <div class="me-0">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <h6 class="mb-0 fw-bold"><?php echo $to;?></h6>
                                                        <small class="small text-black-50 fw-bold"><?php echo $rcdata["date"]; ?></small>
                                                    </div>
                                                    <p class="mb-0"><?php echo $rcdata["content"]; ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php

        }
        ?>




                        <div class="col-12 col-md-7 gy-3">
                            <div class="row px-4 py-5 text-white chatbox" id="cht">
                                <?php
                                            $msgrs = Database::search("SELECT*FROM `messages` WHERE (`to`='" . $me . "' AND `from`='" . $to . "') OR (`to`='" . $to . "' AND `from`='" . $me . "' ) ORDER BY `date` ASC");
                                            $msgn = $msgrs->num_rows;
                                            if ($msgn == 0) {
                                            ?>
                                <div class="col-12">
                                    <span class="fs-3 text-center text-primary fw-bold">No Messages to View</span>
                                </div>
                                <?php
                                            } else {

                                                for ($i = 0; $i < $msgn; $i++) {
                                                    $msd = $msgrs->fetch_assoc();
                                                    if ($me == $msd["to"]) {

                                                ?>
                                <!-- senders message -->
                                <div class="col-12">


                                    <div class="media mb-3 w-50">
                                        <img src="resources/demoProfileImg.jpg" width="50px"
                                            class="rounded-circle mb-1">
                                        <div class="media-body me-3">
                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                <p class="mb-0 text-black-50"><?php echo $msd["content"]; ?></p>
                                            </div>
                                            <p class="small text-end text-white"><?php echo $msd["date"]; ?></p>
                                        </div>
                                    </div>

                                </div>
                                <!-- senders message    -->

                                <?php


                                                    } else {

                                                    ?>

                                <!-- reciever message -->
                                <div class="col-12 d-flex justify-content-end">


                                    <div class="media w-50 mb-3">
                                        <div class="media-body">
                                            <div class="bg-success rounded py-2 px-3 mb-2">
                                                <p class="mb-0 text-white"><?php echo $msd["content"]; ?></p>
                                            </div>
                                            <p class="small text-end text-black-50"><?php echo $msd["date"]; ?></p>
                                        </div>
                                    </div>


                                </div>
                                <!-- reciever message -->
                                <?php


                                                    }
                                                }
                                            }


                                            ?>








                            </div>
                            <Div class="row">
                                <!--text-->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="input-group">
                                            <input type="text" placeholder="Type your text here"
                                                aria-describedby="sendbtn"
                                                class="form-control rounded-0 border-0 py-4 bg-light" id="msg">
                                            <div class="input-group-append">
                                                <button id="sendbtn" class="btn btn-link fs-2"
                                                    onclick="sendmsg('<?php echo $to; ?>');"><i
                                                        class="bi bi-cursor-fill text-info"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--text-->
                            </Div>
                        </div>
                    </div>
                </div>

                <?php require "footer.php" ?>
                <?php ?>

            </div>
        </div>

    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
}
?>