<?php
include("op_sesion.php");
include("../class/tipo_mercado.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$tip = new tipo_mercado();
$tip->setTipM_Codigo($_POST['codigo']);
$tip->consultar();

$tip->setTipM_Estado('0');

$resultado['resultado'] = $tip->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $tip->imprimirError();
}
echo json_encode($resultado);
?>