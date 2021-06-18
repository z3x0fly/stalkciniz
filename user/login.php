<?php
require  '../vendor/autoload.php';
include '../backend/engine/database.php';
error_reporting(E_ALL);

ob_start();
session_start();
if (isset($_SESSION['giris']))
{
  header("Location:home.php");

}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Stalkcınız - Giriş Ekranı</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="background"></div>
<div class="sign-in">
  <div class="title">Giriş</div>
  <form class="form" action="home.php" method="post">
    <label class="lbl-text">Kullanıcı adı, telefon ya da mail</label>
    <br>
    <input class="input" type="text" name="username" required>
    <br>
    <label class="lbl-text">Şifre</label>
    <br>
    <input class="input" type="password" name="password" required>

    <div class="btn-area">
      <br>

      <button class="button" name="giris"><input class="signin" type="button" value=" Giriş Yap "></button>

    </div>

  </form>
</div>
<!-- partial -->

</body>
</html>
