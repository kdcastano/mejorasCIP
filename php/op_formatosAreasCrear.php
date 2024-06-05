<?php
include( "op_sesion.php" );
include( "../class/formatos_areas.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$for = new formatos_areas();

$area = $_POST[ 'area' ];
foreach ( $area as $registro ) {
  $for->setAre_Codigo( $registro );
  $for->setFor_Codigo( $_POST[ 'formato' ] );

  $for->setForA_FechaHoraCrea( $fecha . ' ' . $hora );
  $for->setForA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $for->setForA_Estado( '1' );

  $resultado[ 'resultado' ] = $for->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $for->imprimirError();
}
echo json_encode( $resultado );
?>