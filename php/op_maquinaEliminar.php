<?php
include("op_sesion.php");
include("../class/maquinas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigo']);
$maq->consultar();

$maq->setMaq_Estado('0');

$resultado['resultado'] = $maq->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $maq->imprimirError();
}
echo json_encode($resultado);
?>