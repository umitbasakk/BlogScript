<?php
require_once '../../functions/db.php';


         $title = $_POST["title"];
         $url = $_POST["url"];
         $description = $_POST["description"];
         $about = $_POST["about"];


         $up = $db->prepare("UPDATE settings SET site_title=?,site_url=?,description=?,about=? WHERE id=?");
         $up->execute(array($title,$url,$description,$about,1));

         if($up->rowCount()){

             $data["status"] = "success";
             $data["message"] = "Başarıyla Güncellendi";
             echo json_encode($data);

         }


 ?>
