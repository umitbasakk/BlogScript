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

 <?php include("pages/headers.php") ?>

   <div class="row">
  <div class="col-8">

    <div class="container">
      <?php if(isset($_GET["update"])){
        $usid= $_GET["id"];

       $select = $db->prepare("SELECT * FROM users WHERE id=?");
       $select->execute(array($usid));
       $result = $select->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="card mb-4">
          <div class="card-body">
            <form action="" method="POST" >
              <div class="form-group">
                <label for="exampleFormControlInput1">Email adresi</label>
                <input type="email" class="form-control" id="emailz" value="<?php echo $result["email"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Adı</label>
                <input type="text" class="form-control" id="namez" value="<?php echo $result["name"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Soyadı</label>
                <input type="text" class="form-control" id="surnamez" value="<?php echo $result["surname"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="usernamez" value="<?php echo $result["username"]; ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Telefon</label>
                <input type="numeric" class="form-control" id="telephonez" value="<?php echo $result["telephone"]; ?>">
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Statu</label>

                <select class="form-control" id="statuz">

                  <?php
                    if($statu== '2'){
                      echo'
                      <option value="2">Admin</option>
                      <option value="1">Mail Onaylı Kullanıcı</option>
                      <option value="0">Mail Onaysız Kullanıcı</option>

                      '



                      ;
                    }else if($statu == '1'){
                      echo' <option>Mail Onaylı Kullanıcı</option>
                      <option value="2">Admin</option>
                      <optionvalue="0">Mail Onaysız Kullanıcı</option>';

                    }else if($statu == '0'){
                      echo' <option value="0">Mail Onaysız Kullanıcı</option>
                      <option value="2">Admin</option>
                      <option value="1">Mail Onaylı Kullanıcı</option>
                    ';

                    }
                   ?>



                </select>


              </div>



            </form>
            <button id="<?php echo $_GET["id"]; ?>" class="btn btn-sm btn-info login  btns" onClick="updateus(this.id)" style="float:right;" type="button">Güncelle</button>


          </div>
        </div>

        <?php } ?>
          <div class="table-wrapper mb-4">
              <div class="table-title">
                  <div class="row">
                      <div class="col-sm-6">
  						<h2>Kullanıcılar</h2>
  					</div>
  					<div class="col-sm-6">


              <button  class="btn btn-sm btn-info btns"  data-toggle="modal" data-target="#registerModals" type="button"> <span>Kullanıcı Ekle</span></button>


               <!-- Kullanıcı Ekle -->
               <div class="modal fade" id="registerModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <form class="forms">
                       <div class="form-group">
                          <label for="exampleFormControlSelect1">Example select</label>
                          <select class="form-control" id="statu">
                              <option value="0">Kullanıcı</option>
                              <option value="2">Admin</option>

                            </select>
                          </div>

                       <div class="form-group">
                         <label for="exampleInputEmail1">Kullanıcı Adınız</label>
                         <input type="email" class="form-control" id="usernames" aria-describedby="emailHelp" >
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Email Adresiniz</label>
                         <input type="email" class="form-control" id="emailsq" aria-describedby="emailHelp" >
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Adınız</label>
                         <input type="email" class="form-control" id="names" aria-describedby="emailHelp" >
                       </div>

                       <div class="form-group">
                         <label for="exampleInputEmail1">Soyadınız</label>
                         <input type="email" class="form-control" id="surnames" aria-describedby="emailHelp" >
                       </div>
                       <div class="form-group">
                         <label for="exampleInputEmail1">Telefon Numaranız</label>
                         <input type="numeric" class="form-control" id="telephones" aria-describedby="emailHelp" >
                       </div>
                       <div class="form-group">
                         <label for="exampleInputPassword1">Parolanız</label>
                         <input type="password" class="form-control" id="sifres">
                       </div>
                       <div class="form-group">
                         <label for="exampleInputPassword1">Parolanız</label>
                         <input type="password" class="form-control" id="sifre2s">
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary devami" data-dismiss="modal">Kapat</button>
                         <button type="button" id="reg" class="btn btn-primary devami">Kayıt Ol</button>
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

                          <th>ID</th>
                          <th>Adı</th>
                          <th>Email</th>
  					            	<th>Statu</th>
                          <th>Telefon</th>
                          <th>Durum</th>
                          <th></th>

                      </tr>
                  </thead>
                  <tbody>
           <?php

              $uss = $db->prepare("SELECT * FROM users");
              $uss->execute();

              if($uss->rowCount()){

                foreach($uss as $user){


           ?>



  					<tr>

                          <td><?php echo $user["id"]; ?></td>
                          <td><?php echo $user["name"]; ?></td>
                          <td><?php echo $user["email"]; ?></td>
  				  	          	<td><?php if($user["name"] == 0){ echo'Mail Onaylanmadı';}else if($user["statu"] == 1){ echo'Mail Onaylı';}else if($user["statu"] == 2){ echo'Admin';} ?></td>
                          <td><?php echo $user["telephone"]; ?></td>
                          <td><td>



                              <a class="btn btn-sm btn-info btns" style="color:white;margin-left:-60px;"  href="?update&id=<?php echo $user["id"]; ?>">Düzenle</a>
                              <button id="<?php echo $user["id"]; ?>" class="btn btn-sm btn-danger login  btns" onClick="deleteuserz(this.id)" type="button">Sil</button>
                          </td>
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


    $("#reg").click(function(){

      var statu = $("#statu").val();
      var usernames = $("#usernames").val();
      var telephones = $("#telephones").val();
      var names = $("#names").val();
      var surnames = $("#surnames").val();
      var emailsq = $("#emailsq").val();
      var passwords = $("#sifres").val();
      var password2s = $("#sifre2s").val();

      var Data = "useradd="+statu+"&statu="+statu+"&username="+usernames+"&telephone="+telephones+"&surname="+surnames+"&emailsq="+emailsq+"&password="+passwords+"&name="+names+"&password2="+password2s;



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
                              window.location = "";
                         }
                       });

                       if(vari.status == "success"){
                           setTimeout(function(){
                                window.location = "";
                           },1333);
                       }
           }
         })
      }


   })








    })


})


 </script>

 <script type="text/javascript">

  function updateus(id){
          var email = $("#emailz").val();
          var name = $("#namez").val();
          var surname = $("#surnamez").val();
          var username = $("#usernamez").val();
          var telephone = $("#telephonez").val();
          var statu = $("#statuz").val();


          var Data = "updateuser="+email+"&email="+email+"&name="+name+"&surname="+surname+"&username="+username+"&telephone="+telephone+"&statu="+statu+"&id="+id;

              Swal.fire({
                icon: "info",
                title: "Emin misiniz?",
                text: "Güncelleme Yapacaksınız?",
                showCancelButton:true,
                confirmButtonText: "Evet Eminim",
                cancelButtonText:"İptal Et"
              }).then((result) => {
                if(result.value){

                   $.ajax({
                     type: "POST",
                     url: "details.php",
                     data: Data,
                     success:function(data){

                             updateuser = JSON.parse(data);

                             Swal.fire({
                               icon: updateuser.status,
                               title: updateuser.message
                             })

                     }

                   })


                }else if(result.Dismiss == Swal.DismissReason.cancel){

                }
              })
    }




</script>

<script>
function deleteuserz(id){

  var Dataq = "deleteuser="+id+"&id="+id;

       Swal.fire({
         icon: "info",
         title: "Emin misin?",
         text: "Kullanıcıyı sileceksiniz",
         showCancelButton:true,
         confirmButtonText: "Evet, Eminim",
         cancelButtonText: "İptal Et"
       }).then((result) => {
         if(result.value){

                   $.ajax({
                     type: "POST",
                     url : "details.php",
                     data: Dataq,
                     success:function(data){

                              deleteuser = JSON.parse(data);

                              Swal.fire({
                                icon: deleteuser.status,
                                title: deleteuser.message
                              }).then((result) =>  {
                                 if(result.value){
                                   window.location = "users";
                                 }
                              })

                              if(deleteuser.status == "success"){

                                setTimeout(function(){

                                   window.location = "users";
                                },1500);

                              }

                     }

                   })
         }
       })

}
</script>
<?php }?>
