<?php 
  session_start();
  include("php/conexion.php");
  if (isset($_SESSION['datos_login'])) {
      header('Location: admin/');
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>  
    <title><?= TITLE_WEB; ?> - Login</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobileOptimized" content="width"/>
    <meta name="handheldFriendly" content="true"/>

    <!-- Seo Meta-->
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="author" content="Jean Cuadros"/>

    <!-- Icos -->
    <link type="image/x-icon" rel="shortcut icon" href="images/icons/favicon.ico"/>
    <link type="image/x-icon" rel="apple-touch-icon" href="images/icons/favicon.ico"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="./admin/dashboard/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./admin/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./admin/dashboard/dist/css/adminlte.min.css">
  </head>
<body class="hold-transition login-page">
<div class="login-box">
  <?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      La Usuario o Contraseña no son validos
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>
  <div class="login-logo">
    <a href="<?= BASE_URL_TIENDA; ?>"><b>Fres-Art</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>

      <form action="./php/check.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
        <br>
        <br>
          <?php 
            // if(isset($_GET['error'])){
            //   echo '<div class="col-12 alert alert-danger">'.$_GET['error'].'</div>';
            // }
          ?>
        </div>
      </form>

     

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <p class="mb-0">
        <a href="register" class="text-center">Registrar una nueva Cuenta</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./admin/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./admin/dashboard/dist/js/adminlte.min.js"></script>

</body>
</html>