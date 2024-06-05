<?php
include("op_sesion.php");
include("../class/estaciones_maquinas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estM = new estaciones_maquinas();

$maquina = $_POST['maquina'];

foreach($maquina as $registro){
  $estM->setEst_Codigo($_POST['estacion']);
  $estM->setMaq_Codigo($registro);
  $estM->setEstM_FechaHoraCrea($fecha." ".$hora);
  $estM->setEstM_UsuarioCrea($_SESSION['CP_Usuario']);
  $estM->setEstM_Estado("1");

  $resultado['resultado'] = $estM->insertar(); 
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estM->imprimirError();
}
echo json_encode($resultado);
?>