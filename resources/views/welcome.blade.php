<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IntelliCard</title>

    <!-- PRELOAD DA IMAGEM -->
    <link rel="preload-img" href="<?php echo e(asset('/assets/img/hero-bg.png')); ?>" alt="hero-bg">


    <!-- Favicons -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    
    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('/assets/vendor/aos/aos.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/remixicon/remixicon.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo e(asset('/assets/css/style.css')); ?>" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Gp
    * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

    
  </head>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
      <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="/">IntelliCard<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">IntelliCard</a></li>
            <li><a class="nav-link scrollto" href="#cards">Cartões Anki</a></li>
            <li><a class="nav-link scrollto " href="#ia">IA Generativa</a></li>
            <li><a class="nav-link scrollto" href="#contact">Contato</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        
        <div name="BOOOO DIV FANTASMA(FAVOR NÃO TIRAR)"></div>

        <div class="auth-buttons">
          
          <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="get-started-btn scrollto">Cadastrar</a>
          <?php endif; ?>
          <a href="<?php echo e(route('login')); ?>" class="get-started-btn scrollto ">Entrar</a>
        </div>
        

      </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center">
      <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
            <h1>Gerencie Cartões de uma maneira produtiva<span>.</span></h1>
            <h2>Crie cartões com auxílio da IA Generativa</h2>
          </div>
        </div>
        <!-- Nav Sobre o Site -->
        <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
          <div class="col-xl-2 col-md-4">
            <div class="icon-box">
              <i class="ri-store-line"></i>
              <h3><a href="#about">O que é o IntelliCard?</a></h3>
            </div>
          </div>

          <!-- Nav Sobre os Cartões Anki -->
          <div class="col-xl-2 col-md-4">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line"></i>
              <h3><a href="#cards">Cartões Anki</a></h3>
            </div>
          </div>
          
          <!-- Nav Sobre IA generativa -->
          <div class="col-xl-2 col-md-4">
            <div class="icon-box">
              <i class="ri-paint-brush-line"></i>
              <h3><a href="#ia">IA Generativa</a></h3>
            </div>
          </div>

          <!-- Nav Sobre Contatos -->
          <div class="col-xl-2 col-md-4">
            <div class="icon-box">
              <i class="ri-database-2-line"></i>
              <h3><a href="#contact">Contato</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Hero -->

    <main id="main">

      <!-- ======= System Section ======= -->
      <section id="about" class="about">
        <div class="container" data-aos="fade-up">

          <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
              <img src="<?php echo e(asset('/assets/img/about.jpg')); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
              <h3>Sobre o Sistema</h3>
              <p class="fst-italic pt-3">
                Bem-vindo ao nosso sistema inovador de criação de cartões Anki!     
              </p>
              <ul>
                <li><i class="ri-check-double-line"></i>Nosso diferencial está no uso da inteligência artificial generativa, que auxilia você na criação de conteúdo de forma rápida e personalizada.</li>
                <li><i class="ri-check-double-line"></i> Com nossa ferramenta, você poderá criar cartões de maneira simples e eficaz, aproveitando ao máximo a tecnologia para otimizar sua experiência de aprendizado.</li>
              </ul>       
              </div>
          </div>

        </div>
      </section>

      <!-- ======= Cards Anki Section ======= -->
      <section id="cards" class="about">
        <div class="container" data-aos="fade-up">

          <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
              <img src="<?php echo e(asset('/assets/img/cards.jpg')); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
              <h3>Cartões Anki</h3>
              <p class="fst-italic">
              Explore o mundo dos cartões Anki de uma maneira totalmente nova com nossa plataforma.
              </p>
              <ul>
                <li><i class="ri-check-double-line"></i>Os cartões Anki são uma ferramenta popular entre estudantes, profissionais e entusiastas que desejam memorizar informações de forma eficaz.</li>
                <li><i class="ri-check-double-line"></i> Com nosso sistema, você poderá criar seus próprios cartões Anki personalizados de maneira simples e intuitiva, adaptando-os às suas necessidades de aprendizado específicas.</li>
              </ul>
              <p>
                Saiba mais <a href="https://docs.ankiweb.net/getting-started.html" target="_blank">aqui</a>...
              </p>
            </div>
          </div>

        </div>
      </section>
      
      <!-- ======= IA Section ======= -->
      <section id="ia" class="about">
        <div class="container" data-aos="fade-up">

          <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
              <img src="<?php echo e(asset('/assets/img/ai.jpg')); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
              <h3>Inteligência Artificial</h3>
              <p class="fst-italic">
                Descubra como a inteligência artificial pode potencializar sua experiência na criação de cartões Anki.
              </p>
              <ul>
                <li><i class="ri-check-double-line"></i>Utilizamos o modelo Llama3 da Groq para potencializar os resultados desejados.</li>
                <li><i class="ri-check-double-line"></i>Apenas cole textos para que a IA crie seus cartões Anki, economizando seu tempo e aumentando a eficácia do seu estudo.</li>
              </ul>
              <p>
                Saiba mais <a href="https://wow.groq.com/why-groq/" target="_blank">aqui</a>...
              </p>
            </div>
          </div>
        </div>
      </section><!-- End About Section -->
      
      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Contact</h2>
            <p>Contact Us</p>
          </div>

          <div class="row mt-5">

            <div class="col-lg-4">
              <div class="info">

                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>intellicardufsj@gmail.com</p>
                </div>


              </div>

            </div>


          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= 
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6">
              <div class="footer-info">
                <h3>Gp<span>.</span></h3>
                <p>
                  A108 Adam Street <br>
                  NY 535022, USA<br><br>
                  <strong>Phone:</strong> +1 5589 55488 55<br>
                  <strong>Email:</strong> info@example.com<br>
                </p>
                <div class="social-links mt-3">
                  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                  <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-2 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Services</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
              </ul>
            </div>

            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Our Newsletter</h4>
              <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
              <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Subscribe">
              </form>

            </div>

          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>Gp</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/ -->
        </div>
      </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo e(asset('/assets/vendor/purecounter/purecounter_vanilla.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/aos/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/vendor/php-email-form/validate.js')); ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo e(asset('/assets/js/main.js')); ?>"></script>

  </body>

</html><?php /**PATH /home/antonioforte/Projects/ai-card/ai-card-api/resources/views/welcome.blade.php ENDPATH**/ ?>