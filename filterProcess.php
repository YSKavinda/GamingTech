<?php
require "db.php";

session_start();

$array;

$user = $_SESSION["u"];
$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];
$resultset="";
$aray;

if(isset($user)){
  if(!empty($search)){
// search field filled
       if(!$age==0){
        //search and age
           if($age==1){
              //new to old
            $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' ORDER BY `datetime_added` DESC");
            //  echo "1";
           }else{
             //old to new
             $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' ORDER BY `datetime_added` ASC");
            //  echo "2";
           }
       }else if(!$qty==0){
        //search and qty
          if($qty==1){
            //low to high
            $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' ORDER BY `qty` DESC");
            // echo "3";
           }else{
             //high to low
             $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' ORDER BY `qty` ASC");
            //  echo "4";
           }
       }else if(!$condition==0){
        //search & condition
        if($condition==1){
            //bnew
            $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' AND `condition_id` = '1'  ");
          //  echo "5";
          }else{
            //used
            $resultset= Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' AND `condition_id` = '2' ");
          // echo "6";
          }
       }else{
       //only search
       $resultset = Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."' AND `title` LIKE '%".$search."%' ");
      //  echo "7";

       }
         


    }else{
      //search field not filled
      if(!$age==0){
        //only age
           if($age==1){
            //new to old
              $resultset = Database::search("SELECT*FROM `product` ORDER BY `datetime_added` DESC");
              // echo "8";
           }else{
            //old to new
            $resultset = Database::search("SELECT*FROM `product` ORDER BY `datetime_added` ASC");
            // echo "9";
           }
       }else if(!$qty==0){
        //only qty
          if($qty==1){
            //low
            $resultset = Database::search("SELECT*FROM `product` ORDER BY `qty` DESC");
            // echo "10";
           }else{
             //high
             $resultset = Database::search("SELECT*FROM `product` ORDER BY `qty` ASC");  
            //  echo "11";
           }
       }else if(!$condition==0){
        //only condition
        if($condition==1){
         //bnew
         $resultset = Database::search("SELECT*FROM `product` WHERE `condition_id` = '1'");
        //  echo "12";
        }else{
          //used
          $resultset = Database::search("SELECT*FROM `product` WHERE `condition_id` = '2'");
          // echo "13";
        }
       }else{
       
      //all products
        $resultset = Database::search("SELECT*FROM `product` WHERE `user_email`='".$user["email"]."';");
        // echo "14";



       }
    }
    $no =$resultset->num_rows;
    if($no==0){
        //no search results;

        // echo "no results";

    }else{
      ?>

<div class="row">
                                <div class="col-10 offset-1 col-lg-12 text-center">
                                    <div class="row mt-3">
                                        <?php
                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }
                                        $results_per_page = 6;

                                        $number_of_pages = ceil($no / $results_per_page);
                                        $page_first_result = ((int)$pageno - 1) * $results_per_page;


      for($i=0;$i<$no;$i++){
        $rdata=$resultset->fetch_assoc();
      //  search output
      ?>
      
  
  
  
  
  <!--product-->
<?php                           
                                       
                                        ?><div class="card mb-3 col-12 col-lg-5 mx-md-2 bg-transparent" style="box-shadow: 0px 0px 10px 2px black;">
                                                <div class="row g-0">
                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $rdata["id"] . "'");
                                                    $pir = $pimgrs->fetch_assoc();
                                                    ?>
                                                    <div class="col-md-10 offset-md-1 mt-4 mb-4">
                                                        <img src="resources/products//<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $rdata["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-warning my-2"><?php echo $rdata["price"]; ?></span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $rdata["qty"]; ?>
                                                                items left</span>
                                                            <div class="form-check form-switch my-1">
                                                                <input class="form-check-input" type="checkbox" onchange="changeStatus(<?php echo $rdata['id']; ?>);" id="check" <?php if ($rdata["status_id"] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                                <label class="form-check-label fw-bold text-info" id="checklabel">
                                                                    <?php if ($rdata["status_id"] == 1) {
                                                                        echo "Make Your Product Deactive";
                                                                    } else {
                                                                        echo "Make Your Product Active";
                                                                    }
                                                                    ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6 d-grid mb-1 mb-md-0"><a href="#" class="btn btn-success fw-bold" style="font-size: 14px;" onclick="sendid(<?php echo $rdata['id']; ?>);">Update
                                                                            Product</a>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6 d-grid mt-1 mt-md-0"><a href="#" class="btn btn-danger fw-bold" onclick="deleteModel(<?php echo $rdata['id']; ?>);">Delete
                                                                            Product</a>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="deleteModel<?php echo $rdata['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bolder text-danger" id="exampleModalLabel">Warning....!</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are You Sure to Delete This Product
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" onclick="deleteProduct(<?php echo $rdata['id']; ?>);">Delete</button>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                     

  
  
  
  
  
      <?php
       //  search output
      }

      ?>
      </div>
      </div>
  </div>
  <div class="row mt-4">
      <div class="col-12 col-lg-4 offset-lg-4 d-grid">
          <a href="addproduct.php" class="btn btn-success fs-4 fw-bold">Add Products <b>+</b></a>
      </div>
  </div>
  <div class="row mt-3 mb-3">

      <!--pagination-->
      <div class="col-12 text-center mb-3">
          <div class="pagination">
              <a href="<?php if ($pageno <= 1) {
                              echo "#";
                          } else {
                              echo "?page=" . ($pageno - 1);
                          } ?>">&laquo;</a>
              <?php
              for ($page = 1; $page <= $number_of_pages; $page++) {
                  if ($page == $pageno) {
              ?><a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a><?php
                                                                                          } else {
                                                                                              ?>
                      <a href="<?php echo "?page=" . ($page) ?>" class="ms-1"><?php echo $page; ?></a>
              <?php
                                                                                          }
                                                                                      }
              ?>
              <a href="<?php if ($pageno >= $number_of_pages) {
                              echo "#";
                          } else {
                              echo "?page=" . ($pageno + 1);
                          } ?>">&raquo;</a>
          </div>
      </div>
      <!--pagination-->


  </div>

<!--product-->
<?php



    }
    

}else{
  //no user found error
}


?>