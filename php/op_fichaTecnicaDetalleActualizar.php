<?php
include( "op_sesion.php" );
include( "../class/detalle_ficha_tecnica.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$det = new detalle_ficha_tecnica();
$det->setDetFT_Codigo($_POST['codigo']);
$det->consultar();

$det->setDetFT_Tipo( $_POST[ 'tipo' ] );
$det->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
if ( $_POST[ 'tipo' ] == 1 ) {
  $det->setDetFT_ValorControlTexto( $_POST[ 'valorControl' ] );
  $det->setDetFT_UnidadMedida(NULL);
  $det->setDetFT_ValorControl(NULL);
  $det->setDetFT_ValorTolerancia(NULL);
  $det->setDetFT_Operador(NULL);
  $det->setDetFT_TomaVariable(NULL);
} else {
  $det->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
}
$det->setDetFT_Operador( $_POST[ 'valorOperador' ] );
$det->setDetFT_ValorTolerancia( $_POST[ 'valorTolerancia' ] );
$det->setDetFT_TomaVariable( $_POST[ 'tomaVariable' ] );


$resultado[ 'resultado' ] = $det->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $det->imprimirError();
}
echo json_encode( $resultado );
?>