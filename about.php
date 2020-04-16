<?php
@session_start();
@ob_start();

define("guvenlik",true);
require_once'functions/db.php';
include("pages/header.php");

 ?>


   <div class="container">

     <div class="row">

       <div class="col-lg-12">

      <div class="card mb-4 mt-4">
        <div class="card-body">
         <h1 class="mt-4">Hakkımda</h1>
      </div>
    </div>
          <?php

          $select = $db->prepare("SELECT * FROM settings WHERE id=?");
          $select->execute(array(1));
          $result = $select->fetch(PDO::FETCH_ASSOC);




           ?>



           <div class="card  mb-4 mt-4">
             <div class="card-body">
         <?php
         if($result["about"]){
            echo'<p class="lead">'.$result["about"].'</p>';
         }else {
             echo' <div class="alert alert-danger categorydanger" role="alert">Site hakkında bilgi girmediğiniz için veri gözükmemekte.Admin Paneli > Site ayarları kısmından bilgi girebilirsiniz.</div>';
         }
         ?>

       </div>
     </div>




       </div>



     </div>

   </div>

   <?php include("pages/footer.php"); ?>
