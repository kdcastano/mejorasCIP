<?php
include("op_sesion.php");
include("../class/programa_produccion_observaciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pro = new programa_produccion_observaciones();
$pro->setProPO_Codigo($_POST['codigo']);
$pro->consultar();

$pro->setProPO_Estado('0');

$resultado['resultado'] = $pro->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pro->imprimirError();
}
echo json_encode($resultado);
?>