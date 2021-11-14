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
  $resultado= $conexion->query("select * from colores order by id DESC")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Colores</title>
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
            <h1 class="m-0 text-dark">Colores</h1>
          </div><!-- /.col -->
          <div class="col-sm-8 text-right">
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='productos'">
              Productos
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='categorias'">
              Categorias
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='tallas'">
              Tallas
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Agregar Color
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
          El color ha sido eliminada.
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
                <th>Color</th>
                <th>Codigo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                while ($f = mysqli_fetch_array($resultado)) {
              ?>
              <tr>
                <td><?php echo $f['id']; ?></td>
                <td><?php echo $f['color']; ?></td>
                <td>
                  <span style="border:solid 1px #bdbdbd;width:10px;height:10px;background-color: <?php echo $f['codigo'];?>" class="color d-inline-block rounded-circle mr-2"></span><?php echo $f['codigo']; ?></td>
                <td>
                  <button class="btn btn-primary btn-small btnEditar" 
                  data-id="<?php echo $f['id']; ?>" 
                  data-color="<?php echo $f['color']; ?>" 
                  data-codigo="<?php echo $f['codigo']; ?>"
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../php/insertarcolor.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Color</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="color">Color</label>
          <input type="text" name="color" placeholder="Color" id="color" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="codigo">Codigo</label>
          <input type="text" name="codigo" placeholder="Codigo" id="codigo" class="form-control" required>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../php/editarcolor.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Color</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idEdit" name="id">
        <div class="form-group">
          <label for="color">Color</label>
          <input type="text" name="color" placeholder="Color" id="colorEdit" class="form-control">
        </div>
        <div class="form-group">
          <label for="codigoEdit">Codigo</label>
          <input type="text" name="codigo" placeholder="Codigo" id="codigoEdit" class="form-control">
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
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Color</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea eliminar el Color?
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
        url: '../php/eliminarcolor.php',
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
      var color=$(this).data('color');
      var codigo=$(this).data('codigo');
      $("#colorEdit").val(color);
      $("#codigoEdit").val(codigo);
      $("#idEdit").val(idEditar);
    });
  });
</script>
</body>
</html>
