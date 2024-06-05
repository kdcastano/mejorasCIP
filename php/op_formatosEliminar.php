<?php
include("op_sesion.php");
include("../class/formatos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$for = new formatos();
$for->setFor_Codigo($_POST['codigo']);
$for->consultar();

$for->setFor_Estado('0');

$resultado['resultado'] = $for->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $for->imprimirError();
}
echo json_encode($resultado);
?>