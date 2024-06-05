<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/estados_programa_produccion.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$proP = new programa_produccion();
$proP->setProP_Codigo($_POST['codigo']);
$proP->consultar();

if($_POST['estado'] != $_POST['estadoComp']){
  $estProP = new estados_programa_produccion();

  $estProP->setProP_Codigo($_POST['codigo']);
  $estProP->setEProP_EstadoActual($_POST['estado']);
  $estProP->setEProP_FechaHoraCrea($fecha." ".$hora);
  $estProP->setEProP_UsuarioCrea($_SESSION['CP_Usuario']);
  $estProP->setEProP_Estado("1");

  $resultado['resultado'] = $estProP->insertar();
}else{
  $resultado['resultado'] = true; 
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  if($_POST['horaConfirmada'] != "" && $_POST['horaConfirmada'] != NULL){
    $proP->setProP_HoraConfirmada(PasarAMPMaMilitar($_POST['horaConfirmada']));
    $proP->actualizar();
  }
  
  if($_POST['fechaConfirmada'] != "" && $_POST['fechaConfirmada'] != NULL){
    $proP->setProP_FechaConfirmada($_POST['fechaConfirmada']);
    $proP->actualizar();
  }
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>