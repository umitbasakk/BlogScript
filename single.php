<?php
@session_start();
@ob_start();
define("guvenlik",true);
require_once'functions/db.php';

@$referer = $_SERVER['HTTP_REFERER'];

if ($referer == "")
{
header("Location:/home");
}else{
include("pages/header.php");

 ?>


   <div class="container">

     <div class="row">

       <div class="col-lg-12">

         <?php

           $url = $_GET["url"];


           $select = $db->prepare("SELECT * FROM articles WHERE url=? and statu=?");
           $select->execute(array($url,1));
           $result = $select->fetch(PDO::FETCH_ASSOC);


           if($select->rowCount()){



          ?>
          <div style="margin-bottom:20px;" style="margin-top:230px;"  class="card mb-4 mt-4">
            <div class="card-body">

         <h1 class="mt-4"><?php echo $result['title']; ?></h1>


       </div>
     </div>
         <div style="margin-bottom:20px;padding-top:15px;"   class="card">
           <div class="card-body icons">
                  <p class="lead">
                    <svg class="bi bi-pen"   width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391L10.086 2.5a2 2 0 012.828 0l.586.586a2 2 0 010 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 011.414 0l.586.586a1 1 0 010 1.414L5 13l-3 1 1-3z" clip-rule="evenodd"/>
    <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 00-.708 0L5.854 5.855a.5.5 0 01-.708-.708L8.44 1.854a1.5 1.5 0 012.122 0l.293.292a.5.5 0 01-.707.708l-.293-.293z" clip-rule="evenodd"/>
    <path d="M13.293 1.207a1 1 0 011.414 0l.03.03a1 1 0 01.03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
  </svg>

                    <a href="" ><?php echo $result["author"]; ?></a>
                    <svg class="bi bi-x-diamond" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 010-2.098L6.95.435zm1.4.7a.495.495 0 00-.7 0L1.134 7.65a.495.495 0 000 .7l6.516 6.516a.495.495 0 00.7 0l6.516-6.516a.495.495 0 000-.7L8.35 1.134z" clip-rule="evenodd"/>
    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
  </svg>
                    <a href="/blog/category/<?php echo $result["category"]; ?>" target="_blank"><?php echo $result["category"]; ?></a>
                    <svg class="bi bi-alarm"  width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8 15A6 6 0 108 3a6 6 0 000 12zm0 1A7 7 0 108 2a7 7 0 000 14z" clip-rule="evenodd"/>
<path fill-rule="evenodd" d="M8 4.5a.5.5 0 01.5.5v4a.5.5 0 01-.053.224l-1.5 3a.5.5 0 11-.894-.448L7.5 8.882V5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
<path d="M.86 5.387A2.5 2.5 0 114.387 1.86 8.035 8.035 0 00.86 5.387zM11.613 1.86a2.5 2.5 0 113.527 3.527 8.035 8.035 0 00-3.527-3.527z"/>
<path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 01.708 0l1 1a.5.5 0 01-.708.708l-1-1a.5.5 0 010-.708zm-7.292 0a.5.5 0 00-.708 0l-1 1a.5.5 0 00.708.708l1-1a.5.5 0 000-.708zM5.5.5A.5.5 0 016 0h4a.5.5 0 010 1H6a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
<path d="M7 1h2v2H7V1z"/>
</svg>
                    <a href=""><?php echo timeConvert($result["time"]); ?>  Yayınlandı</a>

                  </p>


       </div>
     </div>

 <div class="card">
   <div class="card-body">
         <img class="img-fluid rounded photo" src="<?php echo $result["photo"]; ?>" alt="">

         <hr>

         <p class="lead"><?php echo $result["text"]; ?></p>

         <hr>

       </div>
     </div>




       <?php } ?>

         <?php   if(!isset($_SESSION["oturum"])){ ?>
           <div class="alert alert-danger my-4" role="alert">
           Yorum yapabilmek için giriş yapmanız gerekmektedir.
           </div>

      <?php  } else { ?>



             <div class="card my-4">
           <h5 class="card-header">Yorum Yap:</h5>
           <div class="card-body">
             <form>
               <div class="form-group">
                <label for="formGroupExampleInput">Adınz</label>
                 <input type="text" class="form-control" id="name" value="<?php echo $namez; ?>" placeholder="Example input" readonly>
                  </div>
               <div class="form-group">
                 <label for="formGroupExampleInput">Mesajınız</label>

                 <textarea class="form-control" rows="3" id="CommentText"></textarea>
                 <input type="hidden" id="url" value="<?php echo $url ?>"></input
               </div>
               <button id="CommentSubmit" style="float:right;margin-top:10px;" type="button" class="btn btn-primary commentsubmit">Submit</button>
             </form>
           </div>
         </div>


       <?php } ?>



             </div>
             <?php

             $selects = $db->prepare("SELECT * FROM comments WHERE comment_statu=? and article_url=?");
             $selects->execute(array(1,$url));

                if($selects->rowCount()){

                foreach ($selects as $res) {
              ?>

              <div class="container">

            <div class="card my-4">
              <h5 class="card-header"><?php echo $res["comment_name"]; ?></h5>
                  <div class="card-body">

                       <div class="media-body" >
                        <h5 class="mt-0"></h5>
                        <p><?php echo $res["comment"];  ?></p>
                      </div>
                   </div>
                </div>
              </div>
              <?php
            }
           }?>



           </div>
         </div>

       </div>



     </div>

   </div>
   <?php include("pages/footer.php"); ?>

   <script>

  $(document).ready(function(){
    $("#CommentSubmit").click(function(){

           var url = $("#url").val();
           var text = $("#CommentText").val();

           var Data = "comments="+url+"&url="+url+"&text="+text;

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

             }
           })

    })
  })

   </script>
 <?php } ?>
