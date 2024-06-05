<?php
include("op_sesion.php");
include("../class/formularios_defectos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$for = new formularios_defectos();

$for->setCal_Codigo($_POST['codCalidad']);
$for->setEstU_Codigo($_POST['codigoEstU']);
$for->setFor_Codigo($_POST['formato']);
$for->setForD_Familia($_POST['familia']);
$for->setForD_Color($_POST['color']);
$for->setForD_Defecto($_POST['defecto']);
$for->setForD_Estampo($_POST['estampo']);
$for->setForD_Lado($_POST['lado']);
$for->setForD_NumeroPiezas($_POST['numPieza']);
$for->setForD_Hora($_POST['hora']);
$for->setForD_Fecha($fecha);

$for->setForD_FechaHoraCrea($fecha.' '.$hora);
$for->setForD_UsuarioCrea($_SESSION['CP_Usuario']);
$for->setForD_Estado('1');

$resultado['resultado'] = $for->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $for->imprimirError();
}
echo json_encode($resultado);
?>