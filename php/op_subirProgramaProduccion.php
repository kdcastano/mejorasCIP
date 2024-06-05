<?php
include("op_sesion.php");
include("../class/programa_produccion.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pPro = new programa_produccion();
$pPro->setProP_Codigo($_POST['codigo']);
$pPro->consultar();

$pPro->setProP_Prioridad($pPro->getProP_Prioridad()-1);

$resultado['resultado'] = $pPro->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  $pPro2 = new programa_produccion();
  $pPro2->setProP_Codigo($_POST['codigoArriba']);
  $pPro2->consultar();

  $pPro2->setProP_Prioridad($pPro2->getProP_Prioridad()+1);

  $pPro2->actualizar();
}else{
	$resultado['mensaje'] = $pPro->imprimirError();
}
echo json_encode($resultado);
?>