<?php
include( "op_sesion.php" );
include( "../class/maquinas.php" );
include( "../class/agrupaciones_maquinas_configft.php" );
include_once( "../class/usuarios.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$maq = new maquinas();

$agrMaqCFT = new agrupaciones_maquinas_configft();

$maq->setAre_Codigo( $_POST[ 'area' ] );
$maq->setMaq_Nombre( $_POST[ 'nombre' ] );
$maq->setAgrM_Codigo( NULL );
$maq->setMaq_Orden( $_POST[ 'orden' ] );

$maq->setMaq_FechaHoraCrea( $fecha . ' ' . $hora );
$maq->setMaq_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$maq->setMaq_Estado( '1' );

$resultado[ 'resultado' ] = $maq->insertar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
//  $_POST[ 'agrupacion' ]
  
  $MaqAgr = $maq->buscarUltimoRegistroCreadoMaquina($_SESSION['CP_Usuario']);
  $agrMaqCFT->setAgrM_Codigo($_POST[ 'agrupacion' ]);
  $agrMaqCFT->setMaq_Codigo($MaqAgr[0]);

  $agrMaqCFT->setAgrMCon_FechaHoraCrea($fecha.' '.$hora);
  $agrMaqCFT->setAgrMCon_UsuarioCrea($_SESSION['CP_Usuario']);
  $agrMaqCFT->setAgrMCon_Estado( '1' );

  $agrMaqCFT->insertar();
} else {
  $resultado[ 'mensaje' ] = $maq->imprimirError();
}
echo json_encode( $resultado );
?>