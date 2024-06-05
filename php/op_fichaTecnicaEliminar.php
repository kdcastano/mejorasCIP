<?php
include("op_sesion.php");
include("../class/ficha_tecnica.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$fic = new ficha_tecnica();
$fic->setFicT_Codigo($_POST['codigo']);
$fic->consultar();

$fic->setFicT_Estado('0');

$resultado['resultado'] = $fic->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $fic->imprimirError();
}
echo json_encode($resultado);
?>