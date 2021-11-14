<?php
  session_start();
  include('./php/conexion.php');
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
    <link type="image/x-icon" rel="shortcut icon" href="images/icons/favicon.ico"/>
    <link type="image/x-icon" rel="apple-touch-icon" href="images/icons/favicon.ico"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/all.min.css"/>
    <link type="text/css" rel="stylesheet" href="fonts/icomoon/style.css">
    <link type="text/css" rel="stylesheet" href="css/magnific-popup.css">
    <link type="text/css" rel="stylesheet" href="css/jquery-ui.css">
    <link type="text/css" rel="stylesheet" href="css/owl.carousel.min.css">
    <link type="text/css" rel="stylesheet" href="css/owl.theme.default.min.css">
    <link type="text/css" rel="stylesheet" href="css/aos.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <div class="site-wrap">
      <?php include("./layouts/header.php"); ?>

      <div class="site-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-9 order-2">
              <div class="row">
                <!-- Header Products -->
                <div class="col-md-12">
                  <div class="float-md-left mb-4"><h2 class="text-black h5">Productos</h2></div>

                  <div class="d-flex">
                    <div class="dropdown mr-1 ml-md-auto mb-3">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <?php 
                        $re4= $conexion->query("select * from categorias") or die($conexion->error);
                        while ($f = mysqli_fetch_array($re4)) {
                        ?>
                        <a class="dropdown-item" href="busqueda.php?texto=<?php echo $f['nombre']?>"><?php echo $f['nombre']?></a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Pagination  -->
                <div class="col-md-12 text-center mb-4">
                  <div class="site-block-27">
                    <ul>
                      <?php
                        $limite= 9;
                        $totalQuery= $conexion->query("select count(*) from productos") or die($conexion ->error);
                        $totalProductos= mysqli_fetch_row($totalQuery);
                        $totalBotones= ceil($totalProductos[0]/$limite);

                        if (isset($_GET['limite'])) {
                          $resultado= $conexion ->query("select * from productos where inventario > 0 order by indice ASC limit ".$_GET['limite'].",".$limite) or die($conexion ->error);
                        }else{
                          $resultado= $conexion ->query("select * from productos where inventario > 0 order by indice ASC limit ".$limite) or die($conexion ->error);
                        }

                        if (isset($_GET['limite'])) {
                          if ($_GET['limite']>0) {
                            echo '<li><a href="index.php?limite='.($_GET['limite']-9).'"><i class="fas fa-arrow-left"></i></a></li>';
                          }
                        }

                        for ($k=0; $k < $totalBotones; $k++) {
                          if (isset($_GET['limite'])) {
                            if ($_GET['limite'] == (9*$k)) {
                              echo '<li class="active"><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }else{
                              echo '<li><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }
                          }else{
                            if (($k+1) == 1) {
                              echo '<li class="active"><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }else{
                              echo '<li><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }
                          }
                        }

                        if (isset($_GET['limite'])) {
                          if ($_GET['limite']+9 < $totalBotones*9) {
                            echo '<li><a href="index.php?limite='.($_GET['limite']+9).'"><i class="fas fa-arrow-right"></i></a></li>';
                          }
                        }else{
                          if ($totalProductos[0] < 9) {
                          }else{
                            echo '<li><a href="index.php?limite=9"><i class="fas fa-arrow-right"></i></a></li>';
                          }
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Section Products -->
              <div class="row mb-2">
                <?php
                  while ($fila=mysqli_fetch_array($resultado)) {
                ?>
                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <a href="producto/<?= $fila['id'].'/'.$fila['url']; ?>" class="box-hover">
                    <div class="block-4 text-center border">
                      <figure class="block-4-image home-content-img">
                        <?php if ($fila['precio_oferta'] != 0) { ?><div class="oferta"></div><?php } ?>
                        <?php if ($fila['nuevo'] == 1) { ?><div class="nuevo"></div><?php } ?>
                        <img src="images/small/<?php echo $fila['imagen2'];?>" alt="<?php echo $fila['nombre']; ?>" class="img-fluid img-height-limit px-4 pt-2">
                      </figure>
                      <div class="block-4-text px-2 pt-0 pb-0 mt-0">
                        <h3 class="bg-purple p-2 text-white"><?php echo $fila['nombre']; ?></h3>
                        <p class="mb-0 text-primary"><?php echo $fila['descripcion']; ?></p>
                        <p class="text-primary font-weight-bold mb-1">
                          <?php if ($fila['precio_oferta'] != 0) { ?>
                            <span class="text-secondary mr-2" style="text-decoration: line-through;">S/. <?php echo number_format($fila['precio_oferta'], 2, '.', ''); ?></span> 
                          <?php } ?>
                          S/. <?php echo number_format($fila['precio'], 2, '.', ''); ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
                <?php } ?>
              </div>

              <!--Pagination  -->
              <div class="row" data-aos="fade-up">
                <div class="col-md-12 text-center">
                  <div class="site-block-27">
                    <ul>
                      <?php
                        if (isset($_GET['limite'])) {
                          if ($_GET['limite']>0) {
                            echo '<li><a href="index.php?limite='.($_GET['limite']-9).'"><i class="fas fa-arrow-left"></i></a></li>';
                          }
                        }

                        for ($k=0; $k < $totalBotones; $k++) {
                          if (isset($_GET['limite'])) {
                            if ($_GET['limite'] == (9*$k)) {
                              echo '<li class="active"><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }else{
                              echo '<li><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }
                          }else{
                            if (($k+1) == 1) {
                              echo '<li class="active"><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }else{
                              echo '<li><a href="index.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                            }
                          }
                        }

                        if (isset($_GET['limite'])) {
                          if ($_GET['limite']+9 < $totalBotones*9) {
                            echo '<li><a href="index.php?limite='.($_GET['limite']+9).'"><i class="fas fa-arrow-right"></i></a></li>';
                          }
                        }else{
                          if ($totalProductos[0] < 9) {
                          }else{
                            echo '<li><a href="index.php?limite=9"><i class="fas fa-arrow-right"></i></a></li>';
                          }
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Section Filters  -->
            <div class="col-md-3 order-1 mb-5 mb-md-0 d-none d-md-block">
              <!--Categories  -->
              <div class="p-4 rounded mb-4 bg-grey" style="max-width: 200px;">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Categorias</h3>
                <ul class="list-unstyled mb-0">
                  <?php 
                  $re= $conexion->query("select * from categorias") or die($conexion->error);
                  while ($f = mysqli_fetch_array($re)) {
                  ?>
                  <li class="mb-1">
                    <a href="busqueda.php?texto=<?php echo $f['nombre'];?>" class="d-flex box-color">
                      <span><?php echo $f['nombre'];?></span> 
                      <span class="ml-auto">
                        <?php 
                          $re2= $conexion->query("select count(*) from productos where id_categoria=".$f['id']) or die($conexion->error);
                          $fila = mysqli_fetch_row($re2);
                          echo $fila[0];
                        ?>
                      </span>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </div>

              <!-- Color  -->
              <div class="p-4 rounded mb-4 bg-grey" style="max-width: 200px;">
                <div class="mb-4">
                  <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                  <?php 
                    $re= $conexion->query("select * from colores") or die($conexion->error);
                    while ($f=mysqli_fetch_array($re)) {
                  ?>
                  <a href="busqueda.php?texto=<?php echo $f['color'];?>" class="d-flex color-item align-items-center" >
                    <span style="border:1px solid #bdbdbd;background-color: <?php echo $f['codigo'];?>" class="color d-inline-block rounded-circle mr-2"></span> <span class="text-muted"><?php echo $f['color'];?></span>
                  </a>
                  <?php } ?>
                </div>
                <div class="mb-4">
                  <h3 class="mb-3 h6 text-uppercase text-black d-block">Tallas</h3>
                  <?php 
                    $re5= $conexion->query("select * from tallas") or die($conexion->error);
                    while ($f=mysqli_fetch_array($re5)) {
                  ?>
                  <a href="busqueda.php?texto=<?php echo $f['talla'];?>" class="d-flex color-item align-items-center" >
                    <span class="text-muted"><?php echo $f['talla'];?></span>
                  </a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Section Categories -->
          <div class="row d-none d-md-block">
            <div class="col-md-12">
              <div class="site-section site-blocks-2">
                  <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-7 site-section-heading pt-4">
                      <h2>Categorias</h2>
                    </div>
                  </div>
                  <div class="row">
                    <?php 
                    $re2= $conexion->query("select * from categorias where id<=4") or die($conexion->error);
                    while ($f = mysqli_fetch_array($re2)) {
                    ?>
                    <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                      <a class="block-2-item" href="busqueda.php?texto=<?php echo $f['nombre']?>">
                        <figure class="image">
                          <img src="images/<?php echo $f['imagen']?>" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                          <span class="text-uppercase">Fres-Art</span>
                          <h3><?php echo $f['nombre'];?></h3>
                        </div>
                      </a>
                    </div>
                    <?php } ?>
                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <?php include("./layouts/footer.php"); ?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>