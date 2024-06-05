<?php
include("op_sesion.php");
include("../class/submarcas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$sub = new submarcas();
$sub->setSub_Codigo($_POST['codigo']);
$sub->consultar();

$sub->setSub_Estado('0');

$resultado['resultado'] = $sub->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $sub->imprimirError();
}
echo json_encode($resultado);
?>