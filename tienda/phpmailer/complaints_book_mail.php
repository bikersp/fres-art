<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

if (empty($_POST["name"])){
    header("location:complaints_book.html");
}else{

	$name=$_POST["name"];
	$last_name=$_POST["last_name"];
	$document_number=$_POST["document_number"];
	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$address=$_POST["address"];
	$complaints=$_POST["complaints"];
	$title_complaint=$_POST["title_complaint"];
	$description=$_POST["description"];

	$nombre="Fiesta Tours Peru";
	$from=$email;

	//Correo
	//$to = 'control2@fiestatoursperu.com';
	$to = 'dg1@fiestatoursperu.com';

	$mail->setFrom($email, $name);
	$mail->addAddress($to);
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Subject  = 'Complaints Book';
	$mail->Body = "<h2>Complaints Book</h2>
		<b>Name:</b> ".$name."
		<br />
		<b>Last Name:</b> ".$last_name."
		<br />
		<b>Document Number:</b> ".$document_number."
		<br />
		<b>Email:</b> ".$email."
		<br />
		<b>Phone Number:</b> ".$phone."
		<br />
		<b>Address:</b> ".$address."
		<br />
		<b>Details:</b> ".$complaints."
		<br />
		<b>Title:</b> ".$title_complaint."
		<br />
		<b>Description of the events:</b> ".$description."
		<br />";

	if(!$mail->send()) {
	  echo 'Message was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	  // echo 'Message has been sent.';	  
		header("location: https://www.fiestatoursperu.com/complaints_book_success.html");
	}
}
?>