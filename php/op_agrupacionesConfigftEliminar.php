<?php
include("op_sesion.php");
include("../class/agrupaciones_configft.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$agr = new agrupaciones_configft();
$agr->setAgrC_Codigo($_POST['codigo']);
$agr->consultar();

$agr->setAgrC_Estado('0');

$resultado['resultado'] = $agr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $agr->imprimirError();
}
echo json_encode($resultado);
?>