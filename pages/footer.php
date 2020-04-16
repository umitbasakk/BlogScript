<div class="footer">
  <div class="container">
   <div class="row">

    <div class="col-sm">
     <h5>Haber Bülteni</h5>
       <div class="input-group mb-3">
         <input type="text" class="form-control" value=" <?php if(isset($_SESSION["oturum"])){ echo $email;}else{ echo'Email Adresiniz'; } ?>" aria-label="" aria-describedby="basic-addon2">
       </div>

       <div class="input-group mb-3">
        <button class="btn btn-sm btn-info login form-control"  style=" margin-left:10px;"data-toggle="modal" id="news" type="button">Kayıt Ol</button>
       </div>
    </div>


    <div class="col-sm linkim">
       <h5>Dahili Bağlantılar</h5>
       <p><a   href="https://www.burakodabas.net">Anasayfa</a></p>
       <p><a   href="http://fatiharikan.com/">Hakkımda</a></p>
       <p><a   href="http://barisozcan.com/">İletişim</a></p>
    </div>


    <div class="col-sm linkim">
       <h5>Harici Bağlantılar</h5>
       <p><a   target="_blank"  href="https://www.burakodabas.net">Burak Odabaş</a></p>
       <p><a   target="_blank"  href="http://fatiharikan.com/">Fatih Arıkan</a></p>
       <p><a   target="_blank"  href="http://barisozcan.com/">Barış Özcan</a></p>
    </div>

   <h4>Copyright 2020 Ümit Başak</h4>

</div>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  <script src="<?php echo $site_url; ?>js/sweetalert.js"></script>
  <script src="<?php echo $site_url; ?>js/loginorregister.js"></script>
  <script src="<?php echo $site_url; ?>js/logout.js"></script>


  <script>

       $(document).ready(function(){

          $("#news").click(function(){
              Swal.fire({
                icon: "info",
                title: "Kısa Sürede Hizmete Alınacaktır"
              })

          })


       })

  </script>



</body>
</html>
