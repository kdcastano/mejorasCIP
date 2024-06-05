<?php
include("op_sesion.php");
include("../class/formularios_defectos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$for = new formularios_defectos();
$for->setForD_Codigo($_POST['codigo']);
$for->consultar();

$for->setForD_Defecto($_POST['defecto']);
$for->setForD_Estampo($_POST['estampo']);
$for->setForD_Lado($_POST['lado']);
$for->setForD_NumeroPiezas($_POST['numPieza']);

$resultado['resultado'] = $for->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $for->imprimirError();
}
echo json_encode($resultado);
?>