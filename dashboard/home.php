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
              <h2>Gelen Kutusu</h2>
            </div>
            <div class="col-sm-6">


            </div>
                  </div>
              </div>
              <table class="table table-striped table-hover">
                  <thead>
                      <tr>

                          <th>Id</th>
                          <th>Ad</th>
                          <th>Email</th>
                          <th>Statu</th>
                          <th>Durum</th>
                      </tr>
                  </thead>
                  <tbody>
           <?php

              $uss = $db->prepare("SELECT * FROM contact");
              $uss->execute();

              if($uss->rowCount()){

                foreach($uss as $con){


           ?>



            <tr>

                          <td><?php echo $con["id"]; ?></td>
                          <td><?php echo $con["name"]; ?></td>
                          <td><?php echo $con["email"]; ?></td>
                          <td><?php if($con["statu"] == 0){ echo'Okunmadı';}else if($con["statu"] == 1){ echo'Okundu';} ?></td>
                          <td>
                            <button style="margin-left:-15px;"   id="<?php echo $con["id"]; ?>" class="btn btn-sm btn-info btns" onClick="detail(this.id)"  > Oku</button>
                            <button   id="<?php echo $con["id"]; ?>" class="btn btn-sm btn-danger btns" onClick="deletecon(this.id)"  > Sil</button>
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

 <script type="text/javascript">

function detail(id){

    var Data = "id="+id;

         $.ajax({
            type: "POST",
            url: "details.php",
            data: Data,
            success:function(data){

                       vare = JSON.parse(data);

                       Swal.fire({
                         title: vare.message,
                         text: vare.te
                       }).then((result)  => {
                         if(result.value){
                               window.location = "";
                         }
                       })


            }


        })





}

function deletecon(id){

     var Data = "deletecon="+id+"&id="+id;

      Swal.fire({
               title: 'Emin Misin?',
               text: "sileceksiniz!",
               icon: 'warning',
               showCancelButton: true,
               cancelButtonColor: '#d33',
               confirmButtonColor: '#28a745',
               confirmButtonText: 'Evet, Sil'
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
                                })

                                if(vari.status == "success"){
                                  setTimeout(function(){
                                     window.location = "";
                                  },1300);
                                }
                    }
                  })
               }


    })






}
</script>
<?php } ?>
