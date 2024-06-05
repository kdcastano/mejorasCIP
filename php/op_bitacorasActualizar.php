<?php
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );


$resultado = array();
$bit= new bitacoras();
$bit->setBit_Codigo($_POST['codigo']);
$bit->consultar();

$bit->setPla_Codigo( $_POST[ 'planta' ] );
$bit->setPueT_Codigo($_POST['puesto']);
$bit->setBit_Descripcion($_POST['descripcion']);
$bit->setBit_Accion($_POST['accion']);
$bit->setBit_Requerimiento($_POST['requerimiento']);
$bit->setBit_SAM($_POST['sam']);
$bit->setBit_SAP($_POST['sap']);

$resultado[ 'resultado' ] = $bit->actualizar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $bit->imprimirError();
}
echo json_encode( $resultado );
?>