<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas_configft.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$agrMaqCFT = new agrupaciones_maquinas_configft();

$maquinas = $_POST['maquina'];

foreach($maquinas as $registro){
  $agrMaqCFT->setAgrM_Codigo($_POST['agrMaquina']);
  $agrMaqCFT->setMaq_Codigo($registro);

  $agrMaqCFT->setAgrMCon_FechaHoraCrea($fecha.' '.$hora);
  $agrMaqCFT->setAgrMCon_UsuarioCrea($_SESSION['CP_Usuario']);
  $agrMaqCFT->setAgrMCon_Estado( '1' );

  $resultado[ 'resultado' ] = $agrMaqCFT->insertar();
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $agrMaqCFT->imprimirError();
}
echo json_encode( $resultado );
?>