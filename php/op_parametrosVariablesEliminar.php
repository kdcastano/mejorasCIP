<?php
include("op_sesion.php");
include("../class/parametros_variables.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$par = new parametros_variables();
$par->setParV_Codigo($_POST['codigo']);
$par->consultar();

$par->setParV_Estado('0');

$resultado['resultado'] = $par->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $par->imprimirError();
}
echo json_encode($resultado);
?>