<?php
include("op_sesion.php");
include("../class/puestos_trabajos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pueT = new puestos_trabajos();

$pueT->setEstA_Codigo($_POST['estacionesAreas']);
$pueT->setPueT_Nombre($_POST['nombre']);
$pueT->setPueT_FechaHoraCrea($fecha." ".$hora);
$pueT->setPueT_UsuarioCrea($_SESSION['CP_Usuario']);
$pueT->setPueT_Estado("1");

$resultado['resultado'] = $pueT->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pueT->imprimirError();
}
echo json_encode($resultado);
?>