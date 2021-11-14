<?php 
  session_start();
  include("php/conexion.php");
  if (!isset($_SESSION['carrito'])) {
    header('Location: index.php');
  }
  if (isset($_SESSION['datos_login'])) {
    $arregloUsiario = $_SESSION['datos_login'];
  }
  $arreglo = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_WEB; ?> - Registro de Pago</title>
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

    <form action="php/insertarpedido.php" method="post" class="needs-validation" novalidate>
    <div class="site-section">
      <div class="container">

        <div class="row mb-5" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <a href="<?= BASE_URL_TIENDA; ?>carrito-de-compras"><li class="active mr-4"><span class="font-weight-bold" style="font-size:20px;">1</span> <h3 class="d-inline-block font-weight-bold" style="color:#ccc;">Carrito</h3></li></a>
                <li class="active mr-4"><span class="font-weight-bold" style="font-size:20px;">2</span> <h3 class="d-inline-block font-weight-bold text-black">Detalle de Compra</h3></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              ¿Soy Cliente? Haga <a href="<?= BASE_URL_TIENDA; ?>login">Clic aquí</a> para ingresar
            </div>
          </div>
        </div>    
       
        <div class="row">          
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Detalles de facturación</h2>
            <?php 
              if (isset($_SESSION['datos_login'])) {
            ?>

            <div class="p-3 p-lg-5 border">
              <input type="hidden" name="country" value="Peru">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php echo $arregloUsiario['nombre'];?>" required>
                  <div class="invalid-feedback">
                    Ingresar un Nombre.
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Apellido <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname" value="<?php echo $arregloUsiario['apellido'];?>" required>
                  <div class="invalid-feedback">
                    Ingresar un Apellido.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">Provincia / Región</label>
                  <select name="c_companyname" id="c_companyname" class="form-control" onchange="showDiv(this)">
                    <option value="Lima">Lima</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Áncash">Áncash</option>
                    <option value="Apurímac">Apurímac</option>
                    <option value="Arequipa">Arequipa</option>
                    <option value="Ayacucho">Ayacucho</option>
                    <option value="Cajamarca">Cajamarca</option>
                    <option value="Cusco">Cusco</option>
                    <option value="Huancavelica">Huancavelica</option>
                    <option value="Huánuco">Huánuco</option>
                    <option value="Ica">Ica</option>
                    <option value="Junín">Junín</option>
                    <option value="La Libertad">La Libertad</option>
                    <option value="Lambayeque">Lambayeque</option>
                    <option value="Loreto">Loreto</option>
                    <option value="Madre de Dios">Madre de Dios</option>
                    <option value="Moquegua">Moquegua</option>
                    <option value="Pasco">Pasco</option>
                    <option value="Piura">Piura</option>
                    <option value="Puno">Puno</option>
                    <option value="San Martín">San Martín</option>
                    <option value="Tacna">Tacna</option>
                    <option value="Tumbes">Tumbes</option>
                    <option value="Ucayali">Ucayali</option>
                  </select>
                </div>
              </div>

              <div class="form-group row distrito-1">
                <div class="col-md-12">
                  <label for="c_state_country" class="text-black">Distrito </label>
                  <select name="c_state_country" id="c_state_country" class="form-control">
                    <option value="Ate">Ate</option>
                    <option value="Ancón">Ancón</option>
                    <option value="Barranco">Barranco</option>
                    <option value="Breña">Breña</option>
                    <option value="Cercado de Lima">Cercado de Lima</option>
                    <option value="Carabayllo">Carabayllo</option>
                    <option value="Chaclacayo">Chaclacayo</option>
                    <option value="Chorrillos">Chorrillos</option>
                    <option value="Cieneguilla">Cieneguilla</option>
                    <option value="Comas">Comas</option>
                    <option value="El Agustino">El Agustino</option>
                    <option value="Independencia">Independencia</option>
                    <option value="Jesús María">Jesús María</option>
                    <option value="La Molina">La Molina</option>
                    <option value="La Victoria">La Victoria</option>
                    <option value="Lince">Lince</option>
                    <option value="Los Olivos">Los Olivos</option>
                    <option value="Lurigancho-Chosica">Lurigancho-Chosica</option>
                    <option value="Lurín">Lurín</option>
                    <option value="Magdalena Del Mar">Magdalena Del Mar</option>
                    <option value="Miraflores">Miraflores</option>
                    <option value="Pachacámac">Pachacámac</option>
                    <option value="Pucusana">Pucusana</option>
                    <option value="Pueblo Libre">Pueblo Libre</option>
                    <option value="Puente Piedra">Puente Piedra</option>
                    <option value="Punta Hermosa">Punta Hermosa</option>
                    <option value="Punta Negra">Punta Negra</option>
                    <option value="Rímac">Rímac</option>
                    <option value="San Bartolo">San Bartolo</option>
                    <option value="San Borja">San Borja</option>
                    <option value="San Isidro">San Isidro</option>
                    <option value="San Juan De Lurigancho">San Juan De Lurigancho</option>
                    <option value="San Juan De Miraflores">San Juan De Miraflores</option>
                    <option value="San Luis">San Luis</option>
                    <option value="San Martin De Porres">San Martin De Porres</option>
                    <option value="San Miguel">San Miguel</option>
                    <option value="Santa Anita">Santa Anita</option>
                    <option value="Santa María Del Mar">Santa María Del Mar</option>
                    <option value="Santa Rosa">Santa Rosa</option>
                    <option value="Santiago De Surco">Santiago De Surco</option>
                    <option value="Surquillo">Surquillo</option>
                    <option value="Villa El Salvador">Villa El Salvador</option>
                    <option value="Villa Maria Del Triunfo">Villa Maria Del Triunfo</option>
                  </select>
                </div>
              </div>

              <div class="form-group row distrito-2" style="display: none;">
                <div class="col-md-12">
                  <label for="c_state_country" class="text-black">Distrito <span class="text-danger">*</span></label>
                  <input type="text" class="form-control c_state_country2" id="c_state_country" name="c_state_country2">
                  <div class="invalid-feedback">
                    Ingresar un Distrito.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="" required>
                  <div class="invalid-feedback">
                    Ingresar una dirección.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_postal_zip" class="text-black">Referencia de Ubicación</label>
                  <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo $arregloUsiario['email'];?>" required>
                  <div class="invalid-feedback">
                    Ingresar un Email.
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Teléfono <span class="text-danger">*</span></label>
                  <input type="number" class="form-control arrow-none" id="c_phone" name="c_phone" value="<?php echo $arregloUsiario['telefono'];?>" placeholder="" required>
                  <div class="invalid-feedback">
                    Ingresar un Teléfono.
                  </div>
                </div>
              </div>
            </div>

            <?php }else{ ?>
            <div class="p-3 p-lg-5 border">
              <input type="hidden" name="country" value="Peru">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                  <div class="invalid-feedback">
                    Ingresar un Nombre.
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Apellido <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname" required>
                  <div class="invalid-feedback">
                    Ingresar un Apellido.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">Provincia / Región </label>
                  <select name="c_companyname" id="c_companyname" class="form-control" onchange="showDiv(this)">
                    <option value="Lima">Lima</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Áncash">Áncash</option>
                    <option value="Apurímac">Apurímac</option>
                    <option value="Arequipa">Arequipa</option>
                    <option value="Ayacucho">Ayacucho</option>
                    <option value="Cajamarca">Cajamarca</option>
                    <option value="Cusco">Cusco</option>
                    <option value="Huancavelica">Huancavelica</option>
                    <option value="Huánuco">Huánuco</option>
                    <option value="Ica">Ica</option>
                    <option value="Junín">Junín</option>
                    <option value="La Libertad">La Libertad</option>
                    <option value="Lambayeque">Lambayeque</option>
                    <option value="Loreto">Loreto</option>
                    <option value="Madre de Dios">Madre de Dios</option>
                    <option value="Moquegua">Moquegua</option>
                    <option value="Pasco">Pasco</option>
                    <option value="Piura">Piura</option>
                    <option value="Puno">Puno</option>
                    <option value="San Martín">San Martín</option>
                    <option value="Tacna">Tacna</option>
                    <option value="Tumbes">Tumbes</option>
                    <option value="Ucayali">Ucayali</option>
                    <option value="Ucayali">Callao</option>
                  </select>
                </div>
              </div>

              <div class="form-group row distrito-1">
                <div class="col-md-12">
                  <label for="c_state_country" class="text-black">Distrito </label>
                  <select name="c_state_country" id="c_state_country" class="form-control">
                    <option value="Ate">Ate</option>
                    <option value="Ancón">Ancón</option>
                    <option value="Barranco">Barranco</option>
                    <option value="Breña">Breña</option>
                    <option value="Cercado de Lima">Cercado de Lima</option>
                    <option value="Carabayllo">Carabayllo</option>
                    <option value="Chaclacayo">Chaclacayo</option>
                    <option value="Chorrillos">Chorrillos</option>
                    <option value="Cieneguilla">Cieneguilla</option>
                    <option value="Comas">Comas</option>
                    <option value="El Agustino">El Agustino</option>
                    <option value="Independencia">Independencia</option>
                    <option value="Jesús María">Jesús María</option>
                    <option value="La Molina">La Molina</option>
                    <option value="La Victoria">La Victoria</option>
                    <option value="Lince">Lince</option>
                    <option value="Los Olivos">Los Olivos</option>
                    <option value="Lurigancho-Chosica">Lurigancho-Chosica</option>
                    <option value="Lurín">Lurín</option>
                    <option value="Magdalena Del Mar">Magdalena Del Mar</option>
                    <option value="Miraflores">Miraflores</option>
                    <option value="Pachacámac">Pachacámac</option>
                    <option value="Pucusana">Pucusana</option>
                    <option value="Pueblo Libre">Pueblo Libre</option>
                    <option value="Puente Piedra">Puente Piedra</option>
                    <option value="Punta Hermosa">Punta Hermosa</option>
                    <option value="Punta Negra">Punta Negra</option>
                    <option value="Rímac">Rímac</option>
                    <option value="San Bartolo">San Bartolo</option>
                    <option value="San Borja">San Borja</option>
                    <option value="San Isidro">San Isidro</option>
                    <option value="San Juan De Lurigancho">San Juan De Lurigancho</option>
                    <option value="San Juan De Miraflores">San Juan De Miraflores</option>
                    <option value="San Luis">San Luis</option>
                    <option value="San Martin De Porres">San Martin De Porres</option>
                    <option value="San Miguel">San Miguel</option>
                    <option value="Santa Anita">Santa Anita</option>
                    <option value="Santa María Del Mar">Santa María Del Mar</option>
                    <option value="Santa Rosa">Santa Rosa</option>
                    <option value="Santiago De Surco">Santiago De Surco</option>
                    <option value="Surquillo">Surquillo</option>
                    <option value="Villa El Salvador">Villa El Salvador</option>
                    <option value="Villa Maria Del Triunfo">Villa Maria Del Triunfo</option>
                  </select>
                </div>
              </div>

              <div class="form-group row distrito-2" style="display: none;">
                <div class="col-md-12">
                  <label for="c_state_country" class="text-black">Distrito <span class="text-danger">*</span></label>
                  <input type="text" class="form-control c_state_country2" id="c_state_country" name="c_state_country2">
                  <div class="invalid-feedback">
                    Ingresar un Distrito.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="" required>
                  <div class="invalid-feedback">
                    Ingresar un Dirección.
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_postal_zip" class="text-black">Referencia de Ubicación</label>
                  <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email_address" name="c_email_address" required>
                  <div class="invalid-feedback">
                    Ingresar un Email.
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Teléfono <span class="text-danger">*</span></label>
                  <input type="number" class="form-control arrow-none" id="c_phone" name="c_phone" placeholder="" required>
                  <div class="invalid-feedback">
                    Ingresar un Teléfono.
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-12">
                  <label for="c_account_password" class="text-black">Contraseña</label>
                  <input type="password" class="form-control" id="c_account_password" name="c_account_password" required>
                  <div class="invalid-feedback">
                    Ingresar una Contraseña.
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

            <div class="row mb-3 mt-2">
              <div class="col-md-12">
                <h2 class="h3 mb-2 text-black">Delibery</h2>
                <div class="px-3 pt-3 pb-2 px-lg-5 pt-lg-4 border">                  
                  <label for="c_code" class="text-black">Por compras mayor a S/. 160.00 el delibery es gratis</label>

                  <p>
                    <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Lista de distritos donde aplica delibery de S/. 10.00
                    </a>
                  </p>
                  <div class="collapse" id="collapseExample">
                    <ul class="pl-0" style="list-style: none;">
                      <li>La Victoria</li>
                      <li>San Luis</li>
                      <li>Lince</li>
                      <li>San Borja</li>
                      <li>Santiago de Surco</li>
                      <li>Surquillo</li>
                      <li>Santa Anita</li>
                      <li>Cercado de Lima</li>
                      <li>La Molina</li>
                      <li>Ate</li>
                      <li>San Isidro</li>
                      <li>Miraflores</li>
                      <li>El Agustino</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-6">

            <div class="row mb-3">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Codigo de Cupon</h2>
                <div class="p-3 p-lg-5 border">
                  <label for="c_code" class="text-black mb-3">Ingrese su código de cupón si tiene uno</label>
                  <div class="input-group w-75" id="formCupon">
                    <input type="text" class="form-control" id="c_code" placeholder="Codigo de Cupon" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                    </div>
                  </div>
                  <p id="error" style="display: none; margin-top: 10px" class="text-danger">Cupon no valido</p>
                  <div class="input-group w-75" id="datosCupon" style="display: none">
                    <p id="textoCupon" class="text-success"></p>
                  </div>
                </div>
                <input type="hidden" name="id_cupon" id="id_cupon">
              </div>
            </div>
            
            <div class="row mb-0">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Orden de Compra</h2>
                <div class="pr-3 pl-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-2">
                    <thead>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php
                      $delibery=0;
                      $total=0;
                        for ($i=0; $i < count($arreglo); $i++) { 
                          $total= $total + ($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);                          
                      ?>

                      <tr>
                        <td><?php echo $arreglo[$i]['Nombre']; ?></td>
                        <td><?php echo $arreglo[$i]['Cantidad']; ?></td>
                        <td>S/. <?php echo number_format(($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']), 2, '.', '');?></td>
                      </tr>

                    <?php } ?>
                      <tr>
                        <td colspan="2">Subtotal</td>
                        <td>S/. <?php echo number_format($total, 2, '.', '');?></td> 
                      </tr>
                      <tr>
                        <td class="text-success" colspan="2">
                          Descuento
                        </td>
                        <td id="tdTotal">0</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          Delibery
                        </td>
                        <td class="tdelibery">
                        <?php 
                        if ($total <= 160) {
                          $delibery=10; 
                          echo "S/. 10.00";
                        }else{
                          echo "0";
                        }
                        $totald=$total+$delibery;
                        ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td id="tdTotalFinal" data-total="<?php echo $totald;?>">S/. <?php echo number_format($totald, 2, '.', '');?></td>
                      </tr>
                    </tbody>
                  </table>

                  <input type="hidden" class="totalf" value="<?php echo $totald;?>">
                  <input type=hidden class="delibery" name="delibery" value="<?php if($total > 160){echo 0;}else{echo 10;};?>">
                  <input type=hidden class="cupon" name="cupon" value="0">
                  <div class="form-group">
                    <p class="text-center">Despues de procesar el pedido, realizar la trasnferencia a las sgtes cuentas
                    y enviar el ID pedido y voucher al correo: Freddy.Cuadros@fres-art.com</p>
                    <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Finalizar Compra</button>
                  </div>


                  <div class="form-group pt-3 mb-0">
                    <div class="row mb-3">
                      <div class="col-4"><img class="img-fluid" src="images/icons/bcp.jpg" alt=""></div>
                      <div class="col-4"><img class="img-fluid" src="images/icons/bbva.jpg" alt=""></div>
                      <div class="col-4"><img class="img-fluid" src="images/icons/interbank.jpg" alt=""></div>
                    </div>
                    <h3 class="text-primary text-center">CUENTAS DE AHORRO</h3>
                    <p class="text-center">Freddy Saul Cuadros Castañeda</p>
                    <div class="cuenta" style="background-color: #ef9500;color: #002983;">
                      <b class="mr-4">BCP + AHORRO EN SOLES</b> 191-96973127-0-51
                    </div>
                    <p class="text-center mb-0">
                      <b class="mr-3" style="color: #ef9500;">N° cta Interbancaria</b> 002-19119697312705153
                    </p>
                    <div class="cuenta" style="background-color: #002983;color: #fff;">
                      <b class="mr-4">BBVA + AHORRO EN SOLES</b> 0111-0124-0200188858
                    </div>
                    <p class="text-center mb-0">
                      <b class="mr-3" style="color: #002983;">N° cta Interbancaria</b> 011-124-000200188858-51
                    </p>
                    <div class="cuenta" style="background-color: #008e2f;color: #fff;">
                      <b class="mr-4">INTERBANK + AHORRO EN SOLES</b> 4883151980575
                    </div>
                    <p class="text-center mb-0">
                      <b class="mr-3" style="color: #008e2f;">N° cta Interbancaria</b> 003-488-013151980575-41
                    </p>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- </form> -->
      </div>
    </div>

    </form>
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
      $("#button-addon2").click(function(){
        var delibery = parseFloat($(".delibery").val());
        var codigo= $("#c_code").val();
        $.ajax({
          url: "php/validarcodigo.php",
          data: {
            codigo: codigo
          },
          method: 'POST'
        }).done(function(respuesta){
          if (respuesta == "error" || respuesta == "codigo no valido") {
            $("#error").show();
            $("#id_cupon").val();
          }else{
            var arreglo = JSON.parse(respuesta);
            if (arreglo.tipo == "moneda") {
              $("#textoCupon").text("Usted tiene un descuento de S/. "+arreglo.valor+".00 Soles");
              $("#tdTotal").text("S/. "+arreglo.valor+".00")
              $(".cupon").val(arreglo.valor)
              var total = parseFloat($("#tdTotalFinal").data('total')) - arreglo.valor;
              $("#tdTotalFinal").text("S/. "+total.toFixed(2));
            }else{
              $("#textoCupon").text("Usted tiene un descuento de "+arreglo.valor+"% en su compra");
              $("#tdTotal").text(arreglo.valor+"%")
              var total = parseFloat($("#tdTotalFinal").data('total')) - ((arreglo.valor/100) * parseFloat($("#tdTotalFinal").data('total')));
              $("#tdTotalFinal").text("S/. "+total.toFixed(2));
            }
            $("#formCupon").hide();
            $("#datosCupon").show();
            $("#id_cupon").val(arreglo.id);
          }
        });
      });
      $("#c_code").keyup(function(){
        $("#error").hide();
      })
    });

    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    $('#c_companyname').on('change', function() {
      var total = parseFloat($(".totalf").val());
      var cupon = parseFloat($(".cupon").val());
      var ciudad = this.value;
      var delibery=10;
      var distrito= $('#c_state_country').val();
      
        if (ciudad == "Lima") {
          $(".distrito-1").css("display", "block");
          $(".distrito-2").css("display", "none");
          $(".c_state_country2").val("");

          if (total < 160) {
            if (distrito == "La Victoria" || 
            distrito == "San Luis" || 
            distrito == "Lince" || 
            distrito == "San Borja" || 
            distrito == "Santiago De Surco" || 
            distrito == "Surquillo" || 
            distrito == "Santa Anita" || 
            distrito == "Cercado de Lima" || 
            distrito == "La Molina" || 
            distrito == "Ate" || 
            distrito == "San Isidro" || 
            distrito == "Miraflores" || 
            distrito == "El Agustino") {
              $(".tdelibery").text("S/. "+delibery+".00");
              $(".delibery").val(delibery);
              $("#tdTotalFinal").text("S/. "+(total)+".00");
            }else{
              $(".tdelibery").text("S/. "+(delibery+10)+".00");
              $(".delibery").val(delibery+10);
              $("#tdTotalFinal").text("S/. "+(total+cupon+10)+".00");
            }
          } 
        }else{
          $(".distrito-1").css("display", "none");
          $(".distrito-2").css("display", "block");
          if (total < 160) {
            $(".tdelibery").text("S/. "+(delibery+10)+".00");
            $(".delibery").val(delibery+10);
            $("#tdTotalFinal").text("S/. "+(total+cupon+10)+".00");
          }
        }      
    })

    $('#c_state_country').on('change', function() {
      var total = parseFloat($(".totalf").val());
      var cupon = parseFloat($(".cupon").val());
      var distrito = this.value;
      var delibery=10;

      if (total < 160) {
        if (distrito == "La Victoria" || 
          distrito == "San Luis" || 
          distrito == "Lince" || 
          distrito == "San Borja" || 
          distrito == "Santiago De Surco" || 
          distrito == "Surquillo" || 
          distrito == "Santa Anita" || 
          distrito == "Cercado de Lima" || 
          distrito == "La Molina" || 
          distrito == "Ate" || 
          distrito == "San Isidro" || 
          distrito == "Miraflores" || 
          distrito == "El Agustino") {
          $(".tdelibery").text("S/. "+delibery+".00");
          $(".delibery").val(delibery);
          $("#tdTotalFinal").text("S/. "+(total+cupon)+".00");
        }else{
          $(".tdelibery").text("S/. "+(delibery+10)+".00");
          $(".delibery").val(delibery+10);
          $("#tdTotalFinal").text("S/. "+(total+cupon+10)+".00");
        }
      }
    })
  </script>
  </body>
</html>