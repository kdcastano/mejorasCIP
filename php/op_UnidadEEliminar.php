<?php
include("op_sesion.php");
include("../class/unidades_empaque.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$uni = new unidades_empaque();
$uni->setUniE_Codigo($_POST['codigo']);
$uni->consultar();

$uni->setUniE_Estado('0');

$resultado['resultado'] = $uni->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $uni->imprimirError();
}
echo json_encode($resultado);
?>