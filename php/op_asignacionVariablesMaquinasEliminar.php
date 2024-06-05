<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_variables_configft.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$agrVarCFT = new agrupaciones_variables_configft();
$agrVarCFT->setAgrVCon_Codigo($_POST['codigo']);
$agrVarCFT->consultar();

$agrVarCFT->setAgrVCon_Estado( '0' );

$resultado[ 'resultado' ] = $agrVarCFT->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agrVarCFT->imprimirError();
}
echo json_encode( $resultado );
?>