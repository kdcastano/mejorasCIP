<?php
include("op_sesion.php");
include("../class/agrupaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['codigo']);
$agr->consultar();

$agr->setAgr_Estado('0');

$resultado['resultado'] = $agr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $agr->imprimirError();
}
echo json_encode($resultado);
?>