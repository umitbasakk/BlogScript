<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>İnstall</title>
  </head>

  <link rel="stylesheet" href="../css/bootstrap.css"></link>
  <link rel="stylesheet" href="../css/bootstrap.min.css"></link>


  <body>




<div class="container">
  <div class="row">

        <div class="card mt-4 mt-4 mt-4" style="width: 25rem;margin-left:auto;margin-right:auto;">
          <div = class= "card-body">
             <h3>Mysql Bağlantısı</h3>
             <hr>

            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Host</label>
                <input type="text" class="form-control" id="databasehost" aria-describedby="emailHelp" value="localhost">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Veritabanı Adı</label>
                <input type="text" class="form-control" id="databasedbname" aria-describedby="emailHelp" >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Veritabanı Kullanıcı Adı</label>
                <input type="text" class="form-control" id="databaseusername" >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Veritabanı Şifre</label>
                <input type="text" class="form-control" id="databasepassword" >
              </div>
              <hr>
               <h3>Yönetici Bilgileri ve Site Ayarları</h3>
               <hr>
               <div class="form-group">
                 <label for="exampleInputPassword1">Site adresi (Sonuna / Koyunuz.Locahost için http://localhost:port/blog/)</label>
                 <input type="text" class="form-control" id="site_url" >
               </div>

               <div class="form-group">
                 <label for="exampleInputPassword1">Email</label>
                 <input type="text" class="form-control" id="email" >
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Şifre</label>
                 <input type="password" class="form-control" id="password" >
               </div>


              <button type="button" id="db" style="float:right;" class="btn btn-primary  login btns">Kurulumu Çalıştır</button>
            </form>

  </div>
  </div>

  </div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://umitbasak.com/js/sweetalert.js"></script>
    <script>
      $(document).ready(function(){
        $("#db").click(function(){

          var email = $("#email").val();
          var passwords = $("#password").val();

          var databasehost = $("#databasehost").val();
          var databasedbname = $("#databasedbname").val();
          var databaseusername = $("#databaseusername").val();
          var databasepassword = $("#databasepassword").val();
          var site_url = $("#site_url").val();

          var Data = "install="+databasehost+"&email="+email+"&passwords="+passwords+"&databasehost="+databasehost+"&databasedbname="+databasedbname+"&databaseusername="+databaseusername+"&databasepassword="+databasepassword+"&site_url="+site_url;

          $.ajax({
            type: "POST",
            url: "install2.php",
            data: Data,
            success: function(data){

                           veriler = JSON.parse(data);

                           Swal.fire({
                             icon: veriler.icon,
                             title:veriler.message
                           }).then((result) => {
                               if(result.value){
                                   window.location = "/";
                               }
                           })

                           if(veriler.icon == "success"){

                               setTimeout(function(){
                                   window.location = site_url ;
                               },1330);
                           }
            }

          })

        })
      })
    </script>

  </body>
</html>
