<?php
include("op_sesion.php");
include("../class/estaciones_areas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$estA = new estaciones_areas();
$estA->setEstA_Codigo($_POST['codigo1']);
$estA->consultar();

$estA->setEstA_Estado('0');

$resultado['resultado'] = $estA->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estA->imprimirError();
}
echo json_encode($resultado);
?>