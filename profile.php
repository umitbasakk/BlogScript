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
             <h1 class="mt-4">Profilim</h1>
         </div>
       </div>
      </div>
      <div class="col-sm">
       <div class="card mb-4 mt-4">
         <div class="card-body">
           <h4 style="text-align:center;">Bilgileri Güncelle</h4>

         <form>
           <div class="form-group">
             <label for="exampleInputEmail1">Adınız</label>
             <input type="text" class="form-control" id="ProfileName" aria-describedby="emailHelp" value="<?php echo $namez; ?>">
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Soyadınız</label>
             <input type="email" class="form-control" id="ProfileSurname" aria-describedby="emailHelp" value="<?php echo $surname; ?>">
           </div>
           <div class="form-group">
             <label for="exampleInputEmail1">Email address</label>
             <input type="email" class="form-control" id="ProfileEmail" aria-describedby="emailHelp" value="<?php echo $email; ?>">
           </div>

           <button type="button" id="ProfileUpdate" class="btn btn-primary devami">Güncelle</button>
         </form>
       </div>
     </div>


             </div>
                 <div class="col-sm">
                   <div class="card mb-4 mt-4">
                     <div class="card-body">
                       <h4 style="text-align:center;">Parola Güncelle</h4>
                     <form>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Eski Parolanız</label>
                         <input type="text" class="form-control" id="Oldpassword">
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Yeni Parolanız</label>
                         <input type="password" class="form-control" id="Newpassword">
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Tekrar Yeni Parolanız</label>
                         <input type="password" class="form-control" id="Newpasswordrepeat">
                       </div>

                       <button type="button" id="PasswordUpdate" class="btn btn-primary devami">Güncelle</button>
                     </form>
                   </div>
                 </div>
                 </div>




           </div>
         </div>

       </div>



     </div>

   </div>



   <?php include("pages/footer.php"); ?>

   <script>

      $(document).ready(function(){
          $("#PasswordUpdate").click(function(){

             var oldpassword = $("#Oldpassword").val();
             var  newpassword = $("#Newpassword").val();
             var  newpasswordrepeat = $("#Newpasswordrepeat").val();
             var idzq = "<?php echo $id; ?>";

             var Data = "updateps="+oldpassword+"&oldpassword="+oldpassword+"&newpassword="+newpassword+"&newpasswordrepeat="+newpasswordrepeat+"&idzq="+idzq;

            Swal.fire({
             icon: "info",
             title: "Emin misiniz?",
             showCancelButton:true,

             confirmButtonText: "Evet, Güncelle",
             cancelButtonText: "Hayır, İptal et"
           }).then((result) => {
             if(result.value){

                    $.ajax({
                      type: "POST",
                      url: "operations.php",
                      data: Data,
                      success:function(data){

                                    veri = JSON.parse(data);

                                    Swal.fire({
                                      icon: veri.icon,
                                      title: veri.title
                                    })
                      }
                    })

             }
           })


          })

          $("#ProfileUpdate").click(function(){

             var ProfileName = $("#ProfileName").val();
             var  ProfileSurname = $("#ProfileSurname").val();
             var ProfileEmail = $("#ProfileEmail").val();
             var idzq = "<?php echo $id; ?>";

             var Data = "update="+ProfileName+"&ProfileName="+ProfileName+"&ProfileSurname="+ProfileSurname+"&ProfileEmail="+ProfileEmail+"&idzq="+idzq;

            Swal.fire({
             icon: "info",
             title: "Emin misiniz?",
             showCancelButton:true,

             confirmButtonText: "Evet, Güncelle",
             cancelButtonText: "Hayır, İptal et"
           }).then((result) => {
             if(result.value){

                    $.ajax({
                      type: "POST",
                      url: "operations.php",
                      data: Data,
                      success:function(data){

                                    veri = JSON.parse(data);

                                    Swal.fire({
                                      icon: veri.icon,
                                      title: veri.title
                                    })
                      }
                    })

             }
           })


          })
      })


   </script>
