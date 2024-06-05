<?php
include( "op_sesion.php" );
include( "../class/plantas_usuarios.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$pla = new plantas_usuarios();

$planta = $_POST[ 'planta' ];
foreach ( $planta as $registro ) {

  $pla->setUsu_Codigo( $_POST[ 'usuario' ] );
  $pla->setPla_Codigo( $registro );

  $pla->setPlaU_FechaHoraCrea( $fecha . ' ' . $hora );
  $pla->setPlaU_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $pla->setPlaU_Estado( '1' );

  $resultado[ 'resultado' ] = $pla->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $pla->imprimirError();
}
echo json_encode( $resultado );
?>