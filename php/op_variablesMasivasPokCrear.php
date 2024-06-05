<?php
include("op_sesion.php");
include("../class/respuestas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$resp = new respuestas();

$resp->setVar_Codigo($_POST['variable']);
$resp->setEstU_Codigo($_POST['estacionUsuario']);
$resp->setRes_ValorTexto(NULL);
$resp->setRes_ValorNum($_POST['valor']);
$resp->setRes_Fecha($fecha);
$resp->setRes_HoraReal($hora);
$resp->setRes_HoraSugerida($_POST['hora']);
$resp->setRes_UsuarioCrea($_SESSION['CP_Usuario']);
$resp->setRes_Estado("1");

$resultado['resultado'] = $resp->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $resp->imprimirError();
}
echo json_encode($resultado);
?>