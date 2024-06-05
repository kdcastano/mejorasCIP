<?php
include("op_sesion.php");
include("../class/puestos_trabajos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo($_POST['codigo']);
$pueT->consultar();

$pueT->setPueT_Nombre($_POST['nombre']);

$resultado['resultado'] = $pueT->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pueT->imprimirError();
}
echo json_encode($resultado);
?>