<?php 
include("./php/conexion.php");
if (!isset($_GET['id_venta'])) {
  header('Location: index.php');
}
$id_venta=base64_decode($_GET['id_venta']);
$datos=$conexion ->query("select 
  ventas.*,
  usuario.nombre,usuario.apellido,usuario.telefono,usuario.email
  from ventas 
  inner join usuario on ventas.id_usuario = usuario.id
  where ventas.id=".$id_venta) or die($conexion->error);
$datosUsuario= mysqli_fetch_row($datos);

$envios=$conexion ->query("select * from envios where id_venta=".$id_venta) or die($conexion->error);
$datosEnvio= mysqli_fetch_row($envios);

$productos=$conexion->query("
  select productos_venta.*, productos.nombre, productos.imagen
  from productos_venta 
  inner join productos on productos_venta.id_producto = productos.id
  where productos_venta.id_venta=".$id_venta)or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Pedido</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobileOptimized" content="width"/>
    <meta name="handheldFriendly" content="true"/>

    <!-- Seo Meta-->
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="revisit" content="15 days"/>
    <meta name="author" content="Jean Cuadros"/>
    <meta name="Copyright" content="<?= WEB; ?>"/>
    <meta name="title" content="<?= TITLE_WEB; ?>"/>
    <meta name="Description" content=""/>

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= TITLE_WEB; ?>">
    <meta property="og:url" content="<?= WEB; ?>">
    <meta property="og:image" content="<?= BASE_URL; ?>/img/logo2.png">
    <meta property="og:description" content="">

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

    <div class="site-section pt-3">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-2">
            <h5 class="text-success">ID PEDIDO: #<?php echo base64_decode($_GET['id_venta']);?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <h5 class="text-primary">Datos de Cliente</h5>
            <p><b>Nombre Cliente:</b>  <?php echo $datosUsuario[7];?> <?php echo $datosUsuario[8];?></p>
            <p><b>Email Cliente:</b> <?php echo $datosUsuario[10];?></p>
            <p><b>Teléfono:</b> <?php echo $datosUsuario[9];?></p>
          </div>
          <div class="col-4">
            <h5 class="text-primary">Datos de Envio</h5>
            <p><b>Ciudad:</b> <?php echo $datosEnvio[2];?></p>
            <p><b>Distrito:</b> <?php echo $datosEnvio[4];?></p>
            <p><b>Direccion:</b> <?php echo $datosEnvio[3];?></p>
          </div>
          <div class="col-4">
            <h5 class="text-primary">Datos de Pedido</h5>
            <p><b>Estado:</b> <?php if ($datosUsuario[4] == 'pendiente') { echo "Pendiente a Pagar";}else{echo $datosUsuario[4];}?></p>
            <p><b>Delibery:</b> <?php if ($datosUsuario[2] <= 160) {echo "S/. ".$datosUsuario[6].".00";}else{echo "Gratis";}?></p>
            <p><b>Total:</b> S/. <?php echo number_format($datosUsuario[2], 2, '.', '');?></p>
          </div>
        </div>

        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-name">Talla</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-price">Precio</th>
                    <th class="product-total">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($f2 = mysqli_fetch_array($productos)) { ?>
                  <tr>
                    <td>
                      <img src="images/small/<?php echo $f2['imagen']; ?>" alt="Image" class="img-fluid" width="40px"></td>
                    <td><?php echo $f2['nombre']; ?></td>
                    <td><?php echo $f2['talla']; ?></td>
                    <td><?php echo $f2['cantidad']; ?></td>
                    <td>S/. <?php echo number_format($f2['precio'],2,'.',''); ?></td>
                    <td>S/. <?php echo number_format($f2['subtotal'],2,'.',''); ?></td>
                  </tr> 
                  <?php }?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6">
                <a href="<?= BASE_URL_TIENDA; ?>"><button class="btn btn-outline-primary btn-sm btn-block">Continuar Comprando</button></a>
              </div>
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