<?php
include( "op_sesion.php" );
include( "../class/semanas.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$sem = new semanas();


$sem->setSem_Semana( $_POST[ 'semana' ] );
$sem->setSem_FechaInicial( $_POST[ 'fechaIni' ] );
$sem->setSem_FechaFinal( $_POST[ 'fechaFin' ] );

$sem->setSem_FechaHoraCrea( $fecha . ' ' . $hora );
$sem->setSem_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$sem->setSem_Estado( '1' );


$resultado[ 'resultado' ] = $sem->insertar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $sem->imprimirError();
}
echo json_encode( $resultado );
?>