<?php
include("op_sesion.php");
include("../class/respuestas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$resp = new respuestas();
$resp->setRes_Codigo($_POST['codigo']);
$resp->consultar();

$resp->setRes_ValorNum($_POST['valor']);

$resultado['resultado'] = $resp->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $resp->imprimirError();
}
echo json_encode($resultado);
?>