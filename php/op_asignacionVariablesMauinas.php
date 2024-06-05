<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_variables_configft.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$agrVarCFT = new agrupaciones_variables_configft();

$variables = $_POST['agrVariable'];

foreach($variables as $registro){
  $agrVarCFT->setAgrM_Codigo($_POST['agrMaquina']);
  $agrVarCFT->setAgrC_Codigo($registro);

  $agrVarCFT->setAgrVCon_FechaHoraCrea($fecha.' '.$hora);
  $agrVarCFT->setAgrVCon_UsuarioCrea($_SESSION['CP_Usuario']);
  $agrVarCFT->setAgrVCon_Estado( '1' );

  $resultado[ 'resultado' ] = $agrVarCFT->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agrVarCFT->imprimirError();
}
echo json_encode( $resultado );
?>