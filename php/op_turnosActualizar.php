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

$tur->setPla_Codigo($_POST['planta']);
$tur->setTur_Nombre($_POST['nombre']);
$tur->setTur_HoraInicio($_POST['horaI']);
$tur->setTur_HoraFin($_POST['horaF']);
$tur->setTur_Estado($_POST['estado']);


$resultado['resultado'] = $tur->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $tur->imprimirError();
}
echo json_encode($resultado);
?>