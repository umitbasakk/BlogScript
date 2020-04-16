<?php
@session_start();
@ob_start();



  if(!file_exists("functions/db.php")){
   Header("Location:pages/install.php");
}


define("guvenlik",true);
require_once'functions/db.php';
include("pages/header.php");

 ?>


  <div class="container" style="">

    <div class="row">


      <div class="col-md-8">

        <div class="card mb-4 mt-4">
          <div class="card-body">
        <h1 class="mt-4">Son Yazılarım</h1>
  </div>
  </div>


        <?php
        $sfss = @intval($_GET["sayfa"]); if(!$sfss){ $sfss =1;}
        $selects = $db->prepare("SELECT * FROM articles WHERE statu=?");
        $selects->execute(array(1));
        $AllArticles = $selects->rowCount();
        $Limit = 2;
        $GorunenSayfa = 3;
        $SayfaSayisi = ceil($AllArticles/$Limit);
        if($sfss > $SayfaSayisi){ if($sfss > $SayfaSayisi){ $sfss = 1;} }


        $Goster = $sfss * $Limit - $Limit;

        $select = $db->prepare("SELECT * FROM articles  WHERE statu=? ORDER BY id DESC LIMIT $Goster,$Limit");
        $select->execute(array('1'));

        if($select->rowCount()){

           foreach($select as $row){


            $metin = seo($row["title"]);


         ?>
        <div class="card mb-4">
          <img class="card-img-top" src="<?php echo $row["photo"]; ?>" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?php echo $row["title"]; ?></h2>
            <p class="card-text"><?php echo substr($row["text"],0,250); ?></p>
            <a  href="<?php echo $site_url; ?>article/<?=seo($row["title"])?>" class="btn btn-primary devami">Devamını Oku</a>
          </div>

        </div>
        <?php
      }

    }else{
      echo '
      <div class="card mb-4">
      <div class="card-body">
      <div class="alert alert-danger categorydanger" role="alert">
      Makale Bulunmamaktadır.
      </div>
  </div>  </div>

      ';
    }

         ?>
 <nav aria-label="Page navigation example">
  <ul class="pagination navi">

     <?php  if($sfss == 1){?>
      <li class="page-item disabled "><a class="page-link" href="<?php echo $site_url; ?>home/<?php echo $sfss - 1  ; ?>">önceki</a></li>
      <?php }?>

      <?php  if($sfss > 1){?>
       <li class="page-item"><a class="page-link" href="<?php echo $site_url; ?>home/<?php echo $sfss - 1  ; ?>">önceki</a></li>
       <?php }?>


    <?php
  for($i = $sfss - $SayfaSayisi; $i < $sfss + $SayfaSayisi + 1; $i++){
    if($i >0 and $i <= $SayfaSayisi){
        if($i == $sfss){

          echo'    <li class="page-item active"><a class="page-link" href="'.$site_url.'home/'.$i.'">'.$i.'</a></li>';
        }else{
          echo'    <li class="page-item"><a class="page-link" href="'.$site_url.'home/'.$i.'">'.$i.'</a></li>';


        }
}
  } ?>

  <?php  if($sfss == $SayfaSayisi){?>
   <li class="page-item disabled"><a class="page-link" href="<?php echo $site_url; ?>home/<?php echo $sfss + 1  ; ?>">Sonraki</a></li>
   <?php }?>

   <?php  if($sfss < $SayfaSayisi){?>
    <li class="page-item "><a class="page-link" href="<?php echo $site_url; ?>home/<?php echo $sfss + 1  ; ?>">Sonraki</a></li>
    <?php }?>


  </ul>
</nav>
      </div>

 <?php include("pages/right_bar.php"); ?>

    </div>

  </div>

<?php include("pages/footer.php");  ?>
