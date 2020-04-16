<?php
require_once("../../functions/db.php");


if(isset($_POST["arcticledelete"])){
  $idsq = $_POST["idq"];


  $delete= $db->prepare("DELETE FROM articles WHERE id=?");
  $delete->execute(array($idsq));

  if($delete->rowCount()){
    $data["status"] = "success";
    $data["message"] = "Başarıyla Silindi";
    echo json_encode($data);

  }

}




?>
