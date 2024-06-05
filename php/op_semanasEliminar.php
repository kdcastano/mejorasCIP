<?php
include( "op_sesion.php" );
include( "../class/semanas.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$sem = new semanas();
$sem->setSem_Codigo($_POST['codigo']);
$sem->consultar();

$sem->setSem_Estado('0');


$resultado[ 'resultado' ] = $sem->actualizar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $sem->imprimirError();
}
echo json_encode( $resultado );
?>