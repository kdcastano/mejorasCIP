<?php
include("op_sesion.php");
include("../class/respuestas_observaciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$res = new respuestas_observaciones();
$res->setResO_Codigo($_POST['codigo']);
$res->consultar();

$res->setResO_Estado('0');

$resultado['resultado'] = $res->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $res->imprimirError();
}
echo json_encode($resultado);
?>