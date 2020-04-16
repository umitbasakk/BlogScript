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
          <div class="table-wrapper mb-4">
              <div class="table-title">


  						<h2>Site Ayarları</h2>
              <hr>




            <form>
                   <div class="form-group">
                     <label for="exampleFormControlInput1">Site Başlığı</label>
                     <input type="email" class="form-control" id="title" value="<?php echo $title ?>">
                   </div>
                   <div class="form-group">
                     <label for="exampleFormControlInput1">Site Url</label>
                     <input type="email" class="form-control" id="url" value="<?php echo $site_url ?>">
                   </div>
                   <div class="form-group">
                     <label for="exampleFormControlTextarea1">Açıklama</label>
                     <textarea class="form-control" id="description" rows="3"><?php echo $description ?></textarea>
                   </div>


                   <div class="form-group">
                     <label for="exampleFormControlTextarea1">Hakkımda</label>
                     <textarea class="form-control" id="about" rows="5"><?php echo $about?></textarea>
                   </div>
                  </form>

                  <button  class="btn btn-sm btn-info" id="webupdate" type="button">Güncelle</button>

                  </div>
              </div>



        </div>


  </div>
  <?php include("pages/right.php"); ?>

</div>
 </div>

 <?php include("../pages/footer.php"); ?>

 <script>

$(document).ready(function(){


    $("#webupdate").click(function(){

          var title = $("#title").val();
          var url = $("#url").val();
          var description = $("#description").val();
          var about = $("#about").val();

          var Data = "title="+title+"&url="+url+"&description="+description+"&about="+about;

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
               url: "ajax/settings.php",
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


})


 </script>

<?php }?>
