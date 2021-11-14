<header class="site-navbar" role="banner">
  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="<?= BASE_URL; ?>busqueda.php" class="site-block-top-search" method="GET">
            <span class="icon icon-search2"></span>
            <input type="text" class="form-control border-0" placeholder="Buscar" name="texto">
          </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <div class="site-logo">
            <a href="<?= BASE_URL_TIENDA; ?>" class="js-logo-clone"><img src="<?= BASE_URL_TIENDA; ?>images/logo.png" width="147" alt=""></a>
          </div>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
          <div class="site-top-icons">
            <ul>
              <li><a href="<?= BASE_URL_TIENDA; ?>login"><span class="icon icon-person"></span></a></li>
              <li>
                <a href="<?= BASE_URL_TIENDA; ?>carrito-de-compras" class="site-cart">
                  <span class="icon icon-shopping_cart"></span>
                  <span class="count">
                    <?php 
                    if (isset($_SESSION['carrito'])) {
                      echo count($_SESSION['carrito']);
                    }else{
                      echo 0;
                    } ?>
                  </span>
                </a>
              </li> 
              <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
            </ul>
          </div> 
        </div>

      </div>
    </div>
  </div> 
  <nav class="site-navigation text-right text-md-center bg-fa" role="navigation">
    <div class="container">
      <ul class="site-menu js-clone-nav d-none d-md-block">
        <li><a href="<?= BASE_URL; ?>">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?= BASE_URL_TIENDA; ?>">Tienda</a>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a href="<?= BASE_URL_TIENDA; ?>">Store</a></li>
            <?php 
              $consultas= $conexion->query("select * from categorias") or die($conexion->error);
              while ($filac = mysqli_fetch_array($consultas)) {
            ?>
            <li class="dropdown-item"><a href="<?= BASE_URL_TIENDA; ?>busqueda.php?texto=<?php echo $filac['nombre'];?>"><?php echo $filac['nombre'];?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="<?= BASE_URL; ?>#about">Concepto</a></li>
        <li><a href="<?= BASE_URL; ?>#gallery">Fotos</a></li>
        <li><a href="<?= BASE_URL; ?>#contact">Contactos</a></li>
      </ul>
    </div>
  </nav>
</header>

<div class=" py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?= BASE_URL_TIENDA; ?>" class="text-primary"><b>Tienda</b></a> <span class="mx-2 mb-0">/</span>
       <strong class="text-black">Productos</strong></div>
    </div>
  </div>
</div>