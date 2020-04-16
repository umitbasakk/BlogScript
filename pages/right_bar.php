<?php

if(!defined ('guvenlik')){

    Header("Location:/blog/home");
} else{


@session_start();
@ob_start();
require_once'functions/db.php';



?>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
      <form action="<?php echo $site_url;?>search" method="POST">
        <div class="card my-4">
          <h5 class="card-header">Arama</h5>
          <div class="card-body">
            <div class="input-group">

              <div class="input-group mb-3">
                <input type="text" class="form-control search" placeholder="Aramak İstediğiniz Yazı"  id="search" name="search">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary searchbutton"  type="submit">Ara</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </form>

        <div class="card mb-3">
          <h5 class="card-header">Kategoriler</h5>

        <div class="list-group">
        <?php
             $select = $db->prepare("SELECT * FROM category");
             $select->execute();

             if($select->rowCount()){



                foreach($select as $category){




         ?>

        <a href="<?php echo $site_url; ?>category/<?=seo($category["category_name"])?>"  class="list-group-item list-group-item-action categorybutton"><?php echo $category["category_name"]; ?></a>
    <?php
  }
}else{?>
  <div class="alert alert-danger categorydanger" role="alert">
  Kategori Bulunmamaktadır.
  </div>
<?php } ?>

      </div>
      </div>

      <div class="card mb-3">
        <h5 class="card-header">Son Yazılar</h5>

      <div class="list-group">
      <?php
           $select = $db->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 4");
           $select->execute();

           if($select->rowCount()){



              foreach($select as $articles){




       ?>

      <a href="<?php echo $site_url; ?>article/<?=seo($articles["title"])?>"  class="list-group-item list-group-item-action categorybutton"><?php echo $articles["title"];?></a>
  <?php
}
}else{?>
<div class="alert alert-danger categorydanger" role="alert">
Makale
</div>
<?php } ?>

    </div>
    </div>



      </div>
    <?php } ?>
