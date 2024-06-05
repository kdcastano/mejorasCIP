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

$fic->setPla_Codigo($fic->getPla_Codigo());
$fic->setFor_Codigo($fic->getFor_Codigo());
$fic->setFicT_Familia($fic->getFicT_Familia());
$fic->setFicT_Color($fic->getFicT_Color());
$fic->setFicT_FecEmision($fecha);
$fic->setFicT_CicloHorno(NULL);
$fic->setFicT_NombreArchivo($fic->getFicT_NombreArchivo());

$fic->setFicT_fechaHoraCrea($fecha.' '.$hora);
$fic->setFicT_UsuarioCrea($_SESSION['CP_Usuario']);
$fic->setFicT_Estado('1');

$resultado['resultado'] = $cli->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $cli->imprimirError();
}
echo json_encode($resultado);
?>