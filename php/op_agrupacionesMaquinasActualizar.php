<?php
include("op_sesion.php");
include("../class/agrupaciones_maquinas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$agr = new agrupaciones_maquinas();
$agr->setAgrM_Codigo($_POST['codigo']);
$agr->consultar();

$agr->setPla_Codigo($_POST['planta']);
$agr->setAgrM_Nombre($_POST['nombre']);
$agr->setAgrM_Estado($_POST['estado']);
$agr->setAgrM_Tipo($_POST['tipo']);
$agr->setAgrM_Orden($_POST['orden']);


$resultado['resultado'] = $agr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $agr->imprimirError();
}
echo json_encode($resultado);
?>