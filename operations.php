<?php
@session_start();
@ob_start();
require_once("functions/db.php");

@$referer = $_SERVER['HTTP_REFERER'];

if ($referer == "")
{
header("Location:home");
}

else
{

if(isset($_POST["userlogin"])){

     $email = $_POST["email"];
     $password = md5(sha1($_POST["password"]));


    if($email == '' || $password == ''){

     $data["status"] = "error";
     $data["message"] = "Boş Alan Bırakmayınız";
     echo json_encode($data);

  }else{
    $select = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
    $select->execute(array($email,$password));



    if($select->rowCount()){

      $_SESSION["oturum"] = $_POST["email"];

      $data["status"] = "success";
      $data["message"] = "Başarıyla Giriş Yaptınız";
      echo json_encode($data);



    }else{
      $data["status"] = "error";
      $data["message"] = "Kullanıcı Adınız veya Şifreniz Yanlış";
      echo json_encode($data);

    }
  }

}else if(isset($_POST["userRegister"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $surname = $_POST["surname"];
  $username = $_POST["username"];
  $password2 = md5(sha1($_POST["password2"]));
  $password = md5(sha1($_POST["password"]));



     if($name == "" || $username == "" || $email == "" || $telephone == "" || $surname == "" || $password2 == "" || $password == ""){

            $data["status"] = "error";
            $data["message"] = "Boş Alan Bırakmayınız";
            echo json_encode($data);

     }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $data["status"] = "error";
       $data["message"] = "Email formatınızı kontrol edin";
       echo json_encode($data);


     }else if(!intval($telephone)){

       $data["status"] = "error";
       $data["message"] = "Numaranızı Lütfen Sayı Olarak Giriniz.";
       echo json_encode($data);

     }else if(strlen($telephone) != 10){

       $data["status"] = "error";
       $data["message"] = "Numaranızı Lütfen Başında 0 Olmadan 11 Haneli Giriniz.";
       echo json_encode($data);

     }else if($password != $password2){

       $data["status"] = "error";
       $data["message"] = "Şifreleriniz uyuşmamaktadır.";
       echo json_encode($data);

     }else if(strlen($password) <=6){

       $data["status"] = "error";
       $data["message"] = "Şifreniz 6 Karakterden Fazla Olmalıdır.";
       echo json_encode($data);


     }else if($username){

       $select = $db->prepare("SELECT * FROM users WHERE username=?");
       $select->execute(array($username));

       $select2 = $db->prepare("SELECT * FROM users WHERE email=?");
       $select2->execute(array($email));

             if($select->rowCount()){
               $data["status"] = "error";
               $data["message"] =  $username .  " kullanıcı adı başkası tarafından kullanılmaktadır.";
               echo json_encode($data);

             }else if($select2->rowCount()){
               $data["status"] = "error";
               $data["message"] =  $email . " email başkası tarafından kullanılmaktadır.";
               echo json_encode($data);
             }else{



               $save = $db->prepare("INSERT INTO users SET name=?,username=?,email=?,telephone=?,surname=?,password=?,statu=?");
               $save->execute(array($name,$username,$email,$telephone,$surname,$password,0));

               if($save->rowCount()){



                 $_SESSION["oturum"] = $_POST["email"];

                 $data["status"] = "success";
                 $data["message"] =  "Başarıyla Kayıt Oldunuz";
                 echo json_encode($data);

           }



     }


     }




}else if(isset($_POST["update"])){

  $ProfileName      =     $_POST["ProfileName"];
  $ProfileEmail    =     $_POST["ProfileEmail"];
  $ProfileSurname  =     $_POST["ProfileSurname"];



         if($ProfileName == "" || $ProfileEmail == "" || $ProfileSurname == ""){
           $data["icon"] = "error";
           $data["title"] = $id;
           echo json_encode($data);

         }else {

           $update = $db->prepare("UPDATE users SET name=?, email=?,surname=? WHERE id=?");
           $update->execute(array($ProfileName,$ProfileEmail,$ProfileSurname,$id));

           $_SESSION["oturum"] = $_POST["ProfileEmail"];

             if($update->rowCount()){
               $data["icon"] = "success";
               $data["title"] = "Başarıyla Güncellendi";
               echo json_encode($data);
             }

         }

}else if(isset($_POST["updateps"])){

 $oldpassword = $_POST["oldpassword"];
 $newpassword = md5(sha1($_POST["newpassword"]));
 $newpasswordrepeat = md5(sha1($_POST["newpasswordrepeat"]));
 $idzq = $_POST["idzq"];

  if($oldpassword == "" || $newpassword == "" || $newpasswordrepeat == ""){
    $data["icon"] = "error";
    $data["title"] = "Boş Alan Bırakmayınız";
    echo json_encode($data);
  }else{

           if($newpassword != $newpasswordrepeat){
             $data["icon"] = "error";
             $data["title"] = "Yeni Şifreleriniz Eşleşmiyor.";
             echo json_encode($data);
           }else{
              $select = $db->prepare("SELECT * FROM users WHERE id=?");
              $select->execute(array($idzq));
              $result = $select->fetch(PDO::FETCH_ASSOC);



              if($select->rowCount()){
                 if(md5(sha1($oldpassword)) != $result["password"]){
                   $data["icon"] = "error";
                   $data["title"] = "Eski Parolanız Hatalı";
                   echo json_encode($data);
                 }else{

                  $update = $db->prepare("UPDATE users SET password=? WHERE id=?");
                  $update->execute(array($newpassword,$idzq));


                   if($update->rowCount()){
                     $data["icon"] = "success";
                     $data["title"] = "Başarıyla Güncellendi";
                     echo json_encode($data);
                   }else{
                     $data["icon"] = "error";
                     $data["title"] = "Bir Sorun Oluştu";
                     echo json_encode($data);
                   }


                 }
              }

         }


  }





}else if(isset($_POST["contact"])){




    $name = $_POST["name"];
    $email = $_POST["email"];
    $text = $_POST["text"];


    $save = $db->prepare("INSERT INTO contact SET name=?,email=?,text=?");
    $save->execute(array($name,$email,$text));

      if($name == "" || $email == "" || $text == ""){
        $data["status"] = "error";
        $data["message"] = "Lütfen boş alan bırakmayınız";
        echo json_encode($data);
      }else if($save->rowCount()){

     $data["status"] = "success";
     $data["message"] = "Başarıyla Gönderildi";
     echo json_encode($data);

   }else{

     $data["status"] = "error";
     $data["message"] = "Bir hata oluştu lütfen daha sonra deneyiniz";
     echo json_encode($data);

   }

}else if(isset($_POST["logout"])){
  @session_start();
  @ob_start();
  if(!isset($_SESSION["oturum"])){
      Header("Location:home");
  }else{

        $data["status"] = "success";
        $data["message"] = "Başarıyla Çıkış Yaptınız";
        echo json_encode($data);
        @session_destroy();


  }
}else if(isset($_POST["comments"])){


  $url = $_POST["url"];
  $text = $_POST["text"];



  if($text == ""){

    $data["status"] = "error";
    $data["message"] = "Lütfen boş alan bırakmayınız";
    echo json_encode($data);

  }else{

      $save = $db->prepare("INSERT INTO comments SET article_url=?,comment_email=?, comment=?,comment_name=?");
      $save->execute(array($url,$email,$text,$surname));

      if($save->rowCount()){
        $data["status"] = "success";
        $data["message"] = "Başarıyla Gönderildi.Onaylandıktan Sonra Yayınlanacaktır.";
        echo json_encode($data);

      }else{
        $data["status"] = "error";
        $data["message"] = "Bir Hata Oluştu";
        echo json_encode($data);
      }

  }


}


}
?>
