<?php
include("op_sesion.php");
include("../class/unidades_empaque.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$uni = new unidades_empaque();
$uni->setUniE_Codigo($_POST['codigo']);
$uni->consultar();

$uni->setPla_Codigo($_POST['planta']);
$uni->setFor_Codigo($_POST['formato']);
$uni->setUniE_Tipo($_POST['tipo']);
$uni->setUniE_Metros($_POST['metros']);
$uni->setUniE_Estado($_POST['estado']);

$resultado['resultado'] = $uni->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $uni->imprimirError();
}
echo json_encode($resultado);
?>