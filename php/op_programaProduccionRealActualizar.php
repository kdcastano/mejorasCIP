<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/estados_programa_produccion.php");
include("../class/semanas.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$sem = new semanas();

$resSemFec = $sem->hallarSemanaFecha($_POST['fecha']);

$proP = new programa_produccion();
$proP->setProP_Codigo($_POST['codigo']);
$proP->consultar();

$proP->setProP_Semana($resSemFec[0]);
$proP->setProP_Fecha($_POST['fecha']);
$proP->setAre_Codigo($_POST['horno']);

if($_POST['cantidadOrdenada'] != ""){
  $proP->setProP_Cantidad(str_replace(",", "", $_POST['cantidadOrdenada']));
}else{
  $proP->setProP_Cantidad(NULL);
}

if($_POST['cantidadEP'] != ""){
  $proP->setProP_CantEP(str_replace(",", "", $_POST['cantidadEP']));
}else{
  $proP->setProP_CantEP(NULL);
}

if($_POST['cantidadEXPO'] != ""){
  $proP->setProP_CantEXPO(str_replace(",", "", $_POST['cantidadEXPO']));
}else{
  $proP->setProP_CantEXPO(NULL);
}

if($_POST['metrosEP'] != ""){
  $proP->setProP_MetrosEP(str_replace(",", "", $_POST['metrosEP']));
}else{
  $proP->setProP_MetrosEP(NULL);
}

if($_POST['metrosEXPO'] != ""){
  $proP->setProP_MetrosEXPO(str_replace(",", "", $_POST['metrosEXPO']));
}else{
  $proP->setProP_MetrosEXPO(NULL);
}

$proP->setProP_HoraInicio(PasarAMPMaMilitar($_POST['horaInicio']));

$resultado['resultado'] = $proP->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  if($_POST['estado'] != $_POST['estadoComp']){
    $estProP = new estados_programa_produccion();
    
    $estProP->setProP_Codigo($_POST['codigo']);
    $estProP->setEProP_EstadoActual($_POST['estado']);
    $estProP->setEProP_FechaHoraCrea($fecha." ".$hora);
    $estProP->setEProP_UsuarioCrea($_SESSION['CP_Usuario']);
    $estProP->setEProP_Estado("1");
    
    $estProP->insertar();
  }
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>