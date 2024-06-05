<?php
include( "op_sesion.php" );
include( "../class/ficha_tecnica.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fechaL = date( "Ymd" );
$horaL = date( "His" );

$resultado = array();
$fic = new ficha_tecnica();
$fic->setFicT_Codigo( $_POST[ codigo ] );
$fic->consultar();

$fic->setPla_Codigo( $_POST[ 'planta' ] );
$fic->setFor_Codigo( $_POST[ 'formato' ] );
$fic->setFicT_Familia( $_POST[ 'familia' ] );
$fic->setFicT_Color( $_POST[ 'color' ] );
$fic->setFicT_FecEmision( $_POST[ 'fechaEmision' ] );
$fic->setFicT_CicloHorno(NULL);


$fic->setFicT_NombreArchivo( $_POST[ 'nombreArchivo' ] );

$ruta = "../files/ficha_tecnica/";

if ( $_POST[ 'foto' ] != "" ) {
  //Foto 1
  $arc1 = $_POST[ 'foto' ];
  $valores1 = explode( '.', $arc1 );
  $extension1 = end( $valores1 );
  $nombre_foto1 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PUNZONINFERIOR" . "_" . $fechaL . $horaL . "." . $extension1;

  rename( $ruta . $_POST[ 'foto' ], $ruta . $nombre_foto1 );
  $fic->setFicT_Foto( $nombre_foto1 );
} else {
  $fic->setFicT_Foto(NULL);
}

if ( $_POST[ 'fotoDos' ] != "" ) {
  //Foto 1
  $arc1 = $_POST[ 'fotoDos' ];
  $valores2 = explode( '.', $arc1 );
  $extension2 = end( $valores2 );
  $nombre_foto2 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PRODUCTOTERMINADO" . "_" . $fechaL . $horaL . "." . $extension2;

  rename( $ruta . $_POST[ 'fotoDos' ], $ruta . $nombre_foto2 );
  $fic->setFicT_FotoDos( $nombre_foto2 );
} else {
  $fic->setFicT_FotoDos(NULL);
}

$resultado[ 'resultado' ] = $fic->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $fic->imprimirError();
}
echo json_encode( $resultado );
?>