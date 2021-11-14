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
  $resultado= $conexion->query("select * from tallas order by id DESC")or die($conexion->error);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tallas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="dashboard/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link type="image/x-icon" rel="shortcut icon" href="../images/icons/favicon.ico"/>
  <link type="image/x-icon" rel="apple-touch-icon" href="../images/icons/favicon.ico"/>
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
            <h1 class="m-0 text-dark">Tallas</h1>
          </div><!-- /.col -->
          <div class="col-sm-8 text-right">
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='productos'">
              Productos
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='categorias'">
              Categorias
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="window.location='colores'">
              Colores
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Agregar Talla
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
          La categoria ha sido eliminada.
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
                <th>Talla</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                while ($f = mysqli_fetch_array($resultado)) {
              ?>
              <tr>
                <td><?php echo $f['id']; ?></td>
                <td><?php echo $f['talla']; ?></td>
                <td>
                  <button class="btn btn-primary btn-small btnEditar" 
                  data-id="<?php echo $f['id']; ?>" 
                  data-talla="<?php echo $f['talla']; ?>" 
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
      <form action="../php/insertartalla.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Talla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="talla">Talla</label>
          <input type="text" name="talla" placeholder="Talla" id="talla" class="form-control" required>
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
      <form action="../php/editartalla.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Talla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idEdit" name="id">
        <div class="form-group">
          <label for="tallaEdit">Talla</label>
          <input type="text" name="talla" placeholder="Talla" id="tallaEdit" class="form-control">
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
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Talla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea eliminar la Talla?
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
        url: '../php/eliminartalla.php',
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
      var talla=$(this).data('talla');
      $("#tallaEdit").val(talla);
      $("#idEdit").val(idEditar);
    });
  });
</script>
</body>
</html>
