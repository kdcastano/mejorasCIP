<?php
include("op_sesion.php");
include("../class/variables.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$var = new variables();
$var->setVar_Codigo($_POST['codigo']);
$var->consultar();

$var->setVar_Estado('0');

$resultado['resultado'] = $var->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $var->imprimirError();
}
echo json_encode($resultado);
?>