<?php
include("op_sesion.php");
include("../class/bitacoras.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$bit = new bitacoras();
$bit->setBit_Codigo($_POST['codigo']);
$bit->consultar();

$bit->setBit_Estado('0');

$resultado['resultado'] = $bit->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $bit->imprimirError();
}
echo json_encode($resultado);
?>