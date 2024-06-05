<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/sap_programa_produccion.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$proP = new programa_produccion();
$proP->setProP_Codigo($_POST['codigo']);
$proP->consultar();

$proP->setProP_Estado('0');

$resultado['resultado'] = $proP->actualizar();

if($resultado['resultado']){
  
  $sap = new sap_programa_produccion();
  $sap->updateActivarReferenciasSap($_POST['formato'], $_POST['familia'], $_POST['color'], $_POST['semana']);
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>