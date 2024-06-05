<?php
include("op_sesion.php");
include("../class/puestos_trabajos_estaciones_maquinas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pueTEM = new puestos_trabajos_estaciones_maquinas();

$maquina = $_POST['maquina'];

foreach($maquina as $registro){
  $pueTEM->setPueT_Codigo($_POST['puestoTrabajo']);
  $pueTEM->setEstM_Codigo($registro);
  $pueTEM->setPueTEM_FechaHoraCrea($fecha." ".$hora);
  $pueTEM->setPueTEM_UsuarioCrea($_SESSION['CP_Usuario']);
  $pueTEM->setPueTEM_Estado("1");

  $resultado['resultado'] = $pueTEM->insertar(); 
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pueTEM->imprimirError();
}
echo json_encode($resultado);
?>