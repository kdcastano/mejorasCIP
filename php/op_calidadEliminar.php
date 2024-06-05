<?php
include("op_sesion.php");
include("../class/calidad.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$cal = new calidad();
$cal->setCal_Codigo($_POST['codigo']);
$cal->consultar();

$cal->setCal_Estado('0');

$resultado['resultado'] = $cal->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $cal->imprimirError();
}
echo json_encode($resultado);
?>