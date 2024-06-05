<?php
include("op_sesion.php");
include("../class/planes_acciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$plaA = new planes_acciones();
$plaA->setPlaA_Codigo($_POST['codigoPlanAccion']);
$plaA->consultar();

$plaA->setPlaA_ObservacionesSupervisor($_POST['observacion']);

$resultado['resultado'] = $plaA->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $plaA->imprimirError();
}
echo json_encode($resultado);
?>