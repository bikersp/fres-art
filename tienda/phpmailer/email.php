<?php
// Empty fields
if(empty($_POST['c_email_address'])){
   		header("location:../index.html");
}else{
	$message= '
		<html>
			<body>
				<h1 style="color: #1d1d1d">Gracias por su compra '.$_POST['c_fname']." ".$_POST['c_lname'].'</h1>
				<p> Para completar la compra realizar la transferencia a las siguientes cuentas y enviar el ID pedido y voucher al correo: Freddy.Cuadros@fres-art.com</p>
				<p>ID PEDIDO: #'.$id_venta.'</p> <br>
				<p>Freddy Saul Cuadros Castañeda</p>
				<p>BCP + AHORRO EN SOLES 191-96973127-0-51 <br> N° cta Interbancaria 002-19119697312705153</p>
				<p>BBVA + AHORRO EN SOLES 0111-0124-0200188858 <br> N° cta Interbancaria 011-124-000200188858-51</p>
				<p>INTERBANK + AHORRO EN SOLES 4883151980575 <br> N° cta Interbancaria 003-488-013151980575-41</p>

				<h3>Detalles de la compra</h3>
				<table>
					<thead>
						<tr>
							<td>Nombre del producto</td>
							<td>Talla</td>
							<td>Precio</td>
							<td>Cantidad</td>
							<td>Subtotal</td>
						</tr>
					</thead>
					<tbody>';
	$total = 0;
	$arregloCarrito=$_SESSION['carrito'];
	for ($i=0; $i < count($arregloCarrito); $i++) {
	$total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
	$message.= '<tr><td>'.$arregloCarrito[$i]['Nombre'].'</td>';
	$message.= '<td>'.$arregloCarrito[$i]['Talla'].'</td>';
	$message.= '<td>S/. '.$arregloCarrito[$i]['Precio'].'</td>';
	$message.= '<td>'.$arregloCarrito[$i]['Cantidad'].'</td>';
	$message.= '<td>S/. '.($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']).'</td></tr>';
	}

	$message.= '</tbody></table>';
	$message.= '<h2>Total de la compra: S/. '.$total.'</h2>';
	$message.= '<a href="http://fres-art.com/tienda/verpedido.php?id_venta='.base64_encode($id_venta).'" style="background-color: #31B6E2;color: white;padding: 10px;text-decoration: none">
				Ver Status de pedido
			</a></body></html>';

	// Email
	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$from = "fresssart@fres-art.com";
	$to = $_POST['c_email_address'];
	$to2 = 'fresssart@fres-art.com';

	$mail->setFrom($from);
	$mail->addAddress($to);
	$mail->addAddress($to2);
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Subject  = 'Gracias por su compra en Fres-Art.com';
	$mail->Body = $message;

	if(!$mail->send()) {
	  echo "Mailer error: " . $mail->ErrorInfo;
	} else {
		// header("location: email_sent.html");
	}
}
?>