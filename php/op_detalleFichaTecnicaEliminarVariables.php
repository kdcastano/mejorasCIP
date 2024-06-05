<?php
include("op_sesion.php");
include("../class/detalle_ficha_tecnica.php");
include("../class/maquinas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigoMaquina']);
$maq->consultar();

$det = new detalle_ficha_tecnica();
$resDet = $det->listarVariablesMaquinasInfo($_POST['codigoMaquina'], $maq->getAre_Codigo(), $_POST['codigoFT']); 

foreach($resDet as $registro){
  $det->setDetFT_Codigo($registro[0]);
  $det->consultar();

  $det->setDetFT_Estado('0');

  $resultado['resultado'] = $det->actualizar();
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $det->imprimirError();
}
echo json_encode($resultado);
?>