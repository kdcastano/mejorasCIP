<?php
include("op_sesion.php");
include("../class/programa_produccion.php");

$resultado = array();
$proP = new programa_produccion();
$proP->setProP_Codigo($_POST['codigo']);
$proP->consultar();

$proP->setProP_Estado('0');

$resultado['resultado'] = $proP->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>