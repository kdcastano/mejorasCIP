<?php
include( "op_sesion.php" );
include( "../class/permisos.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$per = new permisos();

$planta = $_POST[ 'planta' ];

$per->setPer_Modulo( $_POST[ 'modulo' ] );
$per->setPer_Tipo( $_POST[ 'tipo' ] );
$per->setPer_Descripcion( $_POST[ 'descrip' ] );
$per->setPer_Estado( '1' );


$resultado[ 'resultado' ] = $per->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $per->imprimirError();
}
echo json_encode( $resultado );
?>