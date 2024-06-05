<?php
include("op_sesion.php");
include("../class/estaciones_maquinas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estM = new estaciones_maquinas();
$estM->setEstM_Codigo($_POST['codigoEst']);
$estM->consultar();

$estM->setEstM_Estado("0");

$resultado['resultado'] = $estM->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estM->imprimirError();
}
echo json_encode($resultado);
?>