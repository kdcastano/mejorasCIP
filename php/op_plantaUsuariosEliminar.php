<?php
include("op_sesion.php");
include("../class/plantas_usuarios.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pla = new plantas_usuarios();
$pla->setPlaU_Codigo($_POST['codigo']);
$pla->consultar();

$pla->setPlaU_Estado('0');

$resultado['resultado'] = $pla->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pla->imprimirError();
}
echo json_encode($resultado);
?>