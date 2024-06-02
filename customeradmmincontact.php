<?php 

if($_SESSION["u"]){
      $udbms = Database::search("SELECT*FROM `user` WHERE `email`='".$_SESSION["u"]["email"]."' ");
      $usrow = $udbms->fetch_assoc();

    ?>


<!-- adm msg view modal -->
<div class="col-12">
                                <!-- Modal -->
                                <div class="modal fade" id="msgModal<?php echo $usrow['email'];?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title fw-bolder" id="exampleModalLabel">Contact & Help</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row bg-white  py-3">


                                                    <!-- msg viewing area -->
                                                    <div id="usrmsg_view_box" class="chatbox">

                                                        <?php
                                                       

                                                        $chatrs = Database::search("SELECT * FROM `admin_chat` WHERE  `to`='" . $usrow['email'] . "' OR `from`='" . $usrow['email'] . "'  ORDER BY `sent_date` ASC ");
                                                        $cn = $chatrs->num_rows;
                                                        //  echo $cn;

                                                        if ($cn > 0) {

                                                            for ($x = 0; $x < $cn; $x++) {
                                                                $cdata = $chatrs->fetch_assoc();

                                                                if ($cdata["from"] == $usrow['email']) {
                                                        ?>
                                                                    <!-- api yawana msg -->
                                                                    <div class="col-12 d-flex justify-content-end">

                                                                        <!-- receiver's message -->
                                                                        <div class="media w-50 mb-3">
                                                                            <div class="media-body">
                                                                                <div class="rounded py-2 px-2 mb-2 bg-success" style="background-color:rgb(216, 241, 165);">
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
                                                                                <img src="<?php echo $imd["code"]; ?>" width="50px" class="rounded-circle" />
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
                                                                    <input type="text" class="form-control rounded-0 border-0 py-3 bg-light" placeholder="Type a message..." area-describedby="clientsidesendbtn" id="clientsidemsgtxt" />
                                                                    <!-- <div class="input-group"> -->
                                                                    <button id="clientsidesendbtn" class="btn btn-link fs-2" onclick="clientSidesendMessage();">
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


    <?php

}else{
    ?>
    <script>window.location="home.php"</script>
    <?php
}


?>