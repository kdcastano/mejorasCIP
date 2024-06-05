<?php
include( "op_sesion.php" );
include( "../class/unidades_empaque.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$uni = new unidades_empaque();


$uni->setPla_Codigo( $_POST[ 'planta' ] );
$uni->setFor_Codigo( $_POST[ 'formato' ] );
$uni->setUniE_Tipo( $_POST[ 'tipo' ] );
$uni->setUniE_Metros( $_POST[ 'metros' ] );

$uni->setUniE_FechaHoraCrea( $fecha . ' ' . $hora );
$uni->setUniE_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$uni->setUniE_Estado( '1' );


$resultado[ 'resultado' ] = $uni->insertar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $uni->imprimirError();
}
echo json_encode( $resultado );
?>