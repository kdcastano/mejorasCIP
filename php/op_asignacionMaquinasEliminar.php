<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas_configft.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$agrMaqCFT = new agrupaciones_maquinas_configft();
$agrMaqCFT->setAgrMCon_Codigo($_POST['codigo']);
$agrMaqCFT->consultar();

$agrMaqCFT->setAgrMCon_Estado( '0' );

$resultado[ 'resultado' ] = $agrMaqCFT->actualizar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agrMaqCFT->imprimirError();
}
echo json_encode( $resultado );
?>