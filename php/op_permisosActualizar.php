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


$per->setPer_Modulo($_POST['modulo']);
$per->setPer_Tipo($_POST['tipo']);
$per->setPer_Descripcion($_POST['descripcion']);
$per->setPer_Estado($_POST['estado']);


$resultado['resultado'] = $per->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $per->imprimirError();
}
echo json_encode($resultado);
?>