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
  $resultado= $conexion->query("select * from categorias order by id DESC")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Categorias</title>
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
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Categorias</h1>
          </div><!-- /.col -->
          <div class="col-sm-8 text-right">
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='productos'">
              Productos
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='tallas'">
              Tallas
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='colores'">
              Colores
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Agregar Categoria
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
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                while ($f = mysqli_fetch_array($resultado)) {
              ?>
              <tr>
                <td><?php echo $f['id']; ?></td>
                <td>
                  <img src="../images/<?php echo $f['imagen']; ?>" alt="" width="20px" height="20px">
                  <?php echo $f['nombre']; ?>                  
                </td>
                <td><?php echo $f['descripcion']; ?></td>
                <td>
                  <button class="btn btn-primary btn-small btnEditar" 
                  data-id="<?php echo $f['id']; ?>" 
                  data-nombre="<?php echo $f['nombre']; ?>" 
                  data-descripcion="<?php echo $f['descripcion']; ?>"
                  data-detalle1="<?php echo $f['detalle1']; ?>"
                  data-detalle2="<?php echo $f['detalle2']; ?>"
                  data-detalle3="<?php echo $f['detalle3']; ?>"
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
      <form action="../php/insertarcategoria.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" name="descripcion" placeholder="Descripcion" id="descripcion" class="form-control" required>
        </div>
        <div class="form-group">
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Detalle Opcional <i class="fas fa-chevron-down"></i></a>
          <div class="collapse" id="collapseExample">
            <div class="form-group">
              <label for="detalle1">Detalle 1</label>
              <textarea name="detalle1" placeholder="Detalle1" id="detalle1" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="detalle2">Detalle 2</label>
              <textarea name="detalle2" placeholder="Detalle 2" id="detalle2" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="detalle3">Detalle 3</label>
              <textarea name="detalle3" placeholder="Detalle 3" id="detalle3" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="imagen">Imagen <small>(482px X 348px)(jpg o png)</small></label>
          <input type="file" name="imagen" id="imagen" class="form-control" required>
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

<!-- Modal Editar-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="../php/editarcategoria.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idEdit" name="id">
        <div class="form-group">
          <label for="nombreEdit">Nombre</label>
          <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcionEdit">Descripcion</label>
          <input type="text" name="descripcion" placeholder="Descripcion" id="descripcionEdit" class="form-control">
        </div>
        <div class="form-group">
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Detalle Opcional <i class="fas fa-chevron-down"></i></a>
          <div class="collapse" id="collapseExample">
            <div class="form-group">
              <label for="detalle1Edit">Detalle 1</label>
              <textarea name="detalle1" placeholder="Detalle 1" id="detalle1Edit" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="detalle2Edit">Detalle 2</label>
              <textarea name="detalle2" placeholder="Detalle 2" id="detalle2Edit" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="detalle3Edit">Detalle 3</label>
              <textarea name="detalle3" placeholder="Detalle 3" id="detalle3Edit" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="imagen">Imagen <small>(482px X 348px)(jpg o png)</small></label>
          <input type="file" name="imagen" id="imagen" class="form-control">
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
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea eliminar la categoria?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
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
        url: '../php/eliminarcategoria.php',
        method: 'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){
        $(fila).fadeOut(500);
      });
    });
    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var nombre=$(this).data('nombre');
      var descripcion=$(this).data('descripcion');
      var detalle1=$(this).data('detalle1');
      var detalle2=$(this).data('detalle2');
      var detalle3=$(this).data('detalle3');
      $("#nombreEdit").val(nombre);
      $("#descripcionEdit").val(descripcion);
      $("#detalle1Edit").val(detalle1);
      $("#detalle2Edit").val(detalle2);
      $("#detalle3Edit").val(detalle3);
      $("#idEdit").val(idEditar);
    });
  });
</script>
</body>
</html>
