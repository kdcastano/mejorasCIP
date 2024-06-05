<?php
include("op_sesion.php");
include("../class/areas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$are = new areas();
$are->setAre_Codigo($_POST['codigo']);
$are->consultar();

if($_POST['areaSiguiente'] != ""){
  $are->setAre_Siguiente($_POST['areaSiguiente']);
}else{
  $are->setAre_Siguiente(NULL);
}
if($_POST['areaAnterior'] != ""){
  $are->setAre_Anterior($_POST['areaAnterior']);
}else{
 $are->setAre_Anterior(NULL);
}
$are->setAre_Nombre($_POST['nombre']);
$are->setAre_Secuencia($_POST['secuencia']);
$are->setAre_Tipo($_POST['tipo']);
$are->setAre_Estado($_POST['estado']);

$resultado['resultado'] = $are->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $are->imprimirError();
}
echo json_encode($resultado);
?>