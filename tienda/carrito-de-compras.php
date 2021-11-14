<?php 
session_start();
include("./php/conexion.php");
if (isset($_SESSION['carrito'])) {
  if (isset($_POST['id'])) {
    $arreglo=$_SESSION['carrito'];
    $encontro=false;
    $numero=0;

    for ($i=0; $i < count($arreglo); $i++) { 
      if ($arreglo[$i]['Id'] == $_POST['id'] && $arreglo[$i]['Talla'] == $_POST['talla']) {
        $encontro=true;
        $numero=$i;
      }
    }

    if ($encontro == true) {
      $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+$_POST['cantidad'];
      $_SESSION['carrito']=$arreglo;      
      header("Location: ".BASE_URL_TIENDA."carrito-de-compras");
    }else{
      //Si no estaba el registro
      $nombre="";
      $talla="";
      $precio="";
      $imagen="";
      $res= $conexion ->query("select * from productos where id=".$_POST['id']) or die($conexion -> error);
      $fila = mysqli_fetch_row($res);
      $nombre=$fila[1];
      $precio=$fila[3];
      $imagen=$fila[10];
      $arregloNuevo= array(
        'Id'=> $_POST['id'],
        'Nombre'=> $nombre,
        'Precio'=> $precio,
        'Imagen'=> $imagen,
        'Cantidad'=> $_POST['cantidad'],
        'Talla'=> $_POST['talla']
      );
      array_push($arreglo, $arregloNuevo);
      $_SESSION['carrito']=$arreglo;
      header("Location: ".BASE_URL_TIENDA."carrito-de-compras");
    }
  }
}else{
  //creando variable de session
  if (isset($_POST['id'])) {
    $nombre="";
    $precio="";
    $imagen="";
    $res= $conexion ->query("select * from productos where id=".$_POST['id']) or die($conexion -> error);
    $fila = mysqli_fetch_row($res);
    $nombre=$fila[1];
    $precio=$fila[3];
    $imagen=$fila[10];
    $arreglo[]= array(
      'Id'=> $_POST['id'],
      'Nombre'=> $nombre,
      'Precio'=> $precio,
      'Imagen'=> $imagen,
      'Cantidad'=> $_POST['cantidad'],
      'Talla'=> $_POST['talla']
    );
    $_SESSION['carrito']=$arreglo;
    header("Location: ".BASE_URL_TIENDA."carrito-de-compras");
  }
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Carrito de Compras</title>
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

    <div class="site-section">
      <div class="container">

        <div class="row mb-5" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li class="active mr-4"><a class="font-weight-bold" style="font-size:20px;">1</a> <h3 class="d-inline-block font-weight-bold text-black">Carrito</h3></li>
                <li class="active mr-4"><a class="font-weight-bold" style="font-size:20px;">2</a> <h3 class="d-inline-block font-weight-bold" style="color:#ccc;">Detalle de Compra</h3></li>
              </ul>
            </div>
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
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $total = 0;
                    if (isset($_SESSION['carrito'])) {
                      $arregloCarrito=$_SESSION['carrito'];
                      for ($i=0; $i < count($arregloCarrito); $i++) {
                        $total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
                  ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="images/small/<?php echo $arregloCarrito[$i]['Imagen'];?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre'];?></h2>
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Talla'];?></h2>
                    </td>
                    <td>S/. <?php echo number_format($arregloCarrito[$i]['Precio'], 2, '.', '');?></td>
                    <td style="min-width: 140px;">
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus btnIncrementar restar" type="button">&minus;</button>
                        </div>
                        <input type="text"class="form-control text-center txtCantidad <?php echo $arregloCarrito[$i]['Id'],$arregloCarrito[$i]['Talla'];?>" 
                        data-talla="<?php echo $arregloCarrito[$i]['Talla'];?>"
                        data-precio="<?php echo $arregloCarrito[$i]['Precio'];?>"
                        data-id="<?php echo $arregloCarrito[$i]['Id'];?>"
                        value="<?php echo $arregloCarrito[$i]['Cantidad'];?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus btnIncrementar sumar" type="button">&plus;</button>
                        </div>
                      </div>
                    </td>
                    <td class="cant<?php echo $arregloCarrito[$i]['Id'],$arregloCarrito[$i]['Talla'];?>">
                      S/. <?php echo number_format(($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']), 2, '.', '');?>
                    </td>
                    <td><button class="btn btn-primary btn-sm btnEliminar" 
                      data-indice="<?php echo $i;?>"
                      data-precio="<?php echo $arregloCarrito[$i]['Precio'];?>" 
                      data-cantidad="<?php echo $arregloCarrito[$i]['Cantidad'];?>"
                      >X</button></td>
                  </tr>
                  <?php 
                      }
                    }
                  ?>                              
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
          
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Carrito Total</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black sumaTotal">S/. <?php echo number_format($total, 2, '.', '');?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black sumaTotal">S/. <?php echo number_format($total, 2, '.', '');?></strong>
                    <form name="formtempo">
                      <input type="hidden" class="temptotal" name="temptotal" value="<?php echo $total;?>">
                    </form>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='<?= BASE_URL_TIENDA; ?>checkout'">Proceder Compra</button>
                  </div>
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
  <script>
    $(document).ready(function(){
      $(".btnEliminar").click(function(event){
        event.preventDefault();
        var indice = $(this).data('indice');
        var precio = $(this).data('precio');
        var cantidad = $(this).data('cantidad');
        var boton = $(this);

        var mult = parseFloat(cantidad) * parseFloat(precio);
        var nuevotemporal = document.formtempo.temptotal.value;   
        var total = parseFloat(nuevotemporal) - parseFloat(mult);
        
        $(".sumaTotal").text("S/. "+total+".00");

        $(".count").text(parseFloat($(".count").text()) - 1);
        $.ajax({
          method: 'POST',
          url: 'php/eliminarcarrito.php',
          data: {
            indice:indice
          }
        }).done(function(respuesta){
          boton.parent('td').parent('tr').remove();
        });
      });

      $(".sumar").click(function(){        
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var cantidad = $(this).parent('div').parent('div').find('input').val();
        var sub = $(".temptotal").val();
        var total = parseFloat(sub) + parseFloat(precio);
        $(".temptotal").val(total);
        var nuevotemporal = document.formtempo.temptotal.value;
        $(".sumaTotal").text("S/. "+nuevotemporal+".00");
      });
      $(".restar").click(function(){
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var cantidad = $(this).parent('div').parent('div').find('input').val();
        var sub = $(".temptotal").val();
        if (cantidad >= 1) {
          var total = parseFloat(sub) - parseFloat(precio);
          $(".temptotal").val(total);
          var nuevotemporal = document.formtempo.temptotal.value;
          $(".sumaTotal").text("S/. "+nuevotemporal+".00");
        }
      });

      $(".txtCantidad").keyup(function(){
        var cantidad = $(this).val();
        var precio = $(this).data('precio');
        var id = $(this).data('id');
        incrementar(cantidad,precio,id);
      });
      $(".btnIncrementar").click(function(){
        var talla = $(this).parent('div').parent('div').find('input').data('talla');
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var id = $(this).parent('div').parent('div').find('input').data('id');
        var cantidad = $(this).parent('div').parent('div').find('input').val();
        incrementar(cantidad,precio,id,talla);
      });
      function incrementar(cantidad, precio, id, talla){
        var mult = parseFloat(cantidad) * parseFloat(precio);
        if (cantidad == 0) {
          $("."+id+talla).val(1);
        }else{
          $(".cant"+id+talla).text("S/. "+mult+".00");
          $.ajax({
            method: 'POST',
            url: './actualizar.php',
            data: {
              id:id,
              cantidad: cantidad,
              talla: talla
            }
          }).done(function(respuesta){            
          });
        }
      }

    });
  </script> 
    
  </body>
</html>