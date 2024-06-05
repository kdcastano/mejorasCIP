<?php
include("op_sesion.php");
include("../class/formatos_hornos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$for = new formatos_hornos();
$for->setForH_Codigo($_POST['codigo']);
$for->consultar();

$for->setAre_Codigo($_POST['area']);
$for->setFor_Codigo($_POST['formato']);
$for->setForH_Estado($_POST['estado']);


$resultado['resultado'] = $for->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $for->imprimirError();
}
echo json_encode($resultado);
?>