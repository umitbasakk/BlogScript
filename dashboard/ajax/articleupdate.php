<?php
require_once '../../functions/db.php';



           $id = $_POST["ids"];
           $title = $_POST["title"];
           $photo = $_POST["photo"];
           $text = $_POST["text"];
           $author = $_POST["author"];
           $statu = $_POST["statu"];
           $category = $_POST["category"];
           $urls = seo($title);

            $up = $db->prepare("UPDATE articles SET photo=?, title=?, text=?, url=?, category=?, author=?, statu=? WHERE id=?");
            $up->execute(array($photo,$title,$text,$urls,$category,$author,$statu,$id));

        if($up->rowCount()){
          $data["status"] = "success";
          $data["message"] = "Başarılı";
          echo json_encode($data);
        }else{

          $data["status"] = "error";
          $data["message"] = "Hata";
          echo json_encode($data);

        }






 ?>
