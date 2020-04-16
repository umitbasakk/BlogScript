<?php




if(isset($_SESSION["oturum"])){

    $sez = $db->prepare("SELECT * FROM users WHERE email=?");
    $sez->execute(array($_SESSION["oturum"]));
    $seze = $sez->fetch(PDO::FETCH_ASSOC);

    if($sez->rowCount()){
      $id = $seze["id"];
      $namez = $seze["name"];
      $surname = $seze["surname"];
      $email = $seze["email"];
      $statu = $seze["statu"];


              if($statu == '2'){

                      $sec = $db->prepare("SELECT * FROM articles");
                      $sec->execute();
                      $secs =  $sec->rowCount();

                      $users = $db->prepare("SELECT * FROM users");
                      $users->execute();
                      $user = $users->rowCount();

                      $comment = $db->prepare("SELECT * FROM comments WHERE comment_statu=?");
                      $comment->execute(array(1));
                      $comm = $comment->rowCount();

                      $contact = $db->prepare("SELECT * FROM contact WHERE statu=?");
                      $contact->execute(array(0));
                      $conn = $contact->rowCount();

              }
       }

    }


  $select = $db->prepare("SELECT * FROM settings WHERE id=?");
  $select->execute(array(1));
  $result = $select->fetch(PDO::FETCH_ASSOC);

  if($select->rowCount()){
    $title = $result["site_title"];
    $description = $result["description"];
    $site_url = $result["site_url"];
    $about = $result["about"];
  }



  function seo($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
 $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
 $s = str_replace($tr,$eng,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
}

function timeConvert ( $zaman ){
$zaman =  strtotime($zaman);
$zaman_farki = time() - $zaman;
$saniye = $zaman_farki;
$dakika = round($zaman_farki/60);
$saat = round($zaman_farki/3600);
$gun = round($zaman_farki/86400);
$hafta = round($zaman_farki/604800);
$ay = round($zaman_farki/2419200);
$yil = round($zaman_farki/29030400);
if( $saniye < 60 ){
 if ($saniye == 0){
   return "az önce";
 } else {
   return $saniye .' saniye önce';
 }
} else if ( $dakika < 60 ){
 return $dakika .' dakika önce';
} else if ( $saat < 24 ){
 return $saat.' saat önce';
} else if ( $gun < 7 ){
 return $gun .' gün önce';
} else if ( $hafta < 4 ){
 return $hafta.' hafta önce';
} else if ( $ay < 12 ){
 return $ay .' ay önce';
} else {
 return $yil.' yıl önce';
}
}

?>
