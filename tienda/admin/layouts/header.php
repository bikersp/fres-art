
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../" class="brand-link">
      <img src="../images/logo2.png" alt="AdminLTE Logo" class="brand-image"
           style="opacity: 1">
      <span class="brand-text font-weight-light"><small>Home</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/users/<?php echo $arregloUsiario['imagen']; ?>" class="img-circle elevation-2" alt="<?php echo $arregloUsiario['nombre']; ?>">
        </div>
        <div class="info">
          <a class="d-block"><?php echo $arregloUsiario['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="./" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pedidos" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Pedidos
              </p>
            </a>
          </li>

          <?php 
            if ($arregloUsiario['nivel'] == 'admin') {
          ?>
          <li class="nav-item">
            <a href="banners" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banners
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="fotos" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Fotos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="redes" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Redes Sociales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productos" class="nav-link">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cupones" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Cupones
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="chat" class="nav-link">
              <i class="nav-icon far fa-comment-dots"></i>
              <p>
                Chat
              </p>
            </a>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a href="../php/cerrar_sesion.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Salir
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>