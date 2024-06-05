<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_areas.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$agrA = new agrupaciones_areas();

$area = $_POST[ 'area' ];
foreach ( $area as $registro ) {

  $agrA->setAgr_Codigo( $_POST[ 'agrupacion' ] );
  $agrA->setAre_Codigo( $registro );

  $agrA->setAgrA_FechaHora( $fecha . ' ' . $hora );
  $agrA->setAgrA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $agrA->setAgrA_Estado( '1' );

  $resultado[ 'resultado' ] = $agrA->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agrA->imprimirError();
}
echo json_encode( $resultado );
?>