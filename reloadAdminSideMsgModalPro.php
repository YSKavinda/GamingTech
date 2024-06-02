<?php

session_start();

require "db.php";

if (isset($_SESSION["a"])) {

    $to=$_GET["to"];


    $mye = $_SESSION['a']['email'];

    $chatrs = Database::search("SELECT * FROM `admin_chat` WHERE (`from`='" . $mye . "' AND `to`='" . $to . "') OR (`from`='" . $to . "' AND `to`='" . $mye . "')  ORDER BY `sent_date` ASC ");
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
                            <img src="resources//demoProfileImg.png" width="50px" class="rounded-circle" />
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
}

?>