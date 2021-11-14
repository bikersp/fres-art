<?php 

define('CHAT_TOKEN', 'MODA-FRESSART');
define('CHAT_URL', 'MODA-FRESSART');

function sendMessage($to, $msg){
	$data=[
		'phone' => $to,
		'body' => $msg,
	];
	$json = json_encode($data);
	$url = CHAT_URL.'senMessage?token='.CHAT_TOKEN;
	$options = stream_context_create(['http' =>[
		'method' => 'POST',
		'method' => 'Content-type: application/json',
		'method' => $json
	]]);

	$result = file_get_contents($url, false, $options);
	if ($result) {
		return json_decode($result);		
	}else{
		return false;
	}
}

$msg = "Se ha realizado una Orden de compra 1234";
$result = sendMessage('940130484', $msg);
if ($result != false) {
	if ($result->sent == 1) {
		echo "Mensaje Enviado";
		echo $result->message;
	}else{
		echo $result->message;
	}
}else{
	var_dump(($result))
}

?>