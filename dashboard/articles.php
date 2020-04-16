<?php
@ob_start();
@session_start();

define("guvenlik",true);
require_once'../functions/db.php';

if(!isset($_SESSION["oturum"])){
    Header("Location:$site_url");
}else if($statu != 2){
  Header("Location:$site_url");

}else{
include("../pages/header.php");

 ?>


 <div class="container">
<?php include("pages/headers.php"); ?>

   <div class="row">
  <div class="col-8">

    <div class="container">

      <?php if(isset($_GET["update"])){

       $arid= $_GET["id"];

       $select = $db->prepare("SELECT * FROM articles WHERE id=?");
       $select->execute(array($arid));
       $result = $select->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="card mb-4">
          <div class="card-body">
            <form action="" method="POST" >
              <div class="form-group">
                <label for="exampleFormControlInput1">Makale Başlığı</label>
                <input type="email" class="form-control" id="title" value="<?php echo $result["title"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Makale Fotoğraf Url</label>
                <input type="text" class="form-control" id="photo" value="<?php echo $result["photo"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Kategori</label>
                <input type="text" class="form-control" id="category" value="<?php echo $result["category"]; ?>">
              </div>

              <div class="form-group">
                <label for="exampleFormControlInput1">Yazar</label>
                <input type="text" class="form-control" id="authors" value="<?php echo $result["author"]; ?>">
              </div>
              <label for="exampleFormControlSelect1">Statu</label>

              <select class="form-control" id="statu">

                <?php
                  if($result["statu"] == '0'){
                    echo'
                    <option value="0">Yayında Değil</option>
                    <option value="1">Yayınla</option>

                    '
                    ;
                  }else if($result["statu"] == '1'){
                    echo'
                    <option value="1">Yayında</option>
                    <option value="0">Yayından Kaldır</option>';

                  }
                 ?>



              </select>
              <div class="form-group">
                <label for="exampleFormControlInput1">Metin</label>
                <textarea type="text" class="ckeditor" id="text"  rows="10"><?php echo $result["text"]; ?></textarea>

              </div>

              <div class="form-group">

               <button class="btn btn-sm btn-info login  btns" id="updateArticle" type="button">Güncelle</button>
              </div>


            </form>
          </div>
        </div>

        <?php } ?>
          <div class="table-wrapper mb-4">
              <div class="table-title">
                  <div class="row">
                      <div class="col-sm-6">
  						<h2>Makaleler</h2>
  					</div>
  					<div class="col-sm-6">
              <button  class="btn btn-sm btn-info btns" data-toggle="modal" data-target="#registerModals" type="button"> <span>Makale Ekle</span></button>


               <!-- Kullanıcı Ekle -->

               <div class="modal fade" id="registerModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <form class="forms">
                       <div class="form-group">
                          <label for="exampleFormControlSelect1">Category</label>
                          <select class="form-control" id="category">

                              <?php

                                $category = $db->prepare("SELECT * FROM category");
                                $category->execute();
                                foreach($category as  $cat){
                               ?>

                              <option value="<?php echo $cat["category_name"];?>"><?php echo $cat["category_name"];?></option>
                            <?php  } ?>

                            </select>
                          </div>

                       <div class="form-group">
                         <label for="exampleInputEmail1">Fotoğraf Url</label>
                         <input type="email" class="form-control" id="url" aria-describedby="emailHelp" >
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Title</label>
                         <input type="email" class="form-control" id="titles" aria-describedby="emailHelp" >
                       </div>

                       <div class="form-group">
                         <label for="exampleInputEmail1">Makale</label>
                         <textarea class="ckeditor"  id="text2" rows="3"></textarea>
                       </div>





                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary devami" data-dismiss="modal">Kapat</button>
                         <button type="button" id="send" class="btn btn-primary devami">Gönder</button>
                       </div>
                     </div>
                    </form>
                   </div>
                 </div>



  					</div>
                  </div>
              </div>
              <table class="table table-striped table-hover">
                  <thead>
                      <tr>
  						<th>
  							<span class="custom-checkbox">
  								<input type="checkbox" id="select">
  								<label for="selectAll"></label>
  							</span>
  						</th>
                          <th>ID</th>
                          <th>Makale Adı</th>
                          <th>Yazar</th>
  					            	<th>Statu</th>
                          <th>Kategori</th>
                          <th>Durum</th>
                      </tr>
                  </thead>
                  <tbody>
           <?php

              $uss = $db->prepare("SELECT * FROM articles");
              $uss->execute();

              if($uss->rowCount()){

                foreach($uss as $article){


           ?>



  					<tr>
  						<td>
  						     	<span class="custom-checkbox">
  							     	<input type="checkbox" id="deleteuser"  value="<?php echo $user["id"]; ?>">
  							     	<label for="checkbox5"></label>
  						    	</span>
  						     </td>
                          <td><?php echo $article["id"]; ?></td>
                          <td><?php echo $article["title"]; ?></td>
                          <td><?php echo $article["author"]; ?></td>
  				  	          	<td><?php if($article["statu"] == 0){ echo'Yayında Değil';}else if($article["statu"] == 1){ echo'Yayında';} ?></td>
                          <td><?php echo $article["category"]; ?></td>
                          <td>

                              <a href="?update&id=<?php echo $article["id"]; ?>" style="color:white;margin-left:-40px;" class="btn btn-sm btn-info btns">Düzenle</a>
                            <button   id="<?php echo $article["id"]; ?>" class="btn btn-sm btn-danger btns" onClick="deletearticle(this.id)"  > sil</button>
                           </td>
                      </tr>
                    <?php } } ?>

                  </tbody>
              </table>


          </div>
        </div>


  </div>
  <?php include("pages/right.php"); ?>

</div>
 </div>

 <?php include("../pages/footer.php"); ?>

 <script>

$(document).ready(function(){


    $("#send").click(function(){

               var category = $("#category").val();
               var url = $("#url").val();
               var titles = $("#titles").val();
               var text = CKEDITOR.instances.text2.getData();
               var namea = "<?php echo $namez; ?>";



               var Data = "category="+category+"&url="+url+"&titles="+titles+"&text="+text+"&namea="+namea;

               Swal.fire({
               title: 'Emin Misin?',
               text: "ekleme yapcaksınız!",
               icon: 'warning',
               showCancelButton: true,
               cancelButtonColor: '#d33',
               confirmButtonColor: '#28a745',
               confirmButtonText: 'Evet, Ekle'
             }).then((result) => {
               if (result.value) {

                  $.ajax({
                    type: "POST",
                    url: "ajax/article.php",
                    data: Data,
                    success:function(data){

                                vari = JSON.parse(data);
                                Swal.fire({
                                  icon: vari.status,
                                  title: vari.message
                                }).then((result) => {
                                  if(result.value){
                                    window.location = "articles.php";
                                  }
                                })
                    }
                  })
               }


    })
  })

  })

/*


  */






 </script>

 <script>
 $("#updateArticle").click(function(){

         var ids = "<?php echo $arid; ?>";
         var title = $("#title").val();
         var photo = $("#photo").val();
         var author = $("#authors").val();
         var text =  CKEDITOR.instances.text.getData();
         var statu = $("#statu").val();
         var category = $("#category").val();

         var Data = "ids="+ids+"&author="+author+"&title="+title+"&photo="+photo+"&text="+text+"&statu="+statu+"&category="+category;

                     Swal.fire({
                     title: 'Emin Misin?',
                     text: "güncelleme yapcaksınız!",
                     icon: 'warning',
                     showCancelButton: true,
                     cancelButtonColor: '#d33',
                     confirmButtonColor: '#28a745',
                     confirmButtonText: 'Evet, Güncelle'
                   }).then((result) => {
                     if (result.value) {

                        $.ajax({
                          type: "POST",
                          url: "ajax/articleupdate.php",
                          data: Data,
                          success:function(data){

                                      vari = JSON.parse(data);
                                      Swal.fire({
                                        icon: vari.status,
                                        title: vari.message
                                      })
                          }
                        })
                     }
                   })


 })

 </script>

 <script>


   function deletearticle(idq){


     var Data = "arcticledelete="+idq+"&idq="+idq;

     Swal.fire({
       title: 'Emin Misin?',
       text: "Makale silinecek",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Evet, Sil'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           $.ajax({
                type:"POST",
                url: "ajax/delete.php",
                data: Data,
                success:function(data){

                          vari = JSON.parse(data);

                          Swal.fire({
                            icon: vari.status,
                            title: vari.message
                          })

                          if(vari.status == "success"){

                               setTimeout(function(){
                                 window.location = "articles";
                               },1000);

                          }
                }


           })
         )
       }
     })






   }





 </script>












<?php }?>
