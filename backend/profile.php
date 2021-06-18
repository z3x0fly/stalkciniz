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
    $array  = $_SESSION['id'];
    $query  = $con -> prepare("SELECT * FROM admin WHERE id = :id");
    $query -> execute(['id' => $array]);
    $row    = $query -> fetchAll(PDO::FETCH_ASSOC);

}

else
{
    echo "403!";
    header('location:login.php?forbidden');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Yönetim Paneli | Kullanıcı Ayarları</title>
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

            <!-- Code Here -->
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Kullanıcı Ayarları</h4>
                        <div class="clearfix"></div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Kullanıcı Bilgilerini Güncelle</h3>
                            </div>
                  <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <h3 class="header-title m-t-0"><small></small></h3>
                                        <?php
                                        if (isset($_POST['kaydet'])) {
                                          // code...
                                          $ad = trim(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING));
                                          $sifre = trim(filter_input(INPUT_POST, 'sifre', FILTER_SANITIZE_STRING));
                                          $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING));
                                          $sifre_enc = md5($sifre);
                                          try {
                                             $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                             $sorgula = $con->prepare("UPDATE admin SET mail = ?, pass = ? WHERE id = ?");
                                             $sorgula->bindParam(1, $mail, PDO::PARAM_STR);
                                             $sorgula->bindParam(2, $sifre_enc, PDO::PARAM_STR);
                                             $sorgula->bindParam(3, $_SESSION['id'], PDO::PARAM_INT);
                                             $sorgula->execute();
                                              ?>
                                              <div class="alert alert-success alert-dismissible fade in">
                                                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                          Bilgiler Güncellendi. Panel Yenileniyor !
                                                                                      </div>
                                                                              <?php
                                                                              header('refresh:2;url=profile.php');
                                          } catch (PDOException $e) {
                                              die($e->getMessage());
                                          }

                                        }



                                        ?>
                                        <div class="m-t-25">
                                          <form action="" method="post">
                                                <div class="form-group">
                                                    <label>Kullanıcı Adı</label>
                                                    <input name="user" value=<?php
                                                       foreach ($row as $item) {
                                                         echo '"'.$item['usn'].'"';
                                                        } ?> disabled type="text" class="form-control" required
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
                                                        <input name="mail" value=<?php
                                                           foreach ($row as $item) {
                                                             echo '"'.$item['mail'].'"';
                                                            } ?> type="email" class="form-control" required
                                                               parsley-type="email" placeholder="Geçerli Bir E-Posta Adresi Giriniz"/>
                                                    </div>
                                                </div>

                                      <div class="form-group">

                                        </div>
                                    </div>

                                                    <div>
                                                        <button name="kaydet" type="submit" class="btn btn-primary waves-effect waves-light">
                                                            Bilgilerimi Güncelle
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


            </div>
            </div>



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

<script src="vendor/assets/pages/dashborad.js"></script>

<script src="vendor/assets/js/app.js"></script>

</body>
</html>
