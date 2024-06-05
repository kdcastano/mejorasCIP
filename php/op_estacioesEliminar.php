<?php
include("op_sesion.php");
include("../class/estaciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$est = new estaciones();
$est->setEst_Codigo($_POST['codigo']);
$est->consultar();

$est->setEst_Estado('0');

$resultado['resultado'] = $est->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $est->imprimirError();
}
echo json_encode($resultado);
?>