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

$studentQuery = $con->prepare("SELECT * FROM admin");
$studentQuery->bindParam(1, $tutSinif, PDO::PARAM_STR);

$studentQuery->execute();
$sutcek=$studentQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Yönetim Paneli | Genel Bakış</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">
    <link href="vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="vendor/assets/js/jquery.table2excel.js"></script>
</head>

<script>
$(document).ready(function(){
	$("#aktar").click(function(){
  $("#datatable-responsive").table2excel({
    // exclude bu class verdiğiniz yerler aktarılmayacak.
    exclude: ".bunu_aktarma",
    filename: "data" //burada .(nokta) ve uzantı kullanmayın
  });
});
});
</script>
<style>
    table { border-top: 1px solid gray; border-left: 1px solid gray}
    table tr td { padding: 5px 10px; border-right: 1px solid gray; border-bottom: 1px solid gray}
    span #aktar { float: left; padding: 5px 8px; background: #FF0D6D; color:#fff; margin-top: 10px  }
</style>

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
                            <h4 class="pull-left page-title">Ana Sayfa</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="panel panel-primary text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title">Kayıtlı Kullanıcı</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b><?php
                                        $admins = $con->prepare("SELECT COUNT(*) FROM users");
                                        $admins->execute();
                                        $adminsay = $admins->fetchColumn();
                                        echo $adminsay;
                                        ?></b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="panel panel-primary text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title">Kayıtlı Admin</h4>
                            </div>
                            <div class="panel-body">
                                <h3 class=""><b><?php
                                        $admins = $con->prepare("SELECT COUNT(*) FROM admin");
                                        $admins->execute();
                                        $adminsay = $admins->fetchColumn();
                                        echo $adminsay;
                                        ?></b></h3>
                            </div>
                        </div>
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
                                      foreach($sutcek as $cek){?>
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

                </div> <!-- End Row -->

            </div> <!-- container -->

        </div> <!-- content -->

            <?php include "vendor/parts/footer.php";?>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->

<!-- jQuery  -->
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
<script src="vendor/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="vendor/assets/plugins/datatables/jszip.min.js"></script>
<script src="vendor/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="vendor/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="vendor/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="vendor/assets/plugins/datatables/buttons.print.min.js"></script>
<!-- Datatables-->
<script src="vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="vendor/assets/pages/dashborad.js"></script>

<script src="vendor/assets/js/app.js"></script>


</body>
</html>
