 <?php
    session_start();
    require "db.php";
    $pageno;
    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utd-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <link rel="icon" href="resources/logo.png">
     <title>Advanced Search</title>
     <link rel="stylesheet" href="bootstrap.min.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
     <link rel="stylesheet" href="style.css" />
 </head>

 <body class="main-background">
     <div class="container-fluid">
         <div class="row">
         <?php
                    require "header.php";
                    ?>
             <div class="col-12 bg-body border border-3 border-primary border-start-0 border-end-0 border-top-0">
                 
             </div>
             <div class="col-12 bg-dark">
                 <div class="row">
                     <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                         <div class="row mb-3">
                             <div class="col-4 mt-2">
                             <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Advanced Search</li>
                                </ol>
                            </nav>
                        
                             </div>
                             <div class="col-8">
                                 <label class="fw-bolder fs-2 mt-4" style="color: rgb(216, 241, 165);">Advanced Search</label>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-transparent mt-3 mb-3 rounded">
                 <div class="row">
                     <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                         <div class="row">
                             <div class="col-12 col-lg-10 mt-3 mb-3">
                                 <input type="text" class="form-control fw-bold" placeholder="Type Keyword to Search...." id="k" />
                             </div>
                             <div class="col-12 col-lg-2 mt-3 mb-3 d-grid">
                                 <button class="btn btn-primary" onclick="advancedSearch(1);">Search</button>
                             </div>
                             <div class="col-12">
                                 <hr class="border border-primary border-3" />
                             </div>
                         </div>
                     </div>
                     <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                         <div class="row">
                             <div class="col-12">
                                 <div class="row">
                                     <div class="col-12 col-lg-4 mb-3">
                                         <select class="form-select" id="c">
                                             <option class="p-3" value="0">Select Category</option>
                                             <?php
                                                $catrs = Database::search("SELECT*FROM `category`");
                                                $cn = $catrs->num_rows;
                                                for ($i = 0; $i < $cn; $i++) {

                                                    $catd = $catrs->fetch_assoc();
                                                ?>
                                                 <option class="p-3" value="<?php echo $catd["id"]; ?>"><?php echo $catd["name"]; ?></option>
                                             <?php


                                                }

                                                ?>
                                         </select>
                                     </div>
                                     <div class="col-12 col-lg-4 mb-3">
                                         <select class="form-select" id="b">
                                             <option class="p-3" value="0">Select Brand</option>

                                             <?php
                                                $brs = Database::search("SELECT*FROM `brand`");
                                                $bn = $brs->num_rows;
                                                for ($i = 0; $i < $bn; $i++) {

                                                    $bd = $brs->fetch_assoc();
                                                ?>
                                                 <option class="p-3" value="<?php echo $bd["id"]; ?>"><?php echo $bd["name"]; ?></option>
                                             <?php


                                                }

                                                ?>

                                         </select>
                                     </div>
                                     <div class="col-12 col-lg-4 mb-3">
                                         <select class="form-select" id="m">
                                             <option value="0">Select Model</option>

                                             <?php
                                                $mrs = Database::search("SELECT*FROM `model`");
                                                $mn = $mrs->num_rows;
                                                for ($i = 0; $i < $mn; $i++) {

                                                    $md = $mrs->fetch_assoc();
                                                ?>
                                                 <option class="p-3" value="<?php echo $md["id"]; ?>"><?php echo $md["name"]; ?></option>
                                             <?php


                                                }

                                                ?>

                                         </select>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <div class="row">
                                     <div class="col-12 col-lg-6 mb-3">
                                         <select class="form-select" id="con">
                                             <option class="p-3" value="0">Select Condition</option>
                                             <?php
                                                $brs = Database::search("SELECT*FROM `condition`");
                                                $bn = $brs->num_rows;
                                                for ($i = 0; $i < $bn; $i++) {

                                                    $bd = $brs->fetch_assoc();
                                                ?>
                                                 <option class="p-3" value="<?php echo $bd["id"]; ?>"><?php echo $bd["name"]; ?></option>
                                             <?php


                                                }

                                                ?>
                                         </select>
                                     </div>
                                     <div class="col-12 col-lg-6 mb-3">
                                         <select class="form-select">
                                             <option class="p-3" value="0" id="clr">Select Colour</option>
                                             <?php




                                                $brs = Database::search("SELECT*FROM `color`");
                                                $bn = $brs->num_rows;
                                                for ($i = 0; $i < $bn; $i++) {

                                                    $bd = $brs->fetch_assoc();
                                                ?>
                                                 <option class="p-3" value="<?php echo $bd["id"]; ?>"><?php echo $bd["name"]; ?></option>
                                             <?php


                                                }

                                                ?>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <div class="row">
                                     <div class="col-12 col-lg-6 mb-3">
                                         <input type="text" class="form-control" placeholder="Price From" id="pf">
                                     </div>
                                     <div class="col-12 col-lg-6 mb-3">
                                         <input type="text" class="form-control" placeholder="Price To" id="pt">
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3 rounded bg-transparent" id="filter">
                 <div class="row" id="pv">
                     
                     
                 </div>
             </div>


         </div>

         <div class="row">
             <?php require "footer.php"; ?>
         </div>
     </div>
     <script src="script.js"></script>
     <script src="bootstrap.bundle.js"></script>
 </body>

 </html>