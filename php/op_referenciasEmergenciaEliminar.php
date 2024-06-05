<?php
include( "op_sesion.php" );
include( "../class/referencias_emergencias.php" );

$resultado = array();
$ref = new referencias_emergencias();
$ref->setRefE_Codigo($_POST['codigo']);
$ref->consultar();


$ref->setRefE_Estado( '0' );


$resultado[ 'resultado' ] = $ref->actualizar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $ref->imprimirError();
}
echo json_encode( $resultado );
?>