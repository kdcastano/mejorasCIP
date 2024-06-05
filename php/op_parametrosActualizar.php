<?php
include("op_sesion.php");
include("../class/parametros.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$par = new parametros();
$par->setpar_Codigo($_POST['codigo']);
$par->consultar();

$par->setPla_Codigo($_POST['planta']);
$par->setPar_Nombre($_POST['nombre']);
$par->setPar_Tipo($_POST['tipo']);
$par->setPar_Estado($_POST['estado']);
$par->setPar_RelacionFT($_POST['efecto']);


$resultado['resultado'] = $par->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $par->imprimirError();
}
echo json_encode($resultado);
?>