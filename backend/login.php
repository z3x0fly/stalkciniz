<?php
ob_start();
session_start();
if (isset($_SESSION['id']))
{
    header('location:home.php');
}
if (isset($_GET['forbidden']))
{
    ?>
    <div class="alert alert-danger">
        Direkt Erişim Kapalıdır !!
    </div>
    <?php
    header( "refresh:5;url=login.php" );

}
if ($_POST)
{
    include ('engine/database.php');
    $user = $_POST['usn'];
    $pass = $_POST['pass'];
    $user_sanitize = filter_var($user, FILTER_SANITIZE_STRING);
    $pass_sanitize = filter_var($pass, FILTER_SANITIZE_STRING);
    $pass_enc = md5($pass_sanitize);

    if (!empty($user_sanitize) || !empty($pass_enc))
    {
        $query=$con->prepare("SELECT * FROM admin WHERE usn=? and pass=?");
        $query->execute(array($user_sanitize,$pass_enc));
        $op=$query->fetch();
        if ($op)
        {
            $_SESSION['id'] = $op['id'];
            header('Location:home.php');
        }
        else
        {
            ?>
            <div class="alert alert-danger">
                Kullanıcı adı ve ya şifre hatalı.
            </div>
            <?php

        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>X-Dash | Admin Paneli</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">

    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-image: url('vendor/assets/images/background.jpg');
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
</head>


<body>

<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">

        <div class="panel-body">
            <h3 class="text-center m-t-0 m-b-30">
                <!--span class=""><img src="vendor/assets/images/logo_dark.png" alt="logo" height="32"></span-->
            </h3>
            <h4 class="text-muted text-center m-t-0"><b>Giriş Yapın</b></h4>

            <form class="form-horizontal m-t-20" action="" method="POST">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="usn" class="form-control" type="text" required="" placeholder="Kullanıcı Adı">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="pass" class="form-control" type="password" required="" placeholder="Şifre">
                    </div>
                </div>
                <center>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Beni Hatırla
                            </label>
                        </div>
                    </div>

                </div>
                </center>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Giriş Yap</button>
                    </div>
                </div>


            </form>
        </div>

    </div>
</div>



<!-- jQuery  -->
<script src="vendor/assets/js/jquery.min.js"></script>
<script src="vendor/assets/js/bootstrap.min.js"></script>
<script src="vendor/assets/js/modernizr.min.js"></script>
<script src="vendor/assets/js/detect.js"></script>
<script src="vendor/assets/js/fastclick.js"></script>
<script src="vendor/assets/js/jquery.slimscroll.js"></script>
<script src="vendor/assets/js/jquery.blockUI.js"></script>
<script src="vendor/assets/js/waves.js"></script>
<script src="vendor/assets/js/wow.min.js"></script>
<script src="vendor/assets/js/jquery.nicescroll.js"></script>
<script src="vendor/assets/js/jquery.scrollTo.min.js"></script>

<script src="vendor/assets/js/app.js"></script>

</body>
</html>