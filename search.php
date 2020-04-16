<?php
@session_start();
@ob_start();
define("guvenlik",true);
require_once'functions/db.php';
include("pages/header.php");



 ?>

   <div class="container">

     <div class="row">

       <div class="col-md-8">

         <h1 class="my-4">Arama Sonuçları
         </h1>


          <?php

          if(!isset($_POST["search"])){
              echo '<div class="alert alert-danger" role="alert">Direk erişmeye çalıştığınız için sonuç bulunamadı</div>';
            }else if(isset($_POST["search"])){
          $search = $_POST["search"];

          $select = $db->prepare("SELECT * FROM articles WHERE title like '%$search%'");
          $select->execute(array());

           if($select->rowCount()){



             foreach($select as $ress){

           ?>


         <div class="card mb-4">
           <img class="card-img-top" src="<?php echo $ress["photo"]; ?>" alt="Card image cap">
           <div class="card-body">
             <h2 class="card-title"><?php echo $ress["title"]; ?></h2>
             <p class="card-text"><?php echo substr($ress["text"],0,250); ?></p>
             <a href="<?php echo $site_url; ?>article/<?=seo($ress["title"])?>" class="btn btn-primary devami">Devamını Oku</a>
           </div>

         </div>

         <?php
       }
     } else{
          echo '<div class="alert alert-danger" role="alert">Aradığınız bulunamadı</div>';
        }
      }


?>


       </div>
       <?php include("pages/right_bar.php"); ?>

       </div>
 </div>

       <?php include("pages/footer.php"); ?>
