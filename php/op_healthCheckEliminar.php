<?php
include("op_sesion.php");
include("../class/health_check.php");
include_once("../class/usuarios.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");


$resultado = array();
$hea = new health_check();
$hea->setHeaC_Codigo($_POST['codigo']);
$hea->consultar();

$hea->setHeaC_Estado('0');

$resultado['resultado'] = $hea->actualizar();
	

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $hea->imprimirError();
}
echo json_encode($resultado);
?>