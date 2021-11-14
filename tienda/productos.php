<?php
  session_start();
  include("./php/conexion.php");

  if ($_GET['id']) {
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];

    $resultado= $conexion ->query("select * from productos where id=".$id." and url='".$nombre."'") or die(header("Location: ".BASE_URL_TIENDA));
    if (mysqli_num_rows($resultado)>0) {
      $fila = mysqli_fetch_row($resultado);
    }else{
      header("Location: ".BASE_URL_TIENDA);
    }
  }else{
    header("Location: ".BASE_URL_TIENDA);
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB.' - '.$fila[1]; ?></title>
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
    <meta name="Description" content="<?= $fila[2]; ?>"/>

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= TITLE_WEB; ?>">
    <meta property="og:url" content="<?= WEB; ?>">
    <meta property="og:image" content="<?= BASE_URL; ?>/img/logo2.png">
    <meta property="og:description" content="<?= $fila[2]; ?>">

    <!-- Icos -->
    <link type="image/x-icon" rel="shortcut icon" href="<?= BASE_URL_TIENDA; ?>images/icons/favicon.ico"/>
    <link type="image/x-icon" rel="apple-touch-icon" href="<?= BASE_URL_TIENDA; ?>images/icons/favicon.ico"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap">

    <style>
      @font-face {
        font-family: 'icomoon';
        src:  url('<?= BASE_URL_TIENDA; ?>fonts/icomoon/fonts/icomoon.eot?10si43');
        src:  url('<?= BASE_URL_TIENDA; ?>fonts/icomoon/fonts/icomoon.eot?10si43#iefix') format('embedded-opentype'),
          url('<?= BASE_URL_TIENDA; ?>fonts/icomoon/fonts/icomoon.ttf?10si43') format('truetype'),
          url('<?= BASE_URL_TIENDA; ?>fonts/icomoon/fonts/icomoon.woff?10si43') format('woff'),
          url('<?= BASE_URL_TIENDA; ?>fonts/icomoon/fonts/icomoon.svg?10si43#icomoon') format('svg');
        font-weight: normal;
        font-style: normal;
      }
      @font-face {
        font-family: 'Beckman-Free';
        src: url('<?= BASE_URL; ?>fonts/Beckman-Free.eot');
        src: url('<?= BASE_URL; ?>fonts/Beckman-Free.eot?#iefix') format('embedded-opentype'),
        url('<?= BASE_URL; ?>fonts/Beckman-Free.woff') format('woff'),
        url('<?= BASE_URL; ?>fonts/Beckman-Free.ttf') format('truetype'),
        url('<?= BASE_URL; ?>fonts/Beckman-Free.svg#ChunkFiveRegular') format('svg');
        font-weight: normal;
        font-style: normal;
      }
    </style>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL; ?>css/all.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>fonts/icomoon/style.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/magnific-popup.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/jquery-ui.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/owl.carousel.min.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/owl.theme.default.min.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/aos.css">
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL_TIENDA; ?>css/style.css">

    <script type="text/javascript" src="<?= BASE_URL; ?>js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL; ?>js/jquery.elevatezoom.js"></script>
  </head>
  <body>

    <div class="site-wrap">
      <?php include("layouts/header.php"); ?>

      <div class="site-section" id="single">
        <form action="<?= BASE_URL_TIENDA; ?>carrito-de-compras" method="post" name="single">
          <div class="container">
            <div class="row">
              <!-- Section Products -->
              <div class="col-md-6 col-xl-5 mb-2">
                <!-- IMG Producto -->
                <div class="position-relative content-img border">
                  <?php if ($fila[12] == 1) { ?><div class="nuevo"></div><?php } ?>
                  <?php if ($fila[4] != 0) { ?><div class="oferta"></div><?php } ?>
                  <img src="<?= BASE_URL_TIENDA; ?>images/small/<?php echo $fila[10];?>" alt="<?php echo $fila[1]; ?>" class="img-fluid mx-auto d-block d-lg-none">
                  <div class="ci-zoom overimg d-none d-lg-block mx-auto">
                    <span class="z-lupa ml-4"></span>
                    <img id="zoom_03" src="<?= BASE_URL_TIENDA; ?>images/small/<?php echo $fila[10]; ?>" data-zoom-image="<?= BASE_URL_TIENDA; ?>images/<?php echo $fila[5]; ?>" title="<?php echo $fila[1]; ?>" alt="<?php echo $fila[1]; ?>" class="img-fluid">
                    <script>
                      $("#zoom_03").elevateZoom({constrainType:"height", zoomType: "inner", containLensZoom: true, gallery:'gal1', cursor: 'pointer',
                      galleryActiveClass: "active"}); 
                    </script>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-xl-3">
                <?php
                  $vercategoria= $conexion ->query("select * from categorias where id=".$fila[7]) or die($conexion->error); 
                  $cate = mysqli_fetch_row($vercategoria);
                ?>
                <h3 class="text-black mb-0 font-Beckman"><?php if ($cate[0] != 2) {echo "Modelo:";}?> <?php echo $fila[1]; ?></h3>
                <?php 
                    if ($cate[0] != 2) {
                  ?>
                  <span class="font-Beckman text-black"><?php echo $cate[1]; ?></span>
                <?php } ?>
                <p class="h5 font-Beckman"><?php echo $fila[2]; ?></p>
                <p>
                  <?php if ($fila[4] != 0) { ?>
                  <strong class="text-secondary h4 mr-2" style="text-decoration: line-through;">S/. <?php echo number_format($fila[4], 2, '.', ''); ?></strong> 
                  <?php } ?>
                  <strong class="text-primary h2">S/. <?php echo number_format($fila[3], 2, '.', ''); ?></strong>
                </p>
                <hr style="border-style: dashed;width: 42%;text-align: left;border-top: 2px dashed #bdbdbd;margin-left: 0;">
                <div class="mb-0 d-flex">
                  <?php
                    $re2= $conexion->query("select * from productos where id=".$fila[0]) or die($conexion->error);
                    $fila2 = mysqli_fetch_row($re2);
                    $talla= explode(",", $fila2[8]);
                    for ($i=0; $i < count($talla); $i++) {
                  ?>
                  <label for="<?php echo $talla[$i];?>" class="d-flex mr-3 mb-3"><span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                    <input type="radio" name="talla" value="<?php echo $talla[$i];?>" id="<?php echo $talla[$i];?>" required></span>
                    <span class="d-inline-block text-black"><?php echo $talla[$i];?></span>
                  </label>
                  <?php } ?>
                </div>
                <div class="mb-2">
                  <div class="input-group mb-3" style="max-width: 120px;">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary js-btn-minus btn-number" type="button" data-type="minus" data-field="cant">&minus;</button>
                  </div>
                  <input type="text" class="form-control text-center arrow-none" name="cantidad" value="1" min="1" max="100" placeholder="">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary js-btn-plus btn-number" type="button" data-type="plus" data-field="cant">&plus;</button>
                  </div>
                </div>

                </div>
                <button class="buy-now btn btn-sm btn-primary">Agregar al 
                  <span class="icon icon-shopping_cart" style="font-size: 20px;"></span>
                <input type="hidden" name="id" value="<?= $fila[0];?>">
              </div>

              <div class="col-md-12 col-xl-4 mt-4 mt-xl-0 producto-detalle">
                <?php if($cate[4] != ""){ ?>
                <div class="row mb-3">
                  <div class="col-1 col-lx-2 text-center p-0"><img src="<?= BASE_URL_TIENDA; ?>images/icons/emblema.png" width="26" alt="" class="d-inline-block"></div>
                  <div class="col-11 col-xl-10 pl-0 pl-xl-3">
                    <p>
                      <?= nl2br($cate[4]); ?>
                    </p>
                  </div>
                </div>
                <?php } if($cate[5] != ""){?>
                <div class="row mb-3">
                  <div class="col-1 col-lx-2 text-center p-0"><img src="<?= BASE_URL_TIENDA; ?>images/icons/hilo.png" width="26" alt="" class="d-inline-block"></div>
                  <div class="col-11 col-xl-10 pl-0 pl-xl-3">
                    <p>
                      <?= nl2br($cate[5]); ?>
                    </p>
                  </div>
                </div>
                <?php } if($cate[6] != ""){?>
                <div class="row mb-3">
                  <div class="col-1 col-lx-2 text-center p-0">
                    <?php if($cate[0] == 1){ ?>
                    <img src="<?= BASE_URL_TIENDA; ?>images/icons/boxer.png" width="26" alt="" class="d-inline-block">
                    <?php }elseif ($cate[0] == 2) { ?>
                      <img src="<?= BASE_URL_TIENDA; ?>images/icons/media.png" width="26" alt="" class="d-inline-block">
                    <?php }elseif ($cate[0] == 3) { ?>
                      <img src="<?= BASE_URL_TIENDA; ?>images/icons/polo.png" width="26" alt="" class="d-inline-block">
                    <?php }elseif ($cate[0] == 4) { ?>
                      <img src="<?= BASE_URL_TIENDA; ?>images/icons/vividi.png" width="26" alt="" class="d-inline-block">
                    <?php }else{ ?>
                      <img src="<?= BASE_URL_TIENDA; ?>images/icons/rand.png" width="26" alt="" class="d-inline-block">
                    <?php }?>

                  </div>
                  <div class="col-11 col-xl-10 pl-0 pl-xl-3">
                    <p>
                      <?= nl2br($cate[6]); ?>
                    </p>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
              <h2>Moda Fres-Art</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="nonloop-block-3 owl-carousel">
                <?php
                  $re= $conexion->query("select * from productos where id_categoria=(select id_categoria from productos where id=".$id.") and id!=".$id." order by precio") or die($conexion->error);
                  while ($f=mysqli_fetch_array($re)) {
                ?>
                <div class="item">
                  <div class="block-4 text-center">
                    <a href="<?= BASE_URL_TIENDA; ?>producto/<?= $f['id'].'/'.$f['url'];?>" class="box-hover">
                      <figure class="img-height-carrucel">
                        <?php if ($f['precio_oferta'] != 0) { ?><div class="oferta"></div><?php } ?>
                        <?php if ($f['nuevo'] == 1) { ?><div class="nuevo" style="margin-right: -10px;"></div><?php } ?>
                        <img src="<?= BASE_URL_TIENDA; ?>images/small/<?php echo $f['imagen2'];?>" alt="<?php echo $f['nombre']; ?>" class="img-fluid">
                      </figure>
                      <div class="block-4-text p-4">
                        <h3 class="bg-primary text-white p-2"><?php echo $f['nombre'];?></h3>
                        <p class="mb-2 mt-1 text-black"><?php echo $f['descripcion'];?></p>
                        <h4 class="text-primary font-weight-bold">
                          <?php if ($f['precio_oferta'] != 0) { ?>
                            <small class="text-secondary mr-2" style="text-decoration: line-through;">S/. <?php echo number_format($f['precio_oferta'], 2, '.', ''); ?></small> 
                          <?php } ?>
                          S/. <?php echo number_format($f['precio'], 2, '.', '');?></h4>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("layouts/footer.php"); ?>
    </div>

    <script src="<?= BASE_URL_TIENDA; ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/jquery-ui.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/popper.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/owl.carousel.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/jquery.mousewheel.min.js"></script>
    <script src="<?= BASE_URL_TIENDA; ?>js/aos.js"></script>

    <script src="<?= BASE_URL_TIENDA; ?>js/main.js"></script>
  </body>
</html>