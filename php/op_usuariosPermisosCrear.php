<?php
include( "op_sesion.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$usu = new usuarios_permisos();

$permiso = $_POST[ 'perCodigo' ];
foreach ( $permiso as $registro ) {

  $usu->setPer_Codigo( $registro );
  $usu->setUsu_Codigo( $_POST[ 'usuario' ] );
  $usu->setUsuP_Ver( '1' );
  $usu->setUsuP_Crear( '1' );
  $usu->setUsuP_Modificar( '1' );
  $usu->setUsuP_Eliminar( '1' );

  $usu->setUsuP_FechaHoraCrea( $fecha . ' ' . $hora );
  $usu->setUsuP_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $usu->setUsuP_Estado( '1' );


  $resultado[ 'resultado' ] = $usu->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $usu->imprimirError();
}
echo json_encode( $resultado );
?>