<?php
include("op_sesion.php");
include("../class/turnos_operaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$turOpe = new turnos_operaciones();
$turOpe->setTurO_Codigo($_POST['codigo']);
$turOpe->consultar();

$turOpe->setTurO_Estado("0");

$resultado['resultado'] = $turOpe->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $turOpe->imprimirError();
}
echo json_encode($resultado);
?>