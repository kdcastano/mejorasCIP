<?php
include("op_sesion.php");
include("../class/turnos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$tur = new turnos();
$tur->setTur_Codigo($_POST['codigo']);
$tur->consultar();

$tur->setTur_Estado('0');

$resultado['resultado'] = $tur->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $tur->imprimirError();
}
echo json_encode($resultado);
?>