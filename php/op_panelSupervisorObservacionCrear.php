<?php
include("op_sesion.php");
include("../class/respuestas_observaciones.php");
include_once("../class/usuarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$res = new respuestas_observaciones();

//if($usu->getUsu_Rol() == "2" || $usu->getUsu_Rol() == "3" || $usu->getUsu_Rol() == "4"){
//  
//}

$res->setRes_Codigo($_POST['resCodigo']);
$res->setUsu_Codigo($_SESSION['CP_Usuario']);
$res->setResO_Fecha($fecha);
$res->setResO_Hora($hora);
$res->setResO_Observacion($_POST['observacion']);

$res->setResO_FechaHoraCrea($fecha.' '.$hora);
$res->setResO_UsuarioCrea($_SESSION['CP_Usuario']);
$res->setResO_Estado('1');

$resultado['resultado'] = $res->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $res->imprimirError();
}
echo json_encode($resultado);
?>