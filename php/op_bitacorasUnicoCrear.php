<?php
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
include_once("../class/usuarios.php");
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$bit= new bitacoras();

  $bit->setPla_Codigo($_POST['planta']);
  $bit->setUsu_Codigo($usu->getUsu_Codigo());
  $bit->setPueT_Codigo($_POST['puesto']);
  $bit->setBit_Fecha($fecha);
  $bit->setBit_Descripcion($_POST['descripcion']);
  $bit->setBit_Accion($_POST['accion']);
  $bit->setBit_Requerimiento($_POST['requerimiento']);
  //    $bit->setBit_SAM($lista9[$i]);
  $bit->setBit_SAP($_POST['sap']);

  $bit->setBit_FechaHoraCrea($fecha.' '.$hora);
  $bit->setBit_UsuarioCrea($_SESSION['CP_Usuario']);
  $bit->setBit_Estado( '1' );

  $resultado[ 'resultado' ] = $bit->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $bit->imprimirError();
}
echo json_encode( $resultado );
?>