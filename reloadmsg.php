<?php
session_start();
require "db.php";

if (isset($_SESSION["u"])) {

    $me = $_SESSION["u"]["email"];
    $to = $_GET["to"];

    $msgrs = Database::search("SELECT*FROM `messages` WHERE (`to`='" . $me . "' AND `from`='" . $to . "') OR (`to`='" . $to . "' AND `from`='" . $me . "' ) ");
    $msgn = $msgrs->num_rows;
    if ($msgn == 0) {
?>
        <div class="col-12">
            <span class="fs-3 text-center text-warning fw-bold">No Messages to View</span>
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
                        <img src="resources/demoProfileImg.jpg" width="50px" class="rounded-circle mb-1">
                        <div class="media-body me-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="mb-0 text-black-50 fw-bold"><?php echo $msd["content"]; ?></p>
                            </div>
                            <p class="small text-end text-white-50"><?php echo $msd["date"]; ?></p>
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
                            <p class="small text-end text-white-50"><?php echo $msd["date"]; ?></p>
                        </div>
                    </div>


                </div>
                <!-- reciever message -->
<?php


            }
        }
    }
}




?>