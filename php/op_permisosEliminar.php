<?php
include("op_sesion.php");
include("../class/permisos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$per = new permisos();
$per->setPer_Codigo($_POST['codigo']);
$per->consultar();

$per->setPer_Estado('0');

$resultado['resultado'] = $per->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $per->imprimirError();
}
echo json_encode($resultado);
?>