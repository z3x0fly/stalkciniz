<?php
include "backend/engine/database.php";
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <?php include "frontend/partials/seo.blade.php"; ?>
    <title>Stalkcınız - En Güvenli Stalk & Profil Görüntüleme Sistemi, Instagram Stalk, Profilime Kimler Baktı, Profilime Bakanlar</title>

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
        <img src="frontend/images/logo-icon.png" alt="">
      </div>
      <div class="preloader-inner">
      </div>
    </div>

    <!-- Mobile Menu -->
    <?php include "frontend/partials/mobile.nav.blade.php"; ?>
    <!-- Header -->
    <?php include "frontend/partials/header.nav.blade.php"; ?>
    <!-- Header -->




    <div class="main-content">

      <!-- Main Banner -->
      <div class="parallax-banner">
        <!--Content before waves-->
        <div class="inner-header">
          <div class="inner-content">
            <h4>Dünyanın En İyi Stalk Sitesi</h4>
            <h1>Stalkcınız<br></h1>
            <h3>
            Profilinize bakanları görüntüleyin
            </h3>
            <br>
            <div class="main-pink-button">
                  <a href="/user">Giriş Yaparak Profilinize Bakanları İnceleyin</a>
                </div>

            <div class="main-decoration">
              <img src="frontend/images/baner-main-decoration.png" alt="">
            </div>
          </div>
        </div>

        <!--Waves Container-->
        <div>
          <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
          <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="parallax">
          <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
          </g>
          </svg>
        </div>
        <!--Waves end-->
      </div>


      <!-- Features -->
      <section class="features">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="feature-item">
                <div class="icon">
                  <img src="frontend/images/features-icon-01.png" alt="">
                </div>
                <h4>Doğru Sonuçlar</h4>
                <p>Karşınıza çıkarılan sonuçlar tamamen gerçek ve tamamiyle sistemsel olarak alınan sonuçlardır. Diğer uygulamalar gibi sonuçlarımız güncellenir.</p>
              </div>

            </div>
            <div class="col-lg-4">
              <div class="feature-item">
                <div class="icon">
                  <img src="frontend/images/features-icon-02.png" alt="">
                </div>
                <h4>Kayıtsız İşlem</h4>
                <p>Giriş çıkış ve ya stalk gibi işlemler kesinlikle sistemimizde kayıtlı olarak tutulmaz. Güvenle kullanabilirsiniz. Sizi kuşkulandırmasın.</p>
              </div>

            </div>
            <div class="col-lg-4">
              <div class="feature-item">
                <div class="icon">
                  <img src="frontend/images/features-icon-03.png" alt="">
                </div>
                <h4>Kullanışlı Entegrasyon</h4>
                <p>Tam zamanlı (Real Time Delayed) Instagram entegrasyonu sayesinde, hesabınız ile giriş yaparak stalk işlemi yapabileceksiniz.</p>
              </div>

            </div>
          </div>
        </div>
      </section>


      <!-- Good Tips -->
      <section class="good-tips">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="section-heading">
                <h6>Kullanımı Pratik</h6>
                <h2>Üstelik kayıtsız şekilde anonim olarak !</h2>
              </div>
              <div class="tips-content">
                <ul>
                  <li>
                    <div class="icon">
                      <img src="frontend/images/features-icon-01.png" alt="">
                    </div>
                    <div class="right-content">
                      <h4>Anonim İzleme</h4>
                      <p>Gizli profile sahip biri profilinize baksa bile, onu bile gösteririz.</p>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <img src="frontend/images/features-icon-02.png" alt="">
                    </div>
                    <div class="right-content">
                      <h4>24 Saat Kuralı</h4>
                      <p>Sistemsel yoğunluk esnasında, 24 saatte bir defa sonuçlar yenilenmeyebilir..</p>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <img src="frontend/images/features-icon-03.png" alt="">
                    </div>
                    <div class="right-content">
                      <h4>Kullanıcı Dostu Arabirim</h4>
                      <p>Ek işlem yapmanız gerekmez, sadece giriş yapıp sizi stalklayanları görebilirsiniz.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 align-self-center">
              <div class="right-image">
                <img src="frontend/images/good-tips-right-image.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </section>



      <!-- Our Services -->
      <section class="our-services">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
                <h6>Öncelik Güvendir</h6>
                <h2>Güvenmenizi gerektiren unsur nedir ?</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="service-item border-bottom border-right">
                <div class="icon">
                  <img src="frontend/images/service-icon-01.png" alt="">
                </div>
                <h4>Güncel Sonuçlar</h4>
                <p>Sistemimizde görünen sonuçlar kesinlikle günceldir. Bu sonuçlar Instagram Gateaway metodundan çekilmektedir..</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-item border-bottom border-right">
                <div class="icon">
                  <img src="frontend/images/service-icon-02.png" alt="">
                </div>
                <h4>Günlük Güncelleme Özelliği</h4>
                <p>Biri sizi stalklamadıysa, 24 saat sonra tekrar denemek gibi hakkınız var. Üstelik sadece ilerleyen günlere kadar ücretsiz. </p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-item border-bottom">
                <div class="icon">
                  <img src="frontend/images/service-icon-03.png" alt="">
                </div>
                <h4>Kullanıcı Dostu Arabirim</h4>
                <p>Sisteme giriş yaptıktan sonra stalk verilerini gördüğünüz arabirim ile karşılaşırsınız.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-item border-right">
                <div class="icon">
                  <img src="frontend/images/service-icon-04.png" alt="">
                </div>
                <h4>Anonim Oturum Sistemi</h4>
                <p>Sistemimiz hiç bir şekilde kişisel bilgilerinizi kayıt altına almaz. Anonim bir şekilde kullanabilirsiniz.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-item border-right">
                <div class="icon">
                  <img src="frontend/images/service-icon-05.png" alt="">
                </div>
                <h4>Kişiye Özel Tekil Oturum</h4>
                <p>Sistemimiz tekil oturum mantığı ile çalışmaktadır. Kullanıcı başı tek oturum ile çalışır. Sonrasında oturum yok olur.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-item">
                <div class="icon">
                  <img src="frontend/images/service-icon-06.png" alt="">
                </div>
                <h4>Destek Alabileceğiniz Bir Developer</h4>
                <p>Üzülmeyin, sorunlarınıza göğüs gerebilecek bir developer var. Yardımcı olabileceğinden emin. 🐱‍👤👨‍💻</p>
              </div>
            </div>
          </div>
        </div>
      </section>


       <!-- Free Quote -->
      <section class="free-quote">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-image">
                <img src="frontend/images/free-quote-left-image.png" alt="">
              </div>
            </div>
            <div class="col-lg-6 align-self-center">
              <div class="section-heading">
                <h6>Kullanmaya Başlayın !</h6>
                <h2>Gecikmeden sizler de kullanmaya başlayın !</h2>
              </div>
            </div>
          </div>
        </div>
      </section>



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
