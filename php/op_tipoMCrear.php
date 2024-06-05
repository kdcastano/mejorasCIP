<?php
include( "op_sesion.php" );
include( "../class/tipo_mercado.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$tip = new tipo_mercado();

$submarca = $_POST[ 'submarca' ];
foreach ( $submarca as $registro ) {
	
  $tip->setPla_Codigo( $_POST[ 'planta' ] );
  $tip->setSub_Codigo( $registro );
  $tip->setTipM_Tipo( $_POST[ 'tipo' ] );

  $tip->setTipM_FechaHoraCrea( $fecha . ' ' . $hora );
  $tip->setTipM_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $tip->setTipM_Estado( '1' );


  $resultado[ 'resultado' ] = $tip->insertar();
}


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $tip->imprimirError();
}
echo json_encode( $resultado );
?>