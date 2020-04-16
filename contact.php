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
         <h1 class="mt-4">İletişim</h1>
 </div>
</div>


<div class="card  mb-4 mt-4">
  <div class="card-body">
         <form>

           <div class="form-group">
             <label for="exampleFormControlInput1">Email Adresiniz</label>
             <input type="email" id="ContactEmail" class="form-control" >
           </div>

           <div class="form-group ">
             <label for="exampleFormControlInput1">Adınız</label>
             <input type="name" id="ContactName" class="form-control" >
           </div>
           <div class="form-group">
             <label for="exampleFormControlTextarea1">Mesajınız</label>
             <textarea class="form-control" id="text" rows="3"></textarea>
           </div>
           <button  id="contacts" type="button" class="btn btn-primary devami">Gönder</button>

         </form>
       </div>
      </div>
       </div>



     </div>

   </div>
   <?php include("pages/footer.php"); ?>

   <script>
   $("#contacts").click(function(){

          var email = $("#ContactEmail").val();
          var name = $("#ContactName").val();
          var text = $("#text").val();

          var Data = "contact="+name+"&name="+name+"&email="+email+"&text="+text;

          $.ajax({
            type: "POST",
            url: "<?php echo $site_url; ?>operations.php",
            data: Data,
            success:function(data){

                  veri = JSON.parse(data);

                  Swal.fire({
                    icon: veri.status,
                    title: veri.message
                  })

                  if(veri.status == "success"){

                    $("#ContactEmail").val("");
                    $("#ContactName").val("");
                    $("#text").val("");

                  }

            }
          })

   })
   </script>
