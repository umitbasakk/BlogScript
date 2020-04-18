<?php

if(isset($_POST["install"])){


   $email = $_POST["email"];
   $passwords = $_POST["passwords"];

   $databasehost = $_POST["databasehost"];
   $databasedbname = $_POST["databasedbname"];
   $databaseusername = $_POST["databaseusername"];
   $databasepassword = $_POST["databasepassword"];
   $site_url = $_POST["site_url"];


   if($email == "" || $passwords == "" || $databasehost== "" || $databasedbname == "" || $site_url == "" ){
     $data["icon"] = "error";
     $data["message"] =  "Boş Alan Bırakmayınız";
     echo json_encode($data);
   }else{

        try{

          $conn = new PDO("mysql:host=$databasehost;dbname=$databasedbname;",$databaseusername,$databasepassword);

          if($conn){



           $create = "CREATE DATABASE IF NOT EXISTS  $databasedbname";


           $conn->exec($create);
           $conn = new PDO("mysql:host=$databasehost;dbname=$databasedbname;",$databaseusername,$databasepassword);
           $conn->exec("SET NAMES utf-8");

           $users = "CREATE TABLE IF NOT EXISTS users (
                          id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(30) NOT NULL ,
                          surname VARCHAR(30) NOT NULL ,
                          username VARCHAR(50) NOT NULL ,
                          telephone VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          statu INT(11) NOT NULL  DEFAULT '0',
                          password VARCHAR(255) NOT NULL,
                          time timestamp NOT NULL DEFAULT NOW()

                        ) CHARACTER SET utf8 COLLATE utf8_turkish_ci";

                          $conn->exec($users);

                        if($users){

                            $save = $conn->prepare("INSERT INTO users SET name=?,surname=?,username=?,telephone=?,email=?,password=?,statu=?");
                            $save->execute(array("Admin","Admin","","",$email,md5(sha1($passwords)),2));
                        }


        $category = "CREATE TABLE IF NOT EXISTS category(
                 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                 category_name VARCHAR(255) NOT NULL
        )";

        $conn->exec($category);

        if($category){
                   $save = $conn->prepare("INSERT INTO category SET category_name=?");
                   $save->execute(array("teknoloji"));
        }






        $settings = "CREATE TABLE IF NOT EXISTS settings(
                  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  about text NOT NULL,
                  site_title VARCHAR(255) NOT NULL,
                  description VARCHAR(255) NOT NULL,
                  site_url VARCHAR(255) NOT NULL
        )  CHARACTER SET utf8 COLLATE utf8_turkish_ci";

        $conn->exec($settings);

        if($settings){
          $save = $conn->prepare("INSERT INTO settings SET about=?,site_title=?,description=?,site_url=?");
          $save->execute(array("Merhabalar,Ben Ümit.2001 Bağcılar Doğumluyum.Şuan aktif olarak Rumeli Üniversitesinde öğrencilik yapıyorum :) uzun zamandan beri bir blog açmayı düşünüyordum lakin script yazmaya üşeniyordum kısmet bugüneymiş. Blogu açmam’da vesile Fatih hocama burdan teşekkürlerime sunuyorum.Esen kalın","","",$site_url));
        }

        $contact = "CREATE TABLE IF NOT EXISTS contact(
                   id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                   name  VARCHAR(255) NOT NULL,
                   email VARCHAR(255) NOT NULL,
                   text text NOT NULL,
                   statu INT(11) NOT NULL  DEFAULT '0',
                   time timestamp NOT NULL DEFAULT NOW()

        )";

        $conn->exec($contact);

        $comments = "CREATE TABLE IF NOT EXISTS comments(
                 comment_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                 article_url VARCHAR(255) NOT NULL,
                 comment_name VARCHAR(255) NOT NULL,
                 comment_email VARCHAR(255) NOT NULL,
                 comment text NOT NULL,
                 comment_statu INT(11) NOT NULL  DEFAULT '0',
                 time timestamp NOT NULL DEFAULT NOW()
        )  CHARACTER SET utf8 COLLATE utf8_turkish_ci";

        $conn->exec($comments);

        if($comments){
                     $save = $conn->prepare("INSERT INTO comments SET article_url=?,commant_name=?,comment_email=?,comment=?,comment_statu=?");
                     $save->execute(array("lorem-ipsum","Admin","deneme@gmail.com","çok güzel yazı olmuş",1));
        }

        $article = "CREATE TABLE IF NOT EXISTS articles(
             id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             photo VARCHAR(255) NOT NULL,
             title VARCHAR(255) NOT NULL,
             text text NOT NULL,
             url VARCHAR(255) NOT NULL,
             category VARCHAR(255) NOT NULL,
             author  VARCHAR(255) NOT NULL,
             statu INT(11) NOT NULL DEFAULT '0',
             time timestamp NOT NULL DEFAULT NOW()
        )  CHARACTER SET utf8 COLLATE utf8_turkish_ci";

        $conn->exec($article);

        if($article){
               $save = $conn->prepare("INSERT INTO articles SET photo=?,title=?,text=?,url=?,category=?,author=?,statu=?");
               $save->execute(array("https://fintechistanbul.org/wp-content/uploads/2016/09/blog.jpg","Bloguma hoş geldiniz","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","bloguma-hos-geldiniz","teknoloji","Admin","1"));

               $save = $conn->prepare("INSERT INTO articles SET photo=?,title=?,text=?,url=?,category=?,author=?,statu=?");
               $save->execute(array("https://fintechistanbul.org/wp-content/uploads/2016/09/blog.jpg","Lorem İpsum","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","lorem-ipsum","teknoloji","Admin","1"));

               $save = $conn->prepare("INSERT INTO articles SET photo=?,title=?,text=?,url=?,category=?,author=?,statu=?");
               $save->execute(array("https://fintechistanbul.org/wp-content/uploads/2016/09/blog.jpg","Lorem İpsum 1","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","lorem-ipsum-1","teknoloji","Admin","1"));

               $save = $conn->prepare("INSERT INTO articles SET photo=?,title=?,text=?,url=?,category=?,author=?,statu=?");
               $save->execute(array("https://fintechistanbul.org/wp-content/uploads/2016/09/blog.jpg","Lorem İpsum 2","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","lorem-ipsum-2","teknoloji","Admin","1"));

               $save = $conn->prepare("INSERT INTO articles SET photo=?,title=?,text=?,url=?,category=?,author=?,statu=?");
               $save->execute(array("https://fintechistanbul.org/wp-content/uploads/2016/09/blog.jpg","Lorem İpsum 3","There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.","lorem-ipsum-3","teknoloji","Admin","1"));
        }

        if($article){
                    $baglan = touch("../functions/db.php");

                    if($baglan){
                      $ac = fopen("../functions/db.php",'w');
                      $icerik = '
                      <?php
                      @session_start();
                      @ob_start();
                      try{
                      $db = new PDO("mysql:host='.$databasehost.';dbname='.$databasedbname.';","'.$databaseusername.'","'.$databasepassword.'");
                      $db->exec("SET NAMES utf-8");
                      }catch(PDOException $e){
                      print $e->getMessage();
                      }

                      include("functions.php");

                      ?>';






                      $kaydet = fwrite($ac,$icerik);

                      if($kaydet){
                          $delete1 = unlink("install.php");
                          $delete2 = unlink("install2.php");

                          $data["icon"] = "success";
                          $data["message"] =  "Başarıyla Kurulum Gerçekleşti.";
                          echo json_encode($data);

                      }



                    }
        }


          }
        }catch(PDOException $e){
          $data["icon"] = "error";
          $data["message"] =  "Veritabanına Bağlanılamadı";
          echo json_encode($data);
        }







   }



}



?>
