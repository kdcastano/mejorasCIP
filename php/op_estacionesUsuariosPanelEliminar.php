<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo($_POST['estacionUsuario']);
$estU->consultar();

//$estU2 = new estaciones_usuarios();
//
//$fechaDiaSiguiente = date("Y-m-d", strtotime($estU->getEstU_Fecha()." + 1 days"));
//
//$resEstU = $estU->listarCodigosEliminarPT($estU->getUsu_Codigo(),$estU->getPueT_Codigo(),$estU->getTur_Codigo(), $estU->getEstU_Fecha(), $fechaDiaSiguiente, $estU->getEstU_FechaHoraCrea());
//
//foreach($resEstU as $registro){
// 
//  $estU2->setEstU_Codigo($registro[0]);
//  $estU2->consultar();
  $estU->setEstU_Estado("0");
  
//}

$resultado['resultado'] = $estU->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $estU->imprimirError();
}
echo json_encode($resultado);
?>