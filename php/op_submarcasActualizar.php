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

$sub->setPla_Codigo($_POST['planta']);
$sub->setSub_Nombre($_POST['nombre']);
$sub->setSub_Estado($_POST['estado']);


$resultado['resultado'] = $sub->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $sub->imprimirError();
}
echo json_encode($resultado);
?>