<?php
require_once'../../functions/db.php';

if(isset($_POST["category"]) && isset($_POST["url"]) && isset($_POST["titles"]) && isset($_POST["text"])){

     $category = $_POST["category"];
     $url = $_POST["url"];
     $titles= $_POST["titles"];
     $text = $_POST["text"];
     $author = $_POST["namea"];

     $urls = seo($title);


     if($category == "" && $url == "" || $titles == "" || $text == ""){

       $data["status"] = "error";
       $data["message"] = "Lütfen Boş Alan Bırakmayınız";
       echo json_encode($data);
     }else{

       $save = $db->prepare("INSERT INTO articles SET category=?,photo=?,url=?,title=?,text=?,author=?,statu=?");
       $save->execute(array($category,$url,$urls,$titles,$text,$author,1));

         if($save->rowCount()){
           $data["status"] = "success";
           $data["message"] = "Başarıyla Eklendi";
           echo json_encode($data);

         }

     }


}else{
  Header("Location:$site_url");
}



 ?>
