<?php
include( "op_sesion.php" );
include( "../class/puesta_puntos.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();

$pue = new puesta_puntos();

$pue->setVar_Codigo($_POST['variable']);
if($_POST['programaProduccion']){
  $pue->setProP_Codigo($_POST['programaProduccion']);
}else{
  $pue->setProP_Codigo(NULL);
}
$pue->setUsu_Codigo($_SESSION['CP_Usuario']);
$pue->setPueP_Fecha($_POST['fecha']);
$pue->setPueP_Hora($_POST['hora']);
$pue->setPueP_UnidadMedida($_POST['unidadMedida']);
$pue->setPueP_ValorControl($_POST['valorControl']);
$pue->setPueP_ValorTolerancia($_POST['tolerancia']);
$pue->setPueP_Operador($_POST['operador']);
$pue->setPueP_TipoVariable($_POST['tipo']);
$pue->setPueP_MotivoCambio($_POST['motivoCambio']);

$pue->setPueP_FechaHoraUsuarioCrea($fecha.' '.$hora);
$pue->setPueP_Estado('1');

$resultado[ 'resultado' ] = $pue->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $pue->imprimirError();
}
echo json_encode( $resultado );
?>