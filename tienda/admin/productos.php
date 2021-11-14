<?php 
  session_start();
  include("../php/conexion.php");
  if (!isset($_SESSION['datos_login'])) {
    header('Location: ../index.php');
  }
  $arregloUsiario= $_SESSION['datos_login'];
  if ($arregloUsiario['nivel'] != 'admin') {
    header('Location: ../index.php');    
  }
  $resultado= $conexion->query("select productos.*, categorias.nombre as catego from 
    productos 
    inner join categorias on productos.id_categoria = categorias.id
    order by indice ASC")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Productos</title>
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
    <link rel="stylesheet" href="../css/datatables.min.css">
    <style>
      /*table*/
      #example {font-size: 13px !important;}
      .dataTables_wrapper{font-size: 15px !important;}
      .table thead, .table tfoot {background-color: #455a64;color: azure;}
      .redclass{background-color: #ff5252 !important;color: #fff;}
    </style>
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
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-8 text-right">
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='categorias'">
              Categorias
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='tallas'">
              Tallas
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='colores'">
              Colores
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Agregar Producto
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $_GET['error']; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Se ha insertado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>

        <?php if (isset($_GET['actualizar'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Se ha actualizado correctamente.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th>Indice</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Marketing</th>
                <th>Inventario</th>
                <th>Categoria</th>
                <th>Talla</th>
                <th>Color</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                while ($f = mysqli_fetch_array($resultado)) {
              ?>
              <tr>
                <td><?php echo $f['indice']; ?></td>
                <td>
                  <img src="../images/small/<?php echo $f['imagen']; ?>" alt="" width="20px" height="20px">
                  <?php echo $f['nombre']; ?>                  
                </td>
                <td style="max-width: 240px;"><?php echo $f['descripcion']; ?></td>
                <td>S/.<?php echo number_format($f['precio'], 2, '.', ''); ?></td>
                <td align="center">S/.<?php echo number_format($f['precio_oferta'], 2, '.', ''); ?></td>
                <?php 
                  if ($f['inventario']>20) {$color="green";}
                  if ($f['inventario']<=20 && $f['inventario']>10) {$color="orange";}
                  if ($f['inventario']<=10) {$color="red";}
                ?>
                <td style="color: <?php echo $color;?>;"><b><?php echo $f['inventario'];?></b></td>
                <td><?php echo $f['catego']; ?></td>
                <!-- <td><?php echo substr($f['talla'], 0, 10).'...'; ?></td> -->
                <td style="max-width: 140px;"><?php echo $f['talla'];?></td>
                <td><?php echo $f['color'];?></td>
                <td style="width: 88px;">
                  <button class="btn btn-primary btn-small btnEditar" 
                  data-id="<?php echo $f['id']; ?>" 
                  data-indice="<?php echo $f['indice']; ?>" 
                  data-nombre="<?php echo $f['nombre']; ?>" 
                  data-descripcion="<?php echo $f['descripcion']; ?>" 
                  data-precio="<?php echo $f['precio']; ?>"   
                  data-preciooferta="<?php echo $f['precio_oferta']; ?>"  
                  data-inventario="<?php echo $f['inventario']; ?>" 
                  data-categoria="<?php echo $f['id_categoria']; ?>" 
                  data-talla="<?php echo $f['talla']; ?>"
                  data-color="<?php echo $f['color']; ?>"
                  data-nuevo="<?php echo $f['nuevo']; ?>"
                  data-toggle="modal" data-target="#modalEditar">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-small btnEliminar" 
                  data-id="<?php echo $f['id']; ?>" data-toggle="modal" data-target="#modalEliminar">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>   
              <?php } ?>           
            </tbody>
          </table>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal Agregar-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="../php/insertarproducto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="indice">Indice <span class="text-danger">*</span></label>
              <input type="number" name="indice" placeholder="Indice" id="indice" class="form-control arrow-none" required>
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label for="nombre">Nombre <span class="text-danger">*</span></label>
              <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
          <input type="text" name="descripcion" placeholder="Descripcion" id="descripcion" class="form-control" required>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="imagen">Imagen Grande <span class="text-danger">*</span><small class="text-muted">(900px x 650px)(jpg o png)</small></label>
              <input type="file" name="imagen" id="imagen" class="form-control" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="imagen2">Imagen Pequeña <span class="text-danger">*</span><small class="text-muted">(482px x 348px)(jpg o png)</small></label>
              <input type="file" name="imagen2" id="imagen2" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="precio">Precio <span class="text-danger">*</span></label>
              <input type="number" min="0" name="precio" placeholder="Precio" id="precio" class="form-control" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="preciooferta">Precio Marketing</label>
              <input type="number" min="0" name="preciooferta" placeholder="Precio Oferta" id="preciooferta" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="inventario">Inventario <span class="text-danger">*</span></label>
              <input type="number" min="0" name="inventario" placeholder="Inventario" id="inventario" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="categoria">Categoria <span class="text-danger">*</span></label>
              <select name="categoria" id="categoria" class="form-control" required>
                <?php 
                  $res= $conexion->query("select * from categorias")or die($conexion->error);
                  while ($f = mysqli_fetch_array($res)) {
                    echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <label for="nuevo">Nuevo</label>
            <select name="nuevo" id="nuevo" class="form-control">
              <option value="0">No</option>
              <option value="1">Si</option>
            </select>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="color">Color <span class="text-danger">*</span></label>
              <input type="text" name="color" placeholder="Color" id="color" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="talla">Talla <span class="text-danger">*</span></label><br>
            <?php 
              $res2= $conexion->query("select * from tallas order by id DESC")or die($conexion->error);
              while ($f2 = mysqli_fetch_array($res2)) {
            ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="talla[]" id="<?php echo $f2['talla'];?>" value="<?php echo $f2['talla'];?>">
            <label class="form-check-label" for="<?php echo $f2['talla'];?>"><?php echo $f2['talla']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea eliminar el producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="../php/editarproducto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idEdit" name="id" value="">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="indiceEdit">Indice</label>
              <input type="number" name="indice" placeholder="Indice" id="indiceEdit" class="form-control arrow-none" required>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
              <label for="nombreEdit">Nombre</label>
              <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control" required>
            </div>
        </div>
        </div>
        <div class="form-group">
          <label for="descripcionEdit">Descripcion</label>
          <input type="text" name="descripcion" placeholder="Descripcion" id="descripcionEdit" class="form-control" required>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="imagen">Imagen Grande<small class="text-muted">(900px x 650px)(jpg o png)</small></label>
              <input type="file" name="imagen" id="imagen" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="imagen2">Imagen Pequeña<small class="text-muted">(482px x 348px)(jpg o png)</small></label>
              <input type="file" name="imagen2" id="imagen2" class="form-control">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="precioEdit">Precio</label>
              <input type="number" min="0" name="precio" placeholder="Precio" id="precioEdit" class="form-control" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="precioofertaEdit">Precio Marketing</label>
              <input type="number" min="0" name="preciooferta" placeholder="Precio Oferta" id="precioofertaEdit" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="inventarioEdit">Inventario</label>
              <input type="number" min="0" name="inventario" placeholder="Inventario" id="inventarioEdit" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="categoriaEdit">Categoria</label>
              <select name="categoria" id="categoriaEdit" class="form-control" required>
                <?php 
                  $res= $conexion->query("select * from categorias")or die($conexion->error);
                  while ($f = mysqli_fetch_array($res)) {
                    echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <label for="nuevoEdit">Nuevo</label>
            <select name="nuevo" id="nuevoEdit" class="form-control">
              <option value="0">No</option>
              <option value="1">Si</option>
            </select>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="colorEdit">Color</label>
              <input type="text" name="color" placeholder="Color" id="colorEdit" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="talla">Talla</label><br>
          <!-- <input type="text" name="talla" placeholder="Talla" id="talla" class="form-control" required> -->
            <?php 
              $res2= $conexion->query("select * from tallas order by id DESC")or die($conexion->error);
              while ($f2 = mysqli_fetch_array($res2)) {
            ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input settings" type="checkbox" name="talla[]" id="x<?php echo $f2['talla'];?>" value="<?php echo $f2['talla'];?>">
            <label class="form-check-label" for="x<?php echo $f2['talla'];?>"><?php echo $f2['talla']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
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
<script src="../js/datatables.min.js"></script>

<script>
  $(document).ready(function(){
    var idEliminar= -1;
    var idEditar= -1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar= $(this).data('id');
      fila=$(this).parent('td').parent('tr');
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminarproducto.php',
        method: 'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){
        $(fila).fadeOut(500);
      });
    });

    $(".btnEditar").click(function(){      
      $("input:checkbox").attr('checked', false);
      idEditar=$(this).data('id');
      var indice=$(this).data('indice');
      var nombre=$(this).data('nombre');
      var descripcion=$(this).data('descripcion');
      var precio=$(this).data('precio');
      var preciooferta=$(this).data('preciooferta');
      var inventario=$(this).data('inventario');
      var categoria=$(this).data('categoria');
      var talla=$(this).data('talla');
      var color=$(this).data('color');
      var nuevo=$(this).data('nuevo');
      $("#indiceEdit").val(indice);
      $("#nombreEdit").val(nombre);
      $("#descripcionEdit").val(descripcion);
      $("#precioEdit").val(precio);
      $("#precioofertaEdit").val(preciooferta);
      $("#inventarioEdit").val(inventario);
      $("#categoriaEdit").val(categoria);
      $("#tallaEdit").val(talla);
      $("#colorEdit").val(color);
      $("#nuevoEdit").val(nuevo);
      $("#idEdit").val(idEditar);

      // var xExtraLarge = document.getElementById('xExtra-Large');
      // var xLarge = document.getElementById('xLarge');
      // var xMedium = document.getElementById('xMedium');
      // var xSmall = document.getElementById('xSmall');

      // if (/Extra-Large/.test(talla)) {xExtraLarge.checked=true;}else{xExtraLarge.checked=false;} 
      // if (/Large/.test(talla)) {xLarge.checked=true;}else{xLarge.checked=false;}
      // if (/Medium/.test(talla)) {xMedium.checked=true;}else{xMedium.checked=false;} 
      // if (/Small/.test(talla)) {xSmall.checked=true;}else{xSmall.checked=false;}

      $('.settings').prop('checked', false);
      var arreglotalla = talla.split(",");
      for (var i = arreglotalla.length - 1; i >= 0; i--) {
        var temptalla = new RegExp(arreglotalla[i]);
        var xtalla = "x"+arreglotalla[i];
        var xtemptalla = document.getElementById(xtalla);
        if (temptalla.test(talla)) {xtemptalla.checked=true;}
        if (temptalla.test(talla) == false) {xtemptalla.checked=false;} 
      }

    });

    var tabla = $("#example").DataTable({
       "createdRow":function(row, data, index){
           if( data[5] > 40){
                    $(row).addClass('redclass');
                }
       },
       "language": espanol,
       "lengthMenu": [[9, 18, 27, -1], [9, 18, 27, "All"]]
    });
  });

  let espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};
</script>
</body>
</html>
