<?php
include("op_sesion.php");
include("../class/estados_programa_produccion.php");
include("../class/programa_produccion.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$proP = new programa_produccion();
$estProP = new estados_programa_produccion();

$estProP->setProP_Codigo($_POST['codigo']);
$estProP->setEProP_EstadoActual($_POST['estadoActual']);
$estProP->setEProP_FechaHoraCrea($fecha." ".$hora);
$estProP->setEProP_UsuarioCrea($_SESSION['CP_Usuario']);
$estProP->setEProP_Estado("1");

$resultado['resultado'] = $estProP->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
   if($_POST['estadoActual'] == "Cancelado" || $_POST['estadoActual'] == "Suspendido"){
    $proP->setProP_Codigo($_POST['codigo']);
    $proP->consultar();
    $proP->setProP_ObservacionEstado($_POST['observacion']);
    $resultado['resultado2'] = $proP->actualizar();
   
    if($resultado['resultado2']){
      $resultado['mensaje2'] = "OK";
    }else{
      $resultado['mensaje2'] = $proP->imprimirError();
    }
  }
}else{
	$resultado['mensaje'] = $estProP->imprimirError();
}
echo json_encode($resultado);
?>