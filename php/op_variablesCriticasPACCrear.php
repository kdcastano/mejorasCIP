<?php
include("op_sesion.php");
include("../class/planes_acciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pla = new planes_acciones();
$pla->setPlaA_Codigo($_POST['codigo']);
$pla->consultar();

$pla->setPlaA_ObservacionesSupervisor($_POST['observacion']);
$pla->setPlaA_FechaObservacionesSupervisor($fecha);
$pla->setPlaA_HoraObservacionesSupervisor($hora);
$pla->setPlaA_Prioridad($_POST['prioridad']);
$pla->setPlaA_Supervisor($_POST['supervisor']);

$resultado['resultado'] = $pla->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pla->imprimirError();
}
echo json_encode($resultado);
?>