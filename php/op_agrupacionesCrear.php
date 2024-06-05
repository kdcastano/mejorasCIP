<?php
include( "op_sesion.php" );
include( "../class/agrupaciones.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );


$resultado = array();
$agr = new agrupaciones();

$agr->setPla_Codigo( $_POST[ 'planta' ] );
$agr->setAgr_Nombre( $_POST[ 'nombre' ] );
$agr->setAgr_Tipo( $_POST[ 'tipo' ] );
$agr->setAgr_Secuencia( $_POST[ 'secuencia' ] );

$agr->setAgr_FechaHoraCrea($fecha.' '.$hora);
$agr->setAgr_UsuarioCrea($_SESSION['CP_Usuario']);
$agr->setAgr_Estado( '1' );

$resultado[ 'resultado' ] = $agr->insertar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agr->imprimirError();
}
echo json_encode( $resultado );
?>