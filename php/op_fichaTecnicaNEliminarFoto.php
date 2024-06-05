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
$fic->setFicT_Codigo( $_POST['codigo'] );
$fic->consultar();

if($_POST['foto'] == 'punzon'){
  $fic->setFicT_Foto(NULL);
}

if($_POST['foto'] == 'terminado'){
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