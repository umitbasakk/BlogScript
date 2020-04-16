<?php
if(!defined ('guvenlik')){

    Header("Location:/");
} else{



 ?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="TR"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/bootstrap.css"></link>
    <link rel="stylesheet" href="<?php echo $site_url; ?>css/style.css"></link>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="og:title" property="og:title" content="<?php echo $title; ?>">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

  </head>
  <body>
    <style>
body{
background:#f5f8fa
}
@media (min-width: 1200px) { .container {
    max-width: 1200px;
} }
</style>
<style type="text/css">
    body {
  color: #343a40;
   background: #f5f5f5;
   font-family: 'Varela Round', sans-serif;
   font-size: 13px;
   min-height: 100%;
 }
 .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
 .table-title {
   padding-bottom: 15px;
   background: #fff;
   color: black;
   padding: 16px 30px;
   margin: -20px -25px 10px;
    }
    .table-title h2 {
   margin: 5px 0 0;
   font-size: 24px;
 }
 .table-title .btn-group {
   float: right;
 }
 .table-title .btn {
   color: #fff;
   float: right;
   font-size: 13px;
   border: none;
   min-width: 50px;
   border-radius: 2px;
   border: none;
   outline: none !important;
   margin-left: 10px;
 }
 .table-title .btn i {
   float: left;
   font-size: 21px;
   margin-right: 5px;
 }
 .table-title .btn span {
   float: left;
   margin-top: 2px;
 }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
   padding: 12px 15px;
   vertical-align: middle;
    }
 table.table tr th:first-child {
   width: 60px;
 }
 table.table tr th:last-child {
   width: 100px;
 }
    table.table-striped tbody tr:nth-of-type(odd) {
     background-color: #fcfcfc;
 }
 table.table-striped.table-hover tbody tr:hover {
   background: #f5f5f5;
 }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child i {
   opacity: 0.9;
   font-size: 22px;
        margin: 0 5px;
    }
 table.table td a {
   font-weight: bold;
   color: #566787;
   display: inline-block;
   text-decoration: none;
   outline: none !important;
 }
 table.table td a:hover {
   color: #2196F3;
 }
 table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
 table.table .avatar {
   border-radius: 50%;
   vertical-align: middle;
   margin-right: 10px;
 }
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {
        background: #0397d6;
    }
 .pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
 /* Custom checkbox */
 .custom-checkbox {
   position: relative;
 }
 .custom-checkbox input[type="checkbox"] {
   opacity: 0;
   position: absolute;
   margin: 5px 0 0 3px;
   z-index: 9;
 }
 .custom-checkbox label:before{
   width: 18px;
   height: 18px;
 }
 .custom-checkbox label:before {
   content: '';
   margin-right: 10px;
   display: inline-block;
   vertical-align: text-top;
   background: white;
   border: 1px solid #bbb;
   border-radius: 2px;
   box-sizing: border-box;
   z-index: 2;
 }
 .custom-checkbox input[type="checkbox"]:checked + label:after {
   content: '';
   position: absolute;
   left: 6px;
   top: 3px;
   width: 6px;
   height: 11px;
   border: solid #000;
   border-width: 0 3px 3px 0;
   transform: inherit;
   z-index: 3;
   transform: rotateZ(45deg);
 }
 .custom-checkbox input[type="checkbox"]:checked + label:before {
   border-color: #03A9F4;
   background: #03A9F4;
 }
 .custom-checkbox input[type="checkbox"]:checked + label:after {
   border-color: #fff;
 }
 .custom-checkbox input[type="checkbox"]:disabled + label:before {
   color: #b8b8b8;
   cursor: auto;
   box-shadow: none;
   background: #ddd;
 }
 /* Modal styles */
 .modal .modal-dialog {
   max-width: 400px;
 }
 .modal .modal-header, .modal .modal-body, .modal .modal-footer {
   padding: 20px 30px;
 }
 .modal .modal-content {
   border-radius: 3px;
 }
 .modal .modal-footer {
   background: #fff;
   border-radius: 0 0 3px 3px;
 }
    .modal .modal-title {
        display: inline-block;
    }
 .modal .form-control {
   border-radius: 2px;
   box-shadow: none;
   border-color: #dddddd;
 }
 .modal textarea.form-control {
   resize: vertical;
 }
 .modal .btn {
   border-radius: 2px;
   min-width: 100px;
 }
 .modal form label {
   font-weight: normal;
 }
</style>

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
  <a class="navbar-brand" href="<?php echo $site_url; ?>">Ümit Başak</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $site_url; ?>home">Anasayfa </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $site_url; ?>about">Hakkımda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $site_url; ?>contact">İletişim</a>
      </li>


    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?php if($statu == '2'){
          echo'       <a href="'.$site_url.'dashboard/home" class="btn btn-sm btn-info login  btns" style="text-decoration:none;color:white;">Admin Paneli</a></button>';
      } ?>
      <?php   if(!isset($_SESSION["oturum"])){ ?>

        <button class="btn btn-sm btn-info login btns" data-toggle="modal" data-target="#loginModal" type="button">Giriş Yap</button>
        <button class="btn btn-sm btn-info  btns" data-toggle="modal" data-target="#registerModal" type="button">Kayıt Ol</button>
      <?php }else{ ?>
<div class="dropdown">
  <button class="btn btn-sm btn-info login dropdown-toggle btns" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Profilim
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="<?php echo $site_url; ?>profile">Profilim</a>
  </div>
</div>
        <button  id="logout" class="btn btn-sm btn-info login  btns"  type="button">Çıkış Yap</button>

      <?php } ?>



    </form>
  </div>
 </div>
</nav>
<!-- Login Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="forms">
    <div class="form-group">
      <label for="exampleInputEmail1">Email adresiniz</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Parolanız</label>
      <input type="password" class="form-control" id="password" >
    </div>

     </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary devami" data-dismiss="modal">Kapat</button>
        <button id="login" type="button" class="btn btn-primary devami">Giriş Yap</button>
      </div>
    </div>
  </div>
</div>


<!-- Register Modal -->

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="forms">
        <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adınız</label>
          <input type="email" class="form-control" id="username" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email Adresiniz</label>
          <input type="email" class="form-control" id="emails" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Adınız</label>
          <input type="email" class="form-control" id="name" aria-describedby="emailHelp" >
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Soyadınız</label>
          <input type="email" class="form-control" id="surname" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Telefon Numaranız</label>
          <input type="numeric" class="form-control" id="telephone" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Parolanız</label>
          <input type="password" class="form-control" id="sifre">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Parolanız</label>
          <input type="password" class="form-control" id="sifre2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary devami" data-dismiss="modal">Kapat</button>
          <button type="button" id="register" class="btn btn-primary devami">Kayıt Ol</button>
        </div>
      </div>





     </form>


    </div>
  </div>
</div>
<?php } ?>
