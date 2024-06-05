<?php
include("op_sesion.php");
include("../class/plantas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pla = new plantas();

$pla->setPla_CentroCostos($_POST['centroCosto']);
$pla->setPla_Nombre($_POST['nombre']);
$pla->setPla_VerMarcaSubMarca($_POST['acceso']);
$pla->setPla_FormatoSAP($_POST['formato']);
$pla->setPla_Tolerancia($_POST['horaAHora']);
$pla->setPla_CantidadAprobador($_POST['aprobador']);
//$pla->setPla_Grupo($_POST['grupo']);
//$pla->setPla_Negocio($_POST['negocio']);
//$pla->setPla_Distribucion($_POST['distribucion']);
//$pla->setPla_Marca($_POST['marca']);

$pla->setPla_FechaHoraCrea($fecha.' '.$hora);
$pla->setPla_UsuarioCrea($_SESSION['CP_Usuario']);
$pla->setPla_Estado('1');

$resultado['resultado'] = $pla->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pla->imprimirError();
}
echo json_encode($resultado);
?>