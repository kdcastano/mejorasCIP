<?php
include("op_sesion.php");
include("../class/agrupaciones.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();
$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['codigo']);
$agr->consultar();

$agr->setPla_Codigo($_POST['planta']);
$agr->setAgr_Nombre($_POST['nombre']);
$agr->setAgr_Tipo($_POST['tipo']);
$agr->setAgr_Secuencia($_POST['secuencia']);
$agr->setAgr_Estado($_POST['estado']);

$resultado['resultado'] = $agr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $agr->imprimirError();
}
echo json_encode($resultado);
?>