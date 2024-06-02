<?php

session_start();
require "db.php";


if(isset($_SESSION["u"])){



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
                            <div class="bg-primary px-4 py-2 text-white">
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
                                                    <small class="small fw-bold"><?php echo $rcdata["date"]; ?></small>
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
 



}
?>



















?>