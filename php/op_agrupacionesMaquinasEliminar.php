<?php
include("op_sesion.php");
include("../class/agrupaciones_maquinas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$agr = new agrupaciones_maquinas();
$agr->setAgrM_Codigo($_POST['codigo']);
$agr->consultar();

$agr->setAgrM_Estado('0');

$resultado['resultado'] = $agr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $agr->imprimirError();
}
echo json_encode($resultado);
?>