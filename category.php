<?php
@session_start();
@ob_start();
define("guvenlik",true);
require_once'functions/db.php';
include("pages/header.php");

$url = $_GET["url"];
 ?>

   <div class="container">

     <div class="row">

       <div class="col-md-8">

  <div class="card mb-4 mt-4">
    <div class="card-body ">
         <h1 class="my-4"><?php echo $url; ?> kategorisinde ki yazılar
         </h1>

       </div>
     </div>




          <?php

          $select = $db->prepare("SELECT * FROM articles WHERE category=?");
          $select->execute(array($url));

           if($select->rowCount()){

             foreach($select as $ress){

           ?>


         <div class="card mb-4">
           <img class="card-img-top" src="<?php echo $ress["photo"]; ?>" alt="Card image cap">
           <div class="card-body">
             <h2 class="card-title"><?php echo $ress["title"]; ?></h2>
             <p class="card-text"><?php echo substr($ress["text"],0,250); ?></p>
             <a href="<?php echo $site_url;?>article/<?=seo($ress["title"])?>" class="btn btn-primary devami">Devamını Oku</a>
           </div>

         </div>

         <?php
       }
     }else{?>
       <div class="alert alert-danger" role="alert">
       Bu kategoriye ait yazı bulunmamaktadır.
       </div>

     <?php } ?>



       </div>
       <?php include("pages/right_bar.php"); ?>

     </div>

   </div>

       <?php include("pages/footer.php"); ?>
