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

       $select = $db->prepare("SELECT * FROM category WHERE id=?");
       $select->execute(array($arid));
       $result = $select->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="card mb-4">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="exampleFormControlInput1">Kategori Adı</label>
                <input type="email" class="form-control" id="category" value="<?php echo $result["category_name"]; ?>">
              </div>
              <div class="form-group">

               <button class="btn btn-sm btn-info login  btns" id="<?php echo $arid; ?>" onClick="upcate(this.id)" type="button">Güncelle</button>
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
              <button  class="btn btn-sm btn-info btns" data-toggle="modal" data-target="#registerModals" type="button"> <span>Kategori Ekle</span></button>


               <!-- Kullanıcı Ekle -->
               <div class="modal fade" id="registerModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <form class="forms">


                       <div class="form-group">
                         <label for="exampleInputEmail1">Kategori Adı</label>
                         <input type="email" class="form-control" id="catname" aria-describedby="emailHelp" >
                       </div>






                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary devami" data-dismiss="modal">Kapat</button>
                         <button type="button" id="catadd" class="btn btn-primary devami">Ekle</button>
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
                          <th>Kategori Adı</th>
                          <th>Durum</th>
                      </tr>
                  </thead>
                  <tbody>
           <?php

              $uss = $db->prepare("SELECT * FROM category");
              $uss->execute();

              if($uss->rowCount()){

                foreach($uss as $cat){


           ?>



  					<tr>
  						<td>
  						     	<span class="custom-checkbox">
  							     	<input type="checkbox" id="deleteuser"  value="<?php echo $user["id"]; ?>">
  							     	<label for="checkbox5"></label>
  						    	</span>
  						     </td>
                          <td><?php echo $cat["id"]; ?></td>
                          <td><?php echo $cat["category_name"]; ?></td>
                          <td>
                              <a href="?update&id=<?php echo $cat["id"]; ?>" style="color:white;margin-left:-40px;" class="btn btn-sm btn-info btns">Düzenle</a>
                            <button   id="<?php echo $cat["id"]; ?>" class="btn btn-sm btn-danger btns" onClick="deletecat(this.id)"  > sil</button>
                           </td>
                      </tr>
                    <?php } } ?>

                  </tbody>
              </table>
              <?php

                  if(isset($_GET["delete"])){

                      $articleid = $_GET["id"];

                    $delete = $db->prepare("DELETE FROM articles WHERE id=?");
                    $delete->execute(array($articleid));
                    Header("Location:articles.php");
                  }




               ?>

          </div>
        </div>


  </div>
  <?php include("pages/right.php"); ?>

</div>
 </div>

 <?php include("../pages/footer.php"); ?>

 <script>



function upcate(ids){

       var category = $("#category").val();

       var Data = "catup="+category+"&id="+ids;

       Swal.fire({
       title: 'Emin Misin?',
       text: "güncelleme yapcaksınız!",
       icon: 'warning',
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#28a745',
       confirmButtonText: 'Evet, Ekle'
     }).then((result) => {
       if (result.value) {

          $.ajax({
            type: "POST",
            url: "details.php",
            data: Data,
            success:function(data){

                        vari = JSON.parse(data);
                        Swal.fire({
                          icon: vari.status,
                          title: vari.message
                        }).then((result) => {
                          if(result.value){

                                     window.location = "category.php?update&id="+ids;
                          }
                        })

                      if(vari.status == "success"){
                          setTimeout(function(){
     window.location = "category.php?update&id="+ids;
                          },1500)
                      }

            }
          })
       }


})


}






$(document).ready(function(){








    $("#catadd").click(function(){

               var category = $("#catname").val();



               var Data =  "catadd="+category+"&category="+category;

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
                    url: "details.php",
                    data: Data,
                    success:function(data){

                                vari = JSON.parse(data);
                                Swal.fire({
                                  icon: vari.status,
                                  title: vari.message
                                }).then((result) => {
                                  if(result.value){

                                             window.location = "category.php";
                                  }
                                })

                              if(vari.status == "success"){
                                  setTimeout(function(){
                                    window.location = "category.php";

                                  },1500)
                              }

                    }
                  })
               }


    })
  })



})


 </script>

 <script>


   function deletecat(idq){


     var Data = "catdelete="+idq+"&idq="+idq;

     Swal.fire({
       title: 'Emin Misin?',
       text: "Kategori silinecek",
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
                url: "details.php",
                data: Data,
                success:function(data){

                          vari = JSON.parse(data);

                          Swal.fire({
                            icon: vari.status,
                            title: vari.message
                          })

                          if(vari.status == "success"){

                               setTimeout(function(){
                                 window.location = "category";
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
