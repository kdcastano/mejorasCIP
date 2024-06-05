<?php
include("op_sesion.php");
include("../class/estaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$est = new estaciones();

$est->setPla_Codigo($_POST['planta']);
$est->setEst_Nombre($_POST['nombre']);
$est->setEst_FechaHoraCrea($fecha." ".$hora);
$est->setEst_UsuarioCrea($_SESSION['CP_Usuario']);
$est->setEst_Estado("1");

$resultado['resultado'] = $est->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $est->imprimirError();
}
echo json_encode($resultado);
?>