<?php 
  session_start();
  include("../php/conexion.php");
  if (!isset($_SESSION['datos_login'])) {
    header('Location: ../index.php');
  }
  $arregloUsiario= $_SESSION['datos_login'];
  if ($arregloUsiario['nivel'] != 'admin') {
    header('Location: pedidos_usuarios');    
  }
  $resultado= $conexion->query("
    select ventas.*, usuario.nombre, usuario.apellido, usuario.telefono, usuario.email
    from ventas
    inner join usuario on ventas.id_usuario = usuario.id 
    where status = 'pendiente'
    order by fecha Desc
    ")or die($conexion->error);
  $resultado2= $conexion->query("
    select ventas.*, usuario.nombre, usuario.apellido, usuario.telefono, usuario.email
    from ventas
    inner join usuario on ventas.id_usuario = usuario.id 
    where status = 'pagado'
    order by fecha Desc
    ")or die($conexion->error);
  $resultado3= $conexion->query("
    select ventas.*, usuario.nombre, usuario.apellido, usuario.telefono, usuario.email
    from ventas
    inner join usuario on ventas.id_usuario = usuario.id 
    where status = 'entregado'
    order by fecha Desc
    ")or die($conexion->error);
?>
<!-- where ventas.status='pagado' order by fecha Desc -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Pedidos</title>
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
    <link type="image/x-icon" rel="shortcut icon" href="../images/icons/favicon.ico"/>
    <link type="image/x-icon" rel="apple-touch-icon" href="../images/icons/favicon.ico"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="dashboard/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dashboard/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dashboard/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dashboard/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="dashboard/plugins/summernote/summernote-bs4.css">
  </head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php include("layouts/header.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedidos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="accordion" id="accordionExample">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pendiente-tab" data-toggle="tab" href="#pendiente" role="tab" aria-controls="pendiente" aria-selected="true">Pendiente</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pagado-tab" data-toggle="tab" href="#pagado" role="tab" aria-controls="pagado" aria-selected="false">Pagado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="entregado-tab" data-toggle="tab" href="#entregado" role="tab" aria-controls="entregado" aria-selected="false">Entregado</a>
            </li>
          </ul>

          <div class="tab-content pt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="pendiente" role="tabpanel" aria-labelledby="home-tab">
              <?php 
                while ($f=mysqli_fetch_array($resultado)) {
              ?>
              <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'];?>">
                  <h5 class="mb-0">
                    <div class="row">
                      <div class="col-sm-10">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'];?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id'];?>">                  
                          <?php 
                          $color="black"; 
                          if ($f['status'] == 'entregado') { $color="#0AAE31";}
                          if ($f['status'] == 'pagado') { $color="orange";}
                          if ($f['status'] == 'pendiente') { $color="red";}
                          ?> 
                          <b class="mr-3" style="color:<?php echo $color;?>">ID Pedido: <?php echo $f['id'];?></b>            
                          <span style="color: #8B8B8B"><b>Fecha de pedido:</b> <?php echo $f['fecha'].' / <b>Cliente:</b> '.$f['nombre'].'   '.$f['apellido'];?></span>
                        </button>
                      </div>
                      <div class="col-sm-2 text-right">
                        <button class="btn btn-secondary btnEntregado d-inline-block" data-id="<?php echo $f['id'];?>" data-status="pendiente" data-toggle="modal" data-target="#modalEntregado">
                          <i class="fas fa-dollar-sign"></i>
                        </button>
                      </div>
                    </div>
                  </h5>
                </div>

                <div id="collapse<?php echo $f['id'];?>" class="collapse" aria-labelledby="heading<?php echo $f['id'];?>" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Cliente</h5>
                        <p><b>Nombre Cliente:</b>  <?php echo $f['nombre'];?> <?php echo $f['apellido'];?></p>
                        <p><b>Email Cliente:</b> <?php echo $f['email'];?></p>
                        <p><b>Teléfono:</b> <?php echo $f['telefono'];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de envio</h5>
                        <?php 
                          $envios=$conexion->query("select * from envios where id_venta=".$f['id'])or die($conexion->error);
                          $fila=mysqli_fetch_row($envios);
                        ?>
                        <p><b>Ciudad:</b> <?php echo $fila[2];?></p> 
                        <p><b>Distrito:</b> <?php echo $fila[4];?></p> 
                        <p><b>Dirección:</b> <?php echo $fila[3];?></p> 
                        <p><b>Referencia:</b> <?php echo $fila[5];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Pedido</h5>
                        <p><b>Estado:</b> <?php echo $f['status'];?></p>
                        <?php 
                          $cupon= $conexion->query("select * from cupones where id=".$f['id_cupon']) or die($conexion->error);
                          $filaCupon=mysqli_fetch_row($cupon);
                          $total = $f['total'];
                          $descuento = "No Usado";
                          $banderadescuento = false;
                          if ($f['id_cupon'] != 0) {
                            $banderadescuento= true;
                            if ($filaCupon[3] == "moneda"){
                              $total = $total - $filaCupon[4];
                              $descuento= " S/. ".number_format($filaCupon[4], 2, '.', '');
                            }else{
                              $total= $total - ($total * ($filaCupon[4]/100));    
                              $descuento= $filaCupon[4]."%";
                            }
                          }
                        ?>
                        <p><b>Cupon:</b> <?php echo $descuento;?></p>
                        <p><b>Delibery:</b> <?php if ($f['delibery'] <= 160) {echo "S/. ".$f['delibery'].".00";}else{echo "Gratis";}?></p>
                        <p><b>Total:</b> S/. <?php echo number_format($total, 2, '.', '');?></p>
                      </div>
                    </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Talla</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $re=$conexion->query("
                            select productos_venta.*, productos.nombre
                            from productos_venta 
                            inner join productos on productos_venta.id_producto = productos.id
                            where productos_venta.id_venta=".$f['id'])or die($conexion->error);
                          while ($f2 = mysqli_fetch_array($re)) {
                        ?>
                        <tr>
                          <td><?php echo $f2['id']; ?></td>
                          <td><?php echo $f2['nombre']; ?></td>
                          <td><?php echo $f2['talla']; ?></td>
                          <td><?php echo $f2['cantidad']; ?></td>
                          <td>S/.<?php echo number_format($f2['precio'],2,'.',''); ?></td>
                          <td>S/.<?php echo number_format($f2['subtotal'],2,'.',''); ?></td>
                        </tr>   
                        <?php } ?>     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>

            <div class="tab-pane fade" id="pagado" role="tabpanel" aria-labelledby="pagado-tab">
              <?php 
                while ($f=mysqli_fetch_array($resultado2)) {
              ?>
              <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'];?>">
                  <h5 class="mb-0">
                    <div class="row">
                      <div class="col-sm-10">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'];?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id'];?>">                  
                          <?php 
                          $color="black"; 
                          if ($f['status'] == 'entregado') { $color="#0AAE31";}
                          if ($f['status'] == 'pagado') { $color="orange";}
                          if ($f['status'] == 'pendiente') { $color="red";}
                          ?> 
                          <b class="mr-3" style="color:<?php echo $color;?>">ID Pedido: <?php echo $f['id'];?></b>            
                          <span style="color: #8B8B8B"><b>Fecha de pedido:</b> <?php echo $f['fecha'].' / <b>Cliente:</b> '.$f['nombre'].'   '.$f['apellido'];?></span>
                        </button>
                      </div>
                      <div class="col-sm-2 text-right">           
                        <button class="btn btn-secondary btnEntregado d-inline-block" data-id="<?php echo $f['id'];?>" data-status="pagado" data-toggle="modal" data-target="#modalEntregado">
                          <i class="fas fa-shuttle-van"></i>
                        </button>
                      </div>
                    </div>
                  </h5>
                </div>

                <div id="collapse<?php echo $f['id'];?>" class="collapse" aria-labelledby="heading<?php echo $f['id'];?>" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Cliente</h5>
                        <p><b>Nombre Cliente:</b>  <?php echo $f['nombre'];?></p>
                        <p><b>Email Cliente:</b> <?php echo $f['email'];?></p>
                        <p><b>Teléfono:</b> <?php echo $f['telefono'];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de envio</h5>
                        <?php 
                          $envios=$conexion->query("select * from envios where id_venta=".$f['id'])or die($conexion->error);
                          $fila=mysqli_fetch_row($envios);
                        ?>
                        <p><b>Ciudad:</b> <?php echo $fila[2];?></p> 
                        <p><b>Distrito:</b> <?php echo $fila[4];?></p> 
                        <p><b>Dirección:</b> <?php echo $fila[3];?></p> 
                        <p><b>Referencia:</b> <?php echo $fila[5];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Pedido</h5>
                        <p><b>Estado:</b> <?php echo $f['status'];?></p>
                        <?php 
                          $cupon= $conexion->query("select * from cupones where id=".$f['id_cupon']) or die($conexion->error);
                          $filaCupon=mysqli_fetch_row($cupon);
                          $total = $f['total'];
                          $descuento = "No Usado";
                          $banderadescuento = false;
                          if ($f['id_cupon'] != 0) {
                            $banderadescuento= true;
                            if ($filaCupon[3] == "moneda"){
                              $total = $total - $filaCupon[4];
                              $descuento= " S/. ".number_format($filaCupon[4], 2, '.', '');
                            }else{
                              $total= $total - ($total * ($filaCupon[4]/100));    
                              $descuento= $filaCupon[4]."%";
                            }
                          }
                        ?>
                        <p><b>Cupon:</b> <?php echo $descuento;?></p>
                        <p><b>Delibery:</b> <?php if ($f['total'] <= 40) {echo "S/. 10.00";}else{echo "Gratis";}?></p>
                        <p><b>Total:</b> S/. <?php echo number_format($total, 2, '.', '');?></p>
                      </div>
                    </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Talla</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $re=$conexion->query("
                            select productos_venta.*, productos.nombre
                            from productos_venta 
                            inner join productos on productos_venta.id_producto = productos.id
                            where productos_venta.id_venta=".$f['id'])or die($conexion->error);
                          while ($f2 = mysqli_fetch_array($re)) {
                        ?>
                        <tr>
                          <td><?php echo $f2['id']; ?></td>
                          <td><?php echo $f2['nombre']; ?></td>
                          <td><?php echo $f2['talla']; ?></td>
                          <td><?php echo $f2['cantidad']; ?></td>
                          <td>S/.<?php echo number_format($f2['precio'],2,'.',''); ?></td>
                          <td>S/.<?php echo number_format($f2['subtotal'],2,'.',''); ?></td>
                        </tr>   
                        <?php } ?>     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>

            <div class="tab-pane fade" id="entregado" role="tabpanel" aria-labelledby="entregado-tab">
              <?php 
                while ($f=mysqli_fetch_array($resultado3)) {
              ?>
              <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'];?>">
                  <h5 class="mb-0">
                    <div class="row">
                      <div class="col-sm-10">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'];?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id'];?>">                  
                          <?php 
                          $color="black"; 
                          if ($f['status'] == 'entregado') { $color="#0AAE31";}
                          if ($f['status'] == 'pagado') { $color="orange";}
                          if ($f['status'] == 'pendiente') { $color="red";}
                          ?> 
                          <b class="mr-3" style="color:<?php echo $color;?>">ID Pedido: <?php echo $f['id'];?></b>            
                          <span style="color: #8B8B8B"><b>Fecha de pedido:</b> <?php echo $f['fecha'].' / <b>Cliente:</b> '.$f['nombre'].'   '.$f['apellido'];?></span>
                        </button>
                      </div>
                    </div>
                  </h5>
                </div>

                <div id="collapse<?php echo $f['id'];?>" class="collapse" aria-labelledby="heading<?php echo $f['id'];?>" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Cliente</h5>
                        <p><b>Nombre Cliente:</b>  <?php echo $f['nombre'];?></p>
                        <p><b>Email Cliente:</b> <?php echo $f['email'];?></p>
                        <p><b>Teléfono:</b> <?php echo $f['telefono'];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de envio</h5>
                        <?php 
                          $envios=$conexion->query("select * from envios where id_venta=".$f['id'])or die($conexion->error);
                          $fila=mysqli_fetch_row($envios);
                        ?>
                        <p><b>Ciudad:</b> <?php echo $fila[2];?></p> 
                        <p><b>Distrito:</b> <?php echo $fila[4];?></p> 
                        <p><b>Dirección:</b> <?php echo $fila[3];?></p> 
                        <p><b>Referencia:</b> <?php echo $fila[5];?></p>
                      </div>
                      <div class="col-4">
                        <h5 class="text-primary">Datos de Pedido</h5>
                        <p><b>Estado:</b> <?php echo $f['status'];?></p>
                        <?php 
                          $cupon= $conexion->query("select * from cupones where id=".$f['id_cupon']) or die($conexion->error);
                          $filaCupon=mysqli_fetch_row($cupon);
                          $total = $f['total'];
                          $descuento = "No Usado";
                          $banderadescuento = false;
                          if ($f['id_cupon'] != 0) {
                            $banderadescuento= true;
                            if ($filaCupon[3] == "moneda"){
                              $total = $total - $filaCupon[4];
                              $descuento= " S/. ".number_format($filaCupon[4], 2, '.', '');
                            }else{
                              $total= $total - ($total * ($filaCupon[4]/100));    
                              $descuento= $filaCupon[4]."%";
                            }
                          }
                        ?>
                        <p><b>Cupon:</b> <?php echo $descuento;?></p>
                        <p><b>Delibery:</b> <?php if ($f['total'] <= 40) {echo "S/. 10.00";}else{echo "Gratis";}?></p>
                        <p><b>Total:</b> S/. <?php echo number_format($total, 2, '.', '');?></p>
                      </div>
                    </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Talla</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $re=$conexion->query("
                            select productos_venta.*, productos.nombre
                            from productos_venta 
                            inner join productos on productos_venta.id_producto = productos.id
                            where productos_venta.id_venta=".$f['id'])or die($conexion->error);
                          while ($f2 = mysqli_fetch_array($re)) {
                        ?>
                        <tr>
                          <td><?php echo $f2['id']; ?></td>
                          <td><?php echo $f2['nombre']; ?></td>
                          <td><?php echo $f2['talla']; ?></td>
                          <td><?php echo $f2['cantidad']; ?></td>
                          <td>S/.<?php echo number_format($f2['precio'],2,'.',''); ?></td>
                          <td>S/.<?php echo number_format($f2['subtotal'],2,'.',''); ?></td>
                        </tr>   
                        <?php } ?>     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php } ?>              
            </div>
          </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEntregado" tabindex="-1" role="dialog" aria-labelledby="modalEntregadoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../php/actualizarestadoventa.php" method="GET" name="enviarid">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEntregadoLabel">Actualizar Estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea actualizar el estado del Pedido?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      <input type="hidden" value="" name="id">
      <input type="hidden" value="" name="status">
      </form>
    </div>
  </div>
</div>

<?php include("layouts/footer.php");?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="dashboard/plugins/moment/moment.min.js"></script>
<script src="dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dashboard/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dashboard/dist/js/demo.js"></script>

<script>
  $(document).ready(function(){
    var idStatus;
    var Status;
    $(".btnEntregado").click(function(){
      idStatus= $(this).data('id');
      Status= $(this).data('status');
      document.enviarid.id.value=idStatus;
      document.enviarid.status.value=Status;
    });
    $(".btnPagado").click(function(){
      idStatus= $(this).data('id');
      Status= $(this).data('status');
      document.enviarid.id.value=idStatus;
      document.enviarid.status.value=Status;
    });
  });
</script>
</body>
</html>
