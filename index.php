<?php
  session_start();
  include('tienda/php/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobileOptimized" content="width"/>
    <meta name="handheldFriendly" content="true"/>

    <!-- Seo Meta-->
    <meta name="robots" content="index, follow"/>
    <meta name="revisit" content="15 days"/>
    <meta name="author" content="Jean Cuadros"/>
    <meta name="Copyright" content="<?= WEB; ?>"/>
    <meta name="title" content="<?= TITLE_WEB; ?>"/>
    <meta name="Description" content="Description"/>

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= TITLE_WEB; ?>">
    <meta property="og:url" content="<?= WEB; ?>">
    <meta property="og:image" content="<?= BASE_URL; ?>/img/logo2.png">
    <meta property="og:description" content="Fres-Art es una marca de venta de Boxers, Medias, etc. Fres-Art busca convertirse y consolidarse como una marca distinta y fuera de lo común, con sus diseños propios y creativos e innovadores. ¡sientete diferente!">

    <!-- Icos -->
    <link type="image/x-icon" rel="shortcut icon" href="img/favicon.ico"/>
    <link type="image/x-icon" rel="apple-touch-icon" href="img/favicon.ico"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/mdb.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/all.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/animate.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/fancybox.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!-- Compatibility -->
    <!--[if lt IE 9]><script type="text/javascript" src="js/html5shiv.min.js"></script><![endif]-->
    <!--[if lt IE 9]><script type="text/javascript" src="js/respond.min.js"></script><![endif]-->
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top " id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
          <img src="img/logo2.png" width="54" alt="Logo Fres-art">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar top-bar"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
          <span class="sr-only">Toggle navigation</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto mr-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Concepto
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#gallery">Fotos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="tienda/">Tienda Online</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contactos</a>
            </li>
          </ul>
        </div>
        <div class="redes d-none d-lg-block">
          <div class="row">
            <div class="col-6">
              <a href="https://www.facebook.com/FresArtoficial" target="_blank"><span class="t-rs t-rs-fb"></span></a>
            </div>
            <div class="col-6">
              <a href="https://www.instagram.com/fres_art_/" target="_blank"><span class="t-rs t-rs-in"></span></a>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <a href="https://www.youtube.com/channel/UCQBfIBYI2zAgwDyeAFem0kQ" target="_blank"><span class="t-rs t-rs-yt"></span></a>
            </div>
            <div class="col-6">
              <a href="https://api.whatsapp.com/send?phone=[51][940130484]" target="_blank"><span class="t-rs t-rs-wa"></span></a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="mt-3">
      <div class="container wow fadeIn" data-wow-duration="2s">
        <div class="row padding">
          <?php 
            $consulta= $conexion->query("select * from banners") or die($conexion->error);
            while ($fila = mysqli_fetch_array($consulta)) {
          ?>
          <div class="col-sm-6 col-md-4 mb-4">
            <div class="card mb-1 d-lg-none">
              <a style="cursor:default;" title="<?php echo $fila['nombre']?>">
                <img loading="lazy" src="<?= BASE_URL_TIENDA; ?>images/banners/<?= $fila['imagen2']?>" alt="<?= $fila['nombre']?>" class="card-img-top" width="482" height="482">
              </a>
            </div>
            <div class="card mb-1 d-none d-lg-flex">
              <a class="fancybox" href="<?= BASE_URL_TIENDA; ?>images/banners/big/<?= $fila['imagen']?>" data-fancybox-group="gallery" title="<?php echo $fila['nombre']?>">
                <img loading="lazy" src="<?= BASE_URL_TIENDA; ?>images/banners/<?= $fila['imagen2']?>" alt="<?= $fila['nombre']?>" class="card-img-top" width="482" height="482">
              </a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- about Section-->
    <section id="about" class="parallax">
      <div class="container py-4 content-box">
        <header>
          <h1 class="text-center">Fres-Art</h1>
        </header>
        <p>
          Desde el 2014 Fres-Art, busca promover el diseño y la creatividad a través de sus productos, de esa manera busca cambiar el estilo y forma de vestir de su público.  <br>
          Somos un equipo que esta comprometido con la tendencia en diseño textil, diseño gráfico y la ilustración impregnadas en nuestras prendas.
        </p>
        <p>
          <span style="color: #6134d3;" class="font-weight-bold">¿Por qué decidimos montar este tipo de producto?</span> <br>
          Porque sentímos que no ahí una marca de prenda que represente un estilo más orgánico y funcional 
        </p>
        <div class="row padding">
          <div class="col-md-6 pt-2">
            <p>
              <span style="color: #6134d3;" class="font-weight-bold">¿Qué valores destacamos del producto?</span> <br>
              Se considera dos puntos 
            </p>
            <p>
              <span style="color: #6134d3;" class="font-weight-bold">Funcional:</span> <br>
              - forma, durabilidad y limpieza.
            </p>
            <p>
              <span style="color: #6134d3;" class="font-weight-bold">Psicológico:</span> <br>
              - calidad, empatía y seguridad. 
            </p>
          </div>
          <div class="col-md-5 pt-4">
              <img loading="lazy" src="img/bg/nube.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="border">
      <div class="container wow fadeIn" data-wow-duration="2s">
        <div class="row no-gutter">
          <?php
            $resultado= $conexion ->query("select * from fotos ") or die($conexion ->error);
            while ($fila=mysqli_fetch_array($resultado)) {
          ?>
          <div class="col-sm-6 col-md-4 p-0">
            <a class="" title="" style="cursor: default;">
              <img loading="lazy" src="tienda/images/fotos/<?= $fila['imagen'];?>" alt="<?= $fila['nombre']?>" class="img-fluid">
            </a>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <footer id="contact" class="footer text-center">
      <div class="container padding mb-4">
        <div class="row padding">
          <?php
            $resredes= $conexion ->query("select * from redes limit 4") or die($conexion ->error);
            while ($redes=mysqli_fetch_array($resredes)) {
          ?>
          <div class="col-md-3 mb-3">
            <div class="card">
              <a href="<?= $redes['link'];?>" target="_blank" title="<?= $redes['nombre'];?>"><img src="tienda/images/redes/<?= $redes['imagen'];?>" alt="<?= $redes['nombre'];?>" class="card-img-top"></a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

      <div class="container pt-4">
        <div class="row">
          <?php
            $resredes2= $conexion ->query("select * from redes where id >= 5") or die($conexion ->error);
            while ($redes2=mysqli_fetch_array($resredes2)) {
          ?>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            
              <?php 
                if ($redes2['id'] == 5) {
                  echo '
                    <h4 class="text-uppercase mb-4">
                      <a href="https://www.instagram.com/fres_art_/" target="_blank" style="color:#9c1e92;"><u>INSTAGRAM</u></a>
                      <a href="https://www.instagram.com/fres_art_/" target="_blank"><img src="img/icon/like-insta.png" alt="Instagram"></a>
                    </h4>
                  ';
                }elseif ($redes2['id'] == 6) {
              ?>
                  <h4 class="text-uppercase mb-4 d-flex" style="color:#0178f7;align-items: center;justify-content: center;">
                    <a href="https://www.facebook.com/FresArtoficial" target="_blank" style="color:#0178f7"><u class="mr-1">FACEBOOK</u></a>
                      <div class="fb-box">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v9.0" nonce="58uQMJVW"></script>
                        <div class="fb-like" data-href="https://www.facebook.com/FresArtoficial" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>            
                      </div>
                    </a>
                  </h4>
              <?php
                }else{
                  echo '
                    <h4 class="text-uppercase mb-4">
                      <a href="https://twitter.com/fresssart" target="_blank" style="color:#1d9ceb;"><u>TWITTER</u></a>
                      <a href="#"><img src="img/icon/twitter.png" alt="Twitter"></a>
                    </h4>
                  ';
                }
              ?>            
            <div class="card">
              <a href="<?= $redes2['link'];?>" target="_blank" title="<?= $redes2['nombre'];?>"><img src="tienda/images/redes/<?= $redes2['imagen'];?>" alt="<?= $redes2['nombre'];?>" class="card-img-top"></a>
            </div> 
          </div>
          <?php } ?>

          <div class="col-md-6 col-lg-3">
            <h4 class="text-uppercase mb-4" style="font-size: 20px;"><u>CONTACTOS F-A</u></h4>
            <p class="mayorista" style="font-size: 22px;"><span style="margin-left: -55px;">Venta para</span> <br> Mayorista <img src="img/icon/carrito.png" style="float: right;margin-top: -16px;right: 40px;margin-right: 20px;" alt="">
            </p>

            <div class="mt-3">
              <a href="https://www.facebook.com/FresArtoficial" target="_blank">
                <span class="rs rs-f"></span>
              </a>
              <a href="https://www.instagram.com/fres_art_/" target="_blank">
                <span class="rs rs-i"></span>
              </a>
              <a>
                <span class="rs rs-y"></span>
              </a>
              <a href="https://api.whatsapp.com/send?phone=[51][940130484]" target="_blank">
                <span class="rs rs-w"></span>
              </a>
            </div>

            <b>51-989504797 <br>
            51-989504797</b>
            <p style="margin-bottom: 2px;">Horario: Lun-Sab: 9:00 a 21:00</p>
            <p style="margin-bottom: 5px;"><img src="img/icon/mensaje.png" alt="" class="mr-1"> freddy.cuadros@fres-art.com <br>Lima-Perú</p>
            <img src="img/logo3.png" alt="">
          </div>

        </div>
      </div>
    </footer>

    <!-- Copyright -->
    <div class="copyright py-2 text-center font-weight-bold">
        <small>Copyright 2020 / Fres-Art &copy;</small>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.js"></script>
    <script type="text/javascript" src="js/modernizr.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.mousewheel.min.js"></script> -->
    <script type="text/javascript" src="js/jquery.easing.min.js"></script>  
    <script type="text/javascript" src="js/fancybox.min.js"></script>  
    <script type="text/javascript" src="js/script.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/60087cafc31c9117cb70be1b/1esgielb7';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script>
    <!--End of Tawk.to Script-->
  </body>
</html>