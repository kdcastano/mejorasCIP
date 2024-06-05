<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo($_POST['estacionUsuario']);
$estU->consultar();

$estU->setForM_Codigo($_POST['formulaMolienda']);

$resultado['resultado'] = $estU->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estU->imprimirError();
}
echo json_encode($resultado);
?>