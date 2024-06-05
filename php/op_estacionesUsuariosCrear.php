<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");
include("../class/turnos.php");

$tur = new turnos();
$tur->setTur_Codigo($_POST['turno']);
$tur->consultar();

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

 $fechaDiaSiguiente = date("Y-m-d", strtotime($fecha." + 1 days"));

$resultado = array();

$estU = new estaciones_usuarios();

$lista1 = $_POST['lista1'];
$r = $_POST['num'];

for($a = 0; $a < $r; $a++){
  
  $estU->setUsu_Codigo($_SESSION['CP_Usuario']);
  $estU->setPueT_Codigo($lista1[$a]);
  $estU->setTur_Codigo($_POST['turno']);
  $estU->setEstU_Fecha($fecha);
  $estU->setEstU_FechaHoraCrea($fecha." ".$hora);
  $estU->setEstU_UsuarioCrea($_SESSION['CP_Usuario']);
  $estU->setEstU_Estado("1");

  $resultado['resultado'] = $estU->insertar();
  
  $UltPueTIns = $lista1[$a];
  
  //turno 3 solo activar -> pendiente eliminar varios puestos de trabajo (turno 3)
//  if(date("H:i", strtotime($tur->getTur_HoraInicio())) >= date("H:i", strtotime("22:00:00")) && date("H:i", strtotime($tur->getTur_HoraFin())) <= date("H:i", strtotime("23:59:00"))){
//    
//    $estU->setUsu_Codigo($_SESSION['CP_Usuario']);
//    $estU->setPueT_Codigo($lista1[$a]);
//    $estU->setTur_Codigo($_POST['turno']);
//    $estU->setEstU_Fecha($fechaDiaSiguiente);
//    $estU->setEstU_FechaHoraCrea($fecha." ".$hora);
//    $estU->setEstU_UsuarioCrea($_SESSION['CP_Usuario']);
//    $estU->setEstU_Estado("1");
//
//    $estU->insertar();
//
//    $UltPueTIns = $lista1[$a];
//  }
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  $resEstU = $estU->hallarCodigoEstacionUsuarioCrear($UltPueTIns, $_POST['turno'], $fecha, $_SESSION['CP_Usuario']);
  
  $resultado['CodigoEstTra'] = $resEstU[0];
  $resultado['CodigoUsuPT'] = $_SESSION['CP_Usuario'];
}else{
	$resultado['mensaje'] = $estU->imprimirError();
}
echo json_encode($resultado);
?>