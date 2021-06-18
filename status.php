<?php
include "backend/engine/database.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php include "frontend/partials/seo.blade.php"; ?>
    <title>Stalkcınız - Durum</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="frontend/styles/bootstrap.css" />
    <link rel="stylesheet" href="frontend/styles/main.css" />
  </head>

  <body>

    <!-- Preloader -->
    <div id="js-preloader" class="js-preloader">
      <div class="content">
        <img src="images/logo-icon.png" alt="">
      </div>
      <div class="preloader-inner">
      </div>
    </div>

    <!-- Mobile Menu -->
    <?php include "frontend/partials/mobile.nav.blade.php"; ?>
    <!-- Header -->
    <?php include "frontend/partials/header.nav.blade.php"; ?>
    <!-- Header -->

    <!-- Search -->
    <div id="search">
      <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="Type to search..." required="">
            <button type="submit" class="primary-button"><i class="fa fa-search"></i></button>
        </form>
    </div>


    <div class="main-content">

      <!-- Page Heading -->
      <div class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>Sistem Duyuruları</h1>
            </div>
          </div>
        </div>
      </div>
    <br>
      <!-- About Tips -->
      <section class="about-tips">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
              <?php
              try
                {

                  $sorgu = $con->query("SELECT * FROM status_page");
                  $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
                  echo $cikti["content"];
                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                $conn = null;

                ?>
            </div>
          </div>
        </div>
      </section>
<br>



    </div>


    <section class="footer-content">
      <div class="cta-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h2>Proje hoşunuza mı gitti ?<br>
              <em>Size de kodlayalım</em> </h2>
            </div>
            <div class="col-lg-4">
              <div class="main-white-button">
                <a href="https://github.com/w0fly">İletişim</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php include "frontend/partials/footer.blade.php"; ?>
    </section>


    <!-- Go To Top -->
    <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
    <?php include "frontend/partials/js.blade.php"; ?>


  </body>
</html>
