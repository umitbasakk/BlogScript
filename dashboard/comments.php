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
                  <div class="row">
                      <div class="col-sm-6">
  						<h2>Yorumlar</h2>
  					</div>

                  </div>
              </div>
              <table class="table table-striped table-hover">
                  <thead>
                      <tr>

                          <th>ID</th>
                          <th>Adı</th>
                          <th>Makale Adı</th>
  					            	<th>Statu</th>
                          <th>Durum</th>
                      </tr>
                  </thead>
                  <tbody>
           <?php

              $uss = $db->prepare("SELECT * FROM comments inner join articles on articles.url = comments.article_url");
              $uss->execute();

              if($uss->rowCount()){

                foreach($uss as $arc){


           ?>



  					<tr>

                             <td><?php echo $arc["comment_id"]; ?></td>
                          <td><?php echo $arc["comment_name"]; ?></td>
                          <td><?php echo $arc["title"]; ?></td>
  				  	          	<td><?php if($arc["comment_statu"] == 0){ echo'Onay Bekliyor';}else if($arc["comment_statu"] == 1){ echo'Onaylı';}?></td>
                          <td>
                            <button style="margin-left:-15px;"   id="<?php echo $arc["comment_id"]; ?>" class="btn btn-sm btn-info btns" onClick="detailcom(this.id)"  > Oku</button>
                            <button   id="<?php echo $arc["comment_id"]; ?>" class="btn btn-sm btn-danger btns" onClick="deletecomment(this.id)"  > Sil</button>
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
 function detailcom(idsz){

     var Data = "readcomment="+idsz+"&id="+idsz;

          $.ajax({
             type: "POST",
             url: "details.php",
             data: Data,
             success:function(data){

                        vare = JSON.parse(data);

                        Swal.fire({
                                 title: vare.status,
                                 text: vare.message,
                                 showCancelButton: true,
                                 cancelButtonColor: '#d33',
                                 confirmButtonColor: '#28a745',
                                 confirmButtonText: 'Yorumu Onayla',
                                 cancelButtonText: 'Onay Kaldır'

                               }).then((result) => {
                                 if(result.value){

                                    var Datas = "successcomment="+idsz+"&id="+idsz;

                                    $.ajax({
                                      type:"POST",
                                      url: "details.php",
                                      data: Datas,
                                      success:function(data){

                                                 success = JSON.parse(data);

                                                 Swal.fire({
                                                   icon: success.status,
                                                   title: success.message
                                                 }).then((result) => {
                                                   if(result.value){
                                                        window.location = "comments";
                                                   }
                                                 })

                                                 if(success.status == "success"){

                                                       setTimeout(function(){
                                                          window.location = "comments";
                                                       },1500)

                                                 }

                                      }
                                    })





                                 }else if( result.dismiss === Swal.DismissReason.cancel){

                                   var Datas = "unsuccesscomment="+idsz+"&id="+idsz;

                                   $.ajax({
                                     type:"POST",
                                     url: "details.php",
                                     data: Datas,
                                     success:function(data){

                                                success = JSON.parse(data);

                                                Swal.fire({
                                                  icon: success.status,
                                                  title: success.message
                                                }).then((result) => {
                                                  if(result.value){
                                                    window.location = "comments";

                                                  }
                                                })

                                                if(success.status == "success"){

                                                      setTimeout(function(){
                                                         window.location = "comments";
                                                      },1500)

                                                }

                                     }
                                   })



                                 }
                               })


             }


         })





 }
 </script>

 <script>

        function deletecomment(ids){
                  var deletecomment = ids;

                  var Data = "deletecomment="+deletecomment;

                  Swal.fire({
                    icon: "info",
                    title: "Emin misiniz?",
                    showCancelButton:true,
                    confirmButtonText: "Evet, Sil"
                  }).then((result) => {
                    if(result.value){

                             $.ajax({
                               type: "POST",
                               url: "details.php",
                               data: Data,
                               success: function(data){
                                               veri = JSON.parse(data);

                                               Swal.fire({
                                                 icon: veri.icon,
                                                 title: veri.title
                                               }).then((result) => {
                                                   if(result.value){
                                                     window.location = "comments";
                                                   }
                                               })

                                               if(veri.icon == "success"){
                                                 setTimeout(function(){
                                                   window.location = "comments";
                                                 },1333);
                                               }
                               }
                             })
                    }
                  })




        }



 </script>

<?php }?>
