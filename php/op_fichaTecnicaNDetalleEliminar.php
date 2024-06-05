<?php
include( "op_sesion.php" );
include( "../class/detalle_ficha_tecnica.php" );

$resultado = array();

$det = new detalle_ficha_tecnica();

$det->setDetFT_Codigo($_POST['codigo']);
$det->consultar();

$det->setDetFT_Estado('0');

$resultado[ 'resultado' ] = $det->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $det->imprimirError();
}
echo json_encode( $resultado );
?>