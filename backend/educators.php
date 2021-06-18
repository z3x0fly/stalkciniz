<?php
ob_start();
session_start();
include 'engine/database.php';
if (isset($_SESSION['id']))
{
    $kimlik = $_SESSION['id'];
    $sql = $con->prepare("SELECT * FROM admin");
    $sql->execute();
    $adminInfo=$sql->fetchAll(PDO::FETCH_OBJ);

  }

else
{
    echo "403!";
    header('location:login.php?forbidden');
}
$educatorQuery = $con->prepare("SELECT * FROM admin");
$educatorQuery->execute();
$tablocek=$educatorQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
///////////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Yönetim Paneli | Adminler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<div id="wrapper">

    <?php include "vendor/parts/topbar.php";?>

    <!-- ========== Left Sidebar Start ========== -->


    <!--- Divider -->
    <?php include "vendor/parts/sidebar.php";?>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->

<!-- Start right Content here -->

<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="container">


                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-header-title">
                                    <h4 class="pull-left page-title">Adminler</h4>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Admin Ekle</h3>
                                    </div>
                          <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <h3 class="header-title m-t-0"><small></small></h3>
                                                <?php
                                                if (isset($_GET['ekle'])) {
                                                  // code...
                                                  $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
                                                  $ad = trim(filter_input(INPUT_POST, 'ad', FILTER_SANITIZE_STRING));
                                                  $sifre = trim(filter_input(INPUT_POST, 'sifre', FILTER_SANITIZE_STRING));
                                                  $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                                                  $pass_enc = md5($sifre);
                                                  try {
                                                     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                     $sorgula = $con->prepare("INSERT INTO admin(usn, pass, mail, name) VALUES(?, ?, ?, ?)");
                                                     $sorgula->bindParam(1, $user, PDO::PARAM_STR);
                                                     $sorgula->bindParam(2, $pass_enc, PDO::PARAM_STR);
                                                     $sorgula->bindParam(3, $mail, PDO::PARAM_STR);
                                                     $sorgula->bindParam(4, $ad, PDO::PARAM_STR);

                                                     $sorgula->execute();
                                                    //echo $ad,$soyad,$pass_enc, $mail, $tarih, $sinif;
                                                      ?>
                                                      <div class="alert alert-success alert-dismissible fade in">
                                                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                  Admin Ekleme İşlemi Başarılı ! Panel Yenileniyor !
                                                                                              </div>
                                                                                      <?php
                                                                                      header('refresh:2;url=educators.php');
                                                  } catch (PDOException $e) {
                                                      die($e->getMessage());
                                                  }

                                                }

                                                if(isset($_GET['sil']))
                                                {
                                                  $sorgu=$con->prepare('DELETE FROM admin WHERE id=?');
                                                  	$sonuc=$sorgu->execute([$_GET['sil']]);
                                                  	if($sonuc){
                                                      echo '  <div class="alert alert-success alert-dismissible fade in">
                                                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                    Admin Başarılı Bir Şekilde Silindi. Yenileniyor !
                                                                                                </div>';
                                                                                                header('refresh:2;url=educators.php');
                                                  	}
                                                  	else
                                                  		echo("Kayıt silinemedi.");
                                                }

                                                ?>
                                                <div class="m-t-25">
                                                  <form action="educators.php?ekle" method="post">
                                                        <div class="form-group">
                                                            <label>Kullanıcı Adı</label>
                                                            <input name="username" type="text" class="form-control" required
                                                                   placeholder="Bir ad giriniz."/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Adı</label>
                                                            <input name="ad" type="text" class="form-control" required
                                                                   placeholder="Bir ad giriniz."/>
                                            </div>
                                                        <div class="form-group">
                                                            <label>Şifre</label>
                                                            <div>
                                                                <input name="sifre" type="password" id="pass2" class="form-control" required
                                                                       placeholder="Şifre"/>
                                                            </div>
                                                            <div class="m-t-10">
                                                                <input type="password" class="form-control" required
                                                                       data-parsley-equalto="#pass2"
                                                                       placeholder="Şifre Tekrar"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>E-Posta</label>
                                                            <div>
                                                                <input name="mail" type="email" class="form-control" required
                                                                       parsley-type="email" placeholder="Geçerli Bir E-Posta Adresi Giriniz"/>
                                                            </div>
                                                        </div>
                                                        
                                             
                                            
                                            
                                                            <div>
                                                                <button  type="submit" class="btn btn-primary waves-effect waves-light">
                                                                    Sisteme Ekle
                                                                </button>
                                                                <script>

                                                                </script>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>


                                        </div>
                                        <!-- end row -->
                                    </div>



                    </div> <!-- container -->

                </div> <!-- content -->


            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Adminler Tablosu</h3>
                            </div>
                            <div class="panel-body">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                          <th>İsim</th>
                                          <th>Kullanıcı Adı</th>
                                          <th>Şifre</th>
                                          <th>E-Posta Adresi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach($tablocek as $cek){?>
                                      <tr>

                                      <td><?= $cek->name ?></td>
                                      <td><?= $cek->usn ?></td>
                                      <td><?= $cek->pass ?></td>
                                      <td><?= $cek->mail ?> </td>
                                      <td> <a type="button" href="educators.php?sil=<?= $cek->id ?>"><button class="btn btn-danger waves-effect waves-light">Yöneticiyi Sil</button></a></td>

                                      </tr>

                                  <?php } ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-6 col-sm-3 m-b-30">
                                  <button  id="aktar" type="button" class="btn btn-success waves-effect waves-light">Excel Olarak Dışa Aktar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div> <!-- End Row -->




        </div>
        </div> <!-- container -->

    </div> <!-- content -->

    <?php include "vendor/parts/footer.php";?>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


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

<script src="vendor/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables-->
<script src="vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="vendor/assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="vendor/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="vendor/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="vendor/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<script src="vendor/assets/pages/dashborad.js"></script>
<script src="vendor/assets/pages/form-advanced.js"></script>
<script type="text/javascript" src="vendor/assets/plugins/parsleyjs/parsley.min.js"></script>
<script src="vendor/assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
</body>
</html>
