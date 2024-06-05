<?php
include("op_sesion.php");
include("../class/programa_produccion_observaciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pro = new programa_produccion_observaciones();

$pro->setAre_Codigo($_POST['area']);
$pro->setProPO_Semana($_POST['semana']);
$pro->setProPO_Observacion($_POST['observacion']);

$pro->setProPO_FechaHoraCrea($fecha.' '.$hora);
$pro->setProPO_UsuarioCrea($_SESSION['CP_Usuario']);
$pro->setProPO_Estado('1');

$resultado['resultado'] = $pro->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pro->imprimirError();
}
echo json_encode($resultado);
?>