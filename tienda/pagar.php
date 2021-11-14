<?php 
include("./php/conexion.php");
if (!isset($_GET['id_venta'])) {
  header('Location: index.php');
}

$datos=$conexion ->query("select 
  ventas.*,
  usuario.nombre,usuario.apellido,usuario.telefono,usuario.email,usuario.telefono
  from ventas 
  inner join usuario on ventas.id_usuario = usuario.id
  where ventas.id=".$_GET['id_venta']) or die($conexion->error);
$datosUsuario= mysqli_fetch_row($datos);

$datos2=$conexion ->query("select * from envios where id_venta=".$_GET['id_venta']) or die($conexion->error);
$datosEnvio= mysqli_fetch_row($datos2);

$datos3=$conexion ->query("select productos_venta.*,
  productos.nombre as nombre_producto, productos.imagen
  from productos_venta 
  inner join productos on productos_venta.id_producto = productos.id 
  where id_venta=".$_GET['id_venta']) or die($conexion->error);

$total = $datosUsuario[2];
$descuento = "0";
$banderadescuento = false;

if ($datosUsuario[6] != 0) {
	$banderadescuento= true;
	$cupon= $conexion->query("select * from cupones where id=".$datosUsuario[6]) or die($conexion->error);
	$filaCupon =mysqli_fetch_row($cupon);
	if ($filaCupon[3] == "moneda"){
		$total = $total - $filaCupon[4];
		$descuento= " S/. ".number_format($filaCupon[4], 2, '.', '');
	}else{
		$total= $total - ($total * ($filaCupon[4]/100));		
		$descuento= $filaCupon[4]."%";
	}
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Metodo de Pago</title>
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
    <meta name="Description" content="Description"/>

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= TITLE_WEB; ?>">
    <meta property="og:url" content="<?= WEB; ?>">
    <meta property="og:image" content="<?= BASE_URL; ?>/img/logo2.png">
    <meta property="og:description" content="Description">

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
    <script src="https://www.paypal.com/sdk/js?client-id=Aab2ARV-epCU--iWjZUkHkwnRetqcJz3_d_W3NxTYE4P8wW4RX-OHodGVL8lP3NGC4xVkQ281-fpjESR"></script>
  
  <div class="site-wrap">
  <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">

        <div class="row mb-5" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li class="active mr-4"><a href="#" class="font-weight-bold" style="font-size:20px;">1</a> <h3 class="d-inline-block font-weight-bold" style="color:#ccc;">Carrito</h3></li>
                <li class="active mr-4"><a href="#" class="font-weight-bold" style="font-size:20px;">2</a> <h3 class="d-inline-block font-weight-bold" style="color:#ccc;">Detalle de Compra</h3></li>
                <li class="active mr-4"><a href="#" class="font-weight-bold" style="font-size:20px;">3</a> <h3 class="d-inline-block font-weight-bold text-black">Metodo de Pago</h3></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Metodo de Pago</h2>
          </div>
          <div class="col-md-6">

            <form action="#" method="post">
              
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"><b class="text-primary">Nombre:</b> <?php echo $datosUsuario[7];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"><b class="text-primary">Apellido:</b> <?php echo $datosUsuario[8];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"><b class="text-primary">Email:</b> <?php echo $datosUsuario[10];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"><b class="text-primary">Teléfono:</b> <?php echo $datosUsuario[9];?></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black"><b class="text-primary">Dirección:</b> <?php echo $datosEnvio[3];?></label>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6 ml-auto">
            <h5>Subtotal: S/. <?php echo number_format($datosUsuario[2], 2, '.', '');?></h5>
            <h5>Descuento: <?php echo $descuento; ?></h5>
            <h4 class="h1">Total: S/.<?php echo number_format($total, 2, '.', ''); ?></h4>
            <div id="paypal-button-container"></div>
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
  <script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '<?php echo $total; ?>'
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
          // This function shows a transaction success message to your buyer.
          //console.log(details);
          if (details.status == 'COMPLETED') {          	
          	//alert('Transaction completed by ' + details.payer.name.given_name);
          	location.href="thankyou.php?id_venta=<?php echo $_GET['id_venta'];?>&metodo=paypal";
          }
        });
      }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
  </script>
    
  </body>
</html>