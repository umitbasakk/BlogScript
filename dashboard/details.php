<?php
@session_start();
@ob_start();
require_once'../functions/db.php';

@$referer = $_SERVER['HTTP_REFERER'];

if ($referer == "")
{
header("Location:home");
}

else
{
if(isset($_POST["useradd"])){


             $statu = $_POST["statu"];
             $name = $_POST["name"];
             $email = $_POST["emailsq"];
             $telephone = $_POST["telephone"];
             $surname = $_POST["surname"];
             $username = $_POST["username"];
             $password2 = md5(sha1($_POST["password2"]));
             $password = md5(sha1($_POST["password"]));

             $save = $db->prepare("INSERT INTO users SET name=?,username=?,email=?,telephone=?,surname=?,password=?,statu=?");
             $save->execute(array($name,$username,$email,$telephone,$surname,$password,$statu));

             if($save->rowCount()){

               $data["status"] = "success";
               $data["message"] =  "Başarıyla kayıt gerçekleştirdiniz.";
               echo json_encode($data);

             }


}else if(isset($_POST["catadd"])){


      $category = $_POST["category"];

      if($category  == ""){
        $data["status"] = "error";
        $data["message"] = "Lütfen kategori adını giriniz";
        echo json_encode($data);
      }else{
        $save  = $db->prepare("INSERT INTO category SET category_name=?");
        $save->execute(array($category));

        if($save->rowCount()){
            $data["status"] = "success";
            $data["message"] = "Başarıyla Eklendi";
            echo json_encode($data);
        }
      }




}else if(isset($_POST["catup"])){

      $idz = $_POST["id"];
      $category = $_POST["catup"];

      if($category  == ""){
        $data["status"] = "error";
        $data["message"] = "Lütfen kategori adını giriniz";
        echo json_encode($data);
      }else{
        $save  = $db->prepare("UPDATE category SET category_name=? WHERE  id=?");
        $save->execute(array($category,$idz));

        if($save->rowCount()){
            $data["status"] = "success";
            $data["message"] = "Başarıyla Güncellendi";
            echo json_encode($data);
        }
      }




}else if(isset($_POST["catdelete"])){

      $ids = $_POST["idq"];

      $delete  = $db->prepare("DELETE FROM category WHERE id=?");
      $delete->execute(array($ids));

      if($delete->rowCount()){
          $data["status"] = "success";
          $data["message"] = "Başarıyla Silindi";
          echo json_encode($data);
      }


}else if(isset($_POST["deletecon"])){

     $id = $_POST["id"];

     $delete = $db->prepare("DELETE FROM contact WHERE id=?");
     $delete->execute(array($id));

     if($delete->rowCount()){

          $data["status"] = "success";
        $data["message"] = "Başarıyla Silindi";
        echo json_encode($data);

     }

}else if(isset($_POST["readcomment"])){


    $id = $_POST["id"];

    $select = $db->prepare("SELECT * FROM comments WHERE comment_id=?");
    $select->execute(array($id));
    $res = $select->fetch(PDO::FETCH_ASSOC);

      $nmq = $res["comment_name"];
      $text = $res["comment"];
      $stat = $res["statu"];


    if($select->rowCount()){
      $data["status"] =  $nmq;
      $data["message"] =   $text;
      $data["statu"] = $statu;
      echo json_encode($data);
    }








}else if(isset($_POST["successcomment"])){

  $id = $_POST["id"];

  $successcomment = $db->prepare("UPDATE comments SET comment_statu=? WHERE  comment_id=?");
  $successcomment->execute(array(1,$id));

  if($successcomment->rowCount()){
    $data["status"] =  "success";
    $data["message"] =  "Başarıyla Onaylandı";
    echo json_encode($data);
  }else{

    $data["status"] =  "error";
    $data["message"] =  "Bir Sorun Oluştu veya yorum zaten onaylı";
    echo json_encode($data);

  }


}else if(isset($_POST["unsuccesscomment"])){

  $id = $_POST["id"];

  $successcomment = $db->prepare("UPDATE comments SET comment_statu=? WHERE  comment_id=?");
  $successcomment->execute(array(0,$id));

  if($successcomment->rowCount()){
    $data["status"] =  "success";
    $data["message"] =  "Başarıyla yorum Kaldırıldı";
    echo json_encode($data);
  }else{

    $data["status"] =  "error";
    $data["message"] =  "Bir Sorun Oluştu veya yorum onaysız";
    echo json_encode($data);

  }


}elseif(isset($_POST["updateuser"])){



      $id = $_POST["id"];

     $email = $_POST["email"];
     $username = $_POST["username"];
     $statu = $_POST["statu"];
     $telephone= $_POST["telephone"];
     $name = $_POST["name"];
     $surname = $_POST["surname"];


     $update = $db->prepare("UPDATE users SET email=?,username=?,statu=?,telephone=?,name=?,surname=? WHERE id=?");
     $update->execute(array($email,$username,$statu,$telephone,$name,$surname,$id));

     if($update->rowCount()){
       $data["status"] = "success";
       $data["message"] = "Başarıyla Güncellendi";
       echo json_encode($data);
     }else{
       $data["status"] = "error";
       $data["message"] = "Bir sorun oluştu ya da aynı bilgileri güncellemeye çalışıyorsunuz.";
       echo json_encode($data);

     }



}else if(isset($_POST["deleteuser"])){

  $idq = $_POST["id"];


  $delete = $db->prepare("DELETE FROM users WHERE id=?");
  $delete->execute(array($idq));

  if($delete->rowCount()){

      $data["status"] = "success";
      $data["message"] = "Başarıyla Silindi";
      echo json_encode($data);
  }

}else if(isset($_POST["deletecomment"])){

             $deletecomment = $_POST["deletecomment"];

          $delete = $db->prepare("DELETE FROM comments WHERE comment_id=?");
          $delete->execute(array($deletecomment));

          if($delete->rowCount()){
            $data["icon"] = "success";
            $data["title"] = "Başarıyla Silindi";
            echo json_encode($data);
          }else{
            $data["icon"] = "error";
            $data["title"] = "Bir Sorun Oluştu";
            echo json_encode($data);
          }


}else{



  $id = $_POST["id"];

   $select = $db->prepare("SELECT * FROM contact WHERE id=?");
   $select->execute(array($id));
   $result = $select->fetch(PDO::FETCH_ASSOC);

   $message = $result["text"];
   $emails = $result["email"];




   if($select->rowCount()){

       $update = $db->prepare("UPDATE contact SET statu=? WHERE id=?");
       $update->execute(array(1,$id));

       if($update->rowCount()){
        $data["te"] = $message;
        $data["message"] = $emails;
        echo json_encode($data);
       }

             $data["te"] = $message;
             $data["message"] = $emails;
             echo json_encode($data);




   }else{
        $data["status"] = "success";
        $data["message"] = "n";
        echo json_encode($data);
   }
}

 ?>

<?php } ?>
