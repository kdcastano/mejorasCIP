<?php
include("op_sesion.php");
include("../class/maquinas.php");
include( "../class/agrupaciones_maquinas_configft.php" );
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$agrMaqCFT = new agrupaciones_maquinas_configft();

$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigo']);
$maq->consultar();

$maq->setAre_Codigo($_POST['area']);
$maq->setMaq_Nombre($_POST['nombre']);
$maq->setMaq_Estado($_POST['estado']);
$maq->setAgrM_Codigo($_POST['agrupacion']);
$maq->setMaq_Orden($_POST['orden']);


$resultado['resultado'] = $maq->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  if($_POST['codAgrMaqCFT'] != ""){
    
    $agrMaqCFT->setAgrMCon_Codigo($_POST['codAgrMaqCFT']);
    $agrMaqCFT->consultar();

    $agrMaqCFT->setAgrM_Codigo($_POST['agrupacion']);
  //  $agrMaqCFT->setMaq_Codigo($_POST['codigo']);

    if($_POST['estado'] == "0"){
      $agrMaqCFT->setAgrMCon_Estado( '0' );
    }else{
      $agrMaqCFT->setAgrMCon_Estado( '1' );
    }

    $agrMaqCFT->actualizar();
    
  }else{
    
    $maq2 = new maquinas();
    $maq2->setMaq_Codigo($_POST['codigo']);
    $maq2->consultar();
    
    $agrMaqCFT->setAgrM_Codigo($_POST['agrupacion']);
    $agrMaqCFT->setMaq_Codigo($maq2->getMaq_Codigo());

    $agrMaqCFT->setAgrMCon_FechaHoraCrea($fecha.' '.$hora);
    $agrMaqCFT->setAgrMCon_UsuarioCrea($_SESSION['CP_Usuario']);
    $agrMaqCFT->setAgrMCon_Estado( '1' );

    $agrMaqCFT->insertar();
  }
  
}else{
	$resultado['mensaje'] = $maq->imprimirError();
}
echo json_encode($resultado);
?>