<?php
include("op_sesion.php");
include("../class/programa_produccion.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pPro = new programa_produccion();
$pPro->setProP_Codigo($_POST['codigo']);
$pPro->consultar();

$pPro->setProP_Prioridad($_POST['numero']);

$resultado['resultado'] = $pPro->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pPro->imprimirError();
}
echo json_encode($resultado);
?>