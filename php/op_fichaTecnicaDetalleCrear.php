<?php
include( "op_sesion.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/ficha_tecnica.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$det = new detalle_ficha_tecnica();
$fic = new ficha_tecnica();

$det->setFicT_Codigo( $_POST[ 'FicT_Codigo' ] );
$det->setConFT_Codigo( $_POST[ 'ConFT_Codigo' ] );
$det->setMaq_Codigo( $_POST[ 'Maq_Codigo' ] );
$det->setDetFT_Tipo( $_POST[ 'tipo' ] );
$det->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
if ( $_POST[ 'tipo' ] == 1 ) {
  $det->setDetFT_ValorControlTexto( $_POST[ 'valorControl' ] );
} else {
  $det->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
}
$det->setDetFT_Operador( $_POST[ 'valorOperador' ] );
$det->setDetFT_ValorTolerancia( $_POST[ 'valorTolerancia' ] );
$det->setDetFT_TomaVariable( $_POST[ 'tomaVariable' ] );


$det->setDetFT_FechaHoraCrea( $fecha . ' ' . $hora );
$det->setDetFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$det->setDetFT_Estado( '1' );

$resultado[ 'resultado' ] = $det->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $det->imprimirError();
}
echo json_encode( $resultado );
?>