<?php
include("op_sesion.php");
include("../class/estaciones_areas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estA = new estaciones_areas();

$estA->setEst_Codigo($_POST['estacion']);
$estA->setAre_Codigo($_POST['area']);
$estA->setEstA_FechaHoraCrea($fecha." ".$hora);
$estA->setEstA_UsuarioCrea($_SESSION['CP_Usuario']);
$estA->setEstA_Estado("1");

$resultado['resultado'] = $estA->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estA->imprimirError();
}
echo json_encode($resultado);
?>