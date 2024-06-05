<?php
include("op_sesion.php");
include("../class/puestos_trabajos_estaciones_maquinas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pueTEM = new puestos_trabajos_estaciones_maquinas();
$pueTEM->setPueTEM_Codigo($_POST['codigo']);
$pueTEM->consultar();

$pueTEM->setPueTEM_Estado("0");

$resultado['resultado'] = $pueTEM->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pueTEM->imprimirError();
}
echo json_encode($resultado);
?>