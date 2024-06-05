<?php
include("op_sesion.php");
include("../class/areas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$are = new areas();
$are->setAre_Codigo($_POST['codigo']);
$are->consultar();

$are->setAre_Estado('0');

$resultado['resultado'] = $are->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $are->imprimirError();
}
echo json_encode($resultado);
?>